@extends('layout.header')

@section('title', 'Giới thiệu - FPT Jobs')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    body { 
        font-family: 'Nunito', system-ui, sans-serif; 
    }
    .card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .card-hover:hover { 
        transform: translateY(-6px); 
        box-shadow: 0 12px 30px -10px rgba(0, 0, 0, 0.08);
    }
</style>

<div class="min-h-screen bg-gray-50 flex flex-col pt-24" id="cv">

    <div class="flex flex-1">

        <div class="w-72 bg-white border-r border-gray-100 flex flex-col sticky top-[70px] h-[calc(100vh-70px)] flex-shrink-0">
            <div class="p-6 flex items-center gap-3">
                <div class="w-10 h-10 bg-violet-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold shadow-sm">📄</div>
                <h1 class="text-2xl font-bold text-gray-800 tracking-tight">CV Assistant</h1>
            </div>

            <nav class="flex-1 px-4 space-y-1">
                <a href="#" class="flex items-center gap-3 px-5 py-3.5 bg-violet-50 rounded-2xl text-violet-700 font-semibold transition-all">
                    <i class="fas fa-chart-bar text-lg"></i><span>Đánh giá CV</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-gray-50 rounded-2xl text-gray-600 font-medium transition-all">
                    <i class="fas fa-plus text-lg text-gray-400"></i><span>Tạo CV</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-gray-50 rounded-2xl text-gray-600 font-medium transition-all">
                    <i class="fas fa-lightbulb text-lg text-gray-400"></i><span>Gợi ý CV</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-gray-50 rounded-2xl text-gray-600 font-medium transition-all">
                    <i class="fas fa-copy text-lg text-gray-400"></i><span>Mẫu CV</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-gray-50 rounded-2xl text-gray-600 font-medium transition-all">
                    <i class="fas fa-history text-lg text-gray-400"></i><span>Lịch sử</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-gray-50 rounded-2xl text-gray-600 font-medium transition-all">
                    <i class="fas fa-user text-lg text-gray-400"></i><span>Hồ sơ</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-100 mt-auto">
                <a href="#" class="flex items-center gap-3 px-5 py-3 hover:bg-gray-50 rounded-2xl text-gray-600 font-medium transition-all">
                    <i class="fas fa-cog text-gray-400"></i><span>Cài đặt</span>
                </a>
                <!-- <a href="#" class="flex items-center gap-3 px-5 py-3 hover:bg-red-50 rounded-2xl text-red-600 font-medium transition-all">
                    <i class="fas fa-sign-out-alt"></i><span>Đăng xuất</span>
                </a> -->
            </div>
        </div>

        <div class="flex-1 min-w-0 flex flex-col">
            


            <div class="p-8 pt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">

                    <div class="bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm card-hover flex flex-col justify-between min-h-[620px]">
                        <div>
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 bg-violet-100 rounded-2xl flex items-center justify-center text-3xl">📊</div>
                                <div>
                                    <h3 class="font-bold text-xl text-gray-800">Đánh giá CV</h3>
                                    <p class="text-gray-400 text-xs mt-0.5 leading-relaxed">Phân tích CV dựa trên tiêu chuẩn tiêu chí tuyển dụng.</p>
                                </div>
                            </div>

                            <div class="bg-gradient-to-br from-violet-50 to-white border border-violet-100/70 rounded-3xl p-4 mb-6">
                                <div class="bg-white rounded-2xl shadow-sm border border-gray-50 p-4">
                                    <div class="flex gap-3 items-center border-b border-gray-100 pb-3">
                                        <img src="https://i.pravatar.cc/80?u=nguyenvana" class="w-12 h-12 rounded-xl object-cover ring-2 ring-violet-100">
                                        <div>
                                            <p class="font-bold text-sm text-gray-800 uppercase tracking-wide">NGUYỄN VĂN A</p>
                                            <p class="text-[11px] text-gray-400 font-medium">Product Designer</p>
                                        </div>
                                    </div>

                                    <div class="mt-3 space-y-2.5 text-[11px]">
                                        <div>
                                            <p class="text-gray-400 font-bold uppercase tracking-wider text-[9px] mb-0.5">KINH NGHIỆM</p>
                                            <p class="font-semibold text-gray-700 truncate">Senior UI/UX Designer - FPT Software</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-400 font-bold uppercase tracking-wider text-[9px] mb-0.5">HỌC VẤN</p>
                                            <p class="font-semibold text-gray-700 truncate">Đại học Bách Khoa Hà Nội</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-400 font-bold uppercase tracking-wider text-[9px] mb-1">KỸ NĂNG chính</p>
                                            <div class="space-y-1.5">
                                                <div class="flex justify-between items-center">
                                                    <span class="text-gray-600">Figma</span>
                                                    <span class="w-20 h-1.5 bg-gray-100 rounded-full relative overflow-hidden">
                                                        <span class="absolute left-0 top-0 h-1.5 bg-violet-600 rounded-full w-[90%]"></span>
                                                    </span>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <span class="text-gray-600">UI/UX Research</span>
                                                    <span class="w-20 h-1.5 bg-gray-100 rounded-full relative overflow-hidden">
                                                        <span class="absolute left-0 top-0 h-1.5 bg-violet-600 rounded-full w-[85%]"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-x-3 gap-y-2 text-xs mb-6 px-1">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="fas fa-check-circle text-emerald-500 text-sm"></i>
                                    <span class="font-medium">Bố cục rõ ràng</span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="fas fa-check-circle text-emerald-500 text-sm"></i>
                                    <span class="font-medium">Nội dung đầy đủ</span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="fas fa-check-circle text-emerald-500 text-sm"></i>
                                    <span class="font-medium">Từ khóa phù hợp</span>
                                </div>
                                <div class="flex items-center gap-2 text-amber-500 font-semibold">
                                    <i class="fas fa-exclamation-triangle text-sm"></i>
                                    <span>Cần cải thiện</span>
                                </div>
                            </div>
                        </div>
                            <a href="{{ Auth::check() ? route('cv.evaluate') : route('login') }}"
                            class="w-full bg-violet-600 hover:bg-violet-700 text-white font-bold py-4 rounded-2xl flex items-center justify-center transition-all shadow-sm shadow-violet-200">
                                Đánh giá ngay →
                            </a>
                    </div>

                    <div class="bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm card-hover flex flex-col justify-between min-h-[620px]">
                        <div>
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-3xl">📝</div>
                                <div>
                                    <h3 class="font-bold text-xl text-gray-800">Tạo CV</h3>
                                    <p class="text-gray-400 text-xs mt-0.5 leading-relaxed">Tạo CV chuyên nghiệp với các mẫu thiết kế hiện đại.</p>
                                </div>
                            </div>

                            <div class="border-2 border-dashed border-gray-200 rounded-3xl h-[264px] flex flex-col items-center justify-center text-center mb-6 bg-gray-50/50 p-4">
                                <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-3">
                                    <i class="fas fa-file-pdf text-4xl text-gray-300"></i>
                                </div>
                                <p class="text-gray-400 text-sm font-semibold">CV của bạn sẽ xuất hiện ở đây</p>
                                <p class="text-gray-300 text-xs mt-1">Chọn mẫu và nhập thông tin để bắt đầu</p>
                            </div>
                        </div>

                        <!-- <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl transition-all shadow-sm shadow-blue-200">
                            Tạo CV ngay →
                        </button> -->
                        <a href="{{ route('cv.templates', ['resume_id' => $resume->resume_id]) }}"
                        class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 rounded-2xl text-center mt-auto transition">
                            Tạo CV ngay →
                        </a>
                    </div>

                    <div class="bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm card-hover flex flex-col justify-between min-h-[620px]">
                        <div>
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center text-3xl">💡</div>
                                <div>
                                    <h3 class="font-bold text-xl text-gray-800">Gợi ý CV</h3>
                                    <p class="text-gray-400 text-xs mt-0.5 leading-relaxed">Đề xuất nội dung, kỹ năng theo mục tiêu nghề nghiệp.</p>
                                </div>
                            </div>

                            <div class="mb-5">
                                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block mb-2 px-1">Vị trí bạn quan tâm</label>
                                <div class="relative">
                                    <input type="text" value="Nhân viên Marketing" 
                                           class="w-full px-5 py-3.5 text-sm font-semibold border border-gray-200 rounded-2xl focus:outline-none focus:border-amber-400 bg-gray-50/50 text-gray-700 transition-all">
                                </div>
                            </div>

                            <div class="space-y-4 text-xs mb-6 px-1">
                                <div class="flex gap-3.5 items-start">
                                    <div class="w-7 h-7 bg-emerald-50 border border-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 flex-shrink-0 text-sm">🌱</div>
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm">Kỹ năng nên có</p>
                                        <p class="text-gray-400 mt-1 leading-relaxed font-medium">Digital Marketing, SEO, Content Marketing, Google Ads...</p>
                                    </div>
                                </div>
                                <div class="flex gap-3.5 items-start">
                                    <div class="w-7 h-7 bg-blue-50 border border-blue-100 rounded-xl flex items-center justify-center text-blue-600 flex-shrink-0 text-sm">💼</div>
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm">Kinh nghiệm nổi bật</p>
                                        <p class="text-gray-400 mt-1 leading-relaxed font-medium">Có trên 2 năm kinh nghiệm thực chiến vận hành campaign.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-2xl transition-all shadow-sm shadow-orange-100">
                            Xem gợi ý ngay →
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@include('layout.footer')

@endsection