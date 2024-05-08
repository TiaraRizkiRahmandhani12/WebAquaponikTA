<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')
@section('content')

<style>
    .heading-title {
        font-size: 24px; /* Sesuaikan dengan ukuran font yang Anda inginkan */
        text-align: center; /* Pusatkan teks */
        margin-top: 20px;
    }

    

</style>

<div class="card bg-grey pd-20 mb-30">
    <div style="width: 80%; margin: auto; text-align: left;">
        <h3 class="heading-title">Trend Kelembapan - Last 7 Days</h3>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Other
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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
        <canvas id="humidityChart" width="300" height="150"></canvas>
    </div>
</div>
@endsection

<!-- Place this at the end of the body -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sample data for the last 7 days
        const days = ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'];
        const humidityData = [60, 65, 70, 75, 80, 85, 90];

        // Get the canvas element
        const ctx = document.getElementById('humidityChart').getContext('2d');

        // Create the humidity chart
        const humidityChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: days,
                datasets: [{
                    label: 'Sensor Lingkungan 1',
                    data: humidityData,
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
                        max: 100
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
