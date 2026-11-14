<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $resume->resume_title ?? 'CV - Võ Đức Toàn' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body { font-family: 'DejaVu Sans', Arial, sans-serif !important; }
        .header-bg { background: linear-gradient(to right, #f8e1e7, #f3d4e0); }
        .section-title {
            background-color: #1e40af;
            color: white;
            padding: 6px 16px;
            font-weight: 700;
            font-size: 1.1rem;
            border-radius: 4px;
        }
        .hexagon {
            clip-path: polygon(30% 0%, 70% 0%, 100% 50%, 70% 100%, 30% 100%, 0% 50%);
        }
        [contenteditable="true"]:focus {
            outline: 2px solid #3b82f6;
            border-radius: 4px;
        }
    </style>
</head>
<body class="bg-gray-100 py-8">
    <div class="max-w-5xl mx-auto bg-white shadow-2xl overflow-hidden">
        
        <!-- HEADER -->
        <div class="header-bg p-8 grid grid-cols-12 items-center">
            <div class="col-span-4 flex justify-center">
                <div class="w-48 h-48 hexagon border-4 border-white shadow-xl overflow-hidden">
                    @if($resume->candidate && $resume->candidate->avatar)
                        <img src="{{ asset($resume->candidate->avatar) }}" 
                             alt="{{ $resume->candidate->full_name }}" 
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gray-300 flex items-center justify-center text-7xl">👤</div>
                    @endif
                </div>
            </div>
            
            <div class="col-span-8">
                <h1 id="full_name" contenteditable="true" class="text-4xl font-bold text-gray-800">
                    {{ $resume->candidate->full_name ?? 'VÕ ĐỨC TOÀN' }}
                </h1>
                <p id="resume_title" contenteditable="true" class="text-xl text-blue-700 mt-1">
                    {{ $resume->resume_title ?? 'Quản Lý Kinh Doanh' }}
                </p>
                <p id="career_objective" contenteditable="true" class="text-gray-600 mt-4 text-sm leading-relaxed">
                    {{ $resume->career_objective ?? 'Quản lý kinh doanh năng động với hơn 8 năm kinh nghiệm...' }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-12">
            
            <!-- CỘT TRÁI -->
            <div class="col-span-5 bg-white border-r p-8 space-y-8">
                
                <!-- LIÊN HỆ -->
                <div>
                    <h2 class="section-title">LIÊN HỆ</h2>
                    <div class="mt-4 space-y-3 text-sm">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-phone text-blue-700"></i>
                            <span id="phone" contenteditable="true">{{ $resume->candidate->phone ?? '' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-blue-700"></i>
                            <span id="address" contenteditable="true">{{ $resume->candidate->address ?? '' }}</span>
                        </div>
                    </div>
                </div>

                <!-- KINH NGHIỆM LÀM VIỆC -->
                <div>
                    <h2 class="section-title">KINH NGHIỆM LÀM VIỆC</h2>
                    <div id="experience" contenteditable="true" class="mt-6 space-y-6 text-sm">
                        {!! $resume->experience !!}
                    </div>
                </div>

                <!-- DỰ ÁN -->
                <div>
                    <h2 class="section-title">DỰ ÁN</h2>
                    <div class="mt-4 text-sm space-y-4">
                        {!! nl2br($resume->projects ?? 'Chưa có thông tin dự án.') !!}
                    </div>
                </div>
            </div>

            <!-- CỘT PHẢI -->
            <div class="col-span-7 p-8 space-y-8">
                
                <!-- HỌC VẤN -->
                <div>
                    <h2 class="section-title">HỌC VẤN</h2>
                    <div id="education" contenteditable="true" class="mt-4">
                        {!! $resume->education !!}
                    </div>
                </div>

                <!-- KỸ NĂNG -->
                <div>
                    <h2 class="section-title">KỸ NĂNG</h2>
                    <div id="soft_skills" contenteditable="true" class="mt-4">
                        <ul class="grid grid-cols-2 gap-x-6 gap-y-2 text-sm">
                            @foreach(explode(',', $resume->soft_skills ?? '') as $skill)
                                @if(trim($skill))
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-check text-emerald-500"></i>
                                        {{ trim($skill) }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- GIẢI THƯỞNG -->
                <div>
                    <h2 class="section-title">GIẢI THƯỞNG</h2>
                    <div id="awards" contenteditable="true" class="mt-4 text-sm">
                        {!! nl2br($resume->awards ?? 'Chưa có giải thưởng.') !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- NÚT LƯU & TẢI PDF -->
        <div class="p-6 text-center border-t">
            <button onclick="saveAndDownloadPDF()" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg inline-flex items-center gap-2">
                <i class="fas fa-save"></i>
                Lưu & Tải PDF
            </button>
        </div>
    </div>

<script>
async function saveAndDownloadPDF() {
    const data = {
        resume_id: {{ $resume->resume_id }},
        full_name: document.getElementById('full_name').innerText.trim(),
        resume_title: document.getElementById('resume_title').innerText.trim(),
        career_objective: document.getElementById('career_objective').innerText.trim(),
        soft_skills: document.getElementById('soft_skills').innerText.trim().replace(/\n/g, ','),
        phone: document.getElementById('phone').innerText.trim(),
        address: document.getElementById('address').innerText.trim(),
        experience: document.getElementById('experience').innerHTML,
        education: document.getElementById('education').innerHTML,
        awards: document.getElementById('awards').innerText.trim(),
    };

    try {
        const response = await fetch('{{ route("cv.save.edited", $resume->resume_id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        });

        if (response.ok) {
            // ✅ Dòng này là quan trọng nhất
            window.location.href = `{{ route('cv.download.pdf', [$resume->resume_id, 'professional1']) }}`;
        } else {
            alert('Có lỗi khi lưu CV!');
        }
    } catch (error) {
        console.error(error);
        alert('Lỗi kết nối server!');
    }
}
</script>
</body>
</html>