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
            ['title' => 'Trend Suhu - Last Mounth', 'id' => 'suhuchart', 'data' => $suhu],
            ['title' => 'Trend TDS - Last Mounth', 'id' => 'tdsValuechart', 'data' => $tdsValue],
            ['title' => 'Trend Jarak Air - Last Mounth', 'id' => 'jarakairchart', 'data' => $jarakAir],
            ['title' => 'Trend Jarak Pakan - Last Mounth', 'id' => 'jarakpakanchart', 'data' => $jarakPakan],
            ['title' => 'Trend pH - Last Mounth', 'id' => 'phchart', 'data' => $phAir],
        ];
    @endphp

    @foreach ($charts as $chart)
        <div class="card bg-grey pd-20 mb-25 chart-card">
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('analisis') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start_date" style="color: #ffffff">Start Date:</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="end_date" style="color: #ffffff">End Date:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-1" style="margin-top: 20px">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" style="height: 40px">Filter</button>
                                </div>
                            </div>
                            <div class="col-md-3" style="margin-top: 20px">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" style="height: 40px"
                                        href="{{ route('download.csv.table', ['start_date' => $startDate, 'end_date' => $endDate]) }}">Download
                                        CSV</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr style="text-align: center">
                                <th>No</th>
                                <th>Water Temperature <i class="bi bi-arrow-down-up" onclick="sortTable('suhu')"></i>
                                </th>
                                <th>Ph <i class="bi bi-arrow-down-up" onclick="sortTable('phAir')"></i></th>
                                <th>Fish Feed <i class="bi bi-arrow-down-up" onclick="sortTable('jarakPakan')"></i>
                                </th>
                                <th>TDS <i class="bi bi-arrow-down-up" onclick="sortTable('tdsValue')"></i></th>
                                <th>Timestamp <i class="bi bi-arrow-down-up" onclick="sortTable('craeted_at')"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestdata as $index => $sensorData)
                                <tr style="text-align: center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $sensorData->suhu }}</td>
                                    <td>{{ $sensorData->phAir }}</td>
                                    <td>{{ $sensorData->jarakPakan }}</td>
                                    <td>{{ $sensorData->tdsValue }}</td>
                                    <td>{{ $sensorData->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end" style="margin-right: 50px">
                        {{ $latestdata->links('vendor.pagination.simple-pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

<!-- Place this at the end of the body -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@foreach ($charts as $chart)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const suhuChart = createChart('suhuchart', '{{ $charts[0]['title'] }}');
            const tdsChart = createChart('tdsValuechart', '{{ $charts[1]['title'] }}');
            const jarakAirChart = createChart('jarakairchart', '{{ $charts[2]['title'] }}');
            const jarakPakanChart = createChart('jarakpakanchart', '{{ $charts[3]['title'] }}');
            const phChart = createChart('phchart', '{{ $charts[4]['title'] }}');

            function createChart(chartId, chartTitle) {
                const ctx = document.getElementById(chartId).getContext('2d');
                return new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [], // Initially empty, will be updated with data
                        datasets: [{
                            label: chartTitle,
                            data: [],
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
            }

            function updateChart(chart, newData) {
                const labels = [];
                const values = [];
                const totalLabels = 20; // Desired number of labels
                const interval = Math.ceil(newData.length / totalLabels);

                for (let i = 0; i < newData.length; i++) {
                    if (i % interval === 0) {
                        labels.push(new Date(newData[i].created_at).toLocaleDateString('en-US', {
                            month: 'short',
                            day: 'numeric'
                        }));
                    } else {
                        labels.push('');
                    }
                    values.push(newData[i].value || newData[i].suhu || newData[i].tdsValue || newData[i].jarakAir ||
                        newData[i].jarakPakan || newData[i].phAir);
                }

                chart.data.labels = labels;
                chart.data.datasets[0].data = values;
                chart.update();
            }

            function fetchDataAndUpdateCharts() {
                $.ajax({
                    url: '{{ route('chart.data') }}',
                    type: 'GET',
                    success: function(response) {
                        console.log('Data fetched:', response);
                        updateChart(suhuChart, response.suhu);
                        updateChart(tdsChart, response.tdsValue);
                        updateChart(jarakAirChart, response.jarakAir);
                        updateChart(jarakPakanChart, response.jarakPakan);
                        updateChart(phChart, response.phAir);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Polling data every 5 seconds
            setInterval(fetchDataAndUpdateCharts, 1000);
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
            link.click();
        }
    </script>
@endforeach
