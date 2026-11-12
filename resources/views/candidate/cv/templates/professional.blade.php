<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $resume->resume_title ?? 'CV Ứng Tuyển' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body { font-family: 'DejaVu Sans', 'Arial', sans-serif; }
        .section-title {
            border-bottom: 3px solid #1e40af;
            padding-bottom: 6px;
            margin-bottom: 12px;
        }
        .left-column { background: linear-gradient(180deg, #1e3a8a 0%, #172554 100%); }
    </style>
</head>
<body class="bg-gray-100 py-8">
    <div class="max-w-5xl mx-auto bg-white shadow-2xl overflow-hidden">
        <div class="grid grid-cols-12 min-h-[1100px]">
            
            <!-- CỘT TRÁI -->
            <div class="col-span-4 left-column text-white p-8">
                @if($resume->candidate && $resume->candidate->avatar)
                    <div class="w-40 h-40 mx-auto rounded-2xl overflow-hidden border-4 border-white shadow-lg mb-6">
                        <img src="{{ asset($resume->candidate->avatar) }}" 
                             alt="{{ $resume->candidate->full_name }}" 
                             class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="w-40 h-40 mx-auto rounded-2xl bg-white/20 flex items-center justify-center text-6xl mb-6">
                        👤
                    </div>
                @endif

                <h1 class="text-3xl font-bold text-center mb-1">{{ $resume->candidate->full_name ?? 'Họ và Tên' }}</h1>
                <p class="text-center text-blue-200 text-lg mb-8">{{ $resume->resume_title ?? 'Vị trí ứng tuyển' }}</p>

                <!-- Mục tiêu nghề nghiệp -->
                <div class="mb-8">
                    <h3 class="text-blue-200 uppercase text-sm tracking-widest mb-3">MỤC TIÊU NGHỀ NGHIỆP</h3>
                    <p class="text-sm leading-relaxed text-gray-100">
                        {{ $resume->career_objective ?? 'Chưa cập nhật mục tiêu nghề nghiệp.' }}
                    </p>
                </div>

                <!-- Kỹ năng -->
                <div class="mb-8">
                    <h3 class="text-blue-200 uppercase text-sm tracking-widest mb-3">KỸ NĂNG</h3>
                    <ul class="space-y-2 text-sm">
                        @foreach(explode(',', $resume->soft_skills ?? '') as $skill)
                            @if(trim($skill))
                                <li class="flex items-center gap-2">
                                    <i class="fas fa-check text-emerald-400"></i>
                                    {{ trim($skill) }}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <!-- Thông tin liên hệ -->
                <div>
                    <h3 class="text-blue-200 uppercase text-sm tracking-widest mb-3">LIÊN HỆ</h3>
                    <div class="space-y-3 text-sm">
                        @if($resume->candidate->phone)
                            <p><i class="fas fa-phone w-5"></i> {{ $resume->candidate->phone }}</p>
                        @endif
                        @if($resume->candidate->address)
                            <p><i class="fas fa-map-marker-alt w-5"></i> {{ $resume->candidate->address }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- CỘT PHẢI -->
            <div class="col-span-8 p-10 bg-white">
                
                <!-- Kinh nghiệm làm việc -->
                <div class="mb-10">
                    <h2 class="section-title text-2xl font-bold text-gray-800">KINH NGHIỆM LÀM VIỆC</h2>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br($resume->experience) ?? '<p class="text-gray-400">Chưa có kinh nghiệm được cập nhật.</p>' !!}
                    </div>
                </div>

                <!-- Học vấn -->
                <div class="mb-10">
                    <h2 class="section-title text-2xl font-bold text-gray-800">HỌC VẤN</h2>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br($resume->education) ?? '<p class="text-gray-400">Chưa cập nhật thông tin học vấn.</p>' !!}
                    </div>
                </div>

                <!-- Giải thưởng & Chứng chỉ -->
                @if($resume->awards)
                <div class="mb-10">
                    <h2 class="section-title text-2xl font-bold text-gray-800">GIẢI THƯỞNG & CHỨNG CHỈ</h2>
                    <p class="text-gray-700">{{ $resume->awards }}</p>
                </div>
                @endif

            </div>
        </div>
    </div>
    <!-- Nút Tải PDF -->
<div class="fixed top-6 right-6 z-50">
    <a href="{{ route('cv.download.pdf', $resume->resume_id) }}" 
       class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl shadow-lg font-medium transition">
        <i class="fas fa-download"></i>
        Tải CV PDF
    </a>
</div>
</body>
</html>