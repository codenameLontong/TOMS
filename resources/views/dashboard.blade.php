<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegawai - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @if(auth()->check() && auth()->user()->hasRole('pegawai'))
    <script>
        window.location.href = '{{ route('overtime.index') }}'; // Redirect to the overtime page
    </script>
    @endif
    @if(auth()->check() && auth()->user()->hasRole('direct_superior'))
    <script>
        window.location.href = '{{ route('overtime.index') }}'; // Redirect to the overtime page
    </script>
    @endif
    @if(auth()->check() && auth()->user()->hasRole('superior'))
    <script>
        window.location.href = '{{ route('overtime.index') }}'; // Redirect to the overtime page
    </script>
    @endif
    @if(auth()->check() && auth()->user()->hasRole('hcs_dept_head'))
    <script>
        window.location.href = '{{ route('overtime.index') }}'; // Redirect to the overtime page
    </script>
    @endif
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg mt-14 bg-white dark:bg-gray-800 shadow-lg">
            <!-- First row of the grid -->
            <div class="grid grid-cols-3 gap-4 mb-4">
                <!-- Card for Jumlah Pegawai -->
                <a href="{{ route('pegawai.index') }}" class="flex flex-col justify-between h-40 rounded-lg border border-gray-300 dark:border-gray-700 bg-white shadow-md dark:bg-gray-800 hover:shadow-lg transition-shadow">
                    <div class="border-b border-gray-300 dark:border-gray-600 p-2 bg-indigo-100 dark:bg-indigo-800 rounded-t-lg">
                        <h3 class="text-sm font-medium text-indigo-800 dark:text-indigo-200 text-center">Jumlah Pegawai</h3>
                    </div>
                    <div class="flex-grow flex items-center justify-center">
                        <p class="text-5xl font-bold text-indigo-900 dark:text-indigo-300">{{ $jumlahPegawai }}</p>
                    </div>
                </a>

                <!-- Card for Jumlah Vendor -->
                <a href="{{ route('vendor.index') }}" class="flex flex-col justify-between h-40 rounded-lg border border-gray-300 dark:border-gray-700 bg-white shadow-md dark:bg-gray-800 hover:shadow-lg transition-shadow">
                    <div class="border-b border-gray-300 dark:border-gray-600 p-2 bg-teal-100 dark:bg-teal-800 rounded-t-lg">
                        <h3 class="text-sm font-medium text-teal-800 dark:text-teal-200 text-center">Jumlah Vendor</h3>
                    </div>
                    <div class="flex-grow flex items-center justify-center">
                        <p class="text-5xl font-bold text-teal-900 dark:text-teal-300">{{ $jumlahVendor }}</p>
                    </div>
                </a>

                <!-- Card for Overtime -->
                <a href="{{ route('overtime.index') }}" class="flex flex-col justify-between h-40 rounded-lg border border-gray-300 dark:border-gray-700 bg-white shadow-md dark:bg-gray-800 hover:shadow-lg transition-shadow">
                    <div class="border-b border-gray-300 dark:border-gray-600 p-2 bg-gray-100 dark:bg-white-100 rounded-t-lg">
                        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-700 text-center">Pengajuan Lembur</h3>
                    </div>
                    <div class="flex-grow grid grid-cols-3 divide-x divide-gray-300 dark:divide-gray-600">
                        <!-- Need Verification Section -->
                        <div class="flex flex-col items-center justify-center bg-blue-50 dark:bg-blue-900">
                            <h4 class="text-xs font-medium text-blue-800 dark:text-blue-200">Menunggu</h4>
                            <h4 class="text-xs font-medium text-blue-800 dark:text-blue-200"> Verifikasi Atasan</h4>
                            <p class="text-4xl font-bold text-blue-900 dark:text-blue-300">{{ $overtimeStatuses['Need Verification'] }}</p>
                        </div>

                        <!-- Need HC Approval Section -->
                        <div class="flex flex-col items-center justify-center bg-yellow-50 dark:bg-yellow-900">
                            <h4 class="text-xs font-medium text-yellow-800 dark:text-yellow-200">Menunggu</h4>
                            <h4 class="text-xs font-medium text-yellow-800 dark:text-yellow-200">Persetujuan HC</h4>
                            <p class="text-4xl font-bold text-yellow-900 dark:text-yellow-300">{{ $overtimeStatuses['Need HC Approval'] }}</p>
                        </div>

                        <!-- Approved Section -->
                        <div class="flex flex-col items-center justify-center bg-green-50 dark:bg-green-900">
                            <h4 class="text-xs font-medium text-green-800 dark:text-green-200">Telah</h4>
                            <h4 class="text-xs font-medium text-green-800 dark:text-green-200">Disetujui</h4>
                            <p class="text-4xl font-bold text-green-900 dark:text-green-300">{{ $overtimeStatuses['Approved'] }}</p>
                        </div>
                    </div>
                </a>

            </div>

            <!-- Middle section with demographic -->
            <div class="p-4 mb-4 bg-white rounded-lg border border-gray-300 dark:border-gray-700 shadow-md dark:bg-gray-800">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Peta Persebaran Pegawai</h3>
                    <div class="flex items-center space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="companyFilter" value="TRAKTOR NUSANTARA" class="form-radio h-5 w-5 text-blue-600" onchange="filterMapData()">
                            <span class="ml-2 text-gray-700 dark:text-gray-200">TN</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="companyFilter" value="SWADAYA HARAPAN NUSANTARA" class="form-radio h-5 w-5 text-blue-600" onchange="filterMapData()">
                            <span class="ml-2 text-gray-700 dark:text-gray-200">SHN</span>
                        </label>
                    </div>
                </div>
                <div id="indonesiaMap" class="w-full h-96 rounded-lg"></div>
            </div>

            <!-- Middle section with pie charts -->
            <div class="p-4 mb-4 bg-white rounded-lg border border-gray-300 dark:border-gray-700 shadow-md dark:bg-gray-800 grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Gender Pie Chart -->
                <div class="flex flex-col justify-between h-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white shadow-md dark:bg-gray-800">
                    <div class="border-b border-gray-300 dark:border-gray-600 p-2 bg-indigo-100 dark:bg-indigo-800 rounded-t-lg">
                        <h3 class="text-sm font-medium text-indigo-800 dark:text-indigo-200 text-center">Jumlah Pegawai berdasarkan Gender</h3>
                    </div>
                    <div class="flex-grow p-4">
                        <div id="genderPieChart" class="h-60"></div>
                    </div>
                </div>

                <!-- Company Pie Chart -->
                <div class="flex flex-col justify-between h-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white shadow-md dark:bg-gray-800">
                    <div class="border-b border-gray-300 dark:border-gray-600 p-2 bg-teal-100 dark:bg-teal-800 rounded-t-lg">
                        <h3 class="text-sm font-medium text-teal-800 dark:text-teal-200 text-center">Jumlah Pegawai berdasarkan Company</h3>
                    </div>
                    <div class="flex-grow p-4">
                        <div id="companyPieChart" class="h-60"></div>
                    </div>
                </div>

                <!-- Education Pie Chart -->
                <div class="flex flex-col justify-between h-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white shadow-md dark:bg-gray-800">
                    <div class="border-b border-gray-300 dark:border-gray-600 p-2 bg-pink-100 dark:bg-pink-800 rounded-t-lg">
                        <h3 class="text-sm font-medium text-pink-800 dark:text-pink-200 text-center">Jumlah Pegawai berdasarkan Pendidikan</h3>
                    </div>
                    <div class="flex-grow p-4">
                        <div id="educationPieChart" class="h-60"></div>
                    </div>
                </div>
            </div>

            <div class="p-4 mb-4 bg-white rounded-lg border border-gray-300 dark:border-gray-700 shadow-md dark:bg-gray-800">
                <div class="flex justify-between mb-2">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Jam Lembur Disetujui</h3>
                    <select id="yearSelector" class="border border-gray-300 rounded px-2 py-1 text-gray-700 dark:bg-gray-700 dark:text-white">
                        <!-- Dynamic years will be added here -->
                    </select>
                </div>
                <div id="lineChart"></div>
            </div>

            <!-- Second middle section with pie chart -->
            <div class="p-4 bg-white rounded-lg border border-gray-300 dark:border-gray-700 shadow-md dark:bg-gray-800">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Penilaian Pegawai Disetujui</h3>
                <div id="pieChart"></div>
            </div>
        </div>
    </div>

        <!-- jQuery Library -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- ApexCharts Library -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Flowbite (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>



    <script>

        // Pie chart data from the controller
        var appraisalStatuses = @json($appraisalStatuses); // Get the status counts from the controller

        // Prepare the series for the pie chart
        var optionsPie = {
            series: [appraisalStatuses[1], appraisalStatuses[2]], // Data for 'Need Superior Approval' and 'Approved'
            chart: {
                type: 'pie',
                height: 350
            },
            labels: ['Need Superior Approval', 'Approved']
        };

        var pieChart = new ApexCharts(document.querySelector("#pieChart"), optionsPie);
        pieChart.render();

        // Gender Pie Chart Data
        var genderData = @json($genderData);
        var genderOptions = {
            series: Object.values(genderData),
            chart: {
                type: 'pie',
                height: 240
            },
            labels: Object.keys(genderData),
            colors: ['#1E90FF', '#FF69B4'],
            legend: {
                position: 'bottom',
                labels: {
                    colors: ['#1E90FF', '#FF69B4'],
                    usePointStyle: true
                }
            }
        };
        var genderChart = new ApexCharts(document.querySelector("#genderPieChart"), genderOptions);
        genderChart.render();

        // Company Pie Chart Data
        var companyData = @json($companyData);

        // Map full company names to abbreviations for the labels
        var companyLabels = {
            'TRAKTOR NUSANTARA': 'TN',
            'SWADAYA HARAPAN NUSANTARA': 'SHN'
        };

        // Update options to use abbreviations
        var companyOptions = {
            series: Object.values(companyData),
            chart: {
                type: 'pie',
                height: 240
            },
            labels: Object.keys(companyData).map(key => companyLabels[key] || key), // Use abbreviations or fallback to original
            colors: ['#e31d1a', '#191f6c'], // Colors for each company
            legend: {
                position: 'bottom',
                labels: {
                    colors: ['#e31d1a', '#191f6c'], // Match colors to chart slices
                    usePointStyle: true
                }
            }
        };

        var companyChart = new ApexCharts(document.querySelector("#companyPieChart"), companyOptions);
        companyChart.render();

        // Education Pie Chart Data
        var educationData = @json($educationData);
        var educationOptions = {
            series: Object.values(educationData),
            chart: {
                type: 'pie',
                height: 240
            },
            labels: Object.keys(educationData),
            colors: ['#7FFFD4', '#8A2BE2', '#5F9EA0', '#D2691E', '#6495ED', '#DC143C', '#00FA9A', '#FF6347', '#8B4513'],
            legend: {
                position: 'bottom',
                labels: {
                    colors: ['#7FFFD4', '#8A2BE2', '#5F9EA0', '#D2691E', '#6495ED', '#DC143C', '#00FA9A', '#FF6347', '#8B4513'],
                    usePointStyle: true
                }
            }
        };
        var educationChart = new ApexCharts(document.querySelector("#educationPieChart"), educationOptions);
        educationChart.render();

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

        // Initialize map
        var map = L.map('indonesiaMap').setView([-2.5489, 118.0149], 5); // Coordinates for Indonesia's center

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Locations and their coordinates
        var locations = [
            { name: "BANDAR LAMPUNG", coords: [-5.4296, 105.2625], key: "BANDAR LAMPUNG" },
            { name: "BANDUNG", coords: [-6.9175, 107.6191], key: "BANDUNG" },
            { name: "BANJARMASIN", coords: [-3.3167, 114.5908], key: "BANJARMASIN" },
            { name: "JAKARTA", coords: [-6.2088, 106.8456], key: "JAKARTA" },
            { name: "JAMBI", coords: [-1.6100, 103.6107], key: "JAMBI" },
            { name: "JAYAPURA", coords: [-2.5337, 140.7181], key: "JAYAPURA" },
            { name: "MAKASSAR", coords: [-5.1477, 119.4327], key: "MAKASSAR" },
            { name: "MEDAN", coords: [3.5952, 98.6722], key: "MEDAN" },
            { name: "PADANG", coords: [-0.9471, 100.4172], key: "PADANG" },
            { name: "PALEMBANG", coords: [-2.9761, 104.7754], key: "PALEMBANG" },
            { name: "PEKANBARU", coords: [0.5071, 101.4478], key: "PEKANBARU" },
            { name: "PONTIANAK", coords: [-0.0263, 109.3425], key: "PONTIANAK" },
            { name: "SAMARINDA", coords: [-0.5022, 117.1536], key: "SAMARINDA" },
            { name: "SAMPIT", coords: [-2.5322, 112.9492], key: "SAMPIT" },
            { name: "SEMARANG", coords: [-6.9667, 110.4167], key: "SEMARANG" },
            { name: "SURABAYA", coords: [-7.2575, 112.7521], key: "SURABAYA" }
        ];

        // Map data passed from the controller
        var originalMapData = @json($mapData);
        var currentMarkers = [];

        // Function to clear markers
        function clearMarkers() {
            currentMarkers.forEach(marker => map.removeLayer(marker));
            currentMarkers = [];
        }

        function addMarkers(filteredData) {
            clearMarkers();
            locations.forEach(location => {
                // Normalize the location key and filteredData keys by trimming whitespace
                const locationKey = location.key.trim();
                const normalizedDataKey = Object.keys(filteredData).find(key => key.trim() === locationKey);

                var locationData = filteredData[normalizedDataKey] || { PRIA: 0, WANITA: 0, total: 0 };

                // Create a popup with male, female, and total counts
                var popupContent = `
                    <strong>${location.name}</strong><br>
                    Pria: ${locationData.PRIA}<br>
                    Wanita: ${locationData.WANITA}<br>
                    Total: ${locationData.total}
                `;

                var marker = L.marker(location.coords)
                    .addTo(map)
                    .bindPopup(popupContent);

                currentMarkers.push(marker);
            });
        }

        // Function to filter map data
        function filterMapData() {
            const selectedCompany = document.querySelector('input[name="companyFilter"]:checked')?.value;

            if (selectedCompany) {
                fetch(`/filter-map-data?company=${selectedCompany}`)
                    .then(response => response.json())
                    .then(filteredData => {
                        addMarkers(filteredData);
                    });
            } else {
                addMarkers(originalMapData); // Show all data if no filter is selected
            }
        }

        // Add initial markers
        addMarkers(originalMapData);

        // Fetch available years dynamically from the server (e.g., based on overtime data)
        // Function to populate available years
    function fetchAvailableYears() {
        $.ajax({
            url: "{{ route('home.getAvailableYears') }}",
            method: 'GET',
            success: function (data) {
                const yearSelector = document.getElementById('yearSelector');
                yearSelector.innerHTML = ""; // Clear current options
                data.years.forEach(year => {
                    const option = document.createElement('option');
                    option.value = year;
                    option.text = year;
                    yearSelector.appendChild(option);
                });
                if (data.years.length > 0) {
                    fetchOvertimeData(data.years[0]); // Load data for the first year
                }
            }
        });
    }

    // Function to fetch and update overtime data
    function fetchOvertimeData(year) {
        $.ajax({
            url: "{{ route('home.getOvertimeData') }}",
            method: 'GET',
            data: { year: year },
            success: function (response) {
                console.log("Overtime Data:", response); // Log the response
                if (response && response.monthlyOvertime) {
                    updateChart(response.monthlyOvertime);
                } else {
                    console.error("Invalid data format:", response);
                }
            },
            error: function (error) {
                console.error("Error fetching overtime data:", error);
            }
        });
    }


    // Initialize the line chart
    var optionsLine = {
        series: [{
            name: 'Jam Lembur',
            data: [] // Default empty data
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

    // Function to update chart data
    function updateChart(data) {
        lineChart.updateSeries([{
            name: 'Jam Lembur',
            data: data
        }]);
    }

    // Event listener for year selection
    document.getElementById('yearSelector').addEventListener('change', function() {
        const selectedYear = this.value;
        fetchOvertimeData(selectedYear);
    });

    // Fetch initial data
    fetchAvailableYears();



    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
