<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Vendor</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Vendor</h2>

            <form method="POST" action="{{ route('vendor.store') }}">
                @csrf

                <!-- Kode Vendor -->
                <div class="mb-4 relative">
                    <label for="kode_vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white flex items-center">
                        Kode Vendor
                        <span class="ml-2 text-gray-400 hover:text-gray-600 cursor-pointer relative group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12" y2="8"></line>
                            </svg>
                            <div class="absolute left-0 top-6 bg-white text-gray-700 border border-gray-200 rounded shadow-lg p-2 text-sm w-64 hidden group-hover:block dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">
                                <p><strong>Kode Vendor:</strong> Sesuaikan dengan data SAP</p>
                            </div>
                        </span>
                    </label>
                    <input type="text" id="kode_vendor" name="kode_vendor" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    <p id="kode_vendor_error" class="text-red-600 text-sm mt-2 hidden">Kode Vendor telah terdaftar!</p>
                </div>

                <!-- Nama Vendor -->
                <div class="mb-4">
                    <label for="nama_vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Vendor</label>
                    <input type="text" id="nama_vendor" name="nama_vendor" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                </div>

                <!-- Astra Non Astra -->
                <div class="mb-4">
                    <label for="astra_non_astra" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Astra/Non Astra</label>
                    <select id="astra_non_astra" name="astra_non_astra" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option value="Astra">Astra</option>
                        <option value="Non Astra">Non Astra</option>
                    </select>
                </div>

                <!-- PICs -->
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PIC (Person In Charge)</label>
                    <div id="pic-container" class="space-y-4">
                    <div class="flex items-center space-x-2" id="pic-row-template">
                        <input type="text" name="pics[0][nama]" placeholder="Nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white w-1/4" required>
                        <input type="text" name="pics[0][no_hp]" placeholder="No HP" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white w-1/4" required>
                        <input type="email" name="pics[0][email]" placeholder="Email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white w-1/4" required>
                        <input type="text" name="pics[0][jabatan]" placeholder="Jabatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white w-1/4" required>
                        <button type="button" class="text-gray-400 cursor-not-allowed text-sm font-medium" disabled>Remove</button>
                    </div>
                    </div>
                    <button type="button" id="add-pic-btn" class="text-blue-600 hover:text-blue-800 text-sm font-medium mt-2">+ Add PIC</button>
                </div>

                <button type="submit" id="tambahVendorBtn" class="w-full text-white bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2.5">
                    Tambah Vendor
                </button>
            </form>
        </div>
    </div>

    <script>
    const kodeVendorInput = document.getElementById('kode_vendor');
    const errorMsg = document.getElementById('kode_vendor_error');
    const tambahVendorBtn = document.getElementById('tambahVendorBtn');

    // Disable the submit button initially and apply grey background
    tambahVendorBtn.disabled = true;

    kodeVendorInput.addEventListener('input', function () {
        const kodeVendor = this.value;

        if (kodeVendor.length > 0) {
            // Send AJAX request to check if kode_vendor exists
            fetch(`{{ route('vendor.checkKodeVendor') }}?kode_vendor=${kodeVendor}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        // Show the error message and disable the button
                        errorMsg.classList.remove('hidden');
                        tambahVendorBtn.disabled = true;
                        tambahVendorBtn.classList.add('bg-gray-400', 'cursor-not-allowed');  // Set grey background when disabled
                        tambahVendorBtn.classList.remove('bg-blue-700', 'hover:bg-primary-800');
                    } else {
                        // Hide the error message and enable the button
                        errorMsg.classList.add('hidden');
                        tambahVendorBtn.disabled = false;
                        tambahVendorBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                        tambahVendorBtn.classList.add('bg-blue-700', 'hover:bg-primary-800');  // Set blue background when enabled
                    }
                });
        } else {
            // If input is empty, disable the button and hide the error message
            errorMsg.classList.add('hidden');
            tambahVendorBtn.disabled = true;
            tambahVendorBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
            tambahVendorBtn.classList.remove('bg-blue-700', 'hover:bg-primary-800');
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

        let picIndex = 1;

        document.getElementById('add-pic-btn').addEventListener('click', function () {
            const picTemplate = document.getElementById('pic-row-template').cloneNode(true);
            picTemplate.id = '';
            picTemplate.querySelectorAll('input').forEach(input => {
                input.name = input.name.replace('[0]', `[${picIndex}]`);
                input.value = '';
            });

            // Enable the "Remove" button for cloned rows
            const removeButton = picTemplate.querySelector('button');
            removeButton.disabled = false;
            removeButton.classList.remove('text-gray-400', 'cursor-not-allowed');
            removeButton.classList.add('text-red-600', 'hover:text-red-800');
            removeButton.textContent = 'Remove';
            removeButton.setAttribute('onclick', 'removePic(this)');

            document.getElementById('pic-container').appendChild(picTemplate);
            picIndex++;
        });

        function removePic(button) {
            button.closest('.flex').remove();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
