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
                <div class="mb-4">
                    <label for="nrp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NRP</label>
                    <input type="text" id="nrp" name="nrp" value="{{ $pegawai->nrp }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>
                <div class="mb-4">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                    <input type="text" id="nama" name="nama" value="{{ $pegawai->nama }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Divisi Sekarang and Divisi Tujuan -->
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

                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2.5">
                    Mutasi
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
