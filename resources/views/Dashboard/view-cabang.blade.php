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

        <div class="p-4 sm:ml-64">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto">
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
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
