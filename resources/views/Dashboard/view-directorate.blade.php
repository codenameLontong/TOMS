<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Directorate</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <form method="POST" action="{{ route('directorate.update', $directorate->id) }}">
        @csrf
        @method('PUT')

        <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
            <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto bg-white shadow-lg">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Informasi Directorate</h2>

                <!-- Company Name -->
                <div class="mb-4">
                    <label for="company_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
                    <input type="text" id="company_name" name="company_name" value="{{ $directorate->company->coy }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Nama Directorate -->
                <div class="mb-4">
                    <label for="nama_directorate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Directorate</label>
                    <input type="text" id="nama_directorate" name="nama_directorate" value="{{ $directorate->nama_directorate }}" disabled class="bg-green-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Divisions
                <div class="mb-4">
                    <label for="divisions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Divisions</label>
                    <div class="space-y-2">
                        @foreach ($directorate->divisions as $division)
                            <div class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                                {{ $division->nama_division }}
                            </div>
                        @endforeach
                        @if($directorate->divisions->isEmpty())
                            <p class="text-sm text-gray-500 dark:text-gray-400">No divisions available.</p>
                        @endif
                    </div>
                </div>

                Departments
                <div class="mb-4">
                    <label for="departments" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departments</label>
                    <div class="space-y-2">
                        @foreach ($directorate->divisions as $division)
                            @foreach ($division->departments as $department)
                                <div class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                                    {{ $department->nama_department }}
                                </div>
                            @endforeach
                        @endforeach
                        @if($directorate->divisions->pluck('departments')->flatten()->isEmpty())
                            <p class="text-sm text-gray-500 dark:text-gray-400">No departments available.</p>
                        @endif
                    </div>
                </div>

                Sections
                <div class="mb-4">
                    <label for="sections" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sections</label>
                    @foreach ($directorate->divisions as $division)
                        @foreach ($division->departments as $department)
                            @if ($department->sections->isNotEmpty())
                                @foreach ($department->sections as $section)
                                    <input type="text" value="{{ $section->nama }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                                @endforeach
                            @else
                                <input type="text" value="No Section" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            @endif
                        @endforeach
                    @endforeach
                </div> -->
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
