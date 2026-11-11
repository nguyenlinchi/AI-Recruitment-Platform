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
        .section-title { border-bottom: 3px solid #1e40af; padding-bottom: 6px; margin-bottom: 12px; }
        .left-column { background: linear-gradient(180deg, #1e3a8a 0%, #172554 100%); }
        [contenteditable]:focus {
            outline: 2px dashed #3b82f6;
            border-radius: 4px;
        }
    </style>
</head>
<body class="bg-gray-100 py-8">
    <div class="max-w-5xl mx-auto bg-white shadow-2xl overflow-hidden">
        <div class="grid grid-cols-12 min-h-[1100px]">
            
            <!-- CỘT TRÁI -->
            <div class="col-span-4 left-column text-white p-8">
                <div class="w-40 h-40 mx-auto rounded-2xl overflow-hidden border-4 border-white shadow-lg mb-6">
                    @if($resume->candidate && $resume->candidate->avatar)
                        <img src="{{ asset($resume->candidate->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-white/20 flex items-center justify-center text-6xl">👤</div>
                    @endif
                </div>

                <h1 id="full_name" contenteditable="true" class="text-3xl font-bold text-center mb-1">{{ $resume->candidate->full_name ?? 'Họ và Tên' }}</h1>
                <p id="resume_title" contenteditable="true" class="text-center text-blue-200 text-lg mb-8">{{ $resume->resume_title ?? 'Vị trí ứng tuyển' }}</p>

                <!-- Mục tiêu -->
                <div class="mb-8">
                    <h3 class="text-blue-200 uppercase text-sm tracking-widest mb-3">MỤC TIÊU NGHỀ NGHIỆP</h3>
                    <p id="career_objective" contenteditable="true" class="text-sm leading-relaxed text-gray-100">
                        {{ $resume->career_objective ?? 'Chưa cập nhật...' }}
                    </p>
                </div>

                <!-- Kỹ năng -->
                <div class="mb-8">
                    <h3 class="text-blue-200 uppercase text-sm tracking-widest mb-3">KỸ NĂNG</h3>
                    <div id="soft_skills" contenteditable="true" class="text-sm space-y-2">
                        @foreach(explode(',', $resume->soft_skills ?? '') as $skill)
                            @if(trim($skill))<div class="flex items-center gap-2">• {{ trim($skill) }}</div>@endif
                        @endforeach
                    </div>
                </div>

                <!-- Liên hệ -->
                <div>
                    <h3 class="text-blue-200 uppercase text-sm tracking-widest mb-3">LIÊN HỆ</h3>
                    <div class="space-y-3 text-sm">
                        <p><i class="fas fa-phone w-5"></i> <span id="phone" contenteditable="true">{{ $resume->candidate->phone ?? '' }}</span></p>
                        <p><i class="fas fa-map-marker-alt w-5"></i> <span id="address" contenteditable="true">{{ $resume->candidate->address ?? '' }}</span></p>
                    </div>
                </div>
            </div>

            <!-- CỘT PHẢI -->
            <div class="col-span-8 p-10 bg-white">
                <div class="mb-10">
                    <h2 class="section-title text-2xl font-bold text-gray-800">KINH NGHIỆM LÀM VIỆC</h2>
                    <div id="experience" contenteditable="true" class="prose max-w-none text-gray-700">
                        {!! nl2br($resume->experience) !!}
                    </div>
                </div>

                <div class="mb-10">
                    <h2 class="section-title text-2xl font-bold text-gray-800">HỌC VẤN</h2>
                    <div id="education" contenteditable="true" class="prose max-w-none text-gray-700">
                        {!! nl2br($resume->education) !!}
                    </div>
                </div>

                @if($resume->awards)
                <div class="mb-10">
                    <h2 class="section-title text-2xl font-bold text-gray-800">GIẢI THƯỞNG & CHỨNG CHỈ</h2>
                    <div id="awards" contenteditable="true" class="text-gray-700">{{ $resume->awards }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Nút hành động -->
    <div class="fixed top-6 right-6 z-50 flex gap-3">
        <button onclick="saveAndDownloadPDF()" 
                class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-2xl shadow-lg font-medium transition">
            <i class="fas fa-download"></i>
            Lưu & Tải PDF
        </button>
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
        awards: document.getElementById('awards') ? document.getElementById('awards').innerText.trim() : '',
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
            window.location.href = `{{ route('cv.download.pdf', [$resume->resume_id, $template ?? 'professional']) }}`;
        } else {
            alert('Có lỗi khi lưu CV!');
        }
    } catch (error) {
        console.error(error);
        alert('Lỗi kết nối!');
    }
}
</script>
</body>
</html>