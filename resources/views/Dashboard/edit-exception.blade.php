<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Exception</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Exception</h2>
                <div class="container mx-auto p-4">
                    <form action="{{ route('exceptions.update', $exception->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="holiday_date" class="block mb-1">Holiday Date</label>
                                <input type="date" id="holiday_date" name="holiday_date" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full" value="{{ $exception->holiday_date }}" required>
                            </div>
                            <div>
                                <label for="note" class="block mb-1">Note</label>
                                <input id="note" name="note" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full" value="{{ $exception->note }}" required>
                            </div>
                        </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg w-full">Update Exception</button>
                        </div>
                    </form>
                </div
    </div>
</body>
</html>
