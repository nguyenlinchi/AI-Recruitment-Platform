@extends('layout.header')

@section('title', 'Giới thiệu - FPT Jobs')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">

    <section class="banner"></section>

    <section class="intro text-center py-5" id="gioi-thieu">
        <h2>Về <span>chúng tôi</span></h2>
        <p class="subtitle">Giới thiệu chung</p>
        <p class="desc">
            Là thành viên của Tập đoàn công nghệ lớn nhất Việt Nam, <br>
            FPT hiện là một trong những nhà cung cấp dịch vụ hàng đầu trong khu vực.
        </p>
    </section>

    <!-- Nội dung 2 cột -->
    <section class="about-content container py-5">
        <div class="row align-items-center">
           <div class="row align-items-start">
            <div class="col-md-8">
                <div class="slideshow-container" style="min-height: 300px;">
                    <div class="slides fade">
                        <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1757086734/38_zesd0v.webp" class="d-block w-100 rounded shadow" alt="Ảnh 1">
                    </div>
                    <div class="slides fade">
                        <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1757086816/39_szkvi5.jpg" class="d-block w-100 rounded shadow" alt="Ảnh 2">
                    </div>
                    <div class="slides fade">
                        <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1757086884/40_afk1g3.png" class="d-block w-100 rounded shadow" alt="Ảnh 3">
                    </div>
                </div>
                <div class="text-center mt-3">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div>
            </div>

            <!-- Cột phải -->
            <div class="col-md-4 mt-4 mt-md-0 d-flex" style="padding-left: 20px; min-height: 300px;">
                <div class="my-auto">
                    <p>
                        FPT Software, thành lập năm 1999, là công ty thành viên của Tập đoàn FPT chuyên về phát triển phần mềm
                        và giải pháp công nghệ thông tin. Công ty cung cấp dịch vụ cho khách hàng toàn cầu, bao gồm phát triển
                        ứng dụng, chuyển đổi số, AI, và các giải pháp công nghệ tiên tiến.
                    </p>
                    <p>
                        FPT Software hướng tới sứ mệnh mang giải pháp công nghệ và chuyển đổi số đến khách hàng toàn cầu,
                        với giá trị cốt lõi “Khách hàng là trọng tâm, đổi mới là động lực”.
                    </p>
                </div>
            </div>
        </div>

        </div>
    </section>

    <!-- Sản phẩm & Dịch vụ -->
    <section class="products py-5 bg-light">
        <div class="container text-center">
            <h2 class="mb-5">Sản phẩm và Dịch vụ</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="product-card orange">
                        <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1756479043/9_v9zpgk.jpg" alt="Internet Cá nhân">
                        <div class="text">FPT<br>Software</div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="product-card green">
                        <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1756479042/10_shw7pm.png" alt="Internet Gia đình">
                        <div class="text">FPT<br>Telecom</div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="product-card blue">
                        <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1756479044/11_e5tmxn.jpg" alt="Internet Doanh nghiệp">
                        <div class="text">FPT<br>Education</div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="product-card pink">
                        <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1756479057/14_ysbuha.jpg" alt="Internet Game thủ">
                        <div class="text">FPT<br>Shop</div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="product-card red">
                        <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1756478123/4_alhqu1.jpg" alt="Truyền hình Giải trí">
                        <div class="text">FPT<br>Giải trí</div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="product-card gray">
                        <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1756478121/2_b6bmhd.jpg" alt="Bảo mật An toàn">
                        <div class="text">FPT<br>An toàn</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JS slideshow -->
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) { showSlides(slideIndex += n); }
        function currentSlide(n) { showSlides(slideIndex = n); }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("slides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (i = 0; i < slides.length; i++) { slides[i].style.display = "none"; }
            for (i = 0; i < dots.length; i++) { dots[i].className = dots[i].className.replace(" active", ""); }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
        }

        setInterval(() => { plusSlides(1); }, 2000);
    </script>
    <!-- Các giải thưởng -->
