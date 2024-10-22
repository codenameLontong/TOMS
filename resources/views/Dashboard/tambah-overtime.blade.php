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
                    <!-- Loading Spinner -->
                <div id="loading-spinner" class="hidden flex justify-center items-center mt-4">
                    <div role="status">
                        <svg class="inline mr-2 w-8 h-8 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5533C95.2932 28.8226 92.871 24.3693 89.8167 20.348C85.4116 14.4137 79.245 9.92839 72.0305 7.47802C64.816 5.02766 57.0089 4.69689 49.6307 6.51471C42.2524 8.33252 35.637 12.2177 30.4862 17.654C25.3355 23.0903 21.8678 29.931 20.4866 37.282C19.1054 44.6331 19.8771 52.2221 22.7251 59.1225C25.5732 66.0229 30.3816 71.8096 36.5164 75.6857C42.6512 79.5619 49.7714 81.2987 56.872 80.6598C63.9727 80.0208 70.6864 77.0364 76.0417 72.225C81.3971 67.4136 85.1553 61.0314 86.7987 54.0471C87.5154 51.0084 85.7376 48.017 82.6948 47.3688C79.652 46.7206 76.7224 48.5259 75.8934 51.5486C74.6376 56.4253 71.9245 60.743 67.9612 64.0277C63.998 67.3124 58.9737 69.3664 53.7214 69.8375C48.4691 70.3085 43.2374 69.1704 38.8741 66.5517C34.5109 63.933 31.2747 59.987 29.6142 55.2306C27.9538 50.4742 27.9499 45.2151 29.6048 40.4608C31.2596 35.7065 34.4862 31.7219 38.7676 29.1031C43.0491 26.4842 48.1578 25.3922 53.2169 26.0013C58.2761 26.6104 62.9697 28.8791 66.5363 32.4024C69.1252 34.9243 71.1915 38.1027 72.5355 41.6841C73.4451 44.1179 76.4458 45.678 79.9676 45.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <form id="overtime-form" action="{{ route('overtime.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                       <!-- NRP Input and Search Button -->
                        <div>
                            <label for="nrp" class="block mb-1">NRP</label>
                            <input type="text" id="nrp" name="nrp" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full">
                            <button type="button" id="search-nrp" class="mt-2 w-full text-white bg-blue-700 hover:bg-primary-800 rounded-lg px-5 py-2.5">Search</button>
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
                            <input type="text" id="division" name="division" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disa>
                        </div>

                        <!-- Hidden field for person_id -->
                        <input type="hidden" id="person_id" name="person_id">
                        <!-- Request Date -->
                        <div>
                            <label for="request_date" class="block mb-1">Request Date</label>
                            <input type="date" id="request_date" name="request_date" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full">
                        </div>
                        <!-- Start Time -->
                        <div>
                            <label for="start_time" class="block mb-1">Start Time</label>
                            <input type="time" id="start_time" name="start_time" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full">
                        </div>
                        <!-- End Time -->
                        <div>
                            <label for="end_time" class="block mb-1">End Time</label>
                            <input type="time" id="end_time" name="end_time" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full">
                        </div>
                        <!-- Overtime Reason -->
                        <div>
                            <label for="overtime_reason_order_id" class="block mb-1">Overtime Reason</label>
                            <select id="overtime_reason_order_id" name="overtime_reason_order_id" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full">
                                <option value="" disabled selected>Select a reason</option>
                                @foreach ($overtimeReasons as $reason)
                                    <option value="{{ $reason->id }}">{{ $reason->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- To-do List -->
                        <div>
                            <label for="todo_list" class="block mb-1">To-do</label>
                            <textarea id="todo_list" name="todo_list" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full" placeholder="Enter tasks to be done during overtime"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="mt-4 w-full text-white bg-blue-700 hover:bg-primary-800 rounded-lg px-5 py-2.5">
                        Submit
                    </button>
                </form>



            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // jQuery to handle NRP search
        $('#search-nrp').click(function() {
            var nrp = $('#nrp').val();
            if (nrp) {
                // Show the loading spinner
                $('#loading-spinner').removeClass('hidden');
                $.ajax({
                    url: '{{ route("pegawais.search") }}',
                    type: 'GET',
                    data: { nrp: nrp },
                    success: function(response) {
                        if (response.success) {
                            // Populate the fields with the returned data
                            $('#nama').val(response.data.nama);
                            $('#department').val(response.data.department);
                            $('#division').val(response.data.division);
                            $('#person_id').val(response.data.id); // Store the 'id' from pegawais as 'person_id' in overtime

                            // // Enable the fields so they can be sent with the form
                            // $('#nama, #department, #division').prop('disabled', false);
                        } else {
                            alert('NRP not found');
                        }
                    },
                    error: function() {
                        alert('Error fetching NRP data');
                    },
                    complete: function() {
                        // Hide the loading spinner
                        $('#loading-spinner').addClass('hidden');
                    }
                });
            } else {
                alert('Please enter NRP');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
