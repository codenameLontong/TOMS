<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegawai - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg mt-14 bg-white dark:bg-gray-800 shadow-lg">
            <!-- First row of the grid -->
            <div class="grid grid-cols-3 gap-4 mb-4">
                <!-- Card for Jumlah Pegawai -->
                <div class="flex flex-col justify-between h-40 rounded-lg border border-gray-300 dark:border-gray-700 bg-white shadow-md dark:bg-gray-800">
                    <div class="border-b border-gray-300 dark:border-gray-600 p-2 bg-indigo-100 dark:bg-indigo-800 rounded-t-lg">
                        <h3 class="text-sm font-medium text-indigo-800 dark:text-indigo-200 text-center">Jumlah Pegawai</h3>
                    </div>
                    <div class="flex-grow flex items-center justify-center">
                        <p class="text-5xl font-bold text-indigo-900 dark:text-indigo-300">{{ $jumlahPegawai }}</p>
                    </div>
                </div>
                <!-- Card for Jumlah Vendor -->
                <div class="flex flex-col justify-between h-40 rounded-lg border border-gray-300 dark:border-gray-700 bg-white shadow-md dark:bg-gray-800">
                    <div class="border-b border-gray-300 dark:border-gray-600 p-2 bg-teal-100 dark:bg-teal-800 rounded-t-lg">
                        <h3 class="text-sm font-medium text-teal-800 dark:text-teal-200 text-center">Jumlah Vendor</h3>
                    </div>
                    <div class="flex-grow flex items-center justify-center">
                        <p class="text-5xl font-bold text-teal-900 dark:text-teal-300">{{ $jumlahVendor }}</p>
                    </div>
                </div>
                <!-- Card for Overtime -->
                <div class="flex flex-col justify-between h-40 rounded-lg border border-gray-300 dark:border-gray-700 bg-white shadow-md dark:bg-gray-800">
                    <div class="border-b border-gray-300 dark:border-gray-600 p-2 bg-gray-100 dark:bg-white-100 rounded-t-lg">
                        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-700 text-center">Overtime</h3>
                    </div>
                    <div class="flex-grow grid grid-cols-3 divide-x divide-gray-300 dark:divide-gray-600">
                        <!-- Plan Section -->
                        <div class="flex flex-col items-center justify-center bg-blue-50 dark:bg-blue-900">
                            <h4 class="text-xs font-medium text-blue-800 dark:text-blue-200">Plan</h4>
                            <p class="text-4xl font-bold text-blue-900 dark:text-blue-300">23</p>
                        </div>

                        <!-- Need Approve Section -->
                        <div class="flex flex-col items-center justify-center bg-yellow-50 dark:bg-yellow-900">
                            <h4 class="text-xs font-medium text-yellow-800 dark:text-yellow-200">Need Approve</h4>
                            <p class="text-4xl font-bold text-yellow-900 dark:text-yellow-300">90</p>
                        </div>

                        <!-- Approved Section -->
                        <div class="flex flex-col items-center justify-center bg-green-50 dark:bg-green-900">
                            <h4 class="text-xs font-medium text-green-800 dark:text-green-200">Approved</h4>
                            <p class="text-4xl font-bold text-green-900 dark:text-green-300">123</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Middle section with line chart -->
            <div class="p-4 mb-4 bg-white rounded-lg border border-gray-300 dark:border-gray-700 shadow-md dark:bg-gray-800">
                <div class="flex justify-between mb-2">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Jam Lembur Approve</h3>
                    <select id="yearSelector" class="border border-gray-300 rounded px-2 py-1 text-gray-700 dark:bg-gray-700 dark:text-white">
                        <option value="2023">2023</option>
                        <option value="2024" selected>2024</option>
                        <option value="2025">2025</option>
                    </select>
                </div>
                <div id="lineChart"></div>
            </div>

            <!-- Second middle section with pie chart -->
            <div class="p-4 bg-white rounded-lg border border-gray-300 dark:border-gray-700 shadow-md dark:bg-gray-800">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Appraisal Full Approve</h3>
                <div id="pieChart"></div>
            </div>
        </div>
    </div>

    <script>
        // Line chart data
        var chartData = {
            2023: [30, 45, 50, 60, 70, 80, 85, 90, 100, 110, 120, 130],
            2024: [50, 70, 80, 65, 90, 100, 120, 110, 95, 85, 105, 115],
            2025: [40, 60, 75, 80, 85, 95, 105, 115, 120, 130, 140, 150]
        };

        var optionsLine = {
            series: [{
                name: 'Jam Lembur',
                data: chartData[2024] // Default data for 2024
            }],
            chart: {
                type: 'line',
                height: 350
            },
            xaxis: {
                categories: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
            }
        };

        var lineChart = new ApexCharts(document.querySelector("#lineChart"), optionsLine);
        lineChart.render();

        // Event listener for the year selector
        document.getElementById('yearSelector').addEventListener('change', function() {
            var selectedYear = this.value;
            lineChart.updateSeries([{
                name: 'Jam Lembur',
                data: chartData[selectedYear] || []
            }]);
        });

        // Pie chart data
        var optionsPie = {
            series: [44, 33, 23], // dummy data
            chart: {
                type: 'pie',
                height: 350
            },
            labels: ['Approved', 'Pending', 'Rejected']
        };

        var pieChart = new ApexCharts(document.querySelector("#pieChart"), optionsPie);
        pieChart.render();

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
