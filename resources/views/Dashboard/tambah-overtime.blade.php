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
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Buat SPL</h2>
            <div class="container mx-auto p-4">

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div id="alert-message" class="hidden p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-medium">Error!</span> Data tidak ditemukan.
                  </div>

                <!-- New Search Input -->
                <div>
                    <div class="flex items-center">
                        <div class="flex-grow">
                            <label for="search" class="block mb-1">Search NRP or Name</label>
                            <input type="text" id="search" class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full" placeholder="Search by NRP or Name">
                        </div>
                        <button id="clear-search" class="bg-red-500 text-white px-4 py-2 rounded-lg ml-2 mt-5">Clear</button>
                    </div>
                    <ul id="search-results" class="bg-white border border-gray-300 rounded-lg mt-2 w-full hidden"></ul>
                    </div>

                <!-- Loading Spinner -->
                <div id="loading-spinner" class="hidden flex justify-center items-center mt-4">
                    <div role="status">
                        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>


                <!-- Form Inputs -->
                <form id="overtime-form" action="{{ route('overtime.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- NRP Input (Auto-filled) -->
                        <div>
                            <label for="nrp" class="block mb-1">NRP</label>
                            <input type="text" id="nrp" name="nrp" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disabled>
                        </div>

                        <!-- Name Input (Auto-filled) -->
                        <div>
                            <label for="nama" class="block mb-1">Name</label>
                            <input type="text" id="nama" name="nama" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disabled>
                        </div>

                        <!-- Department Input (Auto-filled) -->
                        <div>
                            <label for="department" class="block mb-1">Department</label>
                            <input type="text" id="department" name="department" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disabled>
                        </div>

                        <!-- Division Input (Auto-filled) -->
                        <div>
                            <label for="division" class="block mb-1">Division</label>
                            <input type="text" id="division" name="division" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disabled>
                        </div>

                        <!-- Hidden field for pegawai_id -->
                        <input type="hidden" id="pegawai_id" name="pegawai_id">

                        <!-- Hidden field for person_email -->
                        <input type="hidden" id="person_email" name="person_email">

                        <!-- Other Form Fields (Date, Time, Reason, To-Do) -->
                        <div>
                            <label for="request_date" class="block mb-1">Request Date</label>
                            <input type="date" id="request_date" name="request_date" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full">
                        </div>
                        <div>
                            <label for="start_time" class="block mb-1">Start Time</label>
                            <input type="time" id="start_time" name="start_time" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full">
                        </div>
                        <div>
                            <label for="end_time" class="block mb-1">End Time</label>
                            <input type="time" id="end_time" name="end_time" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full">
                        </div>
                        <div>
                            <label for="overtime_reason_order_id" class="block mb-1">Overtime Reason</label>
                            <select id="overtime_reason_order_id" name="overtime_reason_order_id" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full">
                                <option value="" disabled selected>Select a reason</option>
                                @foreach ($overtimeReasons as $reason)
                                    <option value="{{ $reason->id }}">{{ $reason->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="todo_list" class="block mb-1">To-do</label>
                            <textarea id="todo_list" name="todo_list" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full" placeholder="Enter tasks to be done during overtime"></textarea>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg w-full">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle AJAX and search functionality -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to check if "Name" field is filled and hide search results
            function checkNameField() {
                if ($('#nama').val().trim().length > 0) {
                    $('#search-results').empty().addClass('hidden');
                    return true;
                }
                return false;
            }

            // Listen for keyup event on search input
            $('#search').on('keyup', function() {
                var query = $(this).val();

                // Check if "Name" field is filled and hide results
                if (checkNameField()) {
                    return;
                }

                // Display search results only if query is at least 2 characters long
                if (query.length >= 2) {
                    $('#loading-spinner').removeClass('hidden');
                    $.ajax({
                        url: "{{ route('search.pegawais') }}",
                        type: "GET",
                        data: { query: query },
                        success: function(response) {
                            $('#loading-spinner').addClass('hidden');

                            // Double-check if "Name" field is filled after the AJAX call
                            if (checkNameField()) {
                                return;
                            }

                            $('#search-results').empty().removeClass('hidden');
                            if (response.length > 0) {
                                $.each(response, function(index, pegawai) {
                                    $('#search-results').append(
                                        `<li class="p-2 hover:bg-gray-100 cursor-pointer" data-id="${pegawai.id}" data-nrp="${pegawai.nrp}" data-name="${pegawai.nama}" data-department="${pegawai.department}" data-division="${pegawai.division}" data-email="${pegawai.alamat_email}">
                                            ${pegawai.nrp} - ${pegawai.nama}
                                        </li>`
                                    );
                                });
                            } else {
                                $('#search-results').append('<li class="p-2">No results found</li>');
                            }
                        }
                    });
                } else {
                    $('#search-results').addClass('hidden');
                }
            });

            // Handle click on a result item
            $(document).on('click', '#search-results li', function() {
                var id = $(this).data('id');
                var nrp = $(this).data('nrp');
                var name = $(this).data('name');
                var department = $(this).data('department');
                var division = $(this).data('division');
                var email = $(this).data('email');

                $('#pegawai_id').val(id);
                $('#nrp').val(nrp);
                $('#nama').val(name);
                $('#department').val(department);
                $('#division').val(division);
                $('#person_email').val(email);

                $('#search').prop('disabled', true);  // Optionally disable search input
                $('#search-results').addClass('hidden');
            });

            // Clear button functionality
            $('#clear-search').on('click', function() {
                $('#search').val('').prop('disabled', false);  // Clear and enable search input
                $('#search-results').empty().addClass('hidden');  // Hide search results
                $('#nrp, #nama, #department, #division').val('');  // Clear auto-filled fields
                $('#pegawai_id, #person_email').val('');  // Clear hidden fields
            });
        });
        </script>





</body>
</html>