<section class="awards py-5">
    <div class="container text-center">
        <h2 class="mb-5">Các giải thưởng của FPT </h2>
        <div class="award-carousel">
            <div class="award-slide">
                <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1756480913/27_f464zd.jpg" alt="Award 1">
                <p>Top 1 nhà tuyển dụng </p>
            </div>
            <div class="award-slide">
                <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1756480645/24_mddgdp.webp" alt="Award 2">
                <p>FPT Entered Asia's Top 50 IT Services Companies</p>
            </div>
            <div class="award-slide active">
                <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1756479576/17_wvfenb.jpg" alt="Award 3">
                <p>Nơi làm việc xuất sắc nhất VN 2023-2024</p>
            </div>
            <div class="award-slide">
                <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1756480867/25_e9ks9k.png" alt="Award 4">
                <p>Top 2 giá trị tăng trưởng nhất Việt Nam</p>
            </div>
            <div class="award-slide">
                <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1756480912/26_nayp71.png" alt="Award 5">
                <p>Doanh nghiệp dẫn đầu xu hướng</p>
            </div>
            <div class="award-slide">
                <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1756480918/28_aiizwh.jpg" alt="Award 6">
                <p>Giải nhất cuộc thi đỉnh AI</p>
            </div>
        </div>
    </div>
</section>

<!-- JS Awards Carousel -->
<script>
    const awardSlides = document.querySelectorAll(".award-slide");

    // Khi click vào 1 slide thì nó trở thành slide active
    awardSlides.forEach((slide, index) => {
        slide.addEventListener("click", () => {
            awardSlides.forEach(s => s.classList.remove("active"));
            slide.classList.add("active");
        });
    });
</script>
<section class="offices py-5" id="van-phong">
    <div class="container text-center">
        <h2 class="mb-4">Tham quan văn phòng FPT</h2>
        <p class="subtitle">⭐ FPT Tour 360 ⭐</p>

        <div class="carousel-wrapper">
            <!-- Nút điều hướng -->
            <!-- <button class="nav-btn prev">&#10094;</button> -->

            <!-- Carousel -->
            <div class="office-carousel" id="officeCarousel">
                <div class="office-card" style="background-color: #a4c0ebff">
                    <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1756481593/27_visq5g.jpg" alt="FPT Tân Thuận 2">
                    <div class="office-content">
                        <h5>FPT Tp.Hồ Chí Minh</h5>
                        <p>
                            F-Town Building (Saigon Hi-Tech Park, quận 9, TP.HCM) – gồm F-Town 1, 2 và mới nhất là F-Town 3.
                            F-Town 1 & 2: mỗi tòa khoảng 3.000 nhân viên.F-Town 3: khánh thành 2020, sức chứa 7.500 nhân viên
                        </p>
                    </div>
                </div>

                <div class="office-card"style="background-color: #eed295ff">
                    <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1756478123/3_bcnvdd.jpg" alt="Chi nhánh FPT Telecom Huế">
                    <div class="office-content">
                        <h5>FPT Hà Nội</h5>
                        <p>
                           Trụ sở chính: FPT Cau Giay Building, đường Duy Tân, quận Cầu Giấy.Campus HOLA Park (F-Ville 1, 2, 3): tại Khu công nghệ cao Hòa Lạc, Thạch Thất, Hà Nội.
                           F-Ville 1: khoảng 3.000 nhân viên.F-Ville 2: khoảng 3.000 nhân viên.
                           F-Ville 3: khánh thành 2019, sức chứa 5.000 nhân viên
                        </p>
                    </div>
                </div>

                <div class="office-card"style="background-color: #9edd96ff">
                    <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1756478278/8_a7xlq1.jpg" alt="FPT Tower">
                    <div class="office-content">
                        <h5>FPT Đà Nẵng</h5>
                        <p>
                            F-Complex Building, phường Hòa Hải, quận Ngũ Hành Sơn, Đà Nẵng.Khánh thành 2015, campus lớn nhất miền Trung
                            .Sức chứa khoảng 10.000 nhân viên
                        </p>
                    </div>
                </div>
            </div>

            <!-- <button class="nav-btn next">&#10095;</button> -->
        </div>

        <button class="tour-btn">FPT Hring 360 Tour →</button>
    </div>
