<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Cabang</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <form method="POST" action="{{ route('cabang.update', $cabang->id) }}">
        @csrf
        @method('PUT')

        <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
            <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto bg-white shadow-lgbg-white shadow-lg">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Informasi Cabang</h2>

                <!-- Kode Cabang -->
                <div class="mb-4">
                    <label for="kode_cabang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Cabang</label>
                    <input type="text" id="kode_cabang" name="kode_cabang" value="{{ $cabang->kode_cabang }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Lokasi Cabang -->
                <div class="mb-4">
                    <label for="lokasi_cabang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi Cabang</label>
                    <input type="text" id="lokasi_cabang" name="lokasi_cabang" value="{{ $cabang->lokasi_cabang }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Alamat Cabang -->
                <div class="mb-4">
                    <label for="alamat_cabang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat Cabang</label>
                    <input type="text" id="alamat_cabang" name="alamat_cabang" value="{{ $cabang->alamat_cabang }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Jumlah Pegawai -->
                <div class="mb-4 p-4 border rounded-lg bg-gray-50 dark:bg-gray-800 border-gray-300 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Jumlah Pegawai</h3>
                    <div class="mt-4 grid grid-cols-3 gap-4 text-sm text-gray-700 dark:text-gray-300">
                        <div>
                            <span class="font-semibold">Total:</span>
                            <span>{{ $jumlahPegawai }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Laki-laki:</span>
                            <span>{{ $jumlahLakiLaki }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Perempuan:</span>
                            <span>{{ $jumlahPerempuan }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {

            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }

            // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }

        });
    </script>
</body>
</html>
