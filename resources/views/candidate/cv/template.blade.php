@extends('layout.header')

@section('title', 'Giới thiệu - FPT Jobs')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<body class="bg-gray-50 min-h-screen pt-20">
    <div class="max-w-7xl mx-auto py-12 px-6">
        
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800">Chọn mẫu CV của bạn</h1>
            <p class="text-gray-600 mt-3">Hơn 10 mẫu CV chuyên nghiệp - Dễ dàng tùy chỉnh</p>
        
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
           
            <!-- Mẫu 1 -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                <div class="h-96 bg-gray-100 relative overflow-hidden">
                    <img src="{{ asset('images/pr1.png') }}" 
                         alt="Professional CV" 
                         class="w-full h-full object-cover hover:scale-105 transition duration-300">
                    <div class="absolute top-4 right-4 bg-green-500 text-white text-xs px-3 py-1 rounded-full font-medium">Hot</div>
                </div>
                <div class="p-6">
                    <h3 class="font-semibold text-xl">Mẫu 1</h3>
                    <p class="text-gray-500 text-sm mt-1">Phong cách chuyên nghiệp cổ điển</p>
                    <button onclick="useTemplate('professional1')" 
                            class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-medium">
                        Sử dụng mẫu này
                    </button>
                </div>
            </div>

            <!-- Mẫu 2 -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                <div class="h-96 bg-gray-100 relative overflow-hidden">
                    <img src="{{ asset('images/pr2.png') }}" 
                         alt="Professional 1" 
                         class="w-full h-full object-cover hover:scale-105 transition duration-300">
                </div>
                <div class="p-6">
                    <h3 class="font-semibold text-xl">Mẫu 2</h3>
                    <p class="text-gray-500 text-sm mt-1">Thiết kế hiện đại</p>
                    <button onclick="useTemplate('professional2')" 
                            class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-medium">
                        Sử dụng mẫu này
                    </button>
                </div>
            </div>

            <!-- Mẫu 3 -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                <div class="h-96 bg-gray-100 relative overflow-hidden">
                    <img src="{{ asset('images/professional.png') }}" 
                         alt="Professional 2" 
                         class="w-full h-full object-cover hover:scale-105 transition duration-300">
                </div>
                <div class="p-6">
                    <h3 class="font-semibold text-xl">Mẫu 3</h3>
                    <p class="text-gray-500 text-sm mt-1">Phong cách tối sang trọng</p>
                    <button onclick="useTemplate('professional')" 
                            class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-medium">
                        Sử dụng mẫu này
                    </button>
                </div>
            </div>

            <!-- Mẫu 4 -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                <div class="h-96 bg-gray-100 relative overflow-hidden">
                    <img src="{{ asset('images/pr4.png') }}" 
                         alt="Professional 3" 
                         class="w-full h-full object-cover hover:scale-105 transition duration-300">
                </div>
                <div class="p-6">
                    <h3 class="font-semibold text-xl">Mẫu 4</h3>
                    <p class="text-gray-500 text-sm mt-1">Phong cách màu sắc nổi bật</p>
                    <button onclick="useTemplate('professional3')" 
                            class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-medium">
                        Sử dụng mẫu này
                    </button>
                </div>
            </div>



            <!-- mẫu 5 -->
              <!-- Mẫu 1 -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                <div class="h-96 bg-gray-100 relative overflow-hidden">
                    <img src="{{ asset('images/pr5.png') }}" 
                         alt="Professional CV" 
                         class="w-full h-full object-cover hover:scale-105 transition duration-300">
                    <div class="absolute top-4 right-4 bg-green-500 text-white text-xs px-3 py-1 rounded-full font-medium">Hot</div>
                </div>
                <div class="p-6">
                    <h3 class="font-semibold text-xl">Mẫu 5</h3>
                    <p class="text-gray-500 text-sm mt-1">Phong cách chuyên nghiệp cổ điển</p>
                    <button onclick="useTemplate('professional1')" 
                            class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-medium">
                        Sử dụng mẫu này
                    </button>
                </div>
            </div>

            <!-- Mẫu 2 -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                <div class="h-96 bg-gray-100 relative overflow-hidden">
                    <img src="{{ asset('images/pr6.png') }}" 
                         alt="Professional 1" 
                         class="w-full h-full object-cover hover:scale-105 transition duration-300">
                </div>
                <div class="p-6">
                    <h3 class="font-semibold text-xl">Mẫu 6</h3>
                    <p class="text-gray-500 text-sm mt-1">Thiết kế hiện đại</p>
                    <button onclick="useTemplate('professional2')" 
                            class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-medium">
                        Sử dụng mẫu này
                    </button>
                </div>
            </div>

            <!-- Mẫu 3 -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                <div class="h-96 bg-gray-100 relative overflow-hidden">
                    <img src="{{ asset('images/pr3.png') }}" 
                         alt="Professional 2" 
                         class="w-full h-full object-cover hover:scale-105 transition duration-300">
                </div>
                <div class="p-6">
                    <h3 class="font-semibold text-xl">Mẫu 7</h3>
                    <p class="text-gray-500 text-sm mt-1">Phong cách tối sang trọng</p>
                    <button onclick="useTemplate('professional')" 
                            class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-medium">
                        Sử dụng mẫu này
                    </button>
                </div>
            </div>

            <!-- Mẫu 4 -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                <div class="h-96 bg-gray-100 relative overflow-hidden">
                    <img src="{{ asset('images/pr4.png') }}" 
                         alt="Professional 3" 
                         class="w-full h-full object-cover hover:scale-105 transition duration-300">
                </div>
                <div class="p-6">
                    <h3 class="font-semibold text-xl">Mẫu 8</h3>
                    <p class="text-gray-500 text-sm mt-1">Phong cách màu sắc nổi bật</p>
                    <button onclick="useTemplate('professional3')" 
                            class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-medium">
                        Sử dụng mẫu này
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
       

        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('resume_id')) {
            resumeId = urlParams.get('resume_id');
        }

        function useTemplate(templateName) {
            window.location.href = `/preview-cv/${resumeId}/${templateName}`;
        }
    </script>
@include('layout.footer')

@endsection