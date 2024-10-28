<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Section</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <form method="POST" action="#">
        @csrf
        <!-- Main Content Area -->
        <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
            <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto bg-white shadow-lg">

                <!-- Title -->
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">View Section</h2>

                <!-- Company Field -->
                <div class="mb-4">
                    <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
                    <input type="text" id="company" name="company" value="{{ $section->department->division->directorate->company->coy }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Directorate Field -->
                <div class="mb-4">
                    <label for="directorate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Directorate</label>
                    <input type="text" id="directorate" name="directorate" value="{{ $section->department->division->directorate->nama_directorate }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Division Field -->
                <div class="mb-4">
                    <label for="division" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Division</label>
                    <input type="text" id="division" name="division" value="{{ $section->department->division->nama_division }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Department Field -->
                <div class="mb-4">
                    <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                    <input type="text" id="department" name="department" value="{{ $section->department->nama_department }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Section Field with Different Color -->
                <div class="mb-4">
                    <label for="section" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section</label>
                    <input type="text" id="section" name="section" value="{{ $section->nama_section }}" disabled class="bg-yellow-100 border border-yellow-300 text-yellow-900 text-sm rounded-lg block w-full p-2.5 dark:bg-yellow-800 dark:border-yellow-600 dark:text-yellow-100">
                </div>

            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
