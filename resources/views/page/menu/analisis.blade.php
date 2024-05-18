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
            ['title' => 'Trend Suhu - Last 7 Days', 'id' => 'suhuchart', 'data' => $suhu],
            ['title' => 'Trend tdsValue - Last 7 Days', 'id' => 'tdsValuechart', 'data' => $tdsValue],
            ['title' => 'Trend Jarak Air - Last 7 Days', 'id' => 'jarakairchart', 'data' => $jarakAir],
            ['title' => 'Trend Jarak Pakan - Last 7 Days', 'id' => 'jarakpakanchart', 'data' => $jarakPakan],
            ['title' => 'Trend pH - Last 7 Days', 'id' => 'phchart', 'data' => $phAir],
        ];
    @endphp

    @foreach ($charts as $chart)
        <div class="card bg-grey pd-20 mb-30 chart-card">
            <div style="width: 80%; margin: auto; text-align: left;">
                <h3 class="heading-title">{{ $chart['title'] }}</h3>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $chart['id'] }}"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Other
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $chart['id'] }}">
                        <a class="dropdown-item custom-font-size" href="#">
                            <img src="assets\images\analisis\edit.png" alt="Icon" class="icon">
                            Edit
                        </a>
                        <a class="dropdown-item custom-font-size" href="#">
                            <img src="\back\src\images\unduh.png" alt="Icon" class="icon">
                            Download as JPG
                        </a>
                        <a class="dropdown-item custom-font-size" href="#">
                            <img src="\back\src\images\unduh.png" alt="Icon" class="icon">
                            Download as PDF
                        </a>
                        <a class="dropdown-item custom-font-size" href="#">
                            <img src="\back\src\images\unduh.png" alt="Icon" class="icon">
                            Download as CSV
                        </a>
                        <a class="dropdown-item custom-font-size" href="#">
                            <img src="\back\src\images\delete.png" alt="Icon" class="icon">
                            Delete
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
    </script>
@endforeach
