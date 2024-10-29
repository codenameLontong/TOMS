<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Directorate</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto bg-white shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Directorate</h2>

            <form method="POST" action="{{ route('directorate.update', $directorate->id) }}">
                @csrf
                @method('PUT')

                <!-- Select Company (Disabled Display) -->
                <div class="mb-4">
                    <label for="company_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
                    <input type="text" id="company_name" name="company_name" value="{{ $directorate->company->coy }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Hidden Company ID -->
                <input type="hidden" id="company_id" name="company_id" value="{{ $directorate->company_id }}">

                <!-- Nama Directorate -->
                <div class="mb-4">
                    <label for="nama_directorate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Directorate</label>
                    <input type="text" id="nama_directorate" name="nama_directorate" value="{{ $directorate->nama_directorate }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    <p id="nama_directorate_error" class="text-red-600 text-sm mt-2 hidden">Nama Directorate telah terdaftar!</p>
                </div>

                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-primary-800 rounded-lg px-5 py-2.5">
                    Update Directorate
                </button>
            </form>
        </div>
    </div>

    <script>
        // const namaDirectorateInput = document.getElementById('nama_directorate');
        // const companySelect = document.getElementById('company_id');
        // const errorMsg = document.getElementById('nama_directorate_error');

        // namaDirectorateInput.addEventListener('input', function () {
        //     const namaDirectorate = this.value;
        //     const companyId = companySelect.value; // Get the selected company ID

        //     if (namaDirectorate.length > 0 && companyId) {
        //         // Send AJAX request to check if nama_directorate exists for the selected company
        //         fetch(`{{ route('directorate.checkNamaDirectorate') }}?nama_directorate=${namaDirectorate}&company_id=${companyId}`)
        //             .then(response => response.json())
        //             .then(data => {
        //                 if (data.exists) {
        //                     // Show the error message but do not disable the button
        //                     errorMsg.classList.remove('hidden');
        //                 } else {
        //                     // Hide the error message
        //                     errorMsg.classList.add('hidden');
        //                 }
        //             });
        //     } else {
        //         // If input is empty, hide the error message
        //         errorMsg.classList.add('hidden');
        //     }
        // });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
