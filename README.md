# JAX Hiring - Website Dịch Vụ Tìm Việc Làm Tích Hợp AI

**JAX Hiring** là nền tảng kết nối tuyển dụng và tìm kiếm việc làm trực tuyến thông minh, được tích hợp Trí tuệ nhân tạo (AI) nhằm tự động hóa quá trình đọc hiểu, phân tích hồ sơ ứng viên (CV) và đề xuất công việc phù hợp nhất. Dự án giúp rút ngắn thời gian sàng lọc hồ sơ cho nhà tuyển dụng, đồng thời hỗ trợ ứng viên định hướng nghề nghiệp chính xác hơn.

---

## Thông Tin Nhóm Thực Hiện

* **Giảng viên:** ThS. Nguyễn Thanh Tuấn
* **Lớp học phần:** Quản trị dự án (4)
* **Thành viên nhóm:**

| STT | Họ và Tên | Vai Trò | Trách Nhiệm Chính |
| :-: | :--- | :--- | :--- |
| 1 | **Nguyễn Thị Linh Chi** | Project Manager / Business Analyst | Quản lý tiến độ, Project Charter, WBS, Risk Register, Change Management |
| 2 | **Lê Thị Mỹ Duyên** | Technical Lead / Backend Developer | Kiến trúc kỹ thuật, Backend, tích hợp Laravel và FastAPI |
| 3 | **Trần Thu Phương** | Backend / AI Developer | AI Microservice, xử lý CV, bảo mật dữ liệu |
| 4 | **Nguyễn Thị Thanh Thảo** | Frontend / UI-UX / QA | Giao diện, UML, kiểm thử và tài liệu UI/UX |

---

## Tính Năng Chi Tiết

### 1. Phân Hệ Ứng Viên (Candidate)
* **Quản lý tài khoản & Hồ sơ cá nhân:** Đăng ký, đăng nhập (hỗ trợ đăng nhập nhanh qua mạng xã hội), cập nhật thông tin liên hệ, ảnh đại diện và trạng thái tìm việc.
* **Tìm kiếm & Lọc việc làm thông minh:** Tìm kiếm theo từ khóa (chức danh, kỹ năng, tên công ty) kết hợp bộ lọc đa tiêu chí: Ngành nghề, Khu vực địa lý, Mức lương mong muốn, Hình thức làm việc (`Full-time`, `Part-time`, `Remote`, `Internship`).
* **Quản lý CV & Ứng tuyển:**
  * Tạo CV trực tuyến theo mẫu có sẵn hoặc tải lên tệp CV cá nhân (hỗ trợ định dạng `.pdf`, `.png`, `.jpg`).
  * Lưu trữ công việc yêu thích (Bookmark) và theo dõi trạng thái hồ sơ đã ứng tuyển (`Chờ duyệt`, `Đã xem`, `Phù hợp`, `Từ chối`).
* ** Đánh giá & Phân tích CV bằng AI (Tính năng cốt lõi):**
  * Tự động trích xuất nội dung văn bản từ tệp CV tải lên (kể cả CV dạng ảnh hoặc PDF scan).
  * Phân loại và dự đoán top ngành nghề phù hợp nhất kèm tỷ lệ phần trăm tương thích.
  * Phân tích các từ khóa kỹ năng nổi bật có trong CV và đề xuất các việc làm đang tuyển dụng khớp với năng lực ứng viên.
* ** Trắc nghiệm tính cách MBTI:** Cung cấp bộ câu hỏi trắc nghiệm MBTI giúp sinh viên/ứng viên khám phá nhóm tính cách bản thân, từ đó nhận gợi ý về môi trường làm việc và lộ trình nghề nghiệp phù hợp.

### 2. Phân Hệ Nhà Tuyển Dụng (Employer)
* **Xây dựng thương hiệu tuyển dụng:** Cập nhật thông tin doanh nghiệp, logo, quy mô nhân sự, địa chỉ và giới thiệu văn hóa công ty.
* **Quản lý tin tuyển dụng:** Đăng tin tuyển dụng mới, chỉnh sửa nội dung, gia hạn thời gian hiển thị hoặc đóng tin khi đã tuyển đủ.
* **Quản lý quy trình ứng tuyển:** Xem danh sách ứng viên nộp hồ sơ vào từng vị trí, xem trực tiếp CV của ứng viên trên trình duyệt và cập nhật trạng thái xét duyệt.
* **Dashboard thống kê:** Biểu đồ trực quan theo dõi số lượng hồ sơ ứng tuyển theo từng tháng, tỷ lệ hồ sơ đạt yêu cầu và hiệu quả của các tin đăng.

