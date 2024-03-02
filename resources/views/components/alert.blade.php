<!-- resources/views/partials/alert.blade.php -->
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
