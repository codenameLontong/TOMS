<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exception - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg mt-14 bg-white dark:bg-gray-800 shadow-lg">
            <div class="flex flex-row justify-between">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Daftar Exception</h2>
                <!-- Search Bar and Create Overtime Button -->
                <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 pb-4">
                    <a href="{{ route('exceptions.create') }}" class="flex items-center px-4 py-2 text-white bg-blue-700 hover:bg-blue-800 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Buat Exception
                    </a>
                </div>
            </div>

               <!-- Exception Table -->
               <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="asc" onclick="sortTable(0, this)">Id <span>&#9650;</span></th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="asc" onclick="sortTable(1, this)">Holiday Date <span>&#9650;</span></th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="asc" onclick="sortTable(2, this)">Note <span>&#9650;</span></th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($exceptions as $exception)
                        <tr class=" border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ $exception->id }}</td>
                            <td class="px-6 py-4">{{ $exception->holiday_date }}</td>
                            <td class="px-6 py-4">{{ $exception->note }}</td>
                            <td class="flex px-6 py-4">
                                <!-- View Icon -->
                                <div class="relative" style="position: relative; display: inline-block;">
                                    <a href="" class="text-blue-600 hover:text-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>
                                    <span style="position: absolute; bottom: 25px; left: 0; background-color: #E5E7EB; color: #1F2937; padding: 2px 6px; border-radius: 4px; display: none; white-space: nowrap;">View</span>
                                </div>

                                <!-- Edit Icon -->
                                <div class="relative ml-4" style="position: relative; display: inline-block;">
                                    <a href="{{ route('exceptions.edit', $exception->id) }}" class="text-blue-600 hover:text-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                    <span style="position: absolute; bottom: 25px; left: 0; background-color: #E5E7EB; color: #1F2937; padding: 2px 6px; border-radius: 4px; display: none; white-space: nowrap;">Edit</span>
                                </div>

                                <!-- Delete Icon -->
                                <div class="relative ml-4" style="position: relative; display: inline-block;">
                                    <a href="#" class="text-red-600 hover:text-red-800" data-modal-target="deleteModal" data-url="{{ route('exceptions.destroy', $exception->id) }}" onclick="openDeleteModal(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </a>
                                    <span style="position: absolute; bottom: 25px; left: 0; background-color: #E5E7EB; color: #1F2937; padding: 2px 6px; border-radius: 4px; display: none; white-space: nowrap;">Delete</span>
                                </div>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

                        <!-- Pagination -->
                        <nav id="pagination" class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Pagination">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Showing
                    <span id="current-range"class="font-semibold text-gray-900 dark:text-white">1-10</span>
                    of
                    <span id="total-records" class="font-semibold text-gray-900 dark:text-white">100</span>
                </span>
                <ul class="inline-flex items-stretch -space-x-px" id="pagination-list">
                    <li>
                        <a href="#" id="prev-page" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
                            <span class="sr-only">Previous</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" />
                            </svg>
                        </a>
                    </li>
                    <li id="pagination-buttons" class="flex space"></li>
                    <li>
                        <a href="#" id="next-page" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
                            <span class="sr-only">Next</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7.293 5.293a1 1 0 011.414 0L12.586 10l-3.879 3.707a1 1 0 01-1.414-1.414L10.586 10l-3.293-3.293a1 1 0 010-1.414z" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-700 w-96">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Are you sure?</h3>
            <p class="text-sm text-gray-500 dark:text-gray-300 mb-6">Do you really want to delete this record? This action cannot be undone.</p>
            <div class="flex justify-end space-x-3">
                <button id="cancelButton" class="px-4 py-2 bg-gray-500 text-white rounded-md" onclick="closeDeleteModal()">Cancel</button>
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md">Delete</button>
                </form>
            </div>
        </div>
    </div>

</body>
<script>
     function openDeleteModal(link) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = link.getAttribute('data-url');
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
</script>
</html>

