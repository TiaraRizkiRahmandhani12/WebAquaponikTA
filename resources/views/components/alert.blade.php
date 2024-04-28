<!-- resources/views/partials/alert.blade.php -->
{{-- @if (session()->has('success') || session()->has('error'))
    <div class="row">
        <div class="col-12">
            @if (session()->has('success'))
                <div class="alert alert-success" data-timeout="2000">{{ session('success') }}</div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger" data-timeout="2000">{{ session('error') }}</div>
            @endif
        </div>
    </div>
@endif --}}

@if (session()->has('success') || session()->has('error'))
    <div class="row">
        <div class="col-12">
            @if (session()->has('success'))
                <div class="alert alert-success" data-timeout="2000">{{ session('success') }}</div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger" data-timeout="2000">{{ session('error') }}</div>
            @endif
        </div>
    </div>
@endif

<!-- Alert untuk nilai suhu, temperature, dan tds di ambang batas -->
<div id="threshold-alert" class="alert alert-warning" style="display: none;">
    Nilai suhu, temperature, atau tds berada di ambang batas!
</div>

<script>
    // Munculkan alert kuning jika nilai suhu, temperature, atau tds berada di ambang batas
    $(document).ready(function() {
        $.ajax({
            url: '/latest-monitoring-data',
            method: 'GET',
            success: function(response) {
                var suhu = parseFloat(response.suhu);
                var tds = parseFloat(response.tds);
                var temperature = parseFloat(response.temperature);

                // Periksa apakah nilai suhu, tds, atau temperatur berada di ambang batas
                if ((suhu === 25 || suhu === 30) || (tds === 72 || tds === 100) || (temperature ===
                        6 || temperature === 7)) {
                    // Tampilkan alert kuning
                    $('#threshold-alert').fadeIn();

                    // Atur waktu sebelum alert hilang (contoh: 5 detik)
                    setTimeout(function() {
                        $('#threshold-alert').fadeOut();
                    }, 5000);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
</script>
