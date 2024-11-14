<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Exception</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Buat Exception</h2>
            <div class="container mx-auto p-4">
                <!-- New Search Input -->
                <!-- Form Inputs -->
                <form id="exception-form" action="{{ route('exceptions.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Other Form Fields (Date, Time, Reason, To-Do) -->
                        <div>
                            <label for="request_date" class="block mb-1">Holiday Date</label>
                            <input type="date" id="holiday_date" name="holiday_date" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full">
                        </div>
                        <div>
                            <label for="todo_list" class="block mb-1">Note</label>
                            <input id="note" name="note" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full">
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
