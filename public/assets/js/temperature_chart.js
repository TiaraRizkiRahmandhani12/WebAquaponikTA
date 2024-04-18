document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("temperatureChart").getContext("2d");
    ctx.canvas.width = 400;
    ctx.canvas.height = 200;

    // Pastikan data diambil dari variabel global yang di-set di view Blade
    const temperatureChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: window.chartData.labels,
            datasets: [
                {
                    label: "Average Temperature",
                    data: window.chartData.temperatures,
                    backgroundColor: "rgba(255, 99, 132, 0.2)",
                    borderColor: "rgba(255, 99, 132, 1)",
                    borderWidth: 1,
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(255, 99, 132, 1)",
                    fill: false,
                },
            ],
        },
        options: {
            scales: {
                x: {
                    type: "time",
                    time: {
                        unit: "hour",
                        tooltipFormat: "MMM D, hA",
                    },
                },
                y: {
                    beginAtZero: true,
                },
            },
            plugins: {
                legend: {
                    display: true,
                    position: "bottom",
                },
            },
        },
    });
});
