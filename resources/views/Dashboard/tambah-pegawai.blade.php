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
                <!-- NRP and NRP Vendor -->
                <div class="flex space-x-4 mb-4">
                    <!-- <div class="w-1/2">
                        <label for="nrp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NRP</label>
                        <input type="text" id="nrp" name="nrp" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <p id="nrp_error" class="text-red-600 text-sm mt-2 hidden">NRP already exists.</p>
                    </div> -->
                    <div class="w-1/2">
                        <label for="nrp_vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NRP Vendor</label>
                        <input type="text" id="nrp_vendor" name="nrp_vendor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>
                </div>

                <!-- Nama -->
                <div class="mb-4">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                    <input type="text" id="nama" name="nama" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                </div>

                <!-- COY and Cabang -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="coy" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">COY</label>
                        <select id="coy" name="coy" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option value="TN">TN</option>
                            <option value="SHN">SHN</option>
                        </select>
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

                <!-- Jabatan and Directorate -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="directorate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Directorate</label>
                        <select id="directorate" name="directorate" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <!-- Add options for directorate -->
                            <option value="Branch Support and Improvement">Branch Support and Improvement</option>
                            <option value="Corporate Procurement">Corporate Procurement</option>
                            <option value="Finance and Administration">Finance and Administration</option>
                            <option value="Human Capital & Sustainability">Human Capital & Sustainability</option>
                            <option value="Marketing & Sales">Marketing & Sales</option>
                            <option value="Material Handling Business">Material Handling Business</option>
                            <option value="Power, Agro and Construction Business">Power, Agro and Construction Business</option>
                            <!-- Add other directorates -->
                        </select>
                    </div>
                </div>

                <!-- Division and Department -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="division" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Division</label>
                        <select id="division" name="division" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <!-- Add options for division -->
                            <option value="Branch Support and Improvement">Branch Support and Improvement</option>
                            <option value="Corporate Procurement">Corporate Procurement</option>
                            <option value="Finance, Accounting, Taxes and IT">Finance, Accounting, Taxes and IT</option>
                            <option value="Human Capital, SSEHS and General Affair">Human Capital, SSEHS and General Affair</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Material Handling Sales and Marketing">Material Handling Sales and Marketing</option>
                            <option value="Product Support">Product Support</option>
                            <option value="Rental Marketing and Business Controller">Rental Marketing and Business Controller</option>
                            <option value="Rental, FG Wilson and Genset Center">Rental, FG Wilson and Genset Center</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                        <input type="text" id="department" name="department" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>
                </div>

                                <!-- Tanggal Masuk TN/SHN and Vendor -->
                                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="tanggal_masuk_tn_shn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Masuk TN/SHN</label>
                        <input type="date" id="tanggal_masuk_tn_shn" name="tanggal_masuk_tn_shn" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="tanggal_masuk_vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Masuk Vendor</label>
                        <input type="date" id="tanggal_masuk_vendor" name="tanggal_masuk_vendor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
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
                            <!-- Add other religions -->
                        </select>
                    </div>
                </div>

                <!-- Pendidikan and Status -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="pendidikan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pendidikan</label>
                        <select id="pendidikan" name="pendidikan" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option value="SMA">SMA</option>
                            <option value="SMK">SMK</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" name="status" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option value="TK">TK</option>
                            <option value="K1">K1</option>
                            <option value="K2">K2</option>
                            <option value="K2">K3</option>
                            <option value="K2">K4</option>
                            <option value="K2">K5</option>
                            <!-- Add other statuses -->
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

                <!-- Astra/Non Astra -->
                <div class="mb-4">
                    <label for="astra_non_astra" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Astra/Non Astra</label>
                    <select id="astra_non_astra" name="astra_non_astra" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option value="Astra">Astra</option>
                        <option value="Non Astra">Non Astra</option>
                    </select>
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

        // Disable the submit button initially and apply grey background
        tambahPegawaiBtn.disabled = true;

        emailInput.addEventListener('input', function () {
            const email = this.value;

            if (email.length > 0) {
                // Send AJAX request to check if email exists
                fetch(`{{ route('pegawai.checkEmail') }}?alamat_email=${email}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            // Show the error message and disable the button
                            emailErrorMsg.classList.remove('hidden');
                            tambahPegawaiBtn.disabled = true;
                            tambahPegawaiBtn.classList.add('bg-gray-400', 'cursor-not-allowed');  // Set grey background when disabled
                            tambahPegawaiBtn.classList.remove('bg-blue-700', 'hover:bg-primary-800');
                        } else {
                            // Hide the error message and enable the button
                            emailErrorMsg.classList.add('hidden');
                            tambahPegawaiBtn.disabled = false;
                            tambahPegawaiBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                            tambahPegawaiBtn.classList.add('bg-blue-700', 'hover:bg-primary-800');  // Set blue background when enabled
                        }
                    });
            } else {
                // If input is empty, disable the button and hide the error message
                emailErrorMsg.classList.add('hidden');
                tambahPegawaiBtn.disabled = true;
                tambahPegawaiBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                tambahPegawaiBtn.classList.remove('bg-blue-700', 'hover:bg-primary-800');
            }
        });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
