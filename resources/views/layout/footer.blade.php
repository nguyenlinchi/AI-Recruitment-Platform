<style>
         .company-info {
    max-width: 1300px;
    height: 100px;
    margin: 50px 0 15px 30px;
    padding: 12px 30px;           
    background-color: #e9f0f8;
    border-radius: 20px;
    display: flex;
    align-items: center;          
    justify-content: space-between; 
    }

    .company-logo {
        width: 80px;   
        height: auto;
    }

    .company-info h1 {
        font-size: 18px;
        font-weight: bold;
        margin: 0;
        text-align: right; 
    }

    .company-info h1 .sub-text {
        font-size: 14px; 
        font-weight: normal; 
        text-transform: none; 
    }



    .sections {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        margin-top: 15px;
    }

    .sections {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        margin-top: 15px;
    }

    .section {
        flex: 1;
        min-width: 160px;
        margin: 8px;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 5px;
    }

    .section:first-child {
        flex: 3;              
        min-width: 350px;     
        white-space: nowrap; 
        overflow-x: auto;    
    }


    .section h2 {
        font-size: 18px;
        margin-bottom: 8px;
        font-weight: bold;
    }

    .section p {
        font-size: 15px;
        line-height: 1.5;
    }

    .section.social {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 8px;
    }


    .company-support-container {
        max-width: 1300px;
        height: 100px;
        margin: 0px 0 15px 30px;
        padding: 12px 30px;           
        background-color: #e9f0f8;
        border-radius: 20px;
        display: flex;
        align-items: center;          
        justify-content: space-between;
    }

    .company-support-item {
        flex: 1;
        min-width: 150px;
    }
    /* Footer */
    .footer {
        background-color: #e9f0f8; /* màu nền full width */
        padding: 12px 0;
        text-align: center;
        color: #1a3c6e;
        border-top: 1px solid #d0d0d0;
        font-size: 12px;
        width: 100%; 
        border-radius: 15px 15px 0 0;
    }

    .footer-content {
        max-width: 1100px;   
        margin: 0 auto;      
        padding: 0 20px;     
        display: flex;
        justify-content: center; 
        flex-wrap: wrap;
        border-radius: 10px;
    }


    .footer-section {
        margin: 5px 0 0 0;
        padding-top: 10px;              
        border-top: 1px solid #ccc;     
        text-align: center;            
        background-color: #f8f9fa;      
        width: 100%;                   
        box-sizing: border-box;         
    }

    .company-support-container {
        margin-top: 15px;
        padding: 30px;
        background-color: #e9f0f8;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .company-support-item {
        flex: 1; 
        min-width: 200px;
    }

    .company-support-item.follow {
        display: flex;
        align-items: center;
        font-size: 18px;
        font-weight: 500;
    }

    .company-support-item.hotline {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .hotline-text h5 {
        font-size: 10px;
        margin-bottom: 5px;
        text-align: right;
    }

    .hotline-text p {
        font-size: 12px;
        line-height: 1.4;
        text-align: right;
    }

    .social {
        display: flex;
        gap: 15px;
    }

    .social a {
        color: #1a3c6e;
        font-size: 20px;
        text-decoration: none;
        transition: color 0.3s ease, transform 0.2s ease;
    }

    .social a:hover {
        color: #007bff;
        transform: scale(1.1);
    }
    .disabled-link {
    color: #000; 
    text-decoration: none;
    }

</style>
<div class="main-content">
        <div class="company-info">
            <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1778598486/logo-removebg-preview_aecyly.png" 
                alt="FPT Logo" class="company-logo">

            <h1>
                Công ty TNHH GOOD JOB <br>
                <span class="sub-text">Ban nhân sự</span>
            </h1>
        </div>

        <div class="sections">
            <div class="section">
                <h2>Trung tâm Thu hút Ngôn nhân lực</h2>
                <p>Tòa nhà GoodJob Complex, Đường Nam Kỳ Khởi Nghĩa, Ngũ Hành Sơn.</p>
                <p>GoodJob Tower, Đường Phạm Văn Bạch, Cầu Giấy.</p>
                <p>GoodJob tân thuần, KCX Tân Thuận, Quận 7, TP. Hồ Chí Minh</p>
                <p>ftelhr.tuyen@ftel.com</p>
                <p>028 7300 2222</p>
            </div>
            <div class="section">
                <h2>Về chúng tôi</h2>
                <p><a href="#gioi-thieu" class="disabled-link">Giới thiệu công ty</a></p>
                <p><a href="#van-phong" class="disabled-link">Tham quan văn phòng</a></p>
                <p><a href="#lien-he" class="disabled-link">Thông tin liên hệ</a></p>
                <p><a href="{{ route('career.index') }}#cau-hoi" class="disabled-link">Câu hỏi thường gặp</a></p>
            </div>
            <div class="section">
                <h2>Việc làm</h2>
                <p><a href="{{ route('jobs.index') }}#cong-viec" class="disabled-link">Công việc</a></p>
                <p><a href="{{ route('mbti.home') }}#tinh-cach" class="disabled-link">Bài test tính cách</a></p>
                <p><a href="{{ route('cv.index') }}#cv" class="disabled-link">CV</a></p>
            </div>
            <div class="section">
                <h2>Cẩm nang & Sự kiện</h2>
                <p><a href="{{ route('career.index') }}#cau-hoi" class="disabled-link">Cẩm nang</a></p>
                <p><a href="#su-kien" class="disabled-link">Sự kiện</a></p>
            </div>
        </div>
        <div class="company-support-container">
            <div class="company-support-item follow">
                <p>Theo dõi các kênh chính thức của GOOD JOB</p>
            </div>
            <div class="company-support-item">
                <h5>Hỗ trợ Khách hàng</h5>
                <p>hotrokhachhang@fpt.com</p>
            </div>
            <div class="company-support-item">
                <h5>Hotline</h5>
                <p>1900 6600</p>
            </div>
            <div class="social">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-zalo"></i></a>
                </div>
        </div>
 

        <div class="footer-content">
            <div class="footer-section">
                <p>Copyright © 2026. Official Website Tuyển dụng của Công ty Good job.</p>
            </div>
</div>
   