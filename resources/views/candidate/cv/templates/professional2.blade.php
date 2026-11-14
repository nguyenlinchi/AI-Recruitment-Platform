<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $resume->resume_title ?? 'CV' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body { font-family: 'DejaVu Sans', Arial, sans-serif !important; }
       
        .section-header {
            padding: 8px 18px;
            font-weight: 700;
            border-radius: 9999px;
            display: inline-block;
            margin-bottom: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
       
        .info-box {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }

        [contenteditable="true"]:focus {
            outline: 2px solid #3b82f6;
            border-radius: 8px;
            background-color: #f8fafc;
        }
    </style>
</head>
<body class="bg-gray-100 py-8">
    <div class="max-w-6xl mx-auto bg-white shadow-2xl overflow-hidden">
       
        <!-- HEADER -->
        <div class="bg-gradient-to-r from-pink-50 to-rose-50 p-8 grid grid-cols-12 items-center gap-8 border-b">
            <div class="col-span-3 flex justify-center">
                <div class="w-44 h-44 rounded-full overflow-hidden border-4 border-white shadow-2xl">
                    @if($resume->candidate && $resume->candidate->avatar)
                        <img src="{{ asset($resume->candidate->avatar) }}"
                             alt="{{ $resume->candidate->full_name }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-7xl">👤</div>
                    @endif
                </div>
            </div>
           
            <div class="col-span-9">
                <h1 id="full_name" contenteditable="true" class="text-4xl font-bold text-gray-800">
                    {{ $resume->full_name ?? $resume->candidate->full_name ?? 'VÕ ĐỨC TOÀN' }}
                </h1>
                <p id="resume_title" contenteditable="true" class="text-2xl text-blue-700 mt-1">
                    {{ $resume->resume_title ?? 'Quản Lý Kinh Doanh' }}
                </p>
                <p id="career_objective" contenteditable="true" class="text-gray-600 mt-4 leading-relaxed text-[15px]">
                    {{ $resume->career_objective }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-12">
           
            <!-- CỘT TRÁI -->
            <div class="col-span-5 bg-gray-50 p-8 space-y-6 border-r">
               
                <!-- THÔNG TIN LIÊN HỆ -->
                <div class="info-box">
                    <h2 class="section-header bg-yellow-400 text-white text-sm">THÔNG TIN LIÊN HỆ</h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-phone text-yellow-500"></i>
                            <span id="phone" contenteditable="true">{{ $resume->phone ?? $resume->candidate->phone ?? '' }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-envelope text-yellow-500"></i>
                            <span id="email" contenteditable="true">{{ $resume->candidate->email ?? '' }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-map-marker-alt text-yellow-500"></i>
                            <span id="address" contenteditable="true">{{ $resume->address ?? $resume->candidate->address ?? '' }}</span>
                        </div>
                    </div>
                </div>

                <!-- CHUYÊN MÔN -->
                <div class="info-box">
                    <h2 class="section-header bg-blue-600 text-white text-sm">CHUYÊN MÔN</h2>
                    <div id="soft_skills" contenteditable="true" class="text-sm space-y-2 pl-2">
                        @foreach(explode(',', $resume->soft_skills ?? '') as $item)
                            @if(trim($item))
                                <div>• {{ trim($item) }}</div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- NGÔN NGỮ -->
                <div class="info-box">
                    <h2 class="section-header bg-purple-600 text-white text-sm">NGÔN NGỮ</h2>
                    <div id="languages" contenteditable="true" class="text-sm space-y-2 pl-2">
                        {!! nl2br($resume->languages ?? '') !!}
                    </div>
                </div>

                <!-- CHỨNG CHỈ -->
                <div class="info-box">
                    <h2 class="section-header bg-red-500 text-white text-sm">CHỨNG CHỈ</h2>
                    <div id="certifications" contenteditable="true" class="text-sm space-y-2 pl-2">
                        {!! nl2br($resume->certifications ?? '') !!}
                    </div>
                </div>

                <!-- GIẢI THƯỞNG -->
                <div class="info-box">
                    <h2 class="section-header bg-amber-500 text-white text-sm">GIẢI THƯỞNG</h2>
                    <div id="awards" contenteditable="true" class="text-sm pl-2">
                        {!! nl2br($resume->awards ?? '') !!}
                    </div>
                </div>
            </div>

            <!-- CỘT PHẢI -->
            <div class="col-span-7 p-8 space-y-8">
               
                <!-- KINH NGHIỆM -->
                <div>
                    <h2 class="section-header bg-pink-600 text-white text-sm">KINH NGHIỆM LÀM VIỆC</h2>
                    <div id="experience" contenteditable="true" class="mt-5 space-y-6 text-sm">
                        {!! $resume->experience ?? '' !!}
                    </div>
                </div>

                <!-- HỌC VẤN -->
                <div>
                    <h2 class="section-header bg-emerald-600 text-white text-sm">HỌC VẤN</h2>
                    <div id="education" contenteditable="true" class="mt-5">
                        {!! $resume->education ?? '' !!}
                    </div>
                </div>

                <!-- DỰ ÁN -->
                <div>
                    <h2 class="section-header bg-cyan-600 text-white text-sm">DỰ ÁN</h2>
                    <div id="projects" contenteditable="true" class="mt-5 text-sm space-y-6">
                        {!! $resume->projects ?? '' !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- NÚT LƯU & TẢI PDF -->
        <div class="p-6 text-center border-t bg-gray-50">
            <button onclick="saveAndDownloadPDF()" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg inline-flex items-center gap-2 shadow-lg">
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
                // Tải theo template professional2
                window.location.href = `{{ route('cv.download.pdf', [$resume->resume_id, 'professional2']) }}`;
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