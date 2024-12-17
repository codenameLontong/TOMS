<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 bg-white mt-14 max-w-3xl mx-auto shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Informasi Pegawai</h2>

            <!-- <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
                <div class="p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg mt-14 bg-white dark:bg-gray-800 shadow-lg">
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Daftar Pegawai</h2> -->

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
                    <input type="text" id="nama" name="nama" value="{{ $pegawai->nama }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Vendor -->
                <div class="mb-4">
                    <label for="vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vendor</label>
                    <input type="text" id="vendor" name="vendor" value="{{ $pegawai->vendor }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Coy and Directorate -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="coy" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">COY</label>
                        <input type="text" id="coy" name="coy" value="{{ $pegawai->coy }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="directorate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Directorate</label>
                        <input type="text" id="directorate" name="directorate" value="{{ $pegawai->directorate }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <!-- Division and Department -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="division" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Division</label>
                        <input type="text" id="division" name="division" value="{{ $pegawai->division }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                        <input type="text" id="department" name="department" value="{{ $pegawai->department }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="section" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section</label>
                    <input type="text" id="section" name="section" value="{{ $pegawai->section }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Cabang and Jabatan -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="cabang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cabang</label>
                        <input type="text" id="cabang" name="cabang" value="{{ $pegawai->cabang }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan" value="{{ $pegawai->jabatan }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <!-- Project Site and Lokasi Kerja -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="project_site" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project/Site</label>
                        <input type="text" id="project_site" name="project_site" value="{{ $pegawai->project_site }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="lokasi_kerja" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi Kerja</label>
                        <input type="text" id="lokasi_kerja" name="lokasi_kerja" value="{{ $pegawai->lokasi_kerja }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <!-- Tanggal Masuk TN-SHN and Tanggal Masuk Vendor -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="tanggal_masuk_tn_shn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Masuk TN-SHN</label>
                        <input type="text" id="tanggal_masuk_tn_shn" name="tanggal_masuk_tn_shn" value="{{ $pegawai->tanggal_masuk_tn_shn }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="masa_kerja_tn_shn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masa Kerja TN-SHN</label>
                        <input type="text" id="masa_kerja_tn_shn" name="masa_kerja_tn_shn" value="{{ $pegawai->masa_kerja_tn_shn }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <!-- Masa Kerja TN-SHN and Masa Kerja Vendor -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="tanggal_masuk_vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Masuk Vendor</label>
                        <input type="text" id="tanggal_masuk_vendor" name="tanggal_masuk_vendor" value="{{ $pegawai->tanggal_masuk_vendor }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="masa_kerja_vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masa Kerja Vendor</label>
                        <input type="text" id="masa_kerja_vendor" name="masa_kerja_vendor" value="{{ $pegawai->masa_kerja_vendor }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <!-- Jenis Kontrak Kerjasama and Implementasi Kontrak -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="jenis_kontrak" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kontrak Kerjasama</label>
                        <input type="text" id="jenis_kontrak" name="jenis_kontrak" value="{{ $pegawai->jenis_kontrak_kerjasama }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="implementasi_kontrak_kerjasama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Implementasi Kontrak Kerjasama</label>
                        <input type="text" id="implementasi_kontrak_kerjasama" name="implementasi_kontrak_kerjasama" value="{{ $pegawai->implementasi_kontrak_kerjasama }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <!-- Jenis Kelamin and Agama -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
                        <input type="text" id="jenis_kelamin" name="jenis_kelamin" value="{{ $pegawai->jenis_kelamin }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="agama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agama</label>
                        <input type="text" id="agama" name="agama" value="{{ $pegawai->agama }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <!-- Pendidikan and Status -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="pendidikan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pendidikan</label>
                        <input type="text" id="pendidikan" name="pendidikan" value="{{ $pegawai->pendidikan }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <input type="text" id="status" name="status" value="{{ $pegawai->status }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <!-- Tanggal Lahir and Umur -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Lahir</label>
                        <input type="text" id="tanggal_lahir" name="tanggal_lahir" value="{{ $pegawai->tanggal_lahir }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="umur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Umur</label>
                        <input type="text" id="umur" name="umur" value="{{ $pegawai->umur }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <!-- Alamat Email and No HP -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="alamat_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat Email</label>
                        <input type="email" id="alamat_email" name="alamat_email" value="{{ $pegawai->alamat_email }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="w-1/2">
                        <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No HP</label>
                        <input type="text" id="no_hp" name="no_hp" value="{{ $pegawai->no_hp }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- History Section -->
    <!-- <div class="p-4 mt-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 max-w-3xl mx-auto"> -->
    <div class="p-2 sm:ml-64 bg-gray-100 dark:bg-gray-900">
        <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto">
            <h3 class="mb-4 text-lg font-bold text-gray-900 dark:text-white">History</h3>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Action</th>
                        <th class="px-6 py-3">Description</th>
                        <th class="px-6 py-3">Performed By</th> <!-- New column for user -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($pegawai->histories as $history)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ optional($history->action_date)->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-4">{{ $history->action_type }}</td>
                            <td class="px-6 py-4">{{ $history->description }}</td>
                            <td class="px-6 py-4">{{ $history->user->name ?? 'Unknown' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
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