### 3. Phân Hệ Quản Trị Viên (Admin)
* **Dashboard tổng quan:** Thống kê toàn diện số lượng người dùng (Ứng viên/Nhà tuyển dụng), tổng số tin tuyển dụng, lượt ứng tuyển và bài viết trên hệ thống.
* **Quản lý người dùng & Phân quyền:** Kiểm soát danh sách tài khoản, kích hoạt, khóa tài khoản vi phạm hoặc xóa người dùng.
* **Kiểm duyệt tin tuyển dụng:** Phê duyệt các tin tuyển dụng mới từ doanh nghiệp trước khi hiển thị công khai nhằm đảm bảo tính minh bạch, tránh tin rác/lừa đảo.
* **Quản trị danh mục & Nội dung:** Thêm/sửa/xóa các danh mục dùng chung (Ngành nghề, Khu vực, Mức lương, Loại hình công việc) và quản lý chuyên mục Cẩm nang hướng nghiệp (đăng bài viết chia sẻ kinh nghiệm phỏng vấn, viết CV).

---

## Kiến Trúc Hệ Thống & Luồng Xử Lý AI

Hệ thống được thiết kế theo kiến trúc **Decoupled Services** (Tách biệt dịch vụ), bao gồm ứng dụng Web chính và một Microservice chuyên xử lý tác vụ Trí tuệ nhân tạo, giao tiếp với nhau thông qua giao thức **RESTful API (JSON)**.

```text
+-------------------+       HTTP Request        +------------------------+
|                   | ------------------------> |                        |
|   Trình Duyệt     |                           |   Web Server (Laravel) |
|   (Người dùng)    | <------------------------ |   - Giao diện Blade    |
|                   |       HTML / JSON         |   - Nghiệp vụ MVC      |
+-------------------+                           +------------------------+
                                                          |     ^
                                      POST /analyze-cv    |     | JSON Response
                                      (Multipart File)    v     | (Ngành nghề, %)
                                                +------------------------+
                                                |   AI Service (FastAPI) |
                                                |   1. pdf2image         |
                                                |   2. Tesseract OCR     |
                                                |   3. Tiền xử lý NLP    |
                                                |   4. RoBERTa Model     |
                                                +------------------------+
```

### Quy trình xử lý của AI Service:
1. **Tiếp nhận dữ liệu:** Nhận file CV (`.pdf` hoặc ảnh) từ Laravel gửi sang thông qua endpoint của FastAPI.
2. **Chuyển đổi & Nhận dạng ký tự (OCR):** Nếu file là PDF, thư viện `pdf2image` sẽ chuyển đổi từng trang thành hình ảnh. Sau đó, **Tesseract OCR** trích xuất toàn bộ văn bản thô từ hình ảnh.
3. **Tiền xử lý văn bản (Text Preprocessing):** Làm sạch dữ liệu (loại bỏ ký tự đặc biệt, khoảng trắng thừa, chuẩn hóa chữ thường) và thực hiện Tokenization.
4. **Dự đoán bằng mô hình học sâu:** Đưa dữ liệu đã mã hóa qua mô hình **RoBERTa** (đã được Fine-tune trên tập dữ liệu CV đa ngành nghề) kết hợp trích xuất đặc trưng **TF-IDF** để tính toán xác suất tương thích.
5. **Trả kết quả:** Đóng gói kết quả dự đoán (Tên ngành nghề, độ tin cậy, từ khóa kỹ năng) dưới dạng JSON trả về cho Laravel hiển thị lên giao diện.

---

## Công Nghệ Sử Dụng

| Thành phần | Công nghệ / Thư viện | Mô tả vai trò |
| :--- | :--- | :--- |
| **Backend Web** | PHP 8.1+, **Laravel Framework** | Xây dựng kiến trúc MVC, Routing, Authentication, Eloquent ORM |
| **Frontend** | HTML5, CSS3, Bootstrap 5, JavaScript (jQuery/Ajax) | Xây dựng giao diện Responsive, tương tác bất đồng bộ |
| **AI Microservice** | Python 3.9+, **FastAPI**, Uvicorn | Xây dựng API hiệu năng cao phục vụ mô hình học máy |
| **AI / NLP / OCR** | PyTorch, HuggingFace Transformers (**RoBERTa**), Scikit-learn, **Tesseract OCR**, `pdf2image`, Pillow | Trích xuất văn bản từ CV và phân loại ngành nghề |
| **Cơ sở dữ liệu** | **MySQL** (XAMPP / phpMyAdmin) | Lưu trữ dữ liệu quan hệ của toàn bộ hệ thống |
| **Lưu trữ đám mây** | **Cloudinary API** | Lưu trữ và tối ưu hóa hình ảnh (Avatar, Logo công ty, Banner) |
| **Công cụ phát triển** | Visual Studio Code, Git, Postman | Lập trình, quản lý phiên bản và kiểm thử API |

