<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appraisal - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg mt-14 bg-white dark:bg-gray-800 shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Penilaian Pegawai</h2>

            <!-- Search Bar and Add Button -->
            <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 pb-4">
                <div class="flex items-center space-x-2">

                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" id="table-search" onkeyup="searchTable()" placeholder="Cari berdasarkan kata kunci" class="block p-2 pl-10 w-80 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    @role('superadmin')
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
                                    <a href="{{ route('appraisal.export.xlsx') }}" id="export-xlsx" class="block py-2 px-4 w-full text-left text-sm font-medium text-gray-900 rounded-lg border border-gray-200 hover:bg-green-300 bg-green-200">
                                        Export XLSX
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endrole
                </div>
                <div class="flex space-x-3" @if($role == 7) style="display:none;" @else "" @endif>
                    <a href="{{ route('appraisal.create') }}" class="flex items-center px-3 py-2 text-white bg-green-700 hover:bg-green-800 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Tambah Appraisal
                    </a>
                </div>
            </div>

            <!-- Appraisal Table-->
            <div class="relative overflow-x-auto sm:rounded-lg" style="max-height: 621px; overflow-y: auto;">
                <table id="appraisalTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 sticky top-0">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Periode Penilaian</th>
                            <th class="px-6 py-3">Tanggal Pembuatan</th>
                            <th class="px-6 py-3">Status</th>
                            @if($role == 7)
                            <th class="px-6 py-3">Waktu Isi Pegawai</th>
                            <th class="px-6 py-3">Waktu Isi Superior</th>
                            <th class="px-6 py-3">Rata-Rata</th>
                            <th class="px-6 py-3">Nilai Akhir</th>
                            <th class="px-6 py-3">Status Pengajuan</th>
                            <th class="px-6 py-3">Actions</th>
                        @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appraisals as $appraisal)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">{{ $appraisal->id }}</td>
                            <td class="px-6 py-4">{{ $appraisal->appraisal_period }}</td>
                            <td class="px-6 py-4">{{ $appraisal->created_at }}</td>
                            <td class="px-6 py-4">@if($appraisal->appraisal_status == 1) Aktif @else Tidak Aktif @endif</td>
                            @if($role == 7)
                            <td class="px-6 py-4">{{ $appraisal->pegawai_fill_at }}</td>
                            <td class="px-6 py-4">{{ $appraisal->superior_approved_at }}</td>
                            <td class="px-6 py-4">{{ $appraisal->rata_rata }}</td>
                            <td class="px-6 py-4">{{ $appraisal->nilai_final }}</td>

                            @if($appraisal->pegawai_fill_at == 0)
                            <!-- When pegawai_fill_at is 0, show the pencil icon for editing -->
                            <td class="px-6 py-4">Open</td>
                            <td class="px-6 py-4 flex justify-center">
                                <a href="{{ route('appraisal.createappraisalemployee', $appraisal->id) }}" class="text-blue-600 hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                            </td>
                            @else
                            <!-- When pegawai_fill_at is not 0, show the eye icon for viewing -->
                            <td class="px-6 py-4">{{ $appraisal->appraisal_status_name }}</td>
                            <td class="px-6 py-4 flex justify-center">
                                <a href="{{ route('appraisal.updateappraisalemployee', $appraisal->id) }}" class="text-blue-600 hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                            </td>
                            @endif
                            @endif
                        </tr>
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
            const table = document.getElementById('appraisalTable');
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

        // Automatically hide the toast after 4 seconds
        setTimeout(() => {
            const toast = document.getElementById('toast-success');
            if (toast) {
                toast.classList.add('hidden');
            }
        }, 4000);

        document.addEventListener('DOMContentLoaded', function() {
            // Pagination variables
            const rows = document.querySelectorAll('#appraisalTable tbody tr'); // Select all rows from the table
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
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
