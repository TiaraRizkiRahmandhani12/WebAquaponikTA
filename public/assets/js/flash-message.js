document.addEventListener('DOMContentLoaded', function () {
    const alerts = document.querySelectorAll('.alert[data-timeout]');

    alerts.forEach(function (alert) {
        const timeout = parseInt(alert.dataset.timeout);

        setTimeout(function () {
            alert.remove();
        }, timeout);
    });
});