---

##  Cấu Trúc Thư Mục Dự Án

```text
JAX-Hiring/
├── web-laravel/                  # Mã nguồn ứng dụng Web chính (Laravel)
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/      # Xử lý logic (Admin, Employer, Candidate, Auth)
│   │   │   └── Middleware/       # Phân quyền truy cập theo Role
│   │   └── Models/               # Eloquent Models (User, Job, Application, Company...)
│   ├── database/
│   │   ├── migrations/           # Cấu trúc bảng cơ sở dữ liệu
│   │   └── seeders/              # Dữ liệu mẫu khởi tạo
│   ├── public/                   # Tài nguyên tĩnh (CSS, JS, Images, Uploads)
│   ├── resources/
│   │   └── views/                # Giao diện Blade Templates (admin, employer, frontend)
│   ├── routes/
│   │   └── web.php               # Định tuyến toàn bộ trang web
│   └── .env.example              # File cấu hình môi trường mẫu
│
├── ai-service/                   # Mã nguồn dịch vụ AI (Python FastAPI)
│   ├── model/                    # Thư mục chứa trọng số mô hình RoBERTa đã huấn luyện
│   ├── main.py                   # File khởi chạy FastAPI và định nghĩa các API endpoints
│   ├── ocr_utils.py              # Module xử lý PDF và trích xuất văn bản Tesseract OCR
│   ├── predictor.py              # Module tiền xử lý và dự đoán ngành nghề
│   └── requirements.txt          # Danh sách các thư viện Python cần thiết
│
└── README.md                     # Tài liệu hướng dẫn dự án
```

---

##  Thiết Kế Cơ Sở Dữ Liệu

Hệ thống sử dụng cơ sở dữ liệu quan hệ **MySQL** gồm các bảng chính sau:

* `users`: Lưu thông tin tài khoản người dùng và phân quyền (`role`: Admin, Employer, Candidate).
* `companies`: Thông tin chi tiết về hồ sơ doanh nghiệp của nhà tuyển dụng.
* `jobs`: Lưu trữ thông tin các tin tuyển dụng (tiêu đề, mô tả, yêu cầu, quyền lợi, hạn nộp, trạng thái duyệt).
* `categories`, `locations`, `salaries`, `job_types`: Các bảng danh mục dùng để phân loại và lọc việc làm.
* `applications`: Lưu lịch sử ứng tuyển của ứng viên vào từng công việc (đính kèm đường dẫn file CV và trạng thái duyệt).
* `saved_jobs`: Danh sách công việc được ứng viên lưu lại.
* `blogs` / `posts`: Lưu trữ các bài viết thuộc chuyên mục Cẩm nang hướng nghiệp.
* `mbti_questions` & `mbti_results`: Lưu bộ câu hỏi trắc nghiệm và kết quả đánh giá tính cách.

---

##  Hướng Dẫn Cài Đặt và Triển Khai

### 1. Yêu cầu tiên quyết (Prerequisites)
Đảm bảo máy tính của bạn đã cài đặt đầy đủ các công cụ sau:
* **XAMPP** (hỗ trợ PHP >= 8.1 và MySQL).
* **Composer** (Trình quản lý gói cho PHP).
* **Python >= 3.9** và `pip`.

### 2. Cài đặt Cơ sở dữ liệu
1. Mở **XAMPP Control Panel**, khởi động **Apache** và **MySQL**.
2. Truy cập `http://localhost/phpmyadmin`.
3. Tạo một cơ sở dữ liệu mới với tên `jax_hiring` (chọn bảng mã `utf8mb4_unicode_ci`).
4. Chọn database vừa tạo $\rightarrow$ Tab **Import** $\rightarrow$ Chọn file `.sql` đính kèm trong thư mục dự án và nhấn **Go**.

### 3. Cài đặt & Chạy Web Application (Laravel)
Mở Terminal tại thư mục `web-laravel/` và thực hiện lần lượt các lệnh sau:

```bash
# 1. Cài đặt các thư viện phụ thuộc của PHP
composer install

# 2. Tạo file cấu hình môi trường từ file mẫu
cp .env.example .env

# 3. Tạo khóa bảo mật ứng dụng
php artisan key:generate

# 4. Tạo liên kết thư mục storage để hiển thị file tải lên
php artisan storage:link
```

Mở file `.env` và cập nhật các thông số cấu hình cho phù hợp với máy của bạn:

