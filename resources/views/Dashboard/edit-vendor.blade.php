<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vendor</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto bg-white shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Vendor</h2>

            <form method="POST" action="{{ route('vendor.update', $vendor->id) }}">
                @csrf
                @method('PUT')

                <!-- Kode Vendor -->
                <div class="mb-4">
                    <label for="kode_vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Vendor</label>
                    <input type="text" id="kode_vendor" name="kode_vendor" value="{{ $vendor->kode_vendor }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Nama Vendor -->
                <div class="mb-4">
                    <label for="nama_vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Vendor</label>
                    <input type="text" id="nama_vendor" name="nama_vendor" value="{{ $vendor->nama_vendor }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Astra/Non Astra -->
                <div class="mb-4">
                    <label for="astra_non_astra" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Astra/Non Astra</label>
                    <select id="astra_non_astra" name="astra_non_astra" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                        <option value="Astra" {{ $vendor->astra_non_astra == 'Astra' ? 'selected' : '' }}>Astra</option>
                        <option value="Non Astra" {{ $vendor->astra_non_astra == 'Non Astra' ? 'selected' : '' }}>Non Astra</option>
                    </select>
                </div>

                <!-- Optional: Add any other necessary fields related to Vendor if needed -->

                <!-- Submit Button -->
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2.5">
                    Update
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
