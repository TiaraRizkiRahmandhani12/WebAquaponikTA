<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h5>Revenue</h5>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0">$32123</h2>
                                <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
                            </div>
                            <h6 class="text-muted font-weight-normal">11.38% Since last month</h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h5>Sales</h5>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0">$45850</h2>
                                <p class="text-success ml-2 mb-0 font-weight-medium">+8.3%</p>
                            </div>
                            <h6 class="text-muted font-weight-normal"> 9.61% Since last month</h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h5>Purchase</h5>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0">$2039</h2>
                                <p class="text-danger ml-2 mb-0 font-weight-medium">-2.1% </p>
                            </div>
                            <h6 class="text-muted font-weight-normal">2.27% Since last month</h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg mdi mdi-monitor text-success ml-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row-grafik" id="temperatureSection">
        <div class="col-12">
            <div class="card-grafik">
                <div class="card-body">
                    <h5>Temperature</h5>
                    <canvas id="temperatureChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row-grafik" id="phSection">
        <div class="col-12">
            <div class="card-grafik">
                <div class="card-body">
                    <h5>pH Level</h5>
                    <canvas id="phChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row-grafik" id="tdsSection">
        <div class="col-12">
            <div class="card-grafik">
                <div class="card-body">
                    <h5>TDS (Total Dissolved Solids)</h5>
                    <canvas id="tdsChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row-grafik" id="heightSection">
        <div class="col-12">
            <div class="card-grafik">
                <div class="card-body">
                    <h5>Pond Height</h5>
                    <canvas id="heightChart" height="auto"></canvas>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const labels = @json($labels);
    const chartOptions = {
        type: 'line',
        options: {
            scales: { y: { beginAtZero: false } },
            responsive: false,
            maintainAspectRatio: false
        }
    };

    const tempChartCtx = document.getElementById('temperatureChart').getContext('2d');
    const phChartCtx = document.getElementById('phChart').getContext('2d');
    const tdsChartCtx = document.getElementById('tdsChart').getContext('2d');
    const heightChartCtx = document.getElementById('heightChart').getContext('2d');

    new Chart(tempChartCtx, {
        ...chartOptions,
        data: {
            labels: labels,
            datasets: [{
                label: 'Temperature (°C)',
                data: @json($temperatures),
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        }
    });

    new Chart(phChartCtx, {
        ...chartOptions,
        data: {
            labels: labels,
            datasets: [{
                label: 'pH Level',
                data: @json($phLevels),
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        }
    });

    new Chart(tdsChartCtx, {
        ...chartOptions,
        data: {
            labels: labels,
            datasets: [{
                label: 'TDS (ppm)',
                data: @json($tdsLevels),
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        }
    });

    new Chart(heightChartCtx, {
        ...chartOptions,
        data: {
            labels: labels,
            datasets: [{
                label: 'Pond Height (cm)',
                data: @json($heights),
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        }
    });
});

window.onload = function() {
    if (window.location.hash) {
        const element = document.getElementById(window.location.hash.substring(1));
        if (element) {
            element.scrollIntoView({ behavior: 'smooth' });
        }
    }
};
</script>
@endsection
