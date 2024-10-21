<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Cabang</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto bg-white shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Cabang</h2>

            <form method="POST" action="{{ route('cabang.store') }}">
                @csrf

                <!-- Kode Cabang -->
                <div class="mb-4">
                    <label for="kode_cabang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Cabang</label>
                    <input type="text" id="kode_cabang" name="kode_cabang" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    <p id="kode_cabang_error" class="text-red-600 text-sm mt-2 hidden">Kode Cabang already exists.</p>
                </div>

                <!-- Lokasi Cabang -->
                <div class="mb-4">
                    <label for="lokasi_cabang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi Cabang</label>
                    <input type="text" id="lokasi_cabang" name="lokasi_cabang" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                </div>

                <button type="submit" id="tambahCabangBtn" class="w-full text-white bg-gray-400 cursor-not-allowed rounded-lg px-5 py-2.5" disabled>
                    Tambah Cabang
                </button>
            </form>
        </div>
    </div>

    <script>
    const kodeCabangInput = document.getElementById('kode_cabang');
    const errorMsg = document.getElementById('kode_cabang_error');
    const tambahCabangBtn = document.getElementById('tambahCabangBtn');

    // Disable the submit button initially and apply grey background
    tambahCabangBtn.disabled = true;

    kodeCabangInput.addEventListener('input', function () {
        const kodeCabang = this.value;

        if (kodeCabang.length > 0) {
            // Send AJAX request to check if kode_cabang exists
            fetch(`{{ route('cabang.checkKodeCabang') }}?kode_cabang=${kodeCabang}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        // Show the error message and disable the button
                        errorMsg.classList.remove('hidden');
                        tambahCabangBtn.disabled = true;
                        tambahCabangBtn.classList.add('bg-gray-400', 'cursor-not-allowed');  // Set grey background when disabled
                        tambahCabangBtn.classList.remove('bg-blue-700', 'hover:bg-primary-800');
                    } else {
                        // Hide the error message and enable the button
                        errorMsg.classList.add('hidden');
                        tambahCabangBtn.disabled = false;
                        tambahCabangBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                        tambahCabangBtn.classList.add('bg-blue-700', 'hover:bg-primary-800');  // Set blue background when enabled
                    }
                });
        } else {
            // If input is empty, disable the button and hide the error message
            errorMsg.classList.add('hidden');
            tambahCabangBtn.disabled = true;
            tambahCabangBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
            tambahCabangBtn.classList.remove('bg-blue-700', 'hover:bg-primary-800');
        }
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
