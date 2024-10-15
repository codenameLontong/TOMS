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

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 max-w-2xl mx-auto">
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

                <!-- COY Sekarang and COY Tujuan -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="coy_sekarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">COY Sekarang</label>
                        <input type="text" id="coy_sekarang" name="coy_sekarang" value="{{ $pegawai->coy }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="coy_tujuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">COY Tujuan</label>
                        <select id="coy_tujuan" name="coy" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="TN" {{ $pegawai->coy == 'TN' ? 'selected' : '' }}>TN</option>
                            <option value="SHN" {{ $pegawai->coy == 'SHN' ? 'selected' : '' }}>SHN</option>
                        </select>
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
                            <option value="BANDAR LAMPUNG">Bandar Lampung</option>
                            <option value="BANDUNG">Bandung</option>
                            <option value="BANJARMASIN">Banjarmasin</option>
                            <option value="JAKARTA">Jakarta</option>
                            <option value="JAMBI">Jambi</option>
                            <option value="JAYAPURA">Jayapura</option>
                            <option value="MAKASSAR">Makassar</option>
                            <option value="MEDAN">Medan</option>
                            <option value="PALEMBANG">Palembang</option>
                            <option value="PADANG">Padang</option>
                            <option value="PEKANBARU">Pekanbaru</option>
                            <option value="PONTIANAK">Pontianak</option>
                            <option value="SAMARINDA">Samarinda</option>
                            <option value="SAMPIT">Sampit</option>
                            <option value="SEMARANG">Semarang</option>
                            <option value="SURABAYA">Surabaya</option>
                        </select>
                    </div>
                </div>

                <!-- Department Sekarang and Department Tujuan -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="department_sekarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department Sekarang</label>
                        <input type="text" id="department_sekarang" name="department_sekarang" value="{{ $pegawai->department }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="department_tujuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department Tujuan</label>
                        <input type="text" id="department_tujuan" name="department" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <!-- Jabatan Sekarang and Jabatan Tujuan -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="jabatan_sekarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan Sekarang</label>
                        <input type="text" id="jabatan_sekarang" name="jabatan_sekarang" value="{{ $pegawai->jabatan }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="jabatan_tujuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan Tujuan</label>
                        <input type="text" id="jabatan_tujuan" name="jabatan" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <!-- Directorate Sekarang and Directorate Tujuan -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="directorate_sekarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Directorate Sekarang</label>
                        <input type="text" id="directorate_sekarang" name="directorate_sekarang" value="{{ $pegawai->directorate }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="directorate_tujuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Directorate Tujuan</label>
                        <select id="directorate_tujuan" name="directorate" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="Branch Support and Improvement">Branch Support and Improvement</option>
                            <option value="Corporate Procurement">Corporate Procurement</option>
                            <option value="Finance and Administration">Finance and Administration</option>
                            <option value="Human Capital & Sustainability">Human Capital & Sustainability</option>
                            <option value="Marketing & Sales">Marketing & Sales</option>
                            <option value="Material Handling Business">Material Handling Business</option>
                            <option value="Power, Agro and Construction Business">Power, Agro and Construction Business</option>
                        </select>
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
                        <select id="divisi_tujuan" name="division" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
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
                </div>

                <!-- Project Site Sekarang and Project Site Tujuan -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="project_site_sekarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project Site Sekarang</label>
                        <input type="text" id="project_site_sekarang" name="project_site_sekarang" value="{{ $pegawai->project_site }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="project_site_tujuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project Site Tujuan</label>
                        <input type="text" id="project_site_tujuan" name="project_site" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
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
                        <input type="text" id="lokasi_kerja_tujuan" name="lokasi_kerja" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2.5">
                    Mutasi
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