</section>

<!-- JS đặt sau cùng -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const carousel = document.getElementById("officeCarousel");
        const prevBtn = document.querySelector(".prev");
        const nextBtn = document.querySelector(".next");

        const scrollStep = 350; // khoảng cách dịch chuyển px

        prevBtn.addEventListener("click", () => {
            carousel.scrollBy({ left: -scrollStep, behavior: "smooth" });
        });

        nextBtn.addEventListener("click", () => {
            carousel.scrollBy({ left: scrollStep, behavior: "smooth" });
        });
    });
</script>

<section class="contact py-5"id="lien-he">
    <div class="container">
        <h2 class="text-center mb-4">Liên hệ</h2>
        <p class="text-center mb-5">Hãy kết nối với chi nhánh FPT gần bạn, nơi hành trình nghề nghiệp mới đang chờ bạn bước tới!</p>

        <div class="contact-wrapper">
            <!-- Danh sách chi nhánh -->
            <div class="branch-list">
                <input type="text" id="searchBranch" placeholder="Khu vực..." />

                <div class="branch">
                    <h4>FPT Hà Nội</h4>
                    <p><strong>Talent Acquisition – FPT Software Hà Nộ</strong></p>
                    <p>Email: <a href="mailto:hoangqv@fpt.com">hr@fsoft.com.vn</a></p>
                    <p>Phone: <a href="tel:0898324198">(024) 7300 7373</a></p>
                </div>

                <div class="branch">
                    <h4>FPT TP. Hồ Chí Minh</h4>
                    <p><strong>Talent Acquisition – FPT Software HCM</strong></p>
                    <p>Email: <a href="mailto:linhtt15@fpt.com">recruitment_hcm@fsoft.com.vn</a></p>
                    <p>Phone: <a href="tel:0903259191">(028) 7300 7373</a></p>
                </div>

                <div class="branch">
                    <h4>FPT Đà Nẵng</h4>
                    <p><strong>Talent Acquisition – FPT Software Đà Nẵng</strong></p>
                    <p>Email: <a href="mailto:thunta22@fpt.com">recruitment_dn@fsoft.com.vn</a></p>
                    <p>Phone: <a href="tel:0912270295">(0236) 7300 9999</a></p>
                </div>
                <div class="branch">
                    <h4>FPT Cần Thơ</h4>
                    <p><strong>Nguyễn Thị Anh Thu</strong></p>
                    <p>Email: <a href="mailto:thunta22@fpt.com">thunta22@fpt.com</a></p>
                    <p>Phone: <a href="tel:0912270295">0912270295</a></p>
                </div>
                <div class="branch">
                    <h4>FPT Huế</h4>
                    <p><strong>Quách Văn Hoàng</strong></p>
                    <p>Email: <a href="mailto:thunta22@fpt.com">hoangqv@fpt.com</a></p>
                    <p>Phone: <a href="tel:0912270295">024(028) 7300 2222 máy lẻ 6532</a></p>
                </div>
                <div class="branch">
                    <h4>FPT Nha Trang</h4>
                    <p><strong>Huỳnh Lê Bảo Chi</strong></p>
                    <p>Email: <a href="mailto:thunta22@fpt.com">chihlb@fpt.com</a></p>
                    <p>Phone: <a href="tel:0912270295">024(028) 7300 2222 máy lẻ 5611</a></p>
                </div>
            </div>

            <!-- Bản đồ -->
            <div id="map"></div>
        </div>
    </div>
</section>

