<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CV Assistant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body { font-family: 'Nunito', system-ui, sans-serif; }
        .card {
            transition: all 0.3s ease;
            height: 100%;
        }
        .card:hover { transform: translateY(-8px); }
    </style>
</head>
<body class="bg-gray-50">

<div class="flex h-screen">

    <!-- Sidebar -->
    <div class="w-72 bg-white border-r border-gray-100 flex flex-col">
        <div class="p-6 flex items-center gap-3">
            <div class="w-10 h-10 bg-violet-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold">📄</div>
            <h1 class="text-2xl font-bold text-gray-800">CV Assistant</h1>
        </div>

        <nav class="flex-1 px-3 space-y-1">
            <a href="#" class="flex items-center gap-3 px-5 py-3.5 bg-violet-50 text-violet-700 rounded-3xl font-medium">
                <i class="fas fa-home"></i><span>Trang chủ</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-gray-100 rounded-3xl text-gray-700">
                <i class="fas fa-chart-bar"></i><span>Đánh giá CV</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-gray-100 rounded-3xl text-gray-700">
                <i class="fas fa-plus"></i><span>Tạo CV</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-gray-100 rounded-3xl text-gray-700">
                <i class="fas fa-lightbulb"></i><span>Gợi ý CV</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-gray-100 rounded-3xl text-gray-700">
                <i class="fas fa-copy"></i><span>Mẫu CV</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-gray-100 rounded-3xl text-gray-700">
                <i class="fas fa-history"></i><span>Lịch sử</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-gray-100 rounded-3xl text-gray-700">
                <i class="fas fa-user"></i><span>Hồ sơ</span>
            </a>
        </nav>

        <div class="p-4 border-t mt-auto">
            <a href="#" class="flex items-center gap-3 px-5 py-3 hover:bg-gray-100 rounded-3xl text-gray-700">
                <i class="fas fa-cog"></i><span>Cài đặt</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-5 py-3 hover:bg-gray-100 rounded-3xl text-red-600">
                <i class="fas fa-sign-out-alt"></i><span>Đăng xuất</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <header class="bg-white border-b px-8 py-5 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-gray-800">Xin chào, Chào bạn! 👋</h1>
                <p class="text-gray-500 mt-1">Bạn muốn bắt đầu với công cụ hỗ trợ CV nào hôm nay?</p>
            </div>
            <div class="flex items-center gap-4">
                <button class="relative w-10 h-10 flex items-center justify-center text-2xl text-gray-600 hover:text-gray-800">
                    <i class="fas fa-bell"></i>
                    <span class="absolute top-1 right-1 bg-red-500 text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center">3</span>
                </button>
                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/48?u=lan" class="w-9 h-9 rounded-2xl object-cover">
                    <div>
                        <p class="font-semibold text-sm">Nguyễn Thị Lan</p>
                        <p class="text-xs text-gray-500">Marketing Executive</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Cards -->
        <div class="flex-1 p-8 overflow-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-full">

                <!-- === ĐÁNH GIÁ CV (ĐÃ ĐẦY ĐỦ) === -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 card flex flex-col">
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-12 h-12 bg-violet-100 rounded-2xl flex items-center justify-center text-3xl">📊</div>
                        <div>
                            <h3 class="font-bold text-xl">Đánh giá CV</h3>
                            <p class="text-gray-500 text-sm">Phân tích và đánh giá CV của bạn dựa trên tiêu chí tuyển dụng.</p>
                        </div>
                    </div>

                    <!-- CV Preview -->
                    <div class="relative bg-gradient-to-br from-violet-50 to-white border border-violet-100 rounded-3xl p-5 mb-6 flex-1">
                        <div class="bg-white rounded-2xl shadow p-5">
                            <div class="flex gap-4">
                                <img src="https://i.pravatar.cc/80?u=nguyenvana" class="w-16 h-16 rounded-2xl object-cover">
                                <div>
                                    <p class="font-bold text-lg">NGUYỄN VĂN A</p>
                                    <p class="text-sm text-gray-500">Product Designer</p>
                                </div>
                            </div>

                            <div class="mt-5 space-y-4 text-sm">
                                <div>
                                    <p class="text-gray-500 text-xs mb-1">KINH NGHIỆM</p>
                                    <p class="font-medium">Senior UI/UX Designer - FPT Software</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs mb-1">HỌC VẤN</p>
                                    <p class="font-medium">Đại học Bách Khoa Hà Nội</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs mb-1">KỸ NĂNG</p>
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-xs">
                                            <span>Figma</span>
                                            <span class="w-20 h-1.5 bg-violet-200 rounded-full relative">
                                                <span class="absolute left-0 top-0 h-1.5 bg-violet-600 rounded-full w-[90%]"></span>
                                            </span>
                                        </div>
                                        <div class="flex justify-between text-xs">
                                            <span>UI/UX Research</span>
                                            <span class="w-20 h-1.5 bg-violet-200 rounded-full relative">
                                                <span class="absolute left-0 top-0 h-1.5 bg-violet-600 rounded-full w-[85%]"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Score Circle -->
                        
                    </div>

                    <!-- Đánh giá chi tiết -->
                    <div class="grid grid-cols-2 gap-x-6 gap-y-2 text-sm mb-6">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-emerald-500"></i>
                            <span>Bố cục rõ ràng</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-emerald-500"></i>
                            <span>Nội dung đầy đủ</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-emerald-500"></i>
                            <span>Từ khóa phù hợp</span>
                        </div>
                        <div class="flex items-center gap-2 text-amber-500">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span>Cần cải thiện</span>
                        </div>
                    </div>

            <a href="{{ route('cv.evaluate') }}"
            class="w-full bg-violet-600 hover:bg-violet-700 text-white font-semibold py-4 rounded-2xl mt-auto flex items-center justify-center">
                Đánh giá ngay →
            </a>
                </div>

                <!-- Tạo CV và Gợi ý CV giữ nguyên (đã cân bằng) -->
                <!-- Tạo CV -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 card flex flex-col">
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-3xl">📝</div>
                        <div>
                            <h3 class="font-bold text-xl">Tạo CV</h3>
                            <p class="text-gray-500 text-sm">Tạo CV chuyên nghiệp với các mẫu đẹp và dễ dàng tùy chỉnh.</p>
                        </div>
                    </div>

                    <div class="border-2 border-dashed border-gray-300 rounded-3xl flex-1 flex flex-col items-center justify-center text-center mb-6">
                        <i class="fas fa-file-pdf text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-400 font-medium">CV của bạn sẽ xuất hiện ở đây</p>
                    </div>

                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 rounded-2xl mt-auto">
                        Tạo CV ngay →
                    </button>
                </div>

                <!-- Gợi ý CV -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 card flex flex-col">
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center text-3xl">💡</div>
                        <div>
                            <h3 class="font-bold text-xl">Gợi ý CV</h3>
                            <p class="text-gray-500 text-sm">Nhận gợi ý nội dung và kỹ năng phù hợp với vị trí bạn mong muốn.</p>
                        </div>
                    </div>

                    <div class="mb-5">
                        <p class="text-sm text-gray-600 mb-2">Vị trí bạn quan tâm</p>
                        <input type="text" value="Nhân viên Marketing" 
                               class="w-full px-5 py-4 border border-gray-200 rounded-3xl focus:outline-none focus:border-amber-400">
                    </div>

                    <div class="space-y-3 text-sm flex-1">
                        <div class="flex gap-3">
                            <div class="w-6 h-6 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600 flex-shrink-0">🌱</div>
                            <div>
                                <p class="font-medium text-xs">Kỹ năng nền có</p>
                                <p class="text-gray-500 text-xs">Digital Marketing, SEO, Content...</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 flex-shrink-0">💼</div>
                            <div>
                                <p class="font-medium text-xs">Kinh nghiệm nổi bật</p>
                                <p class="text-gray-500 text-xs">2+ năm Marketing</p>
                            </div>
                        </div>
                    </div>

                    <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-4 rounded-2xl mt-auto">
                        Xem gợi ý ngay →
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>