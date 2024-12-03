<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegawai - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg mt-14 bg-white dark:bg-gray-800 shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Daftar Pegawai</h2>
            <!-- Search Bar and Actions -->
            <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 pb-4">
                <div class="flex items-center space-x-2">
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" id="table-search" onkeyup="searchTable()" placeholder="Search for items" class="block p-2 pl-10 w-80 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                     <!-- Filter Button to Switch Between Active and Terminated -->
                    <div class="flex space-x-2">
                        <div id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="flex items-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                            </svg>
                            Aktif / Non
                        </div>

                        <div id="filterDropdown" class="hidden z-10 w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center">
                                    <a href="{{ route('pegawai.index', ['status' => 'active']) }}" class="block py-2 px-4 w-full text-left text-sm font-medium text-gray-900 rounded-lg border border-gray-200 hover:bg-green-300 bg-green-200 {{ $status === 'active' ? 'bg-blue-400' : '' }}">
                                        Aktif
                                    </a>
                                </li>
                                <li class="flex items-center">
                                    <a href="{{ route('pegawai.index', ['status' => 'terminated']) }}" class="block py-2 px-4 w-full text-left text-sm font-medium text-gray-900 rounded-lg border border-gray-200 hover:bg-red-300 bg-red-200 {{ $status === 'terminated' ? 'bg-red-400' : '' }}">
                                        Non-aktif
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Filter Button -->
                    <div id="filterButton" class="flex items-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                        Filter
                    </div>

                    <!-- Filter Modal -->
                    <div id="filterModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
                        <div class="bg-white p-6 rounded shadow-lg w-1/3 relative">
                            <!-- Close Button -->
                            <button type="button" onclick="closeFilterModal()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <h2 class="text-lg font-semibold mb-4 text-gray-900">Filter by Department</h2>
                            <form action="{{ route('pegawai.index') }}" method="GET">
                                <div class="space-y-2 max-h-60 overflow-y-auto">
                                    @foreach ($departments as $department)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="departments[]" value="{{ $department }}" id="department-{{ $loop->index }}" class="mr-2">
                                        <label for="department-{{ $loop->index }}" class="text-sm text-gray-700">{{ $department }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="mt-4 flex justify-end space-x-2">
                                    <button type="button" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400" onclick="closeFilterModal()">Cancel</button>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="flex space-x-2">
                        <div id="exportDropdownButton" data-dropdown-toggle="exportDropdown" class="flex items-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 cursor-pointer">
                            Export
                            <svg class="w-4 h-4 ms-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                        </div>

                        <div id="exportDropdown" class="hidden z-10 w-52 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center">
                                    <a href="{{ route('pegawai.export.xlsx') }}" id="export-xlsx" class="block py-2 px-4 w-full text-left text-sm font-medium text-gray-900 rounded-lg border border-gray-200 hover:bg-green-300 bg-green-200">
                                        Export XLSX
                                    </a>
                                </li>
                                <li class="flex items-center">
                                    <a href="{{ route('pegawai.export.pdf') }}" id="export-pdf" class="block py-2 px-4 w-full text-left text-sm font-medium text-gray-900 rounded-lg border border-gray-200 hover:bg-red-300 bg-red-200">
                                        Export PDF
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="flex space-x-3 mb-4">
                    <a href="{{ route('pegawai.create') }}" class="flex items-center px-3 py-2 text-white bg-blue-700 hover:bg-blue-800 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Tambah Pegawai
                    </a>

                    <a href="{{ route('pegawai.showimport') }}" class="flex items-center px-3 py-2 text-white bg-green-700 hover:bg-green-800 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                        </svg>
                        Import Pegawai
                    </a>
                </div>

            </div>

            <!-- Pegawai Table -->
            <div class="relative overflow-x-auto sm:rounded-lg" style="max-height: 621px; overflow-y: auto;">
                <table id="pegawaiTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 sticky top-0">
                        <tr>
                            <th class="px-6 py-3 sticky top-0">NRP</th>
                            <th class="px-6 py-3 sticky top-0 cursor-pointer" onclick="sortTable(1)">Nama
                                <span id="sortIconNama" class="inline-block"></span>
                            </th>
                            <th class="px-6 py-3 sticky top-0 cursor-pointer" onclick="sortTable(2)">COY
                                <span id="sortIconCOY" class="inline-block"></span>
                            </th>
                            <th class="px-6 py-3 sticky top-0 cursor-pointer" onclick="sortTable(3)">Cabang
                                <span id="sortIconCabang" class="inline-block"></span>
                            </th>
                            <th class="px-6 py-3 sticky top-0 cursor-pointer" onclick="sortTable(4)">Jabatan
                                <span id="sortIconJabatan" class="inline-block"></span>
                            </th>
                            <th class="px-6 py-3 sticky top-0 cursor-pointer" onclick="sortTable(5)">Department
                                <span id="sortIconDepartment" class="inline-block"></span>
                            </th>
                            <th class="px-6 py-3 sticky top-0">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pegawais as $pegawai)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">{{ $pegawai->nrp }}</td>
                            <td class="px-6 py-4">{{ $pegawai->nama }}</td>
                            <td class="px-6 py-4">{{ $pegawai->coy }}</td>
                            <td class="px-6 py-4">{{ $pegawai->cabang }}</td>
                            <td class="px-6 py-4">{{ $pegawai->jabatan }}</td>
                            <td class="px-6 py-4">{{ $pegawai->department }}</td>
                            <td class="flex px-6 py-4">
                                <a href="{{ route('pegawai.view', $pegawai->id) }}" class="text-blue-600 hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                                @if($status === 'active')
                                    <a href="{{ route('pegawai.showupdate', $pegawai->id) }}" class="text-blue-600 hover:text-blue-800 ml-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('pegawai.mutasi', $pegawai->id) }}" class="text-red-600 hover:text-red-800 ml-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                        </svg>
                                    </a>
                                    <button data-modal-target="terminateModal-{{ $pegawai->id }}" data-modal-toggle="terminateModal-{{ $pegawai->id }}" class="text-red-600 hover:text-red-800 ml-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </button>
                                @endif
                            </td>
                        </tr>

                        <!-- Modal for this specific Pegawai -->
                        <div id="terminateModal-{{ $pegawai->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="terminateModal-{{ $pegawai->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin akan menonaktifkan pegawai ini?</h3>
                                        <form method="POST" action="{{ route('pegawai.terminate', $pegawai->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <button data-modal-hide="terminateModal-{{ $pegawai->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Ya
                                            </button>
                                            <button data-modal-hide="terminateModal-{{ $pegawai->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                Tidak
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav id="pagination" class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Pagination">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Showing
                    <span id="current-range"class="font-semibold text-gray-900 dark:text-white">1-10</span>
                    of
                    <span id="total-records" class="font-semibold text-gray-900 dark:text-white">100</span>
                </span>
                <ul class="inline-flex items-stretch -space-x-px" id="pagination-list">
                    <li>
                        <a href="#" id="prev-page" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
                            <span class="sr-only">Previous</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" />
                            </svg>
                        </a>
                    </li>
                    <li id="pagination-buttons" class="flex space"></li>
                    <li>
                        <a href="#" id="next-page" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
                            <span class="sr-only">Next</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7.293 5.293a1 1 0 011.414 0L12.586 10l-3.879 3.707a1 1 0 01-1.414-1.414L10.586 10l-3.293-3.293a1 1 0 010-1.414z" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>

    @if(session('success'))
    <div id="toast-success" class="fixed top-4 right-4 z-50 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ml-3 text-sm font-normal">{{ session('success') }}</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
    @endif

    <script>
        function searchTable() {
            const input = document.getElementById('table-search');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('pegawaiTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let isVisible = false;

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j] && cells[j].innerText.toLowerCase().includes(filter)) {
                        isVisible = true;
                        break;
                    }
                }

                rows[i].style.display = isVisible ? '' : 'none';
            }
        }

        document.querySelectorAll('[data-dismiss-target]').forEach((button) => {
        button.addEventListener('click', function () {
            const target = document.querySelector(this.getAttribute('data-dismiss-target'));
            if (target) {
                target.classList.add('hidden');
            }
            });
        });

        document.getElementById('filterDropdownButton').addEventListener('click', function() {
            const dropdown = document.getElementById('filterDropdown');
            dropdown.classList.toggle('hidden');
        });

    // Automatically hide the toast after 3 seconds (3000 milliseconds)
        setTimeout(() => {
            const toast = document.getElementById('toast-success');
            if (toast) {
                toast.classList.add('hidden');
            }
        }, 4000);

        let currentSortOrder = {};  // Track the current sort state for each column
        const iconNama = document.getElementById('sortIconNama');
        const iconCOY = document.getElementById('sortIconCOY');
        const iconCabang = document.getElementById('sortIconCabang');
        const iconJabatan = document.getElementById('sortIconJabatan');
        const iconDepartment = document.getElementById('sortIconDepartment');

        function resetIcons() {
            iconNama.textContent = '';
            iconCOY.textContent = '';
            iconCabang.textContent = '';
            iconJabatan.textContent = '';
            iconDepartment.textContent = '';
        }

        function sortTable(columnIndex) {
            const table = document.getElementById("pegawaiTable");
            const rows = Array.from(table.rows).slice(1); // Exclude the header row

            let isAscending = currentSortOrder[columnIndex] !== 'asc';
            currentSortOrder = {};  // Reset the sort state for all columns
            currentSortOrder[columnIndex] = isAscending ? 'asc' : 'desc';

            // Sorting logic
            rows.sort((a, b) => {
                const cellA = a.cells[columnIndex].textContent.trim().toLowerCase();
                const cellB = b.cells[columnIndex].textContent.trim().toLowerCase();

                if (cellA < cellB) return isAscending ? -1 : 1;
                if (cellA > cellB) return isAscending ? 1 : -1;
                return 0;
            });

            // Update the table by appending sorted rows
            rows.forEach(row => table.tBodies[0].appendChild(row));

            // Reset icons for all columns
            resetIcons();

            // Update the icons for sorting based on the column sorted
            if (columnIndex === 1) {
                iconNama.textContent = isAscending ? '▲' : '▼';
            } else if (columnIndex === 2) {
                iconCOY.textContent = isAscending ? '▲' : '▼';
            } else if (columnIndex === 3) {
                iconCabang.textContent = isAscending ? '▲' : '▼';
            } else if (columnIndex === 4) {
                iconJabatan.textContent = isAscending ? '▲' : '▼';
            } else if (columnIndex === 5) {
                iconDepartment.textContent = isAscending ? '▲' : '▼';
            }
        }

        // document.addEventListener('DOMContentLoaded', function () {
        //     // Dropdown toggle for export options
        //     document.getElementById('exportDropdownButton').addEventListener('click', function () {
        //         const dropdown = document.getElementById('exportDropdown');
        //         dropdown.classList.toggle('hidden');
        //     });

        //     // Export XLSX functionality (excluding "Actions" column)
        //     document.getElementById('export-xlsx').addEventListener('click', function () {
        //         const table = document.getElementById('pegawaiTable');
        //         // Create a new table array excluding the last column (Actions column)
        //         const data = [];
        //         const rows = table.querySelectorAll('tr');

        //         rows.forEach(row => {
        //             const rowData = [];
        //             row.querySelectorAll('td, th').forEach((cell, index) => {
        //                 if (index !== row.cells.length - 1) { // Exclude last column (Actions)
        //                     rowData.push(cell.innerText);
        //                 }
        //             });
        //             data.push(rowData);
        //         });

        //         // Create the workbook and worksheet
        //         const wb = XLSX.utils.book_new();
        //         const ws = XLSX.utils.aoa_to_sheet(data);
        //         XLSX.utils.book_append_sheet(wb, ws, 'Pegawai Data');

        //         // Export the XLSX file
        //         XLSX.writeFile(wb, 'Pegawai_Export.xlsx');
        //     });

        //     document.getElementById('export-pdf').addEventListener('click', function () {
        //         const { jsPDF } = window.jspdf;
        //         const doc = new jsPDF();

        //         // Get the table element
        //         const table = document.getElementById('pegawaiTable');

        //         // Define the columns to be included (all except the last one, assuming "Actions" is the last column)
        //         const columnsToInclude = Array.from(table.querySelectorAll('thead th')).map((th, index) => {
        //             if (index !== 6) { // Exclude the "Actions" column (index 6)
        //                 return th.innerText;
        //             }
        //         }).filter(Boolean);

        //         // Extract table data and exclude the "Actions" column from each row
        //         const rows = Array.from(table.querySelectorAll('tbody tr')).map(row => {
        //             return Array.from(row.querySelectorAll('td')).map((td, index) => {
        //                 if (index !== 6) { // Exclude the "Actions" column (index 6)
        //                     return td.innerText;
        //                 }
        //             }).filter(Boolean);
        //         });

        //         // Generate the PDF with autoTable
        //         doc.autoTable({
        //             head: [columnsToInclude],
        //             body: rows,
        //             theme: 'grid',
        //             styles: { fontSize: 10 },
        //             margin: { top: 10 },
        //         });

        //         doc.save('Pegawai_Export.pdf');
        //     });
        // });

        document.addEventListener('DOMContentLoaded', function() {
            // Pagination variables
            const rows = document.querySelectorAll('#pegawaiTable tbody tr'); // Select all rows from the table
            const recordsPerPage = 15; // Number of records per page
            let currentPage = 1; // Start on the first page

            // Pagination elements
            const paginationList = document.getElementById('pagination-list');
            const paginationButtons = document.getElementById('pagination-buttons');
            const prevPageButton = document.getElementById('prev-page');
            const nextPageButton = document.getElementById('next-page');
            const currentRange = document.getElementById('current-range');
            const totalRecordsElement = document.getElementById('total-records');

            const totalRecords = rows.length; // Total number of rows in the table
            const totalPages = Math.ceil(totalRecords / recordsPerPage); // Calculate total pages

            // Update total records count in the UI
            totalRecordsElement.textContent = totalRecords;

            // Function to show the correct rows based on the current page
            function showPage(page) {
                const startRecord = (page - 1) * recordsPerPage;
                const endRecord = Math.min(startRecord + recordsPerPage, totalRecords);

                rows.forEach((row, index) => {
                    if (index >= startRecord && index < endRecord) {
                        row.style.display = ''; // Show the row
                    } else {
                        row.style.display = 'none'; // Hide the row
                    }
                });

                // Update the current page range text
                currentRange.textContent = `${startRecord + 1}-${endRecord}`;

                // Disable/Enable prev/next buttons as necessary
                prevPageButton.classList.toggle('pointer-events-none', currentPage === 1);
                nextPageButton.classList.toggle('pointer-events-none', currentPage === totalPages);

                // Render pagination buttons
                renderPaginationButtons();
            }

            // Function to render pagination buttons
            function renderPaginationButtons() {
                paginationButtons.innerHTML = ''; // Clear existing buttons

                for (let i = 1; i <= totalPages; i++) {
                    const pageButton = document.createElement('a');
                    pageButton.href = '#';
                    pageButton.className = `flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 ${i === currentPage ? 'bg-gray-200' : ''}`;
                    pageButton.textContent = i;

                    pageButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        currentPage = i;
                        showPage(currentPage);
                    });

                    paginationButtons.appendChild(pageButton);
                }
            }

            // Handle previous page button click
            prevPageButton.addEventListener('click', function(e) {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    showPage(currentPage);
                }
            });

            // Handle next page button click
            nextPageButton.addEventListener('click', function(e) {
                e.preventDefault();
                if (currentPage < totalPages) {
                    currentPage++;
                    showPage(currentPage);
                }
            });

            // Initial page setup
            showPage(currentPage);
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

        // Open the modal
        function openFilterModal() {
            const modal = document.getElementById('filterModal');
            modal.classList.remove('hidden');
        }

        // Close the modal
        function closeFilterModal() {
            const modal = document.getElementById('filterModal');
            modal.classList.add('hidden');
        }

        // Attach the event listener to the filter button
        document.getElementById('filterButton').addEventListener('click', openFilterModal);



    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
</body>
</html>
