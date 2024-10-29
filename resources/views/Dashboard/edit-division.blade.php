<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Division</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto bg-white shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Division</h2>

            <form method="POST" action="{{ route('division.update', $division->id) }}">
                @csrf
                @method('PUT')

                <!-- Display Company -->
                <div class="mb-4">
                    <label for="company_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
                    <input type="text" id="company_name" name="company_name" value="{{ $division->directorate->company->coy }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Display Directorate -->
                <div class="mb-4">
                    <label for="directorate_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Directorate</label>
                    <input type="text" id="directorate_name" name="directorate_name" value="{{ $division->directorate->nama_directorate }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Nama Division (Editable) -->
                <div class="mb-4">
                    <label for="nama_division" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Division</label>
                    <input type="text" id="nama_division" name="nama_division" value="{{ $division->nama_division }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    <p id="nama_division_error" class="text-red-600 text-sm mt-2 hidden">Nama Division telah terdaftar!</p>
                </div>

                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-primary-800 rounded-lg px-5 py-2.5">
                    Update Division
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
