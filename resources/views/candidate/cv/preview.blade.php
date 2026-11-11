<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem trước CV - {{ $template_name ?? 'Professional' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        .cv-container {
            box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            max-width: 1100px;
            margin: 40px auto;
            background: white;
            overflow: hidden;
            border-radius: 12px;
        }
    </style>
</head>
<body class="bg-gray-100 py-12">

    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Xem trước Mẫu CV</h1>
                <p class="text-gray-600">Mẫu: <strong>{{ ucfirst($template_name) }}</strong></p>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('cv.templates') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-100 flex items-center gap-2">
                    ← Quay lại Thư viện
                </a>
                <a href="{{ route('cv.edit') }}" 
                   class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 flex items-center gap-2">
                    <i class="fas fa-edit"></i> Sử dụng & Chỉnh sửa mẫu này
                </a>
            </div>
        </div>

        <!-- Preview CV -->
        <div class="cv-container">
            @if($template_name === 'professional')
                @include('candidate.cv.templates.professional')
            @elseif($template_name === 'professional1')
                @include('candidate.cv.templates.professional1')
            @elseif($template_name === 'professional2')
                @include('candidate.cv.templates.professional2')
            @elseif($template_name === 'professional3')
                @include('candidate.cv.templates.professional3')
            @else
                <div class="p-20 text-center text-gray-500">
                    <p>Mẫu CV không tồn tại hoặc chưa được tạo.</p>
                </div>
            @endif
        </div>
    </div>

</body>
</html>