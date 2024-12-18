<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-14 bg-white dark:bg-gray-800 max-w-3xl mx-auto bg-white shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Pegawai</h2>

            <form method="POST" action="{{ route('pegawai.store') }}">
                @csrf

                <!-- NRP and Vendor -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="nrp_vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NRP Vendor</label>
                        <input type="text" id="nrp_vendor" name="nrp_vendor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vendor</label>
                        <select id="vendor" name="vendor" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->nama_vendor }}">{{ $vendor->nama_vendor }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Nama -->
                <div class="mb-4">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                    <input type="text" id="nama" name="nama" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                </div>

                <!-- COY and Directorate -->
                <div class="mb-4">
                    <label for="COY" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">COY</label>
                    <select id="COY" name="coy" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option value="" disabled selected>Pilih company</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->coy }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="directorate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Directorate</label>
                    <select id="directorate" name="directorate" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option value=""></option>
                    </select>
                </div>

                <!-- Division and Department -->
                <div class="mb-4">
                    <label for="division" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Division</label>
                    <select id="division" name="division" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option value=""></option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                    <select id="department" name="department" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option value=""></option>
                    </select>
                </div>

                <!-- Section -->
                <div class="mb-4">
                    <label for="section" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section</label>
                    <select id="section" name="section" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option value=""></option>
                    </select>
                </div>

                <!-- Jabatan and Cabang -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase">
                    </div>
                    <div class="w-1/2">
                        <label for="cabang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cabang</label>
                        <select id="cabang" name="cabang" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            @foreach($cabangs as $cabang)
                                <option value="{{ $cabang->lokasi_cabang }}">{{ $cabang->lokasi_cabang }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Tanggal Masuk TN/SHN and Vendor -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="tanggal_masuk_tn_shn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Masuk TN/SHN</label>
                        <input type="date" id="tanggal_masuk_tn_shn" name="tanggal_masuk_tn_shn" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase">
                    </div>
                    <div class="w-1/2">
                        <label for="tanggal_masuk_vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Masuk Vendor</label>
                        <input type="date" id="tanggal_masuk_vendor" name="tanggal_masuk_vendor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white uppercase">
                    </div>
                </div>

                <!-- Jenis Kontrak Kerjasama and Implementasi Kontrak -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="jenis_kontrak_kerjasama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kontrak Kerjasama</label>
                        <select id="jenis_kontrak_kerjasama" name="jenis_kontrak_kerjasama" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option value="LABOUR SUPPLY">LABOUR SUPPLY</option>
                            <option value="JOB SUPPLY">JOB SUPPLY</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="implementasi_kontrak_kerjasama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Implementasi Kontrak</label>
                        <select id="implementasi_kontrak_kerjasama" name="implementasi_kontrak_kerjasama" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option value="LABOUR SUPPLY">LABOUR SUPPLY</option>
                            <option value="JOB SUPPLY">JOB SUPPLY</option>
                        </select>
                    </div>
                </div>

                <!-- Lokasi Kerja and Project Site -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="lokasi_kerja" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi Kerja</label>
                        <input type="text" id="lokasi_kerja" name="lokasi_kerja" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>

                    <div class="w-1/2">
                        <label for="project_site" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project Site</label>
                        <input type="text" id="project_site" name="project_site" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>
                </div>

                <!-- Jenis Kelamin and Agama -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="agama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agama</label>
                        <select id="agama" name="agama" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Khonghucu">Khonghucu</option>
                        </select>
                    </div>
                </div>

                <!-- Pendidikan and Status -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="pendidikan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pendidikan</label>
                        <select id="pendidikan" name="pendidikan" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option value="SD/Sederajat">SD/Sederajat</option>
                            <option value="SMP/Sederajat">SMP/Sederajat</option>
                            <option value="SMA/Sederajat">SMA/Sederajat</option>
                            <option value="D1">D1</option>
                            <option value="D2">D2</option>
                            <option value="D3">D3</option>
                            <option value="D4">D4</option>
                            <option value="S1">S1</option>
                        </select>
                    </div>
                    <div class="w-1/2 relative">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white flex items-center">
                            Status
                            <span
                                class="ml-2 text-gray-400 hover:text-gray-600 cursor-pointer relative group"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="16" x2="12" y2="12"></line>
                                    <line x1="12" y1="8" x2="12" y2="8"></line>
                                </svg>
                                <div class="absolute left-0 top-6 bg-white text-gray-700 border border-gray-200 rounded shadow-lg p-2 text-sm w-64 hidden group-hover:block dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">
                                    <p><strong>TK:</strong> Belum Kawin</p>
                                    <p><strong>K0:</strong> Kawin Tanggungan 0</p>
                                    <p><strong>K1:</strong> Kawin Tanggungan 1</p>
                                    <p><strong>K2:</strong> Kawin Tanggungan 2</p>
                                    <p><strong>K3:</strong> Kawin Tanggungan 3</p>
                                    <p><strong>K4:</strong> Kawin Tanggungan 4</p>
                                    <p><strong>K5:</strong> Kawin Tanggungan 5</p>
                                </div>
                            </span>
                        </label>
                        <select id="status" name="status" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option value="TK">TK</option>
                            <option value="K0">K0</option>
                            <option value="K1">K1</option>
                            <option value="K2">K2</option>
                            <option value="K3">K3</option>
                            <option value="K4">K4</option>
                            <option value="K5">K5</option>
                        </select>
                    </div>
                </div>

                <!-- Tanggal Lahir -->
                <div class="mb-4">
                    <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                </div>

                <!-- Email and No hp -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="alamat_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat Email</label>
                        <input type="email" id="alamat_email" name="alamat_email" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <p id="email_error" class="text-red-600 text-sm mt-2 hidden">Email already exists.</p>
                    </div>
                    <div class="w-1/2">
                        <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No HP</label>
                        <input type="text" id="no_hp" name="no_hp" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>
                </div>

                <button type="submit" id="tambahPegawaiBtn" class="w-full text-white bg-gray-400 cursor-not-allowed rounded-lg px-5 py-2.5">
                    Tambah
                </button>
            </form>
        </div>
    </div>

    <script>
        const emailInput = document.getElementById('alamat_email');
        const emailErrorMsg = document.getElementById('email_error');
        const tambahPegawaiBtn = document.getElementById('tambahPegawaiBtn');

        // Disable the submit button initially
        tambahPegawaiBtn.disabled = true;

        // Email validation and button enable/disable logic
        emailInput.addEventListener('input', function () {
            const email = this.value;

            if (email.length > 0) {
                fetch(`{{ route('pegawai.checkEmail') }}?alamat_email=${email}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            emailErrorMsg.classList.remove('hidden');
                            tambahPegawaiBtn.disabled = true;
                            tambahPegawaiBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                            tambahPegawaiBtn.classList.remove('bg-blue-700', 'hover:bg-primary-800');
                        } else {
                            emailErrorMsg.classList.add('hidden');
                            tambahPegawaiBtn.disabled = false;
                            tambahPegawaiBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                            tambahPegawaiBtn.classList.add('bg-blue-700', 'hover:bg-primary-800');
                        }
                    });
            } else {
                emailErrorMsg.classList.add('hidden');
                tambahPegawaiBtn.disabled = true;
                tambahPegawaiBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                tambahPegawaiBtn.classList.remove('bg-blue-700', 'hover:bg-primary-800');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
        const directorateSelect = document.getElementById('directorate');
        const divisionSelect = document.getElementById('division');
        const departmentSelect = document.getElementById('department');
        const sectionSelect = document.getElementById('section');
        const companySelect = document.getElementById('COY');

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
                    // Filter out directorates with id = 1 and id = 4
                    const filteredData = data.filter(directorate => directorate.id !== 1 && directorate.id !== 4);

                    populateDropdown(directorateSelect, filteredData, 'nama_directorate');
                    resetDropdown(divisionSelect);
                    resetDropdown(departmentSelect);
                    resetDropdown(sectionSelect);

                    // Automatically select the first directorate and trigger the change event
                    if (filteredData.length > 0) {
                        directorateSelect.value = filteredData[0].id;
                        directorateSelect.dispatchEvent(new Event('change')); // Trigger change event for the next dropdown
                    }
                })
                .catch(error => {
                    console.error('Error fetching directorates:', error);
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

        // Fetch departments based on selected division
        divisionSelect.addEventListener('change', function() {
            const divisionId = this.value;
            if (divisionId) {
                fetch(`/get-departments/${divisionId}`)
                    .then(response => response.json())
                    .then(data => {
                        populateDropdown(departmentSelect, data, 'nama_department');
                        resetDropdown(sectionSelect);

                        // Automatically select the first department and trigger the change event
                        if (data.length > 0) {
                            departmentSelect.value = data[0].id;
                            departmentSelect.dispatchEvent(new Event('change'));
                        }
                    });
            } else {
                resetDropdown(departmentSelect);
                resetDropdown(sectionSelect);
            }
        });

        // Fetch sections based on selected department
        departmentSelect.addEventListener('change', function() {
            const departmentId = this.value;
            if (departmentId) {
                fetch(`/get-sections/${departmentId}`)
                    .then(response => response.json())
                    .then(data => {
                        populateDropdown(sectionSelect, data, 'nama_section');

                        // Automatically select the first section
                        if (data.length > 0) {
                            sectionSelect.value = data[0].id;
                        }
                    });
            } else {
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


