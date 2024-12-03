<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vendor</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-14 max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Vendor</h2>

            <form method="POST" action="{{ route('vendor.update', $vendor->id) }}">
                @csrf
                @method('PUT')

                <!-- Kode Vendor -->
                <div class="mb-4">
                    <label for="kode_vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Vendor</label>
                    <input type="text" id="kode_vendor" name="kode_vendor" value="{{ $vendor->kode_vendor }}"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Nama Vendor -->
                <div class="mb-4">
                    <label for="nama_vendor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Vendor</label>
                    <input type="text" id="nama_vendor" name="nama_vendor" value="{{ $vendor->nama_vendor }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                </div>

                <!-- Astra/Non Astra -->
                <div class="mb-4">
                    <label for="astra_non_astra" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Astra/Non Astra</label>
                    <select id="astra_non_astra" name="astra_non_astra" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                        <option value="Astra" {{ $vendor->astra_non_astra == 'Astra' ? 'selected' : '' }}>Astra</option>
                        <option value="Non Astra" {{ $vendor->astra_non_astra == 'Non Astra' ? 'selected' : '' }}>Non Astra</option>
                    </select>
                </div>

                <!-- PIC Section -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar PIC (Person In Charge)</h3>
                    <div id="pic-container" class="space-y-4 mt-4">
                        @foreach ($vendor->pics as $index => $pic)
                            <div class="flex items-center space-x-2" id="pic-row-{{ $index }}">
                                <input type="text" name="pics[{{ $index }}][nama]" value="{{ $pic->nama }}" placeholder="Nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white w-1/4" required>
                                <input type="text" name="pics[{{ $index }}][no_hp]" value="{{ $pic->no_hp }}" placeholder="No HP" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white w-1/4" required>
                                <input type="email" name="pics[{{ $index }}][email]" value="{{ $pic->email }}" placeholder="Email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white w-1/4" required>
                                <input type="text" name="pics[{{ $index }}][jabatan]" value="{{ $pic->jabatan }}" placeholder="Jabatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white w-1/4" required>
                                @if ($index > 0)
                                    <button type="button" class="text-red-600 hover:text-red-800 text-sm font-medium" onclick="removePic(this)">Remove</button>
                                @else
                                    <button type="button" class="text-gray-400 cursor-not-allowed text-sm font-medium" disabled>Remove</button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-pic-btn" class="text-blue-600 hover:text-blue-800 text-sm font-medium mt-2">+ Add PIC</button>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2.5">
                    Update Vendor
                </button>
            </form>
        </div>
    </div>

    <script>
        let picIndex = {{ count($vendor->pics) }};

        document.getElementById('add-pic-btn').addEventListener('click', function () {
            const picContainer = document.getElementById('pic-container');
            const newPicRow = document.createElement('div');
            newPicRow.className = 'flex items-center space-x-2';
            newPicRow.innerHTML = `
                <input type="text" name="pics[${picIndex}][nama]" placeholder="Nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white w-1/4" required>
                <input type="text" name="pics[${picIndex}][no_hp]" placeholder="No HP" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white w-1/4" required>
                <input type="email" name="pics[${picIndex}][email]" placeholder="Email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white w-1/4" required>
                <input type="text" name="pics[${picIndex}][jabatan]" placeholder="Jabatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white w-1/4" required>
                <button type="button" class="text-red-600 hover:text-red-800 text-sm font-medium" onclick="removePic(this)">Remove</button>
            `;
            picContainer.appendChild(newPicRow);
            picIndex++;
        });

        function removePic(button) {
            button.closest('.flex').remove();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
