<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đánh giá CV - CV Assistant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body { font-family: 'Nunito', system-ui, sans-serif; }
        .card-hover:hover { transform: translateY(-3px); }
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
            <a href="{{ url('/') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-gray-100 rounded-3xl text-gray-700">
                <i class="fas fa-home"></i><span>Trang chủ</span>
            </a>
            <a href="{{ route('cv.evaluate') }}" class="flex items-center gap-3 px-5 py-3 bg-violet-50 text-violet-700 rounded-3xl font-medium">
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
            <!-- Thông báo -->
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-2xl mb-6">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-2xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Đánh giá CV</h1>
                    <p class="text-gray-500 text-sm">Phân tích CV của bạn và tìm cơ hội nghề nghiệp phù hợp nhất</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- LEFT: UPLOAD -->
                <div class="lg:col-span-5">
                    <div class="bg-white rounded-3xl p-6">
                        <div class="text-center mb-6">
                            <div class="w-16 h-16 mx-auto bg-violet-100 rounded-2xl flex items-center justify-center text-4xl mb-4">📄</div>
                            <h2 class="text-xl font-semibold">Tải lên CV của bạn</h2>
                            <p class="text-gray-500 text-sm mt-1">Chúng tôi sẽ phân tích mức độ phù hợp</p>
                        </div>
                        <form id="cvForm" action="{{ route('cv.evaluate.analyze') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div id="dropZone" class="border-2 border-dashed border-gray-300 rounded-3xl py-8 px-6 text-center hover:border-violet-400 transition cursor-pointer">
                                <div class="mx-auto w-11 h-11 bg-gray-100 rounded-2xl flex items-center justify-center text-3xl mb-3">☁️</div>
                                <p class="font-medium text-sm">Kéo & thả file CV vào đây</p>
                                <p class="text-gray-400 text-xs mt-1">hoặc</p>
                                <button type="button" class="mt-4 bg-violet-600 hover:bg-violet-700 text-white px-6 py-2.5 rounded-2xl text-sm font-medium">
                                    Chọn file từ máy tính
                                </button>
                                <input type="file" id="cv_file" name="cv_file" accept=".pdf,.doc,.docx" class="hidden" required>
                            </div>

                            <div id="uploadedPreview" class="hidden bg-gray-50 border border-gray-200 rounded-2xl p-4 flex items-center gap-4 mt-6">
                                <div class="w-9 h-9 bg-red-100 rounded-xl flex items-center justify-center text-red-600 text-xs font-bold">PDF</div>
                                <div class="flex-1 min-w-0">
                                    <p id="fileNameDisplay" class="font-medium text-sm truncate"></p>
                                    <p id="fileSizeDisplay" class="text-xs text-gray-400"></p>
                                </div>
                                <i class="fas fa-check-circle text-emerald-500"></i>
                            </div>

                            <button type="submit" id="submitBtn"
                                    class="w-full mt-6 bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-semibold py-4 rounded-2xl text-lg disabled:opacity-50"
                                    disabled>
                                ✨ Đánh giá CV
                            </button>
                        </form>
                    </div>
                </div>

                <!-- RIGHT: KẾT QUẢ -->
                <div class="lg:col-span-7 space-y-6">
                    @if(session('analysis'))
                        @php
                            $data = session('analysis');
                            $jobs = session('recommended_jobs');
                        @endphp

                        <!-- Ngành nghề phù hợp -->
                        <div class="bg-white rounded-3xl p-6">
                            <h3 class="font-semibold mb-4">Ngành nghề phù hợp nhất</h3>
                            <div class="bg-emerald-50 rounded-2xl p-8 text-center">
                                <p class="text-3xl font-bold">{{ $data['predicted_industry'] ?? 'Không xác định' }}</p>
                                <p class="text-7xl font-bold text-emerald-600 mt-4">{{ $data['ats_score'] ?? 0 }}%</p>
                            </div>
                        </div>

                        <!-- Phân tích kỹ năng -->
                        <div class="bg-white rounded-3xl p-6">
                            <h3 class="font-semibold mb-4">Phân tích kỹ năng</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="text-green-600 font-medium mb-3">✅ Điểm mạnh</h4>
                                    <ul class="list-disc pl-5 space-y-2 text-sm">
                                        @foreach($data['strengths'] ?? [] as $item)
                                            <li>{{ ucfirst($item) }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="text-orange-600 font-medium mb-3">⚠️ Cần cải thiện</h4>
                                    <ul class="list-disc pl-5 space-y-2 text-sm">
                                        @foreach($data['weaknesses'] ?? [] as $item)
                                            <li>{{ ucfirst($item) }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Công việc gợi ý -->
                        <div class="bg-white rounded-3xl p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="font-semibold">Công việc phù hợp nhất</h3>
                                <span class="text-sm text-gray-500">
                                    {{ $jobs ? $jobs->count() : 0 }} việc làm
                                </span>
                            </div>

                            @if($jobs && $jobs->count() > 0)
                                <div class="space-y-4">
                                    @foreach($jobs as $job)
                                    <div class="flex gap-4 bg-gray-50 hover:bg-gray-100 p-4 rounded-2xl transition">
                                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-xl border flex-shrink-0">🏢</div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-semibold">{{ $job->job_title ?? 'Không có tiêu đề' }}</p>
                                            <p class="text-sm text-gray-600">{{ $job->employer->company_name ?? 'Không có công ty' }}</p>
                                            <p class="text-xs text-gray-500">
                                                📍 {{ $job->location->location_name ?? 'Không xác định' }} • 
                                                {{ $job->jobType->job_type_name ?? 'Full time' }}
                                            </p>
                                        </div>
                                        <div class="text-right flex-shrink-0">
                                            <span class="inline-block bg-emerald-100 text-emerald-700 text-xs font-medium px-3 py-1.5 rounded-full">
                                                {{ $job->match_score ?? 50 }}% phù hợp
                                            </span>
                                            <p class="text-xs text-gray-500 mt-2">
                                                💰 {{ $job->salary->salary_range ?? 'Thỏa thuận' }}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12 text-gray-400">
                                    <p>Chưa có công việc phù hợp được tìm thấy</p>
                                </div>
                            @endif
                        </div>

                    @else
                        <!-- Chưa có kết quả -->
                        <div class="bg-white rounded-3xl p-16 text-center text-gray-400 min-h-[500px] flex flex-col items-center justify-center">
                            <div class="text-6xl mb-4">📊</div>
                            <p class="text-xl">Kết quả phân tích sẽ hiển thị tại đây</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const fileInput = document.getElementById('cv_file');
    const dropZone = document.getElementById('dropZone');
    const uploadedPreview = document.getElementById('uploadedPreview');
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    const fileSizeDisplay = document.getElementById('fileSizeDisplay');
    const submitBtn = document.getElementById('submitBtn');

    dropZone.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const sizeMB = (file.size / (1024 * 1024)).toFixed(1);
            fileNameDisplay.textContent = file.name;
            fileSizeDisplay.textContent = `${sizeMB} MB`;
            uploadedPreview.classList.remove('hidden');
            submitBtn.disabled = false;
        }
    });
</script>
</body>
</html>