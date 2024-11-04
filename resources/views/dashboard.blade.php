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
                <div class="flex flex-col justify-between h-40 rounded border border-gray-300 dark:border-gray-700 bg-white shadow-md dark:bg-gray-800">
                    <div class="border-b border-gray-300 dark:border-gray-600 p-2">
                        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-200 text-center">Jumlah Pegawai</h3>
                    </div>
                    <div class="flex-grow flex items-center justify-center">
                        <p class="text-5xl font-bold text-gray-800 dark:text-white">1,234</p>
                    </div>
                </div>
                <!-- Card for Jumlah Vendor -->
                <div class="flex flex-col justify-between h-40 rounded border border-gray-300 dark:border-gray-700 bg-white shadow-md dark:bg-gray-800">
                    <div class="border-b border-gray-300 dark:border-gray-600 p-2 " >
                        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-200 text-center">Jumlah Vendor</h3>
                    </div>
                    <div class="flex-grow flex items-center justify-center">
                        <p class="text-5xl font-bold text-gray-800 dark:text-white">1,234</p>
                    </div>
                </div>
                <!-- Card for Overtime -->
                <div class="flex flex-col justify-between h-40 rounded border border-gray-300 dark:border-gray-700 bg-white shadow-md dark:bg-gray-800">
                    <div class="border-b border-gray-300 dark:border-gray-600 p-2">
                        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-200 text-center">Overtime</h3>
                    </div>
                    <div class="flex-grow grid grid-cols-3 divide-x divide-gray-300 dark:divide-gray-600">
                        <div class="flex flex-col items-center justify-center">
                            <h4 class="text-xs font-medium text-gray-700 dark:text-gray-200">Plan</h4>
                            <p class="text-4xl font-bold text-gray-800 dark:text-white">23</p>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <h4 class="text-xs font-medium text-gray-700 dark:text-gray-200">Need Approve</h4>
                            <p class="text-4xl font-bold text-gray-800 dark:text-white">90</p>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <h4 class="text-xs font-medium text-gray-700 dark:text-gray-200">Approved</h4>
                            <p class="text-4xl font-bold text-gray-800 dark:text-white">123</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Middle section with line chart -->
            <div class="p-4 mb-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Total Jam Lembur Approve</h3>
                <div id="lineChart"></div>
            </div>

            <!-- Second middle section with pie chart -->
            <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Appraisal Full Approve</h3>
                <div id="pieChart"></div>
            </div>
        </div>
    </div>

    <script>
        // Line chart data
        var optionsLine = {
            series: [{
                name: 'Jam Lembur',
                data: [50, 70, 80, 65, 90, 100, 120, 110, 95, 85, 105, 115] // dummy data
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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
