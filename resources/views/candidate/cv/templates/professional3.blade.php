<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $resume->resume_title ?? 'CV - Nguyễn Thị Linh Chi' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body { font-family: 'Arial', 'Helvetica', sans-serif; }
        .dark-sidebar { background-color: #0f172a; }
        .section-title {
            color: #1e40af;
            font-size: 1.1rem;
            font-weight: 700;
            position: relative;
            padding-bottom: 6px;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #1e40af;
        }
        .skill-pill {
            background-color: #f1f5f9;
            padding: 6px 14px;
            border-radius: 9999px;
            font-size: 0.9rem;
        }

        /* CSS cho chỉnh sửa */
        [contenteditable="true"]:focus {
            outline: 2px solid #3b82f6;
            border-radius: 4px;
            background-color: #f8fafc;
        }
    </style>
</head>
<body class="bg-gray-100 py-8">
    <div class="max-w-6xl mx-auto bg-white shadow-2xl overflow-hidden">
        
        <!-- HEADER -->
        <div class="grid grid-cols-12">
            <!-- Cột trái + Ảnh -->
            <div class="col-span-5 dark-sidebar text-white pt-8 pb-6 relative">
                <div class="flex justify-center -mt-6">
                    <div class="w-52 h-52 rounded-full overflow-hidden border-4 border-white shadow-2xl">
                        @if($resume->candidate && $resume->candidate->avatar)
                            <img src="{{ asset($resume->candidate->avatar) }}" 
                                 alt="{{ $resume->candidate->full_name }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-slate-700 flex items-center justify-center text-8xl">👤</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Cột phải Header -->
            <div class="col-span-7 pt-10 pr-10">
                <h1 id="full_name" contenteditable="true" class="text-4xl font-bold text-slate-800">
                    {{ $resume->full_name ?? $resume->candidate->full_name ?? 'Nguyễn Thị Linh Chi' }}
                </h1>
                <p id="resume_title" contenteditable="true" class="text-blue-600 text-2xl mt-1">
                    {{ $resume->resume_title ?? 'CV PHP Developer' }}
                </p>
                <p id="career_objective" contenteditable="true" class="text-gray-600 mt-2">
                    {{ $resume->career_objective }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-12">
            
            <!-- CỘT TRÁI - DARK -->
            <div class="col-span-5 dark-sidebar text-white p-8 space-y-8">
                
                <div>
                    <h2 class="uppercase text-sm tracking-widest mb-2">MỤC TIÊU NGHỀ NGHIỆP</h2>
                    <p id="career_objective_sidebar" contenteditable="true" class="text-sm text-slate-300">
                        {{ $resume->career_objective }}
                    </p>
                </div>

                <div>
                    <h2 class="uppercase text-sm tracking-widest mb-3">KỸ NĂNG</h2>
                    <div id="soft_skills" contenteditable="true" class="text-sm space-y-2 text-slate-300">
                        @foreach(explode(',', $resume->soft_skills ?? '') as $skill)
                            @if(trim($skill))
                                <div>• {{ trim($skill) }}</div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div>
                    <h2 class="uppercase text-sm tracking-widest mb-3">NGÔN NGỮ</h2>
                    <div id="languages" contenteditable="true" class="text-sm space-y-2">
                        {!! nl2br($resume->languages ?? '') !!}
                    </div>
                </div>

                <div>
                    <h2 class="uppercase text-sm tracking-widest mb-3">NGƯỜI THAM CHIẾU</h2>
                    <p id="references" contenteditable="true" class="text-sm text-slate-300">
                        {!! nl2br($resume->references ?? '') !!}
                    </p>
                </div>
            </div>

            <!-- CỘT PHẢI - WHITE -->
            <div class="col-span-7 p-8 space-y-10 bg-white">
                
                <!-- KINH NGHIỆM LÀM VIỆC -->
                <div>
                    <h2 class="section-title">KINH NGHIỆM LÀM VIỆC</h2>
                    <div id="experience" contenteditable="true" class="mt-4 text-sm">
                        {!! $resume->experience ?? '' !!}
                    </div>
                </div>

                <!-- HỌC VẤN -->
                <div>
                    <h2 class="section-title">HỌC VẤN</h2>
                    <div id="education" contenteditable="true" class="mt-4 text-sm">
                        {!! $resume->education ?? '' !!}
                    </div>
                </div>

                <!-- KỸ NĂNG MỀM -->
                <div>
                    <h2 class="section-title">KỸ NĂNG MỀM</h2>
                    <div id="soft_skills_pills" contenteditable="true" class="flex flex-wrap gap-3 mt-4">
                        @foreach(explode(',', $resume->soft_skills ?? '') as $skill)
                            @if(trim($skill))
                                <span class="skill-pill">{{ trim($skill) }}</span>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- CHỨNG CHỈ -->
                <div>
                    <h2 class="section-title">CHỨNG CHỈ</h2>
                    <div id="certifications" contenteditable="true" class="mt-4 text-sm">
                        {!! $resume->certifications ?? '' !!}
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
            experience: document.getElementById('experience').innerHTML,
            education: document.getElementById('education').innerHTML,
            certifications: document.getElementById('certifications').innerHTML,
            languages: document.getElementById('languages').innerHTML,
            references: document.getElementById('references').innerText.trim(),
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
                window.location.href = `{{ route('cv.download.pdf', [$resume->resume_id, 'professional3']) }}`;
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