<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat SPL</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-14 bg-white dark:bg-gray-800 max-w-3xl mx-auto bg-white shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Overtime</h2>
                <div class="container mx-auto p-4">
                    <form action="{{ route('overtime.update', $overtime->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- NRP Input (Auto-filled) -->
                        <div>
                            <label for="nrp" class="block mb-1">NRP TRAKNUS</label>
                            <input type="text" id="nrp" name="nrp" value="{{ ($overtime->pegawai)->nrp }}" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disabled>
                        </div>

                        <!-- Name Input (Auto-filled) -->
                        <div>
                            <label for="nama" class="block mb-1">Nama</label>
                            <input type="text" id="nama" name="nama" value="{{ ($overtime->pegawai)->nama }}" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disabled>
                        </div>

                        <!-- Department Input (Auto-filled) -->
                        <div>
                            <label for="department" class="block mb-1">Departemen</label>
                            <input type="text" id="department" name="department" value="{{ ($overtime->pegawai)->department }}" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disabled>
                        </div>

                        <!-- Division Input (Auto-filled) -->
                        <div>
                            <label for="division" class="block mb-1">Divisi</label>
                            <input type="text" id="division" name="division" value="{{ ($overtime->pegawai)->division }}" required class="bg-gray-200 border border-gray-300 rounded-lg p-2 w-full" disabled>
                        </div>

                            <!-- Request Date -->
                            <div>
                                <label for="request_date" class="block mb-1">Tanggal Request</label>
                                <input type="date" id="request_date" name="request_date" value="{{ $overtime->request_date }}" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full">
                            </div>

                            <!-- Start Time -->
                            <div>
                                <label for="start_time" class="block mb-1">Waktu Mulai</label>
                                <input type="time" id="start_time" name="start_time" value="{{ $overtime->start_time }}" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full">
                            </div>

                            <!-- End Time -->
                            <div>
                                <label for="end_time" class="block mb-1">Waktu Selesai</label>
                                <input type="time" id="end_time" name="end_time" value="{{ $overtime->end_time }}" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full">
                            </div>

                            <div>
                                <label for="overtime_reason_order_id" class="block mb-1">Keperluan Lembur</label>
                                <select id="overtime_reason_order_id" name="overtime_reason_order_id" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full">
                                    <option value="" disabled selected>Pilih Keperluan</option>
                                    @foreach ($overtimeReasons as $reason)
                                    <option value="{{ $reason->id }}"
                                        {{ $overtime->overtime_reason_order_id == $reason->id ? 'selected' : '' }}>
                                        {{ $reason->title }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="todo_list" class="block mb-1">Aktivitas</label>
                                <textarea id="todo_list" name="todo_list" required class="bg-gray-50 border border-gray-300 rounded-lg p-2 w-full" placeholder="Tulisan aktivitas yang perlu dilakukan saat lembur">{{ $overtime->todo_list }}</textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white p-2 rounded-lg w-full">Update</button>
                        </div>
                    </form>
                </div
    </div>
</body>
</html>
