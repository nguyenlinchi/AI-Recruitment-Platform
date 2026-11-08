from fastapi import FastAPI, UploadFile, File, HTTPException
from fastapi.middleware.cors import CORSMiddleware
import torch
from transformers import AutoTokenizer, AutoModelForSequenceClassification
import pickle
import os
import shutil
import re
import json
from pathlib import Path
from pdf2image import convert_from_path
import pytesseract
from PIL import Image
from deep_translator import GoogleTranslator
import logging

# ========================= CONFIGURATION =========================
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

app = FastAPI(title="CV Analyzer API", version="1.0")

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# ========================= PATHS =========================
BASE_DIR = Path(__file__).parent
UPLOAD_DIR = BASE_DIR / "uploads"
UPLOAD_DIR.mkdir(exist_ok=True)

MODEL_PATH = BASE_DIR / "cv_classifier"

# ========================= LOAD MODEL =========================
device = "cuda" if torch.cuda.is_available() else "cpu"
tokenizer = None
model = None
le = None

try:
    logger.info("🚀 Đang load model RoBERTa...")
    tokenizer = AutoTokenizer.from_pretrained(MODEL_PATH)
    model = AutoModelForSequenceClassification.from_pretrained(MODEL_PATH)
    model.to(device)
    model.eval()

    with open(MODEL_PATH / "label_encoder.pkl", "rb") as f:
        le = pickle.load(f)

    logger.info(f"✅ RoBERTa model loaded successfully!")
    logger.info(f"   Device: {device} | Labels: {model.config.num_labels}")

except Exception as e:
    logger.error(f"❌ Model load failed: {e}")
    raise

# ========================= JOB PROFILES =========================
try:
    with open(BASE_DIR / "cv_skill_dataset.json", "r", encoding="utf-8") as f:
        JOB_PROFILES = json.load(f)
    logger.info("✅ Job profiles loaded")
except:
    JOB_PROFILES = {}
    logger.warning("⚠️ Không tìm thấy cv_skill_dataset.json")

# ========================= OCR CONFIG =========================
pytesseract.pytesseract.tesseract_cmd = r"D:\DACN\Tesseract-OCR\tesseract.exe"
POPPLER_PATH = r"D:\Release-26.02.0-0\poppler-26.02.0\Library\bin"

# ========================= HELPER FUNCTIONS =========================
def clean_text(text: str) -> str:
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
        return translator.translate(text[:4500])
    except:
        logger.warning("Translation failed, using original text")
        return text

def predict_industry(text: str):
    global tokenizer, model, le, device
    text_en = translate_to_english(text)
    inputs = tokenizer(text_en, truncation=True, padding=True, max_length=256, return_tensors="pt").to(device)
    
    with torch.no_grad():
        outputs = model(**inputs)
        probs = torch.nn.functional.softmax(outputs.logits, dim=-1)
        pred_id = probs.argmax().item()
        confidence = probs[0][pred_id].item()

    predicted = le.inverse_transform([pred_id])[0]
    return predicted, round(confidence * 100, 2)

def analyze_cv(cv_text_en: str, predicted_job: str):
    job_key = predicted_job.replace(" ", "_").lower()
    profile = JOB_PROFILES.get(job_key)
    
    if not profile:
        return {"strengths": [], "weaknesses": [], "score": 50}

    strengths = [skill for skill in profile.get("strengths", []) if skill.lower() in cv_text_en.lower()]
    weaknesses = [skill for skill in profile.get("weaknesses", []) if skill.lower() not in cv_text_en.lower()]

    score = round((len(strengths) / max(len(profile.get("strengths", [])), 1)) * 100, 2)

    return {
        "strengths": strengths[:8],
        "weaknesses": weaknesses[:5],
        "score": score
    }

# ========================= ROUTES =========================
@app.get("/")
async def root():
    return {"message": "CV Analyzer API is running 🚀"}

@app.post("/predict")
async def predict_cv(file: UploadFile = File(...)):
    temp_file_path = None
    try:
        if not file.filename.lower().endswith(('.pdf', '.docx', '.doc')):
            raise HTTPException(400, detail="Chỉ hỗ trợ PDF, DOC, DOCX")

        temp_file_path = UPLOAD_DIR / file.filename
        with open(temp_file_path, "wb") as buffer:
            shutil.copyfileobj(file.file, buffer)

        logger.info(f"Processing: {file.filename}")

        raw_text = extract_text(temp_file_path)
        if len(raw_text.strip()) < 30:
            raise HTTPException(400, detail="Không thể đọc nội dung CV")

        # Predict Industry
        predicted_industry, confidence = predict_industry(raw_text)

        # Analyze
        text_en = translate_to_english(raw_text)
        analysis = analyze_cv(text_en, predicted_industry)

        return {
            "success": True,
            "predicted_industry": predicted_industry,
            "confidence": confidence,
            "ats_score": analysis["score"],
            "strengths": analysis["strengths"],
            "weaknesses": analysis["weaknesses"],
            "message": "Phân tích CV thành công"
        }

    except Exception as e:
        logger.error(f"Error processing CV: {e}")
        return {"error": str(e)}
    finally:
        if temp_file_path and temp_file_path.exists():
            try:
                os.remove(temp_file_path)
            except:
                pass