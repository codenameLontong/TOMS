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

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Pegawai</h2>

            <form method="POST" action="{{ route('pegawai.update', $pegawai->id) }}">
                @csrf
                @method('PUT')

                <!-- NRP and NRP Vendor -->
                <div class="flex space-x-4 mb-4">
                <div class="w-1/2">
                        <label for="nrp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NRP TRAKNUS</label>
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

                <!-- Jenis Kelamin and Agama -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            <option value="PRIA" {{ $pegawai->jenis_kelamin == 'PRIA' ? 'selected' : '' }}>PRIA</option>
                            <option value="WANITA" {{ $pegawai->jenis_kelamin == 'WANITA' ? 'selected' : '' }}>WANITA</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="agama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agama</label>
                        <select id="agama" name="agama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            <option value="Islam" {{ $pegawai->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ $pegawai->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ $pegawai->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ $pegawai->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ $pegawai->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ $pegawai->agama == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                        </select>
                    </div>
                </div>

                <!-- Pendidikan and Status -->
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="pendidikan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pendidikan</label>
                        <select id="pendidikan" name="pendidikan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            <option value="SD" {{ $pegawai->pendidikan == 'SD' ? 'selected' : '' }}>SD</option>
                            <option value="SMP" {{ $pegawai->pendidikan == 'SMP/Sederajat' ? 'selected' : '' }}>SMP/Sederajat</option>
                            <option value="SMA" {{ $pegawai->pendidikan == 'SMA/Sederajat' ? 'selected' : '' }}>SMA/Sederajat</option>
                            <option value="D1" {{ $pegawai->pendidikan == 'D1' ? 'selected' : '' }}>D1</option>
                            <option value="D2" {{ $pegawai->pendidikan == 'D2' ? 'selected' : '' }}>D2</option>
                            <option value="D3" {{ $pegawai->pendidikan == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="S1" {{ $pegawai->pendidikan == 'S1' ? 'selected' : '' }}>S1</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                            <option value="TK" {{ $pegawai->status == 'TK' ? 'selected' : '' }}>TK</option>
                            <option value="K0" {{ $pegawai->status == 'K0' ? 'selected' : '' }}>K0</option>
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

                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2.5">
                    Update
                </button>
            </form>
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
