<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Division</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto bg-white shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Division</h2>

            <form method="POST" action="{{ route('division.store') }}">
                @csrf

                <!-- Select Company -->
                <div class="mb-4">
                    <label for="company_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
                    <select id="company_id" name="company_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->coy }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Select Directorate (dynamically updated based on selected company) -->
                <div class="mb-4">
                    <label for="directorate_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Directorate</label>
                    <select id="directorate_id" name="directorate_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </select>
                </div>

                <!-- Nama Division -->
                <div class="mb-4">
                    <label for="nama_division" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Division</label>
                    <input type="text" id="nama_division" name="nama_division" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    <p id="nama_division_error" class="text-red-600 text-sm mt-2 hidden">Nama Division telah terdaftar!</p>
                </div>

                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-primary-800 rounded-lg px-5 py-2.5">
                    Tambah Division
                </button>
            </form>
        </div>
    </div>

    <script>
    const namaDivisionInput = document.getElementById('nama_division');
    const errorMsg = document.getElementById('nama_division_error');

    namaDivisionInput.addEventListener('input', function () {
        const namaDivision = this.value;

        if (namaDivision.length > 0) {
            // Send AJAX request to check if nama_division exists
            fetch(`{{ route('division.checkNamaDivision') }}?nama_division=${namaDivision}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        // Show the error message but do not disable the button
                        errorMsg.classList.remove('hidden');
                    } else {
                        // Hide the error message
                        errorMsg.classList.add('hidden');
                    }
                });
        } else {
            // If input is empty, hide the error message
            errorMsg.classList.add('hidden');
        }
    });

    // Fetch Directorates when a company is selected
    const companySelect = document.getElementById('company_id');
    const directorateSelect = document.getElementById('directorate_id');

    companySelect.addEventListener('change', function () {
        const companyId = this.value;
        directorateSelect.innerHTML = '<option value="">-- Pilih Directorate --</option>';

        if (companyId) {
            // Send AJAX request to get the directorates for the selected company
            fetch(`{{ route('getDirectoratesByCompany') }}?company_id=${companyId}`)
                .then(response => response.json())
                .then(data => {
                    data.directorates.forEach(function (directorate) {
                        const option = document.createElement('option');
                        option.value = directorate.id;
                        option.textContent = directorate.nama_directorate;
                        directorateSelect.appendChild(option);
                    });
                });
        }
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
