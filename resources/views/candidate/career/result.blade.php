@extends('layout.header')

@section('content')

    <style>

        body{
            font-family:Arial;
            background:#f4f7ff;
            padding:40px;
        }

        .result-box{
            max-width:900px;
            margin:auto;
            background:white;
            padding:50px;
            border-radius:25px;
        }

        h1{
            color:#2563eb;
            font-size:55px;
            text-align:center;
        }

        h2{
            text-align:center;
            margin-top:10px;
        }

        .desc{
            text-align:center;
            margin-top:20px;
            line-height:1.8;
            color:#475569;
        }

        .section{
            margin-top:30px;
            background:#eef2ff;
            padding:25px;
            border-radius:18px;
        }

        .section h3{
            color:#2563eb;
            margin-bottom:15px;
        }

        ul{
            padding-left:20px;
        }

        li{
            margin-bottom:10px;
            color:#334155;
        }

        .tags{
            display:flex;
            flex-wrap:wrap;
            gap:12px;
            margin-top:15px;
        }

        .tag{
            background:#2563eb;
            color:white;
            padding:10px 18px;
            border-radius:30px;
            font-size:14px;
        }

        .btn{
            display:inline-block;
            margin-top:35px;
            padding:14px 30px;
            background:#2563eb;
            color:white;
            text-decoration:none;
            border-radius:12px;
        }

        .center{
            text-align:center;
        }

    </style>
</head>
<body>

<div class="result-box">

    <h1>{{ $result }}</h1>

    <h2>{{ $data['name'] }}</h2>

    <p class="desc">
        {{ $data['description'] }}
    </p>

    {{-- Điểm mạnh --}}
    <div class="section">

        <h3>Điểm mạnh</h3>

        <ul>

            @foreach($data['strengths'] as $item)

                <li>{{ $item }}</li>

            @endforeach

        </ul>

    </div>

    {{-- Điểm yếu --}}
    <div class="section">

        <h3>Điểm yếu</h3>

        <ul>

            @foreach($data['weaknesses'] as $item)

                <li>{{ $item }}</li>

            @endforeach

        </ul>

    </div>

    {{-- Ngành nghề --}}
    <div class="section">

        <h3>Ngành nghề phù hợp</h3>

        <div class="tags">
    @foreach($data['career'] as $career)
        {{-- Chuyển từ div thành thẻ a --}}
        <a href="{{ route('jobs.mbti.filter', ['keyword' => $career]) }}" class="tag">
            {{ $career }}
        </a>
    @endforeach
        </div>

    </div>


    {{-- Môi trường --}}
    <div class="section">

        <h3>Môi trường làm việc phù hợp</h3>

        <p>
            {{ $data['work_env'] }}
        </p>

    </div>

    <div class="center">

        <a href="{{ route('mbti.test') }}" class="btn">
            Làm lại bài test
        </a>

    </div>

</div>

@endsection