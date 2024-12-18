<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mutasi Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-14 max-w-2xl mx-auto bg-white shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Mutasi Pegawai</h2>

            <form method="POST" action="{{ route('pegawai.updateMutasi', $pegawai->id) }}">
                @csrf
                @method('PUT')

                <!-- NRP -->
                <div class="mb-4">
                    <label for="nrp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NRP</label>
                    <input type="text" id="nrp" name="nrp" value="{{ $pegawai->nrp }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Nama -->
                <div class="mb-4">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                    <input type="text" id="nama" name="nama" value="{{ $pegawai->nama }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Jabatan Sekarang and Jabatan Tujuan -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="jabatan_sekarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan Sekarang</label>
                        <input type="text" id="jabatan_sekarang" name="jabatan_sekarang" value="{{ $pegawai->jabatan }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="jabatan_tujuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan Tujuan</label>
                        <input type="text" id="jabatan_tujuan" name="jabatan" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 uppercase block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <!-- Cabang Sekarang and Cabang Tujuan -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="cabang_sekarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cabang Sekarang</label>
                        <input type="text" id="cabang_sekarang" name="cabang_sekarang" value="{{ $pegawai->cabang }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="cabang_tujuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cabang Tujuan</label>
                        <select id="cabang_tujuan" name="cabang" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @foreach($cabangs as $cabang)
                                <option value="{{ $cabang->id }}">{{ $cabang->lokasi_cabang }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- COY Sekarang and COY Tujuan -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="coy_sekarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">COY Sekarang</label>
                        <input type="text" id="coy_sekarang" name="coy_sekarang" value="{{ $pegawai->coy }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="coy_tujuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">COY Tujuan</label>
                        <select id="COY" name="coy" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ $company->id == $pegawai->company_id ? 'selected' : '' }}>{{ $company->coy }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Directorate Sekarang and Directorate Tujuan -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="directorate_sekarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Direktorat Sekarang</label>
                        <input type="text" id="directorate_sekarang" name="directorate_sekarang" value="{{ $pegawai->directorate }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="directorate_tujuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Direktorat Tujuan</label>
                        <select id="directorate" name="directorate" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></select>
                    </div>
                </div>

                <!-- Division Sekarang and Division Tujuan -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="divisi_sekarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Divisi Sekarang</label>
                        <input type="text" id="divisi_sekarang" name="divisi_sekarang" value="{{ $pegawai->division }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="divisi_tujuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Divisi Tujuan</label>
                        <select id="division" name="division" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></select>
                    </div>
                </div>

                <!-- Department Sekarang and Department Tujuan -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="department_sekarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departemen Sekarang</label>
                        <input type="text" id="department_sekarang" name="department_sekarang" value="{{ $pegawai->department }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="department_tujuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departemen Tujuan</label>
                        <select id="department" name="department" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></select>
                    </div>
                </div>

                <!-- Section Sekarang and Section Tujuan -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="section_sekarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section Sekarang</label>
                        <input type="text" id="section_sekarang" name="section_sekarang" value="{{ $pegawai->section }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="section_tujuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section Tujuan</label>
                        <select id="section" name="section" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></select>
                    </div>
                </div>

                <!-- Project Site Sekarang and Project Site Tujuan -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="project_site_sekarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Proyek/Site Sekarang</label>
                        <input type="text" id="project_site_sekarang" name="project_site_sekarang" value="{{ $pegawai->project_site }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="project_site_tujuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Proyek/Site Tujuan</label>
                        <input type="text" id="project_site_tujuan" name="project_site" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm uppercase rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <!-- Lokasi Kerja Sekarang and Lokasi Kerja Tujuan -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="lokasi_kerja_sekarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi Kerja Sekarang</label>
                        <input type="text" id="lokasi_kerja_sekarang" name="lokasi_kerja_sekarang" value="{{ $pegawai->lokasi_kerja }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="lokasi_kerja_tujuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi Kerja Tujuan</label>
                        <input type="text" id="lokasi_kerja_tujuan" name="lokasi_kerja" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm uppercase rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2.5">
                    Mutasi
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const directorateSelect = document.getElementById('directorate');
            const divisionSelect = document.getElementById('division');
            const departmentSelect = document.getElementById('department');
            const sectionSelect = document.getElementById('section');
            const companySelect = document.getElementById('COY');

            // Prefill dropdowns when a company is selected
            const prefillDropdowns = function(companyId) {
                if (companyId) {
                    fetch(`/get-directorates/${companyId}`)
                        .then(response => response.json())
                        .then(data => {
                            populateDropdown(directorateSelect, data, 'nama_directorate');
                            resetDropdown(divisionSelect);
                            resetDropdown(departmentSelect);
                            resetDropdown(sectionSelect);

                            // Automatically select the first directorate to trigger the next dropdowns
                            if (data.length > 0) {
                                directorateSelect.value = data[0].id;
                                directorateSelect.dispatchEvent(new Event('change'));
                            }
                        });
                }
            };

            // Fetch directorates based on selected company
            companySelect.addEventListener('change', function() {
                const companyId = this.value;
                prefillDropdowns(companyId);
            });

            // Prefill on page load if company is already selected
            const initialCompanyId = companySelect.value;
            if (initialCompanyId) {
                prefillDropdowns(initialCompanyId);
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

                            // Automatically select the first division to trigger the next dropdowns
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

                            // Automatically select the first department to trigger the next dropdowns
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

                            // Automatically select the first section (if available)
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
                dropdown.innerHTML = '';
            }
        });

        document.querySelector('form').addEventListener('submit', function(e) {
            console.log("Form submitted");
            console.log("Form data: ", new FormData(this));
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

