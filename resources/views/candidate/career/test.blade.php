@extends('layout.header')

@section('content')
<style>
    .mbti-test-wrapper { background: #f8fafc; padding: 100px 0;
     min-height: 100vh;
 }
    .progress-sticky { position: sticky; top: 70px; z-index: 100; background: rgba(255,255,255,0.8); backdrop-filter: blur(8px); padding: 15px 0; border-bottom: 1px solid #e2e8f0; margin-bottom: 30px; }
    .q-card { background: white; border-radius: 20px; padding: 30px; margin-bottom: 25px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 2px solid transparent; transition: 0.3s; }
    .q-card.active { border-color: #2563eb; transform: scale(1.02); }
    .option-btn { display: block; padding: 15px 20px; border: 2px solid #f1f5f9; border-radius: 12px; margin-top: 10px; cursor: pointer; transition: 0.2s; position: relative; }
    .option-btn:hover { border-color: #2563eb; background: #eff6ff; }
    input[type="radio"] { position: absolute; opacity: 0; }
    input[type="radio"]:checked + .option-text { color: #2563eb; font-weight: bold; }
    input[type="radio"]:checked ~ .option-btn { border-color: #2563eb; background: #eff6ff; }
    .btn-submit { background: #2563eb; color: white; border: none; padding: 15px 30px; border-radius: 12px; width: 100%; font-weight: bold; font-size: 18px; cursor: pointer; }
</style>

<div class="mbti-test-wrapper">
    <div class="progress-sticky">
        <div class="container" style="max-width: 800px;">
            <div class="d-flex justify-content-between mb-2">
                <span class="fw-bold text-primary">Tiến trình khám phá</span>
                <span id="percent-val">0%</span>
            </div>
            <div class="progress" style="height: 10px;">
                <div id="progress-bar" class="progress-bar bg-primary" style="width: 0%"></div>
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 800px;">
        <form action="{{ route('mbti.submit') }}" method="POST">
            @csrf
            @foreach($questions as $idx => $q)
                <div class="q-card" id="q-{{ $idx }}">
                    <h5 class="mb-4">Câu {{ $idx + 1 }}: {{ $q['question'] }}</h5>
                    
                    <label class="option-btn" onclick="markDone({{ $idx }})">
                        <input type="radio" name="answers[{{ $idx }}]" value="{{ $q['typeA'] }}" >
                        <span class="option-text">{{ $q['a'] }}</span>
                    </label>

                    <label class="option-btn" onclick="markDone({{ $idx }})">
                        <input type="radio" name="answers[{{ $idx }}]" value="{{ $q['typeB'] }}">
                        <span class="option-text">{{ $q['b'] }}</span>
                    </label>
                </div>
            @endforeach
            
            <button type="submit" class="btn-submit mb-5">Phân tích kết quả của tôi</button>
        </form>
    </div>
</div>

<script>
    const totalQ = {{ count($questions) }};
    function markDone(idx) {
        document.getElementById('q-' + idx).style.background = '#f8faff';
        document.getElementById('q-' + idx).style.borderColor = '#dbeafe';
        
        const answered = document.querySelectorAll('input[type="radio"]:checked').length;
        const percent = Math.round((answered / totalQ) * 100);
        document.getElementById('progress-bar').style.width = percent + '%';
        document.getElementById('percent-val').innerText = percent + '%';
    }
</script>
@endsection