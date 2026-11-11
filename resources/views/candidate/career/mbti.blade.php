@extends('layout.header')

@section('content')

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:"Segoe UI",sans-serif;
}

body{
    background:#f4f8ff;
    color:#1e293b;
}

.hero{
    background:linear-gradient(135deg,#0f4c81,#2563eb);
    padding:80px 20px;
    text-align:center;
    color:white;
    position:relative;
    overflow:hidden;
}

.hero h1{
    font-size:40px;
    margin-bottom:10px;
    margin-top:30px;
}

.hero p{
    opacity:.9;
    font-size:17px;
}

.hero::before,
.hero::after{
    content:"";
    position:absolute;
    width:260px;
    height:260px;
    border-radius:50%;
    background:linear-gradient(45deg,#60a5fa,#38bdf8);
    opacity:.15;
}

.hero::before{
    top:-60px;
    left:-60px;
}

.hero::after{
    bottom:-60px;
    right:-60px;
}

.btn-start{
    margin-top:25px;
    display:inline-block;
    padding:14px 30px;
    background:white;
    color:#2563eb;
    border-radius:40px;
    font-weight:700;
    text-decoration:none;
    transition:.3s;
    box-shadow:0 8px 20px rgba(255,255,255,.2);
}

.btn-start:hover{
    transform:translateY(-4px);
    background:#eff6ff;
}

.slider{
    margin-top:55px;
    overflow:hidden;
}

.slider-track{
    display:flex;
    animation:scroll 40s linear infinite;
    width:max-content;
}

.slider:hover .slider-track{
    animation-play-state:paused;
}

.card{
    display:flex;
    width:320px;
    margin:0 12px;
    background:white;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(37,99,235,.12);
    transition:.35s;
}

.card:hover{
    transform:translateY(-10px);
}

.card img{
    width:120px;
    object-fit:cover;
}

.card-content{
    padding:18px;
}

.card-content h3{
    font-size:16px;
    margin-bottom:8px;
    color:#0f172a;
}

.card-content p{
    font-size:14px;
    color:#64748b;
}

@keyframes scroll{
    from{
        transform:translateX(0);
    }
    to{
        transform:translateX(-50%);
    }
}

.mbti-section{
    background:white;
    padding:90px 10%;
}

.mbti-title{
    font-size:38px;
    color:#1d4ed8;
    margin-bottom:45px;
    font-weight:800;
}

.mbti-content{
    display:flex;
    align-items:center;
    gap:60px;
}

.mbti-image img{
    width:400px;
    border-radius:25px;
}

.mbti-text{
    line-height:1.9;
    color:#334155;
    font-size:16px;
}

.section{
    padding:90px 10%;
    background:#f8fbff;
}

.section h1{
    font-size:38px;
    color:#1d4ed8;
}

.section p{
    margin-top:15px;
    max-width:700px;
    color:#64748b;
    line-height:1.8;
}

.grid{
    margin-top:45px;
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:25px;
}

.card-grid{
    background:white;
    border-radius:24px;
    padding:22px;
    box-shadow:0 10px 25px rgba(37,99,235,.08);
}

.card-img{
    height:150px;
    border-radius:18px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px;
    color:white;
    font-size:34px;
    font-weight:800;
}

.card-bottom{
    margin-top:18px;
    display:flex;
    gap:12px;
    align-items:center;
}

.card-bottom p{
    margin:0;
    font-size:15px;
    font-weight:600;
    color:#334155;
}

.number{
    width:38px;
    height:38px;
    background:#2563eb;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-weight:700;
}

.bg-ei{
    background:linear-gradient(135deg,#2563eb,#38bdf8);
}

.bg-sn{
    background:linear-gradient(135deg,#0ea5e9,#6366f1);
}

.bg-tf{
    background:linear-gradient(135deg,#3b82f6,#8b5cf6);
}

.bg-jp{
    background:linear-gradient(135deg,#2563eb,#06b6d4);
}

.mbti-container{
    background:linear-gradient(135deg,#0f172a,#1e3a8a);
    padding:80px 20px;
    text-align:center;
}

.main-title{
    color:#fff;
    font-size:36px;
    margin-bottom:45px;
    font-weight:800;
}

.mbti-grid{
    display:none;
    grid-template-columns:repeat(4,1fr);
    gap:22px;
    max-width:1200px;
    margin:auto;
    margin-top:30px;
}

#p1:checked ~ #page-1{
    display:grid;
}

#p2:checked ~ #page-2{
    display:grid;
}

.mbti-card{
    position:relative;
    width:100%;
    height:380px;
    perspective:1000px;
    cursor:pointer;
}

.card-inner{
    position:relative;
    width:100%;
    height:100%;
    transition:transform .8s;
    transform-style:preserve-3d;
}

.mbti-card:hover .card-inner{
    transform:rotateY(180deg);
}

.card-front,
.card-back{
    position:absolute;
    width:100%;
    height:100%;
    backface-visibility:hidden;
    border-radius:28px;
    overflow:hidden;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
}

.card-front{
    background:white;
    box-shadow:0 10px 30px rgba(37,99,235,.15);
    padding:20px;
}

.card-back{
    background:#eff6ff;
    transform:rotateY(180deg);
    padding:25px;
    border:2px solid #93c5fd;
}

.card-back h3{
    margin-bottom:15px;
    color:#1d4ed8;
    font-size:24px;
}

.card-back ul{
    list-style:none;
    padding:0;
    line-height:2;
    color:#334155;
}

.btn-detail{
    margin-top:18px;
    padding:10px 24px;
    background:#2563eb;
    color:white;
    text-decoration:none;
    border-radius:30px;
    font-size:14px;
    font-weight:700;
    transition:.3s;
}

.btn-detail:hover{
    background:#1d4ed8;
}

.type-title{
    font-size:44px;
    font-weight:900;
    margin-bottom:5px;
}

.type-desc{
    font-size:16px;
    color:#64748b;
    margin-bottom:18px;
}

.type-img img{
    width:100%;
    max-width:180px;
}

.color-istj{color:#2563eb;}
.color-infp{color:#0ea5e9;}
.color-intj{color:#6366f1;}
.color-isfj{color:#3b82f6;}
.color-istp{color:#0284c7;}
.color-infj{color:#4f46e5;}
.color-intp{color:#06b6d4;}
.color-isfp{color:#60a5fa;}

.border-istj{border-bottom:8px solid #2563eb;}
.border-infp{border-bottom:8px solid #0ea5e9;}
.border-intj{border-bottom:8px solid #6366f1;}
.border-isfj{border-bottom:8px solid #3b82f6;}
.border-istp{border-bottom:8px solid #0284c7;}
.border-infj{border-bottom:8px solid #4f46e5;}
.border-intp{border-bottom:8px solid #06b6d4;}
.border-isfp{border-bottom:8px solid #60a5fa;}

.pagination-dots{
    margin-top:35px;
}

.dot{
    width:12px;
    height:12px;
    background:#94a3b8;
    display:inline-block;
    border-radius:50%;
    margin:0 6px;
    cursor:pointer;
    transition:.3s;
}

#p1:checked ~ .pagination-dots #dot-1,
#p2:checked ~ .pagination-dots #dot-2{
    background:#38bdf8;
    transform:scale(1.3);
}

.guide-container{
    max-width:1100px;
    margin:60px auto;
    padding:70px 80px;
    background:white;
    border-radius:40px;
    box-shadow:0 10px 35px rgba(37,99,235,.08);
}

.guide-title{
    color:#1d4ed8;
    font-size:34px;
    margin-bottom:50px;
    font-weight:800;
}

.guide-item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:40px 0;
    border-top:1px solid #dbeafe;
}

.guide-content{
    flex:2;
    padding-right:40px;
}

.item-reverse .guide-content{
    padding-right:0;
    padding-left:40px;
}

.guide-content h3{
    color:#2563eb;
    font-size:26px;
    margin-bottom:15px;
}

.guide-content p{
    color:#475569;
    line-height:1.9;
}

.guide-icon img{
    max-width:220px;
}

.action-center{
    display:flex;
    justify-content:center;
    margin-top:35px;
}

.btn-main-test{
    background:linear-gradient(135deg,#2563eb,#38bdf8);
    color:white;
    text-decoration:none;
    padding:15px 45px;
    border-radius:50px;
    font-size:18px;
    font-weight:700;
    transition:.3s;
}

.btn-main-test:hover{
    transform:translateY(-4px);
    box-shadow:0 12px 25px rgba(37,99,235,.25);
}

.faq-container{
    max-width:1100px;
    margin:70px auto;
    padding:0 40px;
}

.faq-main-title{
    color:#1d4ed8;
    font-size:38px;
    font-weight:800;
    margin-bottom:45px;
}

.faq-list{
    background:white;
    border-radius:28px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(37,99,235,.08);
}

.faq-item{
    border-bottom:1px solid #dbeafe;
    padding:24px 30px;
}

summary{
    list-style:none;
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-size:20px;
    font-weight:700;
    color:#1e3a8a;
    cursor:pointer;
}

summary::-webkit-details-marker{
    display:none;
}

.faq-content{
    padding-top:18px;
    color:#475569;
    line-height:1.8;
    animation:fadeIn .4s ease;
}

.faq-icon{
    position:relative;
    width:20px;
    height:20px;
}

.faq-icon::before,
.faq-icon::after{
    content:'';
    position:absolute;
    background:#2563eb;
    transition:.3s;
}

.faq-icon::before{
    top:9px;
    left:0;
    width:100%;
    height:2px;
}

.faq-icon::after{
    top:0;
    left:9px;
    width:2px;
    height:100%;
}

details[open] .faq-icon::after{
    opacity:0;
    transform:rotate(90deg);
}

@keyframes fadeIn{
    from{
        opacity:0;
        transform:translateY(-10px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

@media(max-width:992px){

    .mbti-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .mbti-content{
        flex-direction:column;
    }

    .grid{
        grid-template-columns:1fr;
    }
}

@media(max-width:768px){

    .hero h1{
        font-size:32px;
    }

    .mbti-title,
    .section h1,
    .guide-title,
    .faq-main-title{
        font-size:28px;
    }

    .guide-item,
    .item-reverse{
        flex-direction:column-reverse;
        text-align:center;
    }

    .guide-content,
    .item-reverse .guide-content{
        padding:20px 0;
    }

    .mbti-grid{
        grid-template-columns:1fr;
    }

    .guide-container{
        padding:50px 30px;
    }
}
</style>

</head>

<body>

<div class="hero" id="tinh-cach">
    <h1>TRẮC NGHIỆM TÍNH CÁCH MBTI</h1>
    <p>Tỏa sáng năng lực nghề nghiệp</p>

    <a href="{{ route('mbti.test') }}" class="btn-start">Làm bài test →</a>

    <div class="slider">
        <div class="slider-track">

            <!-- CARD -->
            <div class="card">
                <img src="https://i.imgur.com/k5bX6zX.png">
                <div class="card-content">
                    <h3>INTJ - Nhà khoa học</h3>
                    <p>Chiến lược, logic</p>
                </div>
            </div>

            <div class="card">
                <img src="https://i.imgur.com/2DhmtJ4.png">
                <div class="card-content">
                    <h3>INFP - Người lý tưởng</h3>
                    <p>Sáng tạo, nhạy cảm</p>
                </div>
            </div>

            <div class="card">
                <img src="https://i.imgur.com/yK3K7bM.png">
                <div class="card-content">
                    <h3>INFJ - Người che chở</h3>
                    <p>Sâu sắc, lý tưởng</p>
                </div>
            </div>

            <div class="card">
                <img src="https://i.imgur.com/k5bX6zX.png">
                <div class="card-content">
                    <h3>INTP - Nhà tư duy</h3>
                    <p>Phân tích, sáng tạo</p>
                </div>
            </div>

            <div class="card">
                <img src="https://i.imgur.com/yK3K7bM.png">
                <div class="card-content">
                    <h3>ENTJ - Nhà lãnh đạo</h3>
                    <p>Quyết đoán, chiến lược</p>
                </div>
            </div>

            <div class="card">
                <img src="https://i.imgur.com/2DhmtJ4.png">
                <div class="card-content">
                    <h3>ENTP - Nhà tranh luận</h3>
                    <p>Thông minh, linh hoạt</p>
                </div>
            </div>

            <div class="card">
                <img src="https://i.imgur.com/k5bX6zX.png">
                <div class="card-content">
                    <h3>ENFJ - Người dẫn dắt</h3>
                    <p>Truyền cảm hứng</p>
                </div>
            </div>

            <div class="card">
                <img src="https://i.imgur.com/yK3K7bM.png">
                <div class="card-content">
                    <h3>ENFP - Người truyền cảm</h3>
                    <p>Nhiệt huyết</p>
                </div>
            </div>

            <div class="card">
                <img src="https://i.imgur.com/2DhmtJ4.png">
                <div class="card-content">
                    <h3>ISTJ - Người trách nhiệm</h3>
                    <p>Kỷ luật, đáng tin</p>
                </div>
            </div>

            <div class="card">
                <img src="https://i.imgur.com/k5bX6zX.png">
                <div class="card-content">
                    <h3>ISFJ - Người bảo vệ</h3>
                    <p>Tận tụy, chu đáo</p>
                </div>
            </div>

            <div class="card">
                <img src="https://i.imgur.com/yK3K7bM.png">
                <div class="card-content">
                    <h3>ESTJ - Nhà điều hành</h3>
                    <p>Tổ chức tốt</p>
                </div>
            </div>

            <div class="card">
                <img src="https://i.imgur.com/2DhmtJ4.png">
                <div class="card-content">
                    <h3>ESFJ - Người chăm sóc</h3>
                    <p>Hòa đồng</p>
                </div>
            </div>

            <div class="card">
                <img src="https://i.imgur.com/k5bX6zX.png">
                <div class="card-content">
                    <h3>ISTP - Nhà cơ khí</h3>
                    <p>Thực tế, linh hoạt</p>
                </div>
            </div>

            <div class="card">
                <img src="https://i.imgur.com/yK3K7bM.png">
                <div class="card-content">
                    <h3>ISFP - Nghệ sĩ</h3>
                    <p>Sáng tạo, nhẹ nhàng</p>
                </div>
            </div>

            <div class="card">
                <img src="https://i.imgur.com/2DhmtJ4.png">
                <div class="card-content">
                    <h3>ESTP - Người hành động</h3>
                    <p>Năng động</p>
                </div>
            </div>

            <div class="card">
                <img src="https://i.imgur.com/k5bX6zX.png">
                <div class="card-content">
                    <h3>ESFP - Người trình diễn</h3>
                    <p>Vui vẻ, hoạt bát</p>
                </div>
            </div>

            <!-- Lặp lại để scroll mượt -->
            <div class="card">
                <img src="https://i.imgur.com/k5bX6zX.png">
                <div class="card-content">
                    <h3>INTJ - Nhà khoa học</h3>
                    <p>Chiến lược, logic</p>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="mbti-section">

    <h1 class="mbti-title">Trắc nghiệm tính cách MBTI là gì?</h1>

    <div class="mbti-content">

        <div class="mbti-image">
            <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1757086816/39_szkvi5.jpg">
        </div>

        <div class="mbti-text">
            <p><strong>MBTI</strong> là phương pháp trắc nghiệm giúp phân tích tính cách con người thông qua các câu hỏi.</p>
            <p>
                Hiện nay, MBTI được coi là công cụ khám phá tính cách phổ biến và chính xác.
                Trong công việc, MBTI giúp mỗi cá nhân định hướng nghề nghiệp và lựa chọn môi trường phù hợp.
            </p>

            <p>
                Nhà tuyển dụng cũng có thể sử dụng MBTI để đánh giá mức độ phù hợp của ứng viên
                với vị trí công việc và văn hóa doanh nghiệp.
            </p>
        </div>

    </div>


</div>
<div class="section">
    <h1>Cách MBTI phân loại</h1>
    <p>MBTI chia thành 4 nhóm chính:</p>

    <div class="grid">

        <div class="card-grid">
            <div class="card-img bg-ei">
                <span>E</span>
                <span>I</span>
            </div>
            <div class="card-bottom">
                <div class="number">01</div>
                <p>Năng lượng</p>
            </div>
        </div>

        <div class="card-grid">
            <div class="card-img bg-sn">
                <span>S</span>
                <span>N</span>
            </div>
            <div class="card-bottom">
                <div class="number">02</div>
                <p>Nhận thức</p>
            </div>
        </div>

        <div class="card-grid">
            <div class="card-img bg-tf">
                <span>T</span>
                <span>F</span>
            </div>
            <div class="card-bottom">
                <div class="number">03</div>
                <p>Quyết định</p>
            </div>
        </div>

        <div class="card-grid">
            <div class="card-img bg-jp">
                <span>J</span>
                <span>P</span>
            </div>
            <div class="card-bottom">
                <div class="number">04</div>
                <p>Lối sống</p>
            </div>
        </div>

    </div>
</div>
<div class="mbti-container">
    <h1 class="main-title">16 nhóm tính cách MBTI</h1>
    <input type="radio" name="mbti-page" id="p1" checked hidden>
    <input type="radio" name="mbti-page" id="p2" hidden>
    
    <div class="mbti-grid" id="page-1">
        <div class="mbti-card">
            <div class="card-inner">
                <div class="card-front border-istj">
                    <h2 class="type-title color-istj">ISTJ</h2>
                    <p class="type-desc">Người trách nhiệm </p>
                    <div class="type-img">
                        <img src="https://i.imgur.com/k5bX6zX.png" alt="ISTJ">
                    </div>
                </div>
                
                <div class="card-back bg-istj">
                    <h3>Đặc điểm ISTJ</h3>
                    <ul>
                        <li>Thực tế & Logic</li>
                        <li>Trọng lời hứa</li>
                        <li>Thích sự ngăn nắp</li>
                    </ul>
                    <a href="#" class="btn-detail">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="mbti-card">
            <div class="card-inner">
                <div class="card-front border-infp">
                    <h2 class="type-title color-infp">INFP</h2>
                    <p class="type-desc">Người lý tưởng hóa </p>
                    <div class="type-img">
                        <img src="https://i.imgur.com/k5bX6zX.png" alt="INFP">
                    </div>
                </div>
                
                <div class="card-back bg-infp">
                    <h3>Đặc điểm ISTJ</h3>
                    <ul>
                        <li>Thực tế & Logic</li>
                        <li>Trọng lời hứa</li>
                        <li>Thích sự ngăn nắp</li>
                    </ul>
                    <a href="#" class="btn-detail">Xem chi tiết</a>
                </div>
            </div>
        </div>

        <div class="mbti-card">
            <div class="card-inner">
                <div class="card-front border-istj">
                    <h2 class="type-title color-istj">ISFP</h2>
                    <p class="type-desc">Người nghệ sĩ </p>
                    <div class="type-img">
                        <img src="https://i.imgur.com/k5bX6zX.png" alt="ISTJ">
                    </div>
                </div>
                
                <div class="card-back bg-istj">
                    <h3>Đặc điểm ISTJ</h3>
                    <ul>
                        <li>Thực tế & Logic</li>
                        <li>Trọng lời hứa</li>
                        <li>Thích sự ngăn nắp</li>
                    </ul>
                    <a href="#" class="btn-detail">Xem chi tiết</a>
                </div>
            </div>
        </div>

       
        <div class="mbti-card">
            <div class="card-inner">
                <div class="card-front border-intj">
                    <h2 class="type-title color-intj">INTJ</h2>
                    <p class="type-desc">Người khoa học</p>
                    <div class="type-img">
                        <img src="https://i.imgur.com/k5bX6zX.png" alt="INTJ">
                    </div>
                </div>
                
                <div class="card-back bg-intj">
                    <h3>Đặc điểm ISTJ</h3>
                    <ul>
                        <li>Thực tế & Logic</li>
                        <li>Trọng lời hứa</li>
                        <li>Thích sự ngăn nắp</li>
                    </ul>
                    <a href="#" class="btn-detail">Xem chi tiết</a>
                </div>
            </div>
        </div>

        <div class="mbti-card">
            <div class="card-inner">
                <div class="card-front border-isfj">
                    <h2 class="type-title color-isfj">ISFJ</h2>
                    <p class="type-desc">Người nuôi dưỡng </p>
                    <div class="type-img">
                        <img src="https://i.imgur.com/k5bX6zX.png" alt="ISFJ">
                    </div>
                </div>
                
                <div class="card-back bg-isfj">
                    <h3>Đặc điểm ISTJ</h3>
                    <ul>
                        <li>Thực tế & Logic</li>
                        <li>Trọng lời hứa</li>
                        <li>Thích sự ngăn nắp</li>
                    </ul>
                    <a href="#" class="btn-detail">Xem chi tiết</a>
                </div>
            </div>
        </div>

        <div class="mbti-card">
            <div class="card-inner">
                <div class="card-front border-istp">
                    <h2 class="type-title color-istp">ISTP</h2>
                    <p class="type-desc">Nhà kĩ thuật </p>
                    <div class="type-img">
                        <img src="https://i.imgur.com/k5bX6zX.png" alt="ISTP">
                    </div>
                </div>
                
                <div class="card-back bg-istp">
                    <h3>Đặc điểm ISTJ</h3>
                    <ul>
                        <li>Thực tế & Logic</li>
                        <li>Trọng lời hứa</li>
                        <li>Thích sự ngăn nắp</li>
                    </ul>
                    <a href="#" class="btn-detail">Xem chi tiết</a>
                </div>
            </div>
        </div>

        <div class="mbti-card">
            <div class="card-inner">
                <div class="card-front border-infj">
                    <h2 class="type-title color-infj">INFJ</h2>
                    <p class="type-desc">Người che chở </p>
                    <div class="type-img">
                        <img src="https://i.imgur.com/k5bX6zX.png" alt="INFJ">
                    </div>
                </div>
                
                <div class="card-back bg-infj">
                    <h3>Đặc điểm ISTJ</h3>
                    <ul>
                        <li>Thực tế & Logic</li>
                        <li>Trọng lời hứa</li>
                        <li>Thích sự ngăn nắp</li>
                    </ul>
                    <a href="#" class="btn-detail">Xem chi tiết</a>
                </div>
            </div>
        </div>

        <div class="mbti-card">
            <div class="card-inner">
                <div class="card-front border-intp">
                    <h2 class="type-title color-intp">INTP</h2>
                    <p class="type-desc">Người tư duy</p>
                    <div class="type-img">
                        <img src="https://i.imgur.com/k5bX6zX.png" alt="INTP">
                    </div>
                </div>
                
                <div class="card-back bg-intp">
                    <h3>Đặc điểm ISTJ</h3>
                    <ul>
                        <li>Thực tế & Logic</li>
                        <li>Trọng lời hứa</li>
                        <li>Thích sự ngăn nắp</li>
                    </ul>
                    <a href="#" class="btn-detail">Xem chi tiết</a>
                </div>
            </div>
        </div>
    </div>
     <div class="mbti-grid" id="page-2">
        <div class="mbti-card">
            <div class="card-inner">
                <div class="card-front border-istj">
                    <h2 class="type-title color-istj">ISTJ</h2>
                    <p class="type-desc">Người trách nhiệm </p>
                    <div class="type-img">
                        <img src="https://i.imgur.com/k5bX6zX.png" alt="ISTJ">
                    </div>
                </div>
                
                <div class="card-back bg-istj">
                    <h3>Đặc điểm ISTJ</h3>
                    <ul>
                        <li>Thực tế & Logic</li>
                        <li>Trọng lời hứa</li>
                        <li>Thích sự ngăn nắp</li>
                    </ul>
                    <a href="#" class="btn-detail">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="mbti-card">
            <div class="card-inner">
                <div class="card-front border-infp">
                    <h2 class="type-title color-infp">INFP</h2>
                    <p class="type-desc">Người lý tưởng hóa </p>
                    <div class="type-img">
                        <img src="https://i.imgur.com/k5bX6zX.png" alt="INFP">
                    </div>
                </div>
                
                <div class="card-back bg-infp">
                    <h3>Đặc điểm ISTJ</h3>
                    <ul>
                        <li>Thực tế & Logic</li>
                        <li>Trọng lời hứa</li>
                        <li>Thích sự ngăn nắp</li>
                    </ul>
                    <a href="#" class="btn-detail">Xem chi tiết</a>
                </div>
            </div>
        </div>

        <div class="mbti-card">
            <div class="card-inner">
                <div class="card-front border-istj">
                    <h2 class="type-title color-istj">ISFP</h2>
                    <p class="type-desc">Người nghệ sĩ </p>
                    <div class="type-img">
                        <img src="https://i.imgur.com/k5bX6zX.png" alt="ISTJ">
                    </div>
                </div>
                
                <div class="card-back bg-istj">
                    <h3>Đặc điểm ISTJ</h3>
                    <ul>
                        <li>Thực tế & Logic</li>
                        <li>Trọng lời hứa</li>
                        <li>Thích sự ngăn nắp</li>
                    </ul>
                    <a href="#" class="btn-detail">Xem chi tiết</a>
                </div>
            </div>
        </div>

       
        <div class="mbti-card">
            <div class="card-inner">
                <div class="card-front border-intj">
                    <h2 class="type-title color-intj">INTJ</h2>
                    <p class="type-desc">Người khoa học</p>
                    <div class="type-img">
                        <img src="https://i.imgur.com/k5bX6zX.png" alt="INTJ">
                    </div>
                </div>
                
                <div class="card-back bg-intj">
                    <h3>Đặc điểm ISTJ</h3>
                    <ul>
                        <li>Thực tế & Logic</li>
                        <li>Trọng lời hứa</li>
                        <li>Thích sự ngăn nắp</li>
                    </ul>
                    <a href="#" class="btn-detail">Xem chi tiết</a>
                </div>
            </div>
        </div>

        <div class="mbti-card">
            <div class="card-inner">
                <div class="card-front border-isfj">
                    <h2 class="type-title color-isfj">ISFJ</h2>
                    <p class="type-desc">Người nuôi dưỡng </p>
                    <div class="type-img">
                        <img src="https://i.imgur.com/k5bX6zX.png" alt="ISFJ">
                    </div>
                </div>
                
                <div class="card-back bg-isfj">
                    <h3>Đặc điểm ISTJ</h3>
                    <ul>
                        <li>Thực tế & Logic</li>
                        <li>Trọng lời hứa</li>
                        <li>Thích sự ngăn nắp</li>
                    </ul>
                    <a href="#" class="btn-detail">Xem chi tiết</a>
                </div>
            </div>
        </div>

       

    </div>
    <div class="pagination-dots">
        <label for="p1" class="dot" id="dot-1"></label>
        <label for="p2" class="dot" id="dot-2"></label>
    </div>
</div>

<div class="guide-container">
    <h2 class="guide-title">Hướng dẫn làm trắc nghiệm MBTI để có kết quả chính xác nhất</h2>

    <div class="guide-list">
        <div class="guide-item">
            <div class="guide-content">
                <h3>Giữ tâm trạng ổn định</h3>
                <p>Kết quả của một trắc nghiệm tâm lý phụ thuộc rất nhiều vào tâm trạng của bạn, vậy nên hãy thực hiện nó trong một trạng thái tâm lý bình ổn nhất.</p>
            </div>
            <div class="guide-icon">
                <img src="https://i.imgur.com/WlG397f.png" alt="Tâm trạng">
            </div>
        </div>

        <div class="guide-item item-reverse">
            <div class="guide-icon">
                <img src="https://i.imgur.com/pZzB0B6.png" alt="Trung thực">
            </div>
            <div class="guide-content">
                <h3>Trung thực khi trả lời câu hỏi</h3>
                <p>Hãy phân biệt giữa thực tế <i>(điều thực sự mô tả bạn)</i> với lý tưởng <i>(điều bạn muốn trở thành trong mắt người khác)</i>. Kết quả của bài trắc nghiệm hoàn toàn là câu chuyện của cá nhân bạn, đừng để yếu tố bên ngoài tác động đến câu trả lời.</p>
            </div>
        </div>

        <div class="guide-item">
            <div class="guide-content">
                <h3>Kiểm tra lại định kỳ</h3>
                <p>Chúng ta trưởng thành và thay đổi từng ngày, vậy nên kết quả MBTI cũng có thể thay đổi dựa trên nhận thức và thế giới quan tại những giai đoạn khác nhau trong cuộc đời. Tốt nhất bạn hãy làm kiểm tra MBTI lại nhiều lần để có cái nhìn tổng quát và chính xác nhất.</p>
            </div>
            <div class="guide-icon">
                <img src="https://i.imgur.com/YQkR8H9.png" alt="Định kỳ">
            </div>
        </div>
    </div>

    <div class="action-center">
        <a href="#" class="btn-main-test">Làm bài test <span class="arrow">→</span></a>
    </div>
</div>
<div class="faq-container">
    <h2 class="faq-main-title">FAQs</h2>

    <div class="faq-list">
        <details class="faq-item" open>
            <summary>
                Trắc nghiệm MBTI là gì?
                <span class="faq-icon"></span>
            </summary>
            <div class="faq-content">
                <p>Trắc nghiệm tính cách MBTI <i>(Myers-Briggs Type Indicator)</i> là một phương pháp sử dụng hàng loạt các câu hỏi trắc nghiệm để phân tích tính cách con người. Kết quả trắc nghiệm MBTI chỉ ra cách con người nhận thức thế giới xung quanh và ra quyết định cho mọi vấn đề trong cuộc sống.</p>
            </div>
        </details>

        <details class="faq-item">
            <summary>
                Trắc nghiệm MBTI bắt nguồn từ đâu?
                <span class="faq-icon"></span>
            </summary>
            <div class="faq-content">
                <p>MBTI dựa trên nền tảng lý thuyết phân loại của tâm lý học gia Carl Jung và được phát triển bởi Isabel Briggs Myers cùng mẹ của bà là Katherine Cook Briggs.</p>
            </div>
        </details>

        <details class="faq-item">
            <summary>
                MBTI có bao nhiêu loại tính cách?
                <span class="faq-icon"></span>
            </summary>
            <div class="faq-content">
                <p>Có tổng cộng 16 nhóm tính cách được chia thành 4 nhóm chính: Nhà phân tích, Nhà ngoại giao, Người bảo vệ và Người khám phá.</p>
            </div>
        </details>

        <details class="faq-item">
            <summary>
                Kết quả MBTI có thay đổi không?
                <span class="faq-icon"></span>
            </summary>
            <div class="faq-content">
                <p>Kết quả có thể thay đổi tùy thuộc vào sự trưởng thành, trải nghiệm sống và trạng thái tâm lý của bạn tại thời điểm làm bài test.</p>
            </div>
        </details>

        </div>
</div>


@endsection