<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Appraisal</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 max-w-3xl mx-auto">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">View Appraisal</h2>

            <form method="POST" action="{{ route('appraisal.viewappraisalemployee', $appraisal->id) }}">
                @csrf
                @method('PUT')

                <!-- Hidden Appraisal ID -->
                <input type="hidden" id="id_appraisal" value="{{ $appraisal->id }}" name="id_appraisal">

                <!-- Appraisal Period (Readonly) -->
                <div class="w-full">
                    <label for="appraisal_period" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Periode Appraisal</label>
                    <input
                        type="text"
                        id="appraisal_period"
                        value="{{ $appraisal->appraisal_period }}"
                        name="appraisal_period"
                        readonly
                        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                </div>
                <br>

                <!-- Appraisal Table -->
                <label for="appraisalTable" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori Appraisal</label>
                <div class="relative overflow-x-auto sm:rounded-lg" style="max-height: 621px; overflow-y: auto;">
                    <table id="appraisalTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 sticky top-0">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Kategori</th>
                                <th class="px-6 py-3">Deskripsi</th>
                                <th class="px-6 py-3">Nilai</th>
                                <th class="px-6 py-3">Nilai Atasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appraisal_item as $appraisal_items)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">{{ $appraisal_items->id }}</td>
                                    <td class="px-6 py-4"><b>{{ $appraisal_items->title }}</b></td>
                                    <td class="px-6 py-4">{{ $appraisal_items->description }}</td>
                                    <td class="px-6 py-4">
                                        <input disabled
                                            type="number"
                                            value="{{ $appraisal_items->pegawai_score }}"
                                            id="score_{{ $appraisal_items->id }}"
                                            name="scores[{{ $appraisal_items->pegawai_score }}]"
                                            class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                    </td>
                                    <td class="px-6 py-4">
                                        <input disabled
                                            type="number"
                                            value="{{ $appraisal_items->final_score_bysuperior }}"
                                            id="score_{{ $appraisal_items->id }}"
                                            name="scores[{{ $appraisal_items->pegawai_score }}]"
                                            class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Submit Button
                <div class="mt-4 text-center">
                    <button
                        type="submit"
                        class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800"
                    >
                        Update
                    </button> -->
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
