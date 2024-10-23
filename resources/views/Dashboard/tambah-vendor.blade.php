<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Vendor</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto bg-white shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Vendor</h2>

            <form method="POST" action="{{ route('vendor.store') }}">
                @csrf

                <!-- Kode Vendor -->
                <div class="mb-4">
                    <label for="kode_vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Vendor</label>
                    <input type="text" id="kode_vendor" name="kode_vendor" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    <p id="kode_vendor_error" class="text-red-600 text-sm mt-2 hidden">Kode Vendor telah terdaftar!</p>
                </div>

                <!-- Nama Vendor -->
                <div class="mb-4">
                    <label for="nama_vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Vendor</label>
                    <input type="text" id="nama_vendor" name="nama_vendor" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                </div>

                 <!-- Astra Non Astra -->
                <div class="mb-4">
                    <label for="astra_non_astra" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Astra/Non Astra</label>
                    <select id="astra_non_astra" name="astra_non_astra" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option value="Astra">Astra</option>
                        <option value="Non Astra">Non Astra</option>
                    </select>
                </div>

                <button type="submit" id="tambahVendorBtn" class="w-full text-white bg-gray-400 cursor-not-allowed rounded-lg px-5 py-2.5" disabled>
                    Tambah Vendor
                </button>
            </form>
        </div>
    </div>

    <script>
    const kodeVendorInput = document.getElementById('kode_vendor');
    const errorMsg = document.getElementById('kode_vendor_error');
    const tambahVendorBtn = document.getElementById('tambahVendorBtn');

    // Disable the submit button initially and apply grey background
    tambahVendorBtn.disabled = true;

    kodeVendorInput.addEventListener('input', function () {
        const kodeVendor = this.value;

        if (kodeVendor.length > 0) {
            // Send AJAX request to check if kode_vendor exists
            fetch(`{{ route('vendor.checkKodeVendor') }}?kode_vendor=${kodeVendor}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        // Show the error message and disable the button
                        errorMsg.classList.remove('hidden');
                        tambahVendorBtn.disabled = true;
                        tambahVendorBtn.classList.add('bg-gray-400', 'cursor-not-allowed');  // Set grey background when disabled
                        tambahVendorBtn.classList.remove('bg-blue-700', 'hover:bg-primary-800');
                    } else {
                        // Hide the error message and enable the button
                        errorMsg.classList.add('hidden');
                        tambahVendorBtn.disabled = false;
                        tambahVendorBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                        tambahVendorBtn.classList.add('bg-blue-700', 'hover:bg-primary-800');  // Set blue background when enabled
                    }
                });
        } else {
            // If input is empty, disable the button and hide the error message
            errorMsg.classList.add('hidden');
            tambahVendorBtn.disabled = true;
            tambahVendorBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
            tambahVendorBtn.classList.remove('bg-blue-700', 'hover:bg-primary-800');
        }
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
