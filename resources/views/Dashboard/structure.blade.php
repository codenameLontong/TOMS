<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Structure</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg mt-14 bg-white dark:bg-gray-800 shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Struktur Organisasi</h2>

            <!-- Toggle Expand/Collapse Button -->
            <div class="flex justify-end mb-4">
                <button id="toggleExpandCollapse" class="text-white bg-blue-600 hover:bg-blue-800 rounded-lg px-4 py-2.5">
                    Collapse All
                </button>
            </div>

            <!-- Accordion for the Company Structure -->
            <div id="accordion-collapse" data-accordion="collapse" class="space-y-4">
                @foreach($companies as $company)
                <!-- Company Level -->
                <div class="border rounded-lg">
                    <h3>
                        <button type="button" class="flex items-center justify-between w-full p-4 font-bold text-left text-gray-800 bg-blue-200 dark:bg-blue-900 dark:text-white" data-accordion-target="#company-{{ $company->id }}" aria-expanded="false">
                            <span>{{ $company->coy }}</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </h3>

                    <div id="company-content-{{ $company->id }}" class="pl-4">
                        @foreach($company->directorates as $directorate)
                        <!-- Directorate Level -->
                        <div class="border-l-4 border-gray-300 pl-4">
                            <h4 class="pl-4 py-2">
                                <button type="button" class="flex items-center justify-between w-full p-2 text-left text-gray-700 bg-gray-300 dark:bg-gray-700 dark:text-white" data-accordion-target="#directorate-{{ $directorate->id }}" aria-expanded="false">
                                    <span>{{ $directorate->nama_directorate }}</span>
                                </button>
                            </h4>
                            <div id="directorate-content-{{ $directorate->id }}" class="pl-8">
                                @foreach($directorate->divisions as $division)
                                <!-- Division Level -->
                                <div class="border-l-4 border-gray-400 pl-4">
                                    <h5 class="pl-4 py-2">
                                        <button type="button" class="flex items-center justify-between w-full p-2 text-left text-gray-600 bg-gray-200 dark:bg-gray-600 dark:text-white" data-accordion-target="#division-{{ $division->id }}" aria-expanded="false">
                                            <span>{{ $division->nama_division }}</span>
                                        </button>
                                    </h5>
                                    <div id="division-content-{{ $division->id }}" class="pl-8">
                                        @foreach($division->departments as $department)
                                        <!-- Department Level -->
                                        <div class="border-l-4 border-gray-500 pl-4">
                                            <h6 class="pl-4 py-2">
                                                <button type="button" class="flex items-center justify-between w-full p-2 text-left text-gray-600 bg-gray-100 dark:bg-gray-500 dark:text-white" data-accordion-target="#department-{{ $department->id }}" aria-expanded="false">
                                                    <span>{{ $department->nama_department }}</span>
                                                </button>
                                            </h6>
                                            <div id="department-content-{{ $department->id }}" class="pl-8">
                                                <!-- Section Level -->
                                                <ul class="text-gray-500 dark:text-gray-400 list-disc pl-4">
                                                    @foreach($department->sections as $section)
                                                    <li class="text-gray-500 dark:text-gray-300">{{ $section->nama_section }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <script>
        // Toggle Expand/Collapse functionality
        let isExpanded = false;

        document.getElementById('toggleExpandCollapse').addEventListener('click', function() {
            let companyContents = document.querySelectorAll('[id^="company-content"]');
            if (!isExpanded) {
                // Expand all
                companyContents.forEach(function(content) {
                    content.classList.remove('hidden'); // Show all nested content under companies
                });
                this.textContent = 'Collapse All'; // Change button text to "Collapse All"
                isExpanded = true;
            } else {
                // Collapse all (hide only nested contents, not company names)
                companyContents.forEach(function(content) {
                    content.classList.add('hidden'); // Hide only nested content under companies
                });
                this.textContent = 'Expand All'; // Change button text to "Expand All"
                isExpanded = false;
            }
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
</body>
</html>
