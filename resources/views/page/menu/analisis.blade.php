@extends('layouts.app')
@section('content')
    <style>
        .heading-title {
            font-size: 24px;
            text-align: center;
            margin-top: 20px;
        }

        .chart-card {
            margin-bottom: 50px;
        }
    </style>

    @php
        $charts = [
            ['title' => 'Trend Suhu - Last 2 Weeks', 'id' => 'suhuchart', 'data' => $suhu],
            ['title' => 'Trend TDS - Last 2 Weeks', 'id' => 'tdsValuechart', 'data' => $tdsValue],
            ['title' => 'Trend Jarak Air - Last 2 Weeks', 'id' => 'jarakairchart', 'data' => $jarakAir],
            ['title' => 'Trend Jarak Pakan - Last 2 Weeks', 'id' => 'jarakpakanchart', 'data' => $jarakPakan],
            ['title' => 'Trend pH - Last 2 Weeks', 'id' => 'phchart', 'data' => $phAir],
        ];
    @endphp

    @foreach ($charts as $chart)
        <div class="card bg-grey pd-20 mb-30 chart-card">
            <div style="width: 80%; margin: auto; text-align: right;">
                <h3 class="heading-title">{{ $chart['title'] }}</h3>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $chart['id'] }}"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Other
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $chart['id'] }}">
                        <a class="dropdown-item custom-font-size" href="#"
                            onclick="downloadChartAsJPG('{{ $chart['id'] }}')">
                            Download as JPG
                        </a>
                        <a class="dropdown-item custom-font-size"
                            href="{{ route('download.csv', ['chartId' => $chart['id']]) }}">
                            Download as CSV
                        </a>

                        <a class="dropdown-item custom-font-size" href="#"
                            onclick="downloadPDF('{{ $chart['id'] }}')">
                            Download as PDF
                        </a>
                    </div>
                </div>

                <!-- Set the size of the canvas here as well -->
                <canvas id="{{ $chart['id'] }}" width="300" height="150"></canvas>
            </div>
        </div>
    @endforeach
@endsection

<!-- Place this at the end of the body -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@foreach ($charts as $chart)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const labels = @json($labels);
            const data = @json($chart['data']);

            // Get the canvas element
            const ctx = document.getElementById('{{ $chart['id'] }}').getContext('2d');

            // Create the chart
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: '{{ $chart['title'] }}',
                        data: data,
                        backgroundColor: 'rgba(75, 122, 192, 0.2)',
                        borderColor: 'rgba(75, 122, 192, 1)',
                        borderWidth: 2,
                        pointRadius: 5,
                        pointBackgroundColor: 'rgba(75, 122, 192, 1)',
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 40
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        }
                    }
                }
            });
        });

        function downloadPDF(chartId) {
            window.location.href = "{{ route('download.pdf', ':chartId') }}".replace(':chartId', chartId);
        }


        function downloadChartAsJPG(chartId) {
            const canvas = document.getElementById(chartId);
            const ctx = canvas.getContext('2d');

            // Create a temporary canvas to apply the background
            const tempCanvas = document.createElement('canvas');
            const tempCtx = tempCanvas.getContext('2d');

            tempCanvas.width = canvas.width;
            tempCanvas.height = canvas.height;

            // Fill the background with white
            tempCtx.fillStyle = 'white';
            tempCtx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);

            // Draw the original canvas over the white background
            tempCtx.drawImage(canvas, 0, 0);

            // Convert the temporary canvas to a JPEG image
            const image = tempCanvas.toDataURL('image/jpeg', 1.0);
            const link = document.createElement('a');
            link.href = image;
            link.download = `${chartId}.jpg`;
            link.click();;
        }
    </script>
@endforeach