```env
APP_NAME="JAX Hiring"
APP_URL=[http://127.0.0.1:8000](http://127.0.0.1:8000)

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jax_hiring
DB_USERNAME=root
DB_PASSWORD=

# Cấu hình Cloudinary (nếu sử dụng)
CLOUDINARY_URL=cloudinary://your_api_key:your_api_secret@your_cloud_name

# Đường dẫn kết nối tới AI Service
AI_SERVICE_URL=[http://127.0.0.1:8001](http://127.0.0.1:8001)
```

Khởi chạy server Laravel:

```bash
php artisan serve
```
👉 Truy cập website tại: **`http://127.0.0.1:8000`**

### 4. Cài đặt & Chạy AI Service (FastAPI)
Mở một cửa sổ Terminal mới tại thư mục `ai-service/` và thực hiện các lệnh sau:

```bash
# 1. Tạo môi trường ảo Python
python -m venv venv

# 2. Kích hoạt môi trường ảo
# Trên Windows:
venv\Scripts\activate
# Trên macOS/Linux:
source venv/bin/activate

# 3. Cài đặt các thư viện AI cần thiết
pip install -r requirements.txt
# (Hoặc cài thủ công: pip install fastapi uvicorn python-multipart torch transformers scikit-learn pytesseract pdf2image pillow)

# 4. Khởi chạy FastAPI Server ở cổng 8001
uvicorn main:app --reload --host 127.0.0.1 --port 8001
```
👉 Kiểm tra tài liệu API tự động của AI Service tại: **`http://127.0.0.1:8001/docs`**

---

## 🔑 Tài Khoản Dùng Thử (Demo)

Sau khi import cơ sở dữ liệu mẫu, bạn có thể sử dụng các tài khoản sau để trải nghiệm đầy đủ các phân hệ của hệ thống:

| Vai trò | Email đăng nhập | Mật khẩu |
| :--- | :--- | :--- |
| **Quản trị viên (Admin)** | `admin@gmail.com` | `12345678` |
| **Nhà tuyển dụng (Employer)** | `employer@gmail.com` | `12345678` |
| **Ứng viên (Candidate)** | `candidate@gmail.com` | `12345678` |

---

## 🔧 Các Lỗi Thường Gặp & Cách Khắc Phục

1. **Lỗi `TesseractNotFoundError` khi phân tích CV:**
   * **Nguyên nhân:** Python không tìm thấy đường dẫn thực thi của phần mềm Tesseract OCR.
   * **Khắc phục:** Kiểm tra lại biến môi trường `PATH` trên Windows hoặc khai báo trực tiếp đường dẫn trong code Python:
     ```python
     pytesseract.pytesseract.tesseract_cmd = r'C:\Program Files\Tesseract-OCR\tesseract.exe'
     ```

2. **Lỗi `PDFInfoNotInstalledError` khi tải lên CV định dạng PDF:**
   * **Nguyên nhân:** Thư viện `pdf2image` yêu cầu công cụ Poppler để render file PDF.
   * **Khắc phục:** Tải Poppler cho Windows, giải nén và thêm thư mục `bin/` của Poppler vào biến môi trường `PATH`.

3. **Lỗi `cURL error 7: Failed to connect to 127.0.0.1 port 8001`:**
   * **Nguyên nhân:** Dịch vụ AI (FastAPI) chưa được khởi chạy hoặc chạy sai cổng.
   * **Khắc phục:** Đảm bảo Terminal chạy `uvicorn main:app --port 8001` đang hoạt động song song với `php artisan serve`.

---

## Hướng Phát Triển Tương Lai

* **Hỗ trợ đa ngôn ngữ chuyên sâu:** Nâng cấp mô hình lõi từ RoBERTa lên **XLM-RoBERTa** hoặc **PhoBERT** để tối ưu hóa độ chính xác khi đọc hiểu các CV viết hoàn toàn bằng tiếng Việt hoặc song ngữ Anh - Việt.
* **Chấm điểm & So khớp JD (CV - JD Matching):** Xây dựng thuật toán tính điểm mức độ phù hợp giữa một CV cụ thể với một bản Mô tả công việc (Job Description) chi tiết, đồng thời chỉ ra các kỹ năng còn thiếu (Skill Gap).
* **Tạo CV tự động bằng Generative AI:** Tích hợp LLM API giúp gợi ý viết lời giới thiệu bản thân và mô tả kinh nghiệm làm việc chuyên nghiệp cho ứng viên.
* **Triển khai thực tế (Deployment):** Đóng gói ứng dụng bằng **Docker** và triển khai lên nền tảng đám mây (AWS EC2 hoặc VPS) để phục vụ người dùng thực tế.