<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori Appraisal</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Appraisal</h2>

            <form method="POST" action="{{ route('appraisal.storeappraisal') }}">
            @csrf
                <!-- Appraisal Period -->
                <div div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bulan Periode Appraisal</label>
                    <select type="text" id="monthperiod" name="monthperiod" required class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                    </select>
                    </div>
                    <div class="w-1/2">
                    <label for="yearperiod" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun Periode Appraisal</label>
                    <input type="text" id="yearperiod" value="{{ date('Y') }}" name="yearperiod" required class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
                    </div>
                </div>
            <!-- Appraisal Table -->
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Kategori Appraisal</h2>

            <div class="relative overflow-x-auto sm:rounded-lg" style="max-height: 621px; overflow-y: auto;">
                <table id="appraisalTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 sticky top-0">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Kategori</th>
                            <th class="px-6 py-3">Description</th>
                            <th class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appraisalcategorys as $appraisalcategory)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">{{ $appraisalcategory->id }}</td>
                            <td class="px-6 py-4">{{ $appraisalcategory->title }}</td>
                            <td class="px-6 py-4">{{ $appraisalcategory->description }}</td>
                            <td class="px-6 py-4">@if($appraisalcategory->isactive==1) Aktif @else Tidak Aktif @endif</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                
                <!-- Tombol Input -->
                <div class="mb-4">
                <input type="submit" value="Tambah" class="w-full text-white bg-blue-700 hover:bg-primary-800 rounded-lg px-5 py-2.5">
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>