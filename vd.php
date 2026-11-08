<div class="flex h-screen">

    <!-- Sidebar -->
    <div class="w-72 bg-white border-r border-gray-100 flex flex-col">
        <div class="p-6 flex items-center gap-3">
            <div class="w-10 h-10 bg-violet-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold">📄</div>
            <h1 class="text-2xl font-bold text-gray-800">CV Assistant</h1>
        </div>
        <nav class="flex-1 px-3 space-y-1">
            <a href="{{ url('/') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-gray-100 rounded-3xl text-gray-700">
                <i class="fas fa-home"></i><span>Trang chủ</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-5 py-3 bg-violet-50 text-violet-700 rounded-3xl font-medium">
                <i class="fas fa-chart-bar"></i><span>Đánh giá CV</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-5 py-3 hover:bg-gray-100 rounded-3xl text-gray-700">
                <i class="fas fa-plus"></i><span>Tạo CV</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-5 py-3 hover:bg-gray-100 rounded-3xl text-gray-700">
                <i class="fas fa-lightbulb"></i><span>Gợi ý CV</span>
            </a>
        </nav>
        <div class="p-4 border-t mt-auto">
            <a href="#" class="flex items-center gap-3 px-5 py-3 hover:bg-gray-100 rounded-3xl text-red-600">
                <i class="fas fa-sign-out-alt"></i><span>Đăng xuất</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-auto">
        <div class="p-6 max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Đánh giá CV</h1>
                    <p class="text-gray-500 text-sm">Phân tích CV của bạn và tìm cơ hội nghề nghiệp phù hợp nhất</p>
                </div>
                <div class="flex items-center gap-4">
                    <button class="text-2xl text-gray-600"><i class="fas fa-bell"></i></button>
                    <img src="https://i.pravatar.cc/40?u=lan" class="w-9 h-9 rounded-2xl">
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- Left: Upload CV -->
                <div class="lg:col-span-5">
                    <div class="bg-white rounded-3xl p-6 compact-card">
                        <div class="text-center mb-6">
                            <div class="w-16 h-16 mx-auto bg-violet-100 rounded-2xl flex items-center justify-center text-4xl mb-4">📄</div>
                            <h2 class="text-xl font-semibold">Tải lên CV của bạn</h2>
                            <p class="text-gray-500 text-sm mt-1">Chúng tôi sẽ phân tích mức độ phù hợp với các vị trí công việc</p>
                        </div>

                        <!-- Drag & Drop -->
                        <div class="border-2 border-dashed border-gray-300 rounded-3xl py-8 px-6 text-center hover:border-violet-300 transition mb-6">
                            <div class="mx-auto w-11 h-11 bg-gray-100 rounded-2xl flex items-center justify-center text-3xl mb-3">☁️</div>
                            <p class="font-medium text-sm">Kéo & thả file CV vào đây</p>
                            <p class="text-gray-400 text-xs mt-1">hoặc</p>
                            <button class="mt-4 bg-violet-600 hover:bg-violet-700 text-white px-6 py-2.5 rounded-2xl text-sm font-medium">
                                Chọn file từ máy tính
                            </button>
                            <p class="text-[10px] text-gray-400 mt-4">PDF, DOCX • Tối đa 5MB</p>
                        </div>

                        <!-- Uploaded File -->
                        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-4 flex items-center gap-4 mb-6">
                            <div class="w-9 h-9 bg-red-100 rounded-xl flex items-center justify-center text-red-600 text-xs font-bold">PDF</div>
                            <div class="flex-1">
                                <p class="font-medium text-sm">Nguyen_Van_A_CV.pdf</p>
                                <p class="text-xs text-gray-400">1.2 MB</p>
                            </div>
                            <i class="fas fa-check-circle text-emerald-500"></i>
                        </div>

                        <button class="w-full bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-semibold py-4 rounded-2xl text-lg">
                            ✨ Đánh giá CV
                        </button>

                        <div class="text-center text-[10px] text-gray-400 mt-4 flex items-center justify-center gap-1">
                            <i class="fas fa-lock"></i>
                            <span>Bảo mật tuyệt đối</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Kết quả -->
                <div class="lg:col-span-7 space-y-6">

                    <!-- Ngành nghề phù hợp -->
                    <div class="bg-white rounded-3xl p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold">CV của bạn phù hợp với các ngành nghề</h3>
                            <a href="#" class="text-violet-600 text-sm">Xem chi tiết →</a>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                            <div class="bg-emerald-50 rounded-2xl p-3 text-center card-hover">
                                <div class="text-xl">🌱</div>
                                <p class="text-xs font-medium mt-1">Marketing</p>
                                <p class="text-emerald-600 font-bold text-lg">85%</p>
                            </div>
                            <div class="bg-blue-50 rounded-2xl p-3 text-center card-hover">
                                <div class="text-xl">📡</div>
                                <p class="text-xs font-medium mt-1">Truyền thông</p>
                                <p class="text-blue-600 font-bold text-lg">78%</p>
                            </div>
                            <div class="bg-purple-50 rounded-2xl p-3 text-center card-hover">
                                <div class="text-xl">📱</div>
                                <p class="text-xs font-medium mt-1">Digital Marketing</p>
                                <p class="text-purple-600 font-bold text-lg">75%</p>
                            </div>
                            <div class="bg-amber-50 rounded-2xl p-3 text-center card-hover">
                                <div class="text-xl">✍️</div>
                                <p class="text-xs font-medium mt-1">Content</p>
                                <p class="text-amber-600 font-bold text-lg">72%</p>
                            </div>
                            <div class="bg-pink-50 rounded-2xl p-3 text-center card-hover">
                                <div class="text-xl">🤝</div>
                                <p class="text-xs font-medium mt-1">Quan hệ công chúng</p>
                                <p class="text-pink-600 font-bold text-lg">68%</p>
                            </div>
                        </div>
                    </div>

                    <!-- Công việc phù hợp -->
                    <div class="bg-white rounded-3xl p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold">Các công việc phù hợp nhất</h3>
                            <a href="#" class="text-violet-600 text-sm">Xem tất cả →</a>
                        </div>
                        <div class="space-y-3 text-sm">

                            <div class="flex items-center gap-4 bg-gray-50 rounded-2xl p-4 card-hover">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTj57d6G4EnOHyrwcZ-jB2LhfmqyrdM7nNIOw&s" class="w-9 h-9 object-contain">
                                <div class="flex-1">
                                    <p class="font-semibold">Chuyên viên Marketing</p>
                                    <p class="text-xs text-gray-500">TPBank • Hà Nội • 2 ngày trước</p>
                                </div>
                                <div class="text-right">
                                    <span class="bg-emerald-100 text-emerald-700 text-xs px-3 py-1 rounded-full">90%</span>
                                    <p class="text-xs text-gray-500 mt-1">15-20 triệu</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 bg-gray-50 rounded-2xl p-4 card-hover">
                                <img src="data:image/png;base64,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" class="w-9 h-9 object-contain">
                                <div class="flex-1">
                                    <p class="font-semibold">Nhân viên Content Marketing</p>
                                    <p class="text-xs text-gray-500">Viettel Telecom • HCM • 1 ngày trước</p>
                                </div>
                                <div class="text-right">
                                    <span class="bg-emerald-100 text-emerald-700 text-xs px-3 py-1 rounded-full">85%</span>
                                    <p class="text-xs text-gray-500 mt-1">12-18 triệu</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 bg-gray-50 rounded-2xl p-4 card-hover">
                                <div class="w-9 h-9 bg-orange-100 rounded-xl flex items-center justify-center text-orange-600 font-bold text-xs">VNG</div>
                                <div class="flex-1">
                                    <p class="font-semibold">Digital Marketing Executive</p>
                                    <p class="text-xs text-gray-500">VNG Corporation • HCM • 3 ngày trước</p>
                                </div>
                                <div class="text-right">
                                    <span class="bg-emerald-100 text-emerald-700 text-xs px-3 py-1 rounded-full">82%</span>
                                    <p class="text-xs text-gray-500 mt-1">18-25 triệu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>