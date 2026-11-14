@extends('layout.header')

@section('title', 'Đánh giá CV - CV Assistant')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>
    /* phần css */
    body { 
        font-family: 'Nunito', system-ui, sans-serif; 
    }
    .card-hover:hover { 
        transform: translateY(-3px); 
    }
</style>

<div class="min-h-screen bg-gray-50 flex flex-col pt-24">

    <div class="flex flex-1">

        <div class="w-72 bg-white border-r border-gray-100 flex flex-col sticky top-[96px] h-[calc(100vh-96px)] flex-shrink-0">
            <div class="p-6 flex items-center gap-3">
                <div class="w-10 h-10 bg-violet-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold shadow-sm">📄</div>
                <h1 class="text-2xl font-bold text-gray-800 tracking-tight">CV Assistant</h1>
            </div>

            <nav class="flex-1 px-4 space-y-1">
                <a href="{{ url('/') }}" class="flex items-center gap-3 px-5 py-3.5 hover:bg-gray-50 rounded-2xl text-gray-600 font-medium transition-all">
                    <i class="fas fa-home text-lg text-gray-400"></i><span>Trang chủ</span>
                </a>
                <a href="{{ route('cv.evaluate') }}" class="flex items-center gap-3 px-5 py-3.5 bg-violet-50 rounded-2xl text-violet-700 font-semibold transition-all">
                    <i class="fas fa-chart-bar text-lg"></i><span>Đánh giá CV</span>
                </a>
                
                <a href="" class="flex items-center gap-3 px-5 py-3.5 hover:bg-gray-50 rounded-2xl text-gray-600 font-medium transition-all">
                    <i class="fas fa-plus text-lg text-gray-400"></i><span>Tạo CV</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-gray-50 rounded-2xl text-gray-600 font-medium transition-all">
                    <i class="fas fa-lightbulb text-lg text-gray-400"></i><span>Gợi ý CV</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-100 mt-auto">
                <a href="#" class="flex items-center gap-3 px-5 py-3 hover:bg-red-50 rounded-2xl text-red-600 font-medium transition-all">
                    <i class="fas fa-sign-out-alt"></i><span>Đăng xuất</span>
                </a>
            </div>
        </div>

        <div class="flex-1 min-w-0 overflow-auto">
            <div class="p-8 max-w-7xl mx-auto">
                
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-5 py-3.5 rounded-2xl mb-6 font-medium">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-5 py-3.5 rounded-2xl mb-6 font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Đánh giá CV chuyên sâu</h1>
                        <p class="text-gray-500 text-sm mt-1">Phân tích CV của bạn và tìm cơ hội nghề nghiệp phù hợp nhất</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <div class="lg:col-span-5">
                        <div class="bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm">
                            <div class="text-center mb-6">
                                <div class="w-16 h-16 mx-auto bg-violet-100 rounded-2xl flex items-center justify-center text-4xl mb-4">📄</div>
                                <h2 class="text-xl font-bold text-gray-800">Tải lên CV của bạn</h2>
                                <p class="text-gray-400 text-xs mt-1">Hệ thống AI sẽ tự động phân tích mức độ phù hợp</p>
                            </div>

                            <form id="cvForm" action="{{ route('cv.evaluate.analyze') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div id="dropZone" class="border-2 border-dashed border-gray-200 rounded-3xl py-10 px-6 text-center hover:border-violet-400 bg-gray-50/50 transition cursor-pointer">
                                    <div class="mx-auto w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-3xl mb-3">☁️</div>
                                    <p class="font-semibold text-sm text-gray-700">Kéo & thả file CV vào đây</p>
                                    <p class="text-gray-400 text-xs mt-1">hoặc</p>
                                    <button type="button" class="mt-4 bg-violet-600 hover:bg-violet-700 text-white px-6 py-2.5 rounded-2xl text-sm font-bold transition-all shadow-sm shadow-violet-100">
                                        Chọn file từ máy tính
                                    </button>
                                    <input type="file" id="cv_file" name="cv_file" accept=".pdf,.doc,.docx" class="hidden" required>
                                </div>

                                <div id="uploadedPreview" class="hidden bg-gray-50 border border-gray-100 rounded-2xl p-4 flex items-center gap-4 mt-6">
                                    <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center text-red-600 text-xs font-bold flex-shrink-0">DOCX</div>
                                    <div class="flex-1 min-w-0">
                                        <p id="fileNameDisplay" class="font-bold text-sm text-gray-800 truncate"></p>
                                        <p id="fileSizeDisplay" class="text-xs text-gray-400 mt-0.5"></p>
                                    </div>
                                    <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
                                </div>

                                <button type="submit" id="submitBtn"
                                        class="w-full mt-6 bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-bold py-4 rounded-2xl text-base disabled:opacity-50 transition-all shadow-sm shadow-violet-100"
                                        disabled>
                                    ✨ Bắt đầu phân tích ngay
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="lg:col-span-7 space-y-6">
                        @if(session('analysis'))
                            @php
                                $data = session('analysis');
                                $jobs = session('recommended_jobs');
                            @endphp

                            <div class="bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm">
                                <h3 class="font-bold text-lg text-gray-800 mb-4">Ngành nghề phù hợp nhất</h3>
                                <div class="bg-emerald-50/60 border border-emerald-100 rounded-3xl p-8 text-center">
                                    <p class="text-2xl font-bold text-gray-800">{{ $data['predicted_industry'] ?? 'Không xác định' }}</p>
                                    <p class="text-7xl font-black text-emerald-600 mt-4 tracking-tight">{{ $data['ats_score'] ?? 0 }}%</p>
                                    <p class="text-xs font-semibold text-emerald-700/70 mt-2 uppercase tracking-wider">Điểm tương thích ATS</p>
                                </div>
                            </div>

                            <div class="bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm">
                                <h3 class="font-bold text-lg text-gray-800 mb-4">Phân tích chi tiết</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-gray-50/50 rounded-2xl p-4 border border-gray-100">
                                        <h4 class="text-emerald-600 font-bold mb-3 flex items-center gap-2"><i class="fas fa-check-circle"></i> Điểm mạnh</h4>
                                        <ul class="list-disc pl-5 space-y-2 text-xs font-medium text-gray-600 leading-relaxed">
                                            @foreach($data['strengths'] ?? [] as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="bg-gray-50/50 rounded-2xl p-4 border border-gray-100">
                                        <h4 class="text-amber-600 font-bold mb-3 flex items-center gap-2"><i class="fas fa-exclamation-triangle"></i> Điểm cần cải thiện</h4>
                                        <ul class="list-disc pl-5 space-y-2 text-xs font-medium text-gray-600 leading-relaxed">
                                            @foreach($data['weaknesses'] ?? [] as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm">
                                <div class="flex justify-between items-center mb-5">
                                    <h3 class="font-bold text-lg text-gray-800">Cơ hội việc làm đề xuất</h3>
                                    <span class="text-xs font-bold bg-gray-100 text-gray-500 px-3 py-1 rounded-full">
                                        {{ $jobs ? $jobs->count() : 0 }} việc làm phù hợp
                                    </span>
                                </div>

                                @if($jobs && $jobs->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($jobs as $job)
                                        <div class="flex gap-4 bg-gray-50/50 hover:bg-gray-50 p-4 border border-gray-100/70 rounded-2xl transition-all">
                                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-xl border border-gray-100 shadow-sm flex-shrink-0">🏢</div>
                                            <div class="flex-1 min-w-0">
                                                <p class="font-bold text-gray-800 text-base truncate">
                                                    <a href="{{ route('jobs.show', $job->job_id) }}" style="text-decoration: none; color: inherit;">
                                                        {{ $job->job_title ?? 'Chưa cập nhật tiêu đề' }}
                                                    </a>
                                                </p>                                                
                                                <p class="text-sm text-gray-500 font-medium mt-0.5">{{ $job->employer->company_name ?? 'Công ty ẩn danh' }}</p>
                                                <p class="text-xs text-gray-400 font-medium mt-2">
                                                    <i class="fas fa-map-marker-alt mr-1"></i> {{ $job->location->location_name ?? 'Toàn quốc' }} • 
                                                    <i class="fas fa-briefcase class ml-2 mr-1"></i> {{ $job->jobType->job_type_name ?? 'Full-time' }}
                                                </p>
                                            </div>
                                            <div class="text-right flex-shrink-0 flex flex-col justify-between items-end">
                                                <span class="inline-block bg-emerald-50 text-emerald-700 text-[11px] font-bold px-2.5 py-1 rounded-full border border-emerald-100">
                                                    {{ $job->match_score ?? 50 }}% Match
                                                </span>
                                                <p class="text-xs font-bold text-orange-500 mt-2">
                                                    {{ $job->salary->salary_range ?? 'Thỏa thuận' }}
                                                </p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-12 text-gray-400 bg-gray-50/50 border border-dashed rounded-2xl">
                                        <p class="text-sm font-medium">Hệ thống chưa tìm được việc làm khớp với hồ sơ của bạn</p>
                                    </div>
                                @endif
                            </div>

                        @else
                            <div class="bg-white rounded-[32px] p-16 text-center text-gray-400 min-h-[500px] border border-gray-100 shadow-sm flex flex-col items-center justify-center">
                                <div class="text-6xl mb-4 opacity-70">📊</div>
                                <p class="text-lg font-bold text-gray-700">Chưa có dữ liệu phân tích</p>
                                <p class="text-gray-400 text-sm max-w-xs mt-1 leading-relaxed">Hãy tải file CV định dạng PDF hoặc Word ở khung bên trái để nhận đánh giá chi tiết.</p>
                            </div>
                        @endif
                    </div>
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
            
            // Lấy extension để đổi text trong khung preview icon
            // Lấy extension để đổi text trong khung preview icon
            const extension = file.name.split('.').pop().toUpperCase();
            const iconBlock = uploadedPreview.querySelector('.bg-red-100');
            if(iconBlock) iconBlock.textContent = extension;

            fileNameDisplay.textContent = file.name;
            fileSizeDisplay.textContent = `${sizeMB} MB`;
            uploadedPreview.classList.remove('hidden');
            submitBtn.disabled = false;
        }
    });
</script>
@endsection