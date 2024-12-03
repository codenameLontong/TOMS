<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat SPL</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <x-navbar />
    <x-sidebar />

    <div class="flex justify-center items-center min-h-screen p-10 sm:ml-64">
        <div class="p-6 bg-white shadow-lg rounded-lg max-w-5xl w-full">
            <h2 class="text-center text-2xl font-bold mb-4 underline">SURAT PERINTAH LEMBUR</h2>
            <div class="mb-3 font-bold">Bersama ini kami tugaskan :</div>
            <div class="mb-4 flex items-center">
                <label class="text-gray-700 font-medium w-1/3">Saudara</label>
                <input type="text" value="{{ ($overtime->pegawai)->nama }}" class="flex-grow border border-gray-300 rounded-md p-2 bg-gray-100" disabled>
            </div>

            <div class="mb-4 flex items-center">
                <label class="text-gray-700 font-medium w-1/3">Divisi/Dept</label>
                <input type="text" value="{{ ($overtime->pegawai)->department }}" class="flex-grow border border-gray-300 rounded-md p-2 bg-gray-100" disabled>
            </div>

            <div class="mb-4 flex items-center">
                <label class="text-gray-700 font-medium w-1/3">Tugas yang Dikerjakan</label>
                <input type="text" value="{{ $overtime->overtimeReason->title }}" class="flex-grow border border-gray-300 rounded-md p-2 bg-gray-100" disabled>
            </div>

            <div class="mb-4 flex items-center">
                <label class="text-gray-700 font-medium w-1/3">Keterangan</label>
                <textarea class="flex-grow border border-gray-300 rounded-md p-2 bg-gray-100" disabled>{{ $overtime->todo_list }}</textarea>
            </div>

            <div class="mb-3 font-bold">Untuk kerja lembur pada :</div>

            <div class="mb-4 flex items-center">
                <label class="text-gray-700 font-medium w-1/3">Hari</label>
                <input type="text" value="Selasa" class="flex-grow border border-gray-300 rounded-md p-2 bg-gray-100" disabled>
            </div>

            <div class="mb-4 flex items-center">
                <label class="text-gray-700 font-medium w-1/3">Tanggal</label>
                <span class="flex-grow border border-gray-300 rounded-md p-2 bg-gray-100">
                    {{ \Carbon\Carbon::parse($overtime->request_date)->format('d F Y') }}
                </span>
            </div>


            <div class="mb-4 flex items-center">
                <label class="text-gray-700 font-medium w-1/3">Jam Mulai</label>
                <input type="time" value="{{ $overtime->start_time }}" class="flex-grow border border-gray-300 rounded-md p-2 bg-gray-100" disabled>
            </div>

            <div class="mb-4 flex items-center">
                <label class="text-gray-700 font-medium w-1/3">Jam Selesai</label>
                <input type="time" value="{{ $overtime->end_time }}" class="flex-grow border border-gray-300 rounded-md p-2 bg-gray-100" disabled>
            </div>
            <p class="text-gray-600 italic mt-2">Bahwa saya yang bertandatangan di bawah ini bersedia tanpa paksaan untuk melaksanakan kerja lembur sesuai dengan jumlah waktu yang tertera</p>




            <!-- Signature Section -->
            <div class="mt-8">
                <p class="text-right text-gray-700 font-medium mb-2">Jakarta, {{ \Carbon\Carbon::parse($overtime->order_at)->format('d F Y') }}
                </p>

                <div class="grid grid-cols-3 gap-4 text-center">
                    <div>
                        <p class="font-medium">Mengetahui HC,</p>
                        <div class="flex items-center justify-center">
                            @if($overtime->hc_head_confirmed_by)
                                <span class="text-green-500 font-bold text-2xl">(SIGNED)</span>
                            @else
                                <span class="text-green-500 font-bold text-2xl opacity-0">(SIGNED)</span>
                            @endif
                        </div>
                        <div class="border-t border-gray-300 mt-16">
                            <p class="text-gray-700 mt-2">
                                {{ $hcUser ? $hcUser->name : '(Nama Karyawan HC)' }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <p class="font-medium">Yang bersedia tugas lembur</p>
                        <div class="flex items-center justify-center">
                            @if($overtime->approved_by)
                                <span class="text-green-500 font-bold text-2xl">(SIGNED)</span>
                            @else
                                <span class="text-green-500 font-bold text-2xl opacity-0">(SIGNED)</span>
                            @endif
                        </div>
                        <div class="border-t border-gray-300 mt-16">
                            <p class="text-gray-700 mt-2">
                                {{ $overtime->pegawai->nama ?? '(Nama Karyawan)' }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <p class="font-medium">Yang memberi tugas</p>
                        <div class="flex items-center justify-center">
                            @if($overtime->escalation_approved_by)
                                <span class="text-green-500 font-bold text-2xl">(SIGNED)</span>
                            @else
                                <span class="text-green-500 font-bold text-2xl opacity-0">(SIGNED)</span>
                            @endif
                        </div>
                        <div class="border-t border-gray-300 mt-16">
                            <p class="text-gray-700 mt-2">
                                {{ $overtime->orderedBy->name ?? '(Nama Karyawan)' }}
                            </p>
                        </div>
                    </div>
                </div>


            </div>

            <p class="mt-8 text-center text-sm text-gray-500 italic">
                "Jumlah jam lembur yang diperbolehkan bagi seorang pekerja maksimum 56 jam sebulan" <br> <span class="font-bold">No. 13 Tahun 2003 Pasal 78 point 1 b & PKB 2019 - 2021 Bab IV Pasal 21 point 1 hal 21.</span>
            </p>
        </div>
    </div>
</body>
</html>
