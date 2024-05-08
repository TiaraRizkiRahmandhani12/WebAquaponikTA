<!-- resources/views/pakan.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <select id="theme-selector">
                        <option value="dark">Dark</option>
                        <option value="light">Light</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk mengatur tema berdasarkan pilihan pengguna
        function setTheme(theme) {
            const themeSelector = document.getElementById('theme-selector');

            // Jika tema yang dipilih adalah 'dark'
            if (theme === 'dark') {
                themeSelector.style.backgroundColor = '#191c24'; // Warna latar belakang default
                themeSelector.style.color = '#fff'; // Warna teks default
            }
            // Jika tema yang dipilih adalah 'light'
            else if (theme === 'light') {
                themeSelector.style.backgroundColor = '#accaca'; // Warna latar belakang untuk tema light
                themeSelector.style.color = '#222'; // Warna teks untuk tema light
            }
        }

        // Tambahkan event listener untuk dropdown setelah dokumen dimuat
        const themeSelector = document.getElementById('theme-selector');
        if (themeSelector) {
            themeSelector.addEventListener('change', function() {
                const selectedTheme = themeSelector.value;
                setTheme(selectedTheme);
            });
        }

        // Set tema awal
        setTheme('dark'); // Set tema awal menjadi dark
    });
</script>
