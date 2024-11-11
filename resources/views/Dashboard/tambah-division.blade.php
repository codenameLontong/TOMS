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
        <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Division</h2>

            <form method="POST" action="{{ route('division.store') }}">
                @csrf

                <!-- Select Company -->
                <div class="mb-4">
                    <label for="company_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Company</label>
                    <select id="company_id" name="company_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->coy }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Select Directorate -->
                <div class="mb-4">
                    <label for="directorate_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Directorate</label>
                    <select id="directorate_id" name="directorate_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option value=""></option>
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
        // Handle checking if division name already exists
        const namaDivisionInput = document.getElementById('nama_division');
        const directorateSelect = document.getElementById('directorate_id'); // Ensure this element is captured for the directorate select dropdown
        const errorMsg = document.getElementById('nama_division_error');

        namaDivisionInput.addEventListener('input', function () {
            const namaDivision = this.value;
            const directorateId = directorateSelect.value; // Get the selected directorate ID

            if (namaDivision.length > 0 && directorateId) {
                // Send AJAX request to check if 'nama_division' exists within the selected 'directorate_id'
                fetch(`{{ route('division.checkNamaDivision') }}?nama_division=${namaDivision}&directorate_id=${directorateId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            // Show the error message but don't disable the button
                            errorMsg.classList.remove('hidden');
                        } else {
                            // Hide the error message
                            errorMsg.classList.add('hidden');
                        }
                    });
            } else {
                // Hide the error message if input is empty or no directorate is selected
                errorMsg.classList.add('hidden');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const directorateSelect = document.getElementById('directorate_id');
            const companySelect = document.getElementById('company_id');

            // Initial check for the prefilled company
            if (companySelect.value) {
                fetchDirectorates(companySelect.value);
            }

            // Fetch directorates based on selected company
            companySelect.addEventListener('change', function() {
                const companyId = this.value;
                if (companyId) {
                    fetchDirectorates(companyId);
                } else {
                    resetDropdown(directorateSelect);
                    resetDropdown(divisionSelect);
                    resetDropdown(departmentSelect);
                    resetDropdown(sectionSelect);
                }
            });

            function fetchDirectorates(companyId) {
                fetch(`/get-directorates/${companyId}`)
                    .then(response => response.json())
                    .then(data => {
                        populateDropdown(directorateSelect, data, 'nama_directorate');
                        resetDropdown(divisionSelect);
                        resetDropdown(departmentSelect);
                        resetDropdown(sectionSelect);

                        // Automatically select the first directorate and trigger the change event
                        if (data.length > 0) {
                            directorateSelect.value = data[0].id;
                            directorateSelect.dispatchEvent(new Event('change'));  // Trigger change event for the next dropdown
                        }
                    });
            }

            // Fetch divisions based on selected directorate
            directorateSelect.addEventListener('change', function() {
                const directorateId = this.value;
                if (directorateId) {
                    fetch(`/get-divisions/${directorateId}`)
                        .then(response => response.json())
                        .then(data => {
                            populateDropdown(divisionSelect, data, 'nama_division');
                            resetDropdown(departmentSelect);
                            resetDropdown(sectionSelect);

                            // Automatically select the first division and trigger the change event
                            if (data.length > 0) {
                                divisionSelect.value = data[0].id;
                                divisionSelect.dispatchEvent(new Event('change'));
                            }
                        });
                } else {
                    resetDropdown(divisionSelect);
                    resetDropdown(departmentSelect);
                    resetDropdown(sectionSelect);
                }
            });

            // Helper function to populate dropdown
            function populateDropdown(dropdown, data, attribute) {
                dropdown.innerHTML = '';
                data.forEach(item => {
                    dropdown.innerHTML += `<option value="${item.id}">${item[attribute]}</option>`;
                });
            }

            // Helper function to reset dropdown
            function resetDropdown(dropdown) {
                dropdown.innerHTML = '<option value=""></option>';
            }
        });

        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {

            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }

            // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
