from fastapi import FastAPI, UploadFile, File, HTTPException
from fastapi.middleware.cors import CORSMiddleware
import os
import shutil
import joblib
import re
import json
from pathlib import Path
from pdf2image import convert_from_path
import pytesseract
from PIL import Image
from deep_translator import GoogleTranslator
import logging

# =========================
# CONFIGURATION
# =========================
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

app = FastAPI(title="CV Analyzer API", version="1.0")

# Cho phép Laravel gọi API
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],           # Production nên thay bằng domain của bạn
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# =========================
# PATHS
# =========================
BASE_DIR = Path(__file__).parent
UPLOAD_DIR = BASE_DIR / "uploads"
UPLOAD_DIR.mkdir(exist_ok=True)

# =========================
# LOAD MODEL & DATA
# =========================
try:
    model_data = joblib.load(BASE_DIR / "cv_model.joblib")
    model = model_data["model"]
    vectorizer = model_data["vectorizer"]
    le = model_data["label_encoder"]
    logger.info("✅ Model loaded successfully")
except Exception as e:
    logger.error(f"❌ Failed to load model: {e}")
    raise

# Load Job Profiles
try:
    with open(BASE_DIR / "cv_skill_dataset.json", "r", encoding="utf-8") as f:
        JOB_PROFILES = json.load(f)
    logger.info("✅ Job profiles loaded successfully")
except Exception as e:
    logger.error(f"❌ Failed to load job profiles: {e}")
    JOB_PROFILES = {}

# =========================
# OCR CONFIG
# =========================
pytesseract.pytesseract.tesseract_cmd = r"C:\Program Files\Tesseract-OCR\tesseract.exe"
POPPLER_PATH = r"C:\Users\LAPTOP ACER\Downloads\poppler-26.02.0\Library\bin"

# =========================
# HELPER FUNCTIONS
# =========================
def clean_text(text: str) -> str:
    text = text.lower()
    text = re.sub(r'[^\x00-\x7F]+', ' ', text)
    text = re.sub(r'[^a-z0-9\s]', ' ', text)
    text = re.sub(r'\s+', ' ', text)
    return text.strip()

def extract_text(file_path: Path) -> str:
    text = ""
    try:
        if file_path.suffix.lower() == ".pdf":
            pages = convert_from_path(str(file_path), poppler_path=POPPLER_PATH)
            for page in pages:
                text += pytesseract.image_to_string(page, lang='vie+eng') + "\n"
        else:
            img = Image.open(file_path)
            text = pytesseract.image_to_string(img, lang='vie+eng')
    except Exception as e:
        logger.error(f"OCR Error: {e}")
    return text

def translate_to_english(text: str) -> str:
    try:
        translator = GoogleTranslator(source='auto', target='en')
        # Giới hạn độ dài để tránh lỗi timeout
        return translator.translate(text[:4000])
    except:
        logger.warning("Translation failed, using original text")
        return text

def predict_industry(text: str) -> str:
    cleaned = clean_text(text)
    vec = vectorizer.transform([cleaned])
    pred = model.predict(vec)[0]
    return le.inverse_transform([pred])[0]

def contains_skill(cv_text: str, skill: str) -> bool:
    cv_text = cv_text.lower()
    skill = skill.lower()
    
    if skill in cv_text:
        return True
    
    SYNONYMS = {
        "cloud platforms": ["aws", "azure", "gcp", "cloud"],
        "etl pipeline": ["etl", "data pipeline"],
        "big data": ["spark", "hadoop", "kafka"],
        "data processing": ["pandas", "numpy", "data cleaning"],
    }
    
    if skill in SYNONYMS:
        return any(syn in cv_text for syn in SYNONYMS[skill])
    return False

def calculate_score(found: int, total: int) -> float:
    return round((found / total) * 100, 2) if total > 0 else 0

def analyze_cv(cv_text_en: str, predicted_job: str):
    job_key = predicted_job.replace(" ", "_").replace("/", "_")
    profile = JOB_PROFILES.get(job_key)
    
    if not profile:
        return {"strengths": [], "weaknesses": [], "score": 0}

    strengths = [skill for skill in profile.get("strengths", []) if contains_skill(cv_text_en, skill)]
    weaknesses = [skill for skill in profile.get("weaknesses", []) if not contains_skill(cv_text_en, skill)]

    score = calculate_score(len(strengths), len(profile.get("strengths", [])))

    return {
        "strengths": strengths,
        "weaknesses": weaknesses,
        "score": score
    }

# =========================
# ROUTES
# =========================
@app.get("/")
async def root():
    return {"message": "CV Analyzer API is running 🚀"}

@app.post("/predict")
async def predict_cv(file: UploadFile = File(...)):
    temp_file_path = None
    try:
        # Kiểm tra định dạng file
        if not file.filename.lower().endswith(('.pdf', '.docx', '.doc')):
            raise HTTPException(status_code=400, detail="Chỉ hỗ trợ file PDF, DOC, DOCX")

        # Lưu file tạm thời
        temp_file_path = UPLOAD_DIR / file.filename
        with open(temp_file_path, "wb") as buffer:
            shutil.copyfileobj(file.file, buffer)

        logger.info(f"Processing: {file.filename}")

        # 1. OCR
        raw_text = extract_text(temp_file_path)
        if not raw_text.strip():
            raise HTTPException(status_code=400, detail="Không thể đọc nội dung CV")

        # 2. Translate
        text_en = translate_to_english(raw_text)

        # 3. Predict Industry
        industry = predict_industry(text_en)

        # 4. Analyze
        analysis = analyze_cv(text_en, industry)

        return {
            "success": True,
            "filename": file.filename,
            "predicted_industry": industry,
            "ats_score": analysis["score"],
            "strengths": analysis["strengths"],
            "weaknesses": analysis["weaknesses"],
            "message": "Phân tích CV thành công"
        }

    except HTTPException as e:
        return {"error": e.detail}
    except Exception as e:
        logger.error(f"Error processing CV: {e}")
        return {"error": f"Lỗi hệ thống: {str(e)}"}
    finally:
        # Xóa file tạm sau khi xử lý
        if temp_file_path and temp_file_path.exists():
            try:
                os.remove(temp_file_path)
            except:
                pass

if __name__ == "__main__":
    import uvicorn
    uvicorn.run(app, host="0.0.0.0", port=8001)