<!-- Leaflet JS & CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Khởi tạo bản đồ
        var map = L.map('map').setView([16.047079, 108.206230], 6); // VN center

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Danh sách chi nhánh (tọa độ demo)
        var branches = [
             { name: "FPT Hà Nội", coords: [21.027763, 105.834160] },
                { name: "FPT TP. Hồ Chí Minh", coords: [10.762622, 106.660172] },
                { name: "FPT Đà Nẵng", coords: [16.047079, 108.206230] },
                { name: "FPT Cần Thơ", coords: [10.045162, 105.746857] },
                { name: "FPT Huế", coords: [16.463713, 107.590866] },
                { name: "FPT Nha Trang", coords: [12.238791, 109.196749] }
        ];
        

        branches.forEach(branch => {
            L.marker(branch.coords).addTo(map).bindPopup(branch.name);
        });

        // Tìm kiếm chi nhánh
        document.getElementById("searchBranch").addEventListener("keyup", function() {
            let filter = this.value.toLowerCase();
            document.querySelectorAll(".branch").forEach(function(el) {
                let text = el.innerText.toLowerCase();
                el.style.display = text.includes(filter) ? "block" : "none";
            });
        });
    });
</script>

<section class="faq py-5" id="cau-hoi">
  <div class="container">
    <h2 class="text-center mb-5">Câu hỏi thường gặp</h2>
    <div class="faq-content">
      <!-- Hình minh họa -->
      <div class="faq-img">
        <img src="https://res.cloudinary.com/dumvx2lsj/image/upload/v1755165269/chitiet_t86jag.png" alt="FAQ">
      </div>

      <!-- Danh sách câu hỏi -->
      <div class="faq-list">
        <div class="faq-item">
          <button class="faq-question">Thời gian phản hồi sau khi nộp CV là bao lâu?</button>
          <div class="faq-answer">
            <p>Hồ sơ ứng tuyển sẽ được FPT Telecom xem xét trong thời hạn tối đa 15 ngày làm việc kể từ ngày nộp. Trong trường hợp hồ sơ phù hợp, ứng viên sẽ được liên hệ để bước vào vòng tiếp theo.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">Khi nào tôi được thông báo về kết quả phỏng vấn của mình?</button>
          <div class="faq-answer">
            <p>Kết quả phỏng vấn sẽ được thông báo trong vòng 7 ngày làm việc sau buổi phỏng vấn.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">Có thể ứng tuyển nhiều vị trí cùng lúc?</button>
          <div class="faq-answer">
            <p>Ứng viên có thể ứng tuyển nhiều vị trí, tuy nhiên FPT  sẽ ưu tiên hồ sơ phù hợp nhất.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">Phỏng vấn trực tiếp hay trực tuyến?</button>
          <div class="faq-answer">
            <p>Tùy theo vị trí ứng tuyển, FPT  sẽ tổ chức phỏng vấn trực tiếp hoặc trực tuyến.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">Quy trình tuyển dụng tại FPT gồm những bước nào?</button>
          <div class="faq-answer">
            <p>Quy trình gồm: Nộp CV → Sàng lọc hồ sơ → Phỏng vấn → Nhận kết quả → Ký hợp đồng.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="faq.js"></script>


<button id="scrollTopBtn">
  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" viewBox="0 0 24 24">
    <path d="M12 8l6 6H6z"/>
  </svg>
</button>
<style>
  #scrollTopBtn {
    position: fixed;
    bottom: 40px; 
    right: 28px;
    background: #f88705ff;
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    font-size: 20px;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    z-index: 9997;
    display: none; /* ẩn mặc định */
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
  }
  #scrollTopBtn:hover {
    background: #f1d42eff;
    transform: scale(1.05);
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const scrollBtn = document.getElementById("scrollTopBtn");

    // Hiện nút khi cuộn xuống 200px
    window.addEventListener("scroll", () => {
      if (window.scrollY > 200) {
        scrollBtn.style.display = "flex";
      } else {
        scrollBtn.style.display = "none";
      }
    });

    // Sự kiện click -> cuộn lên đầu
    scrollBtn.addEventListener("click", () => {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  });
</script>

<x-floating-ui />

@include('layout.footer')

@endsection



