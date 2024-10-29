<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat SPL</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Detail Overtime</h2>
            <div class="container mx-auto p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- NRP Input (Auto-filled) -->
                    <div>
                        <label for="nrp" class="block mb-1">NRP</label>
                        <input type="text" id="nrp" name="nrp" value="{{ ($overtime->pegawai)->nrp }}" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disabled>
                    </div>

                    <!-- Name Input (Auto-filled) -->
                    <div>
                        <label for="nama" class="block mb-1">Name</label>
                        <input type="text" id="nama" name="nama" value="{{ ($overtime->pegawai)->nama }}" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disabled>
                    </div>

                    <!-- Department Input (Auto-filled) -->
                    <div>
                        <label for="department" class="block mb-1">Department</label>
                        <input type="text" id="department" name="department" value="{{ ($overtime->pegawai)->department }}" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disabled>
                    </div>

                    <!-- Division Input (Auto-filled) -->
                    <div>
                        <label for="division" class="block mb-1">Division</label>
                        <input type="text" id="division" name="division" value="{{ ($overtime->pegawai)->division }}" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disabled>
                    </div>

                    <!-- Request Date -->
                    <div>
                        <label for="request_date" class="block mb-1">Request Date</label>
                        <input type="date" id="request_date" name="request_date" value="{{ $overtime->request_date }}" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disabled>
                    </div>

                    <!-- Start Time -->
                    <div>
                        <label for="start_time" class="block mb-1">Start Time</label>
                        <input type="time" id="start_time" name="start_time" value="{{ $overtime->start_time }}" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disabled>
                    </div>

                    <!-- End Time -->
                    <div>
                        <label for="end_time" class="block mb-1">End Time</label>
                        <input type="time" id="end_time" name="end_time" value="{{ $overtime->end_time }}" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disabled>
                    </div>

                    <!-- Overtime Reason -->
                    <div>
                        <label for="overtime_reason" class="block mb-1">Overtime Reason</label>
                        <input type="text" id="overtime_reason" name="overtime_reason" value="{{ $overtime->overtimeReason->title }}" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disabled>
                    </div>

                    <!-- To Do -->
                    <div>
                        <label for="todo_list" class="block mb-1">To-do</label>
                        <textarea id="todo_list" name="todo_list" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disabled>{{ $overtime->todo_list }}</textarea>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('overtime.edit', $overtime->id) }}"><div class="mt-6">
                        <button type="submit" class="bg-yellow-500 text-white p-2 rounded-lg w-full">Edit</button>
                    </div>
                </a>
                <a href="#" data-modal-target="deleteModal" data-url="{{ route('overtime.destroy', $overtime->id) }}" onclick="openDeleteModal(this)">
                    <div class="mt-6">
                        <button type="button" class="bg-red-500 text-white p-2 rounded-lg w-full">Delete</button>
                    </div>
                </a>

                </div>

                <!-- Delete Confirmation Modal -->
                <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
                    <div class="relative top-1/4 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="mt-3 text-center">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Are you sure?</h3>
                            <p class="mt-2 text-sm text-gray-500">Do you really want to delete this record? This process cannot be undone.</p>
                            <div class="mt-4">
                                <button id="cancelButton" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm" onclick="closeDeleteModal()">Cancel</button>
                                <form id="deleteForm" action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mt-2 px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-full shadow-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <script>
             function openDeleteModal(link) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const url = link.getAttribute('data-url');
            form.action = url;
            modal.classList.remove('hidden');
        }
        </script>
</body>
</html>
