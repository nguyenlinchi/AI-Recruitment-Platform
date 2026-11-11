@extends('layout.employer')

@section('content')

<style>

.dashboard-card{
    padding: 25px;
    border-radius: 18px;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.dashboard-card:hover{
    transform: translateY(-5px);
}

.dashboard-card h4{
    font-size: 34px;
    font-weight: bold;
    margin-bottom: 5px;
}

.dashboard-card p{
    margin: 0;
    font-size: 16px;
    opacity: 0.9;
}

.card-icon{
    font-size: 50px;
    opacity: 0.25;
}

/* COLORS */

.purple{
    background: linear-gradient(135deg,#667eea,#764ba2);
}

.green{
    background: linear-gradient(135deg,#11998e,#38ef7d);
}

.orange{
    background: linear-gradient(135deg,#f7971e,#ffd200);
}

.red{
    background: linear-gradient(135deg,#ff416c,#ff4b2b);
}

/* CARD */

.card{
    border: none;
    border-radius: 18px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

/* TITLE */

.dashboard-title{
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 25px;
}

</style>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<h3 class="dashboard-title">
    Employer Dashboard
</h3>

<div class="row mb-4">

    <div class="col-md-3 mb-3">
        <div class="dashboard-card purple">

            <div>
                <h4>{{ $jobs }}</h4>
                <p>Bài đăng</p>
            </div>

            <i class="fa fa-briefcase card-icon"></i>

        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="dashboard-card green">

            <div>
                <h4>{{ $applications }}</h4>
                <p>Ứng viên</p>
            </div>

            <i class="fa fa-users card-icon"></i>

        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="dashboard-card orange">

            <div>
                <h4>{{ $pending }}</h4>
                <p>Chờ duyệt</p>
            </div>

            <i class="fa fa-clock card-icon"></i>

        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="dashboard-card red">

            <div>
                <h4>{{ $approved }}</h4>
                <p>Đã duyệt</p>
            </div>

            <i class="fa fa-check-circle card-icon"></i>

        </div>
    </div>

</div>

<!-- CHART -->
<div class="row">

    <div class="col-md-8 mb-4">

        <div class="card p-4">

            <h5 class="mb-4">
                Ứng viên theo tháng
            </h5>

            <canvas id="lineChart"></canvas>

        </div>

    </div>

    <div class="col-md-4 mb-4">

        <div class="card p-4">

            <h5 class="mb-4">
                Trạng thái
            </h5>

            <canvas id="pieChart"></canvas>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    // LINE CHART
    new Chart(document.getElementById('lineChart'), {

        type: 'line',

        data: {

            labels: [
                'Jan','Feb','Mar','Apr',
                'May','Jun','Jul','Aug',
                'Sep','Oct','Nov','Dec'
            ],

            datasets: [{

                label: 'Applications',

                data: @json($chartData),

                borderWidth: 3,
                fill: true,
                tension: 0.4,
                backgroundColor: 'rgba(102,126,234,0.2)',
                borderColor: '#667eea',
                pointBackgroundColor: '#667eea'
            }]
        }

    });

    // PIE CHART
    new Chart(document.getElementById('pieChart'), {

        type: 'doughnut',

        data: {

            labels: ['Pending','Approved','Rejected'],

            datasets: [{

                data: [
                    {{ $pending }},
                    {{ $approved }},
                    {{ $rejected }}
                ],

                backgroundColor: [
                    '#f7971e',
                    '#38ef7d',
                    '#ff416c'
                ]
            }]
        }

    });

</script>

@endsection