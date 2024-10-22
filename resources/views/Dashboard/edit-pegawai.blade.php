<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Pegawai</h2>

            <form method="POST" action="{{ route('pegawai.update', $pegawai->id) }}">
                @csrf
                @method('PUT')

                <!-- NRP and NRP Vendor -->
                <div class="flex space-x-4 mb-4">
                <div class="w-1/2">
                        <label for="nrp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NRP</label>
                        <input type="text" id="nrp" name="nrp" value="{{ $pegawai->nrp }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="nrp_vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NRP Vendor</label>
                        <input type="text" id="nrp_vendor" name="nrp_vendor" value="{{ $pegawai->nrp_vendor }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <!-- Nama -->
                <div class="mb-4">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                    <input type="text" id="nama" name="nama" value="{{ $pegawai->nama }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- COY and Cabang -->
                <!-- <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="coy" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">COY</label>
                        <select id="coy" name="coy" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            <option value="TN" {{ $pegawai->coy == 'TN' ? 'selected' : '' }}>TN</option>
                            <option value="SHN" {{ $pegawai->coy == 'SHN' ? 'selected' : '' }}>SHN</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="cabang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cabang</label>
                        <select id="cabang" name="cabang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            <option value="BANDAR LAMPUNG" {{ $pegawai->cabang == 'BANDAR LAMPUNG' ? 'selected' : '' }}>Bandar Lampung</option>
                            <option value="BANDUNG" {{ $pegawai->cabang == 'BANDUNG' ? 'selected' : '' }}>Bandung</option>
                            <option value="BANJARMASIN" {{ $pegawai->cabang == 'BANJARMASIN' ? 'selected' : '' }}>Banjarmasin</option>
                            <option value="JAKARTA" {{ $pegawai->cabang == 'JAKARTA' ? 'selected' : '' }}>Jakarta</option>
                            <option value="JAMBI" {{ $pegawai->cabang == 'JAMBI' ? 'selected' : '' }}>Jambi</option>
                            <option value="JAYAPURA" {{ $pegawai->cabang == 'JAYAPURA' ? 'selected' : '' }}>Jayapura</option>
                            <option value="MAKASSAR" {{ $pegawai->cabang == 'MAKASSAR' ? 'selected' : '' }}>Makassar</option>
                            <option value="MEDAN" {{ $pegawai->cabang == 'MEDAN' ? 'selected' : '' }}>Medan</option>
                            <option value="PALEMBANG" {{ $pegawai->cabang == 'PALEMBANG' ? 'selected' : '' }}>Palembang</option>
                            <option value="PADANG" {{ $pegawai->cabang == 'PADANG' ? 'selected' : '' }}>Padang</option>
                            <option value="PEKANBARU" {{ $pegawai->cabang == 'PEKANBARU' ? 'selected' : '' }}>Pekanbaru</option>
                            <option value="PONTIANAK" {{ $pegawai->cabang == 'PONTIANAK' ? 'selected' : '' }}>Pontianak</option>
                            <option value="SAMARINDA" {{ $pegawai->cabang == 'SAMARINDA' ? 'selected' : '' }}>Samarinda</option>
                            <option value="SAMPIT" {{ $pegawai->cabang == 'SAMPIT' ? 'selected' : '' }}>Sampit</option>
                            <option value="SEMARANG" {{ $pegawai->cabang == 'SEMARANG' ? 'selected' : '' }}>Semarang</option>
                            <option value="SURABAYA" {{ $pegawai->cabang == 'SURABAYA' ? 'selected' : '' }}>Surabaya</option>
                        </select>
                    </div>
                </div> -->

                <!-- Jabatan and Directorate -->
                <!-- <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan" value="{{ $pegawai->jabatan }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="directorate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Directorate</label>
                        <select id="directorate" name="directorate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            <option value="Branch Support and Improvement" {{ $pegawai->directorate == 'Branch Support and Improvement' ? 'selected' : '' }}>Branch Support and Improvement</option>
                            <option value="Corporate Procurement" {{ $pegawai->directorate == 'Corporate Procurement' ? 'selected' : '' }}>Corporate Procurement</option>
                            <option value="Finance and Administration" {{ $pegawai->directorate == 'Finance and Administration' ? 'selected' : '' }}>Finance and Administration</option>
                            <option value="Human Capital & Sustainability" {{ $pegawai->directorate == 'Human Capital & Sustainability' ? 'selected' : '' }}>Human Capital & Sustainability</option>
                            <option value="Marketing & Sales" {{ $pegawai->directorate == 'Marketing & Sales' ? 'selected' : '' }}>Marketing & Sales</option>
                            <option value="Material Handling Business" {{ $pegawai->directorate == 'Material Handling Business' ? 'selected' : '' }}>Material Handling Business</option>
                            <option value="Power, Agro and Construction Business" {{ $pegawai->directorate == 'Power, Agro and Construction Business' ? 'selected' : '' }}>Power, Agro and Construction Business</option>
                        </select>
                    </div>
                </div> -->

                <!-- Division and Department -->
                <!-- <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="division" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Division</label>
                        <select id="division" name="division" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            <option value="Branch Support and Improvement" {{ $pegawai->division == 'Branch Support and Improvement' ? 'selected' : '' }}>Branch Support and Improvement</option>
                            <option value="Corporate Procurement" {{ $pegawai->division == 'Corporate Procurement' ? 'selected' : '' }}>Corporate Procurement</option>
                            <option value="Finance, Accounting, Taxes and IT" {{ $pegawai->division == 'Finance, Accounting, Taxes and IT' ? 'selected' : '' }}>Finance, Accounting, Taxes and IT</option>
                            <option value="Human Capital, SSEHS and General Affair" {{ $pegawai->division == 'Human Capital, SSEHS and General Affair' ? 'selected' : '' }}>Human Capital, SSEHS and General Affair</option>
                            <option value="Marketing" {{ $pegawai->division == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                            <option value="Material Handling Sales and Marketing" {{ $pegawai->division == 'Material Handling Sales and Marketing' ? 'selected' : '' }}>Material Handling Sales and Marketing</option>
                            <option value="Product Support" {{ $pegawai->division == 'Product Support' ? 'selected' : '' }}>Product Support</option>
                            <option value="Rental Marketing and Business Controller" {{ $pegawai->division == 'Rental Marketing and Business Controller' ? 'selected' : '' }}>Rental Marketing and Business Controller</option>
                            <option value="Rental, FG Wilson and Genset Center" {{ $pegawai->division == 'Rental, FG Wilson and Genset Center' ? 'selected' : '' }}>Rental, FG Wilson and Genset Center</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                        <input type="text" id="department" name="department" value="{{ $pegawai->department }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                </div> -->

                <!-- Tanggal Masuk TN/SHN and Vendor -->
                <!-- <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="tanggal_masuk_tn_shn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Masuk TN/SHN</label>
                        <input type="date" id="tanggal_masuk_tn_shn" name="tanggal_masuk_tn_shn" value="{{ $pegawai->tanggal_masuk_tn_shn }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="tanggal_masuk_vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Masuk Vendor</label>
                        <input type="date" id="tanggal_masuk_vendor" name="tanggal_masuk_vendor" value="{{ $pegawai->tanggal_masuk_vendor }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                </div> -->

                <!-- Jenis Kontrak Kerjasama and Implementasi Kontrak -->
                <!-- <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="jenis_kontrak_kerjasama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kontrak Kerjasama</label>
                        <select id="jenis_kontrak_kerjasama" name="jenis_kontrak_kerjasama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            <option value="LABOUR SUPPLY" {{ $pegawai->jenis_kontrak_kerjasama == 'LABOUR SUPPLY' ? 'selected' : '' }}>LABOUR SUPPLY</option>
                            <option value="JOB SUPPLY" {{ $pegawai->jenis_kontrak_kerjasama == 'JOB SUPPLY' ? 'selected' : '' }}>JOB SUPPLY</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="implementasi_kontrak_kerjasama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Implementasi Kontrak</label>
                        <select id="implementasi_kontrak_kerjasama" name="implementasi_kontrak_kerjasama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            <option value="LABOUR SUPPLY" {{ $pegawai->implementasi_kontrak_kerjasama == 'LABOUR SUPPLY' ? 'selected' : '' }}>LABOUR SUPPLY</option>
                            <option value="JOB SUPPLY" {{ $pegawai->implementasi_kontrak_kerjasama == 'JOB SUPPLY' ? 'selected' : '' }}>JOB SUPPLY</option>
                        </select>
                    </div>
                </div> -->

                <!-- Lokasi Kerja and Project Site -->
                <!-- <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="lokasi_kerja" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi Kerja</label>
                        <input type="text" id="lokasi_kerja" name="lokasi_kerja" value="{{ $pegawai->lokasi_kerja }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="project_site" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project Site</label>
                        <input type="text" id="project_site" name="project_site" value="{{ $pegawai->project_site }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                </div> -->

                <!-- Jenis Kelamin and Agama -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            <option value="Male" {{ $pegawai->jenis_kelamin == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $pegawai->jenis_kelamin == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="agama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agama</label>
                        <select id="agama" name="agama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            <option value="Islam" {{ $pegawai->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ $pegawai->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ $pegawai->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        </select>
                    </div>
                </div>

                <!-- Pendidikan and Status -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="pendidikan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pendidikan</label>
                        <select id="pendidikan" name="pendidikan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            <option value="SMA" {{ $pegawai->pendidikan == 'SMA' ? 'selected' : '' }}>SMA</option>
                            <option value="SMK" {{ $pegawai->pendidikan == 'SMK' ? 'selected' : '' }}>SMK</option>
                            <option value="D3" {{ $pegawai->pendidikan == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="S1" {{ $pegawai->pendidikan == 'S1' ? 'selected' : '' }}>S1</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            <option value="TK" {{ $pegawai->status == 'TK' ? 'selected' : '' }}>TK</option>
                            <option value="K1" {{ $pegawai->status == 'K1' ? 'selected' : '' }}>K1</option>
                            <option value="K2" {{ $pegawai->status == 'K2' ? 'selected' : '' }}>K2</option>
                            <option value="K3" {{ $pegawai->status == 'K3' ? 'selected' : '' }}>K3</option>
                            <option value="K4" {{ $pegawai->status == 'K4' ? 'selected' : '' }}>K4</option>
                            <option value="K5" {{ $pegawai->status == 'K5' ? 'selected' : '' }}>K5</option>
                        </select>
                    </div>
                </div>

                <!-- Tanggal Lahir -->


                <!-- Email and No hp -->
                <div class="flex space-x-4 mb-4">
                    <!-- <div class="w-1/2">
                        <label for="alamat_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat Email</label>
                        <input type="email" id="alamat_email" name="alamat_email" value="{{ $pegawai->alamat_email }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div> -->
                    <div class="w-1/2">
                        <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ $pegawai->tanggal_lahir }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No HP</label>
                        <input type="text" id="no_hp" name="no_hp" value="{{ $pegawai->no_hp }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <!-- Astra/Non Astra -->
                <!-- <div class="mb-4">
                    <label for="astra_non_astra" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Astra/Non Astra</label>
                    <select id="astra_non_astra" name="astra_non_astra" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                        <option value="Astra" {{ $pegawai->astra_non_astra == 'Astra' ? 'selected' : '' }}>Astra</option>
                        <option value="Non Astra" {{ $pegawai->astra_non_astra == 'Non Astra' ? 'selected' : '' }}>Non Astra</option>
                    </select>
                </div> -->

                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-primary-800 rounded-lg px-5 py-2.5">
                    Update Pegawai
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
