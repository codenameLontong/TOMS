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
                <input type="text" value="{{ $overtime->pegawai->nama }}" class="flex-grow border border-gray-300 rounded-md p-2 bg-gray-100" disabled>
            </div>

            <div class="mb-4 flex items-center">
                <label class="text-gray-700 font-medium w-1/3">Divisi/Dept</label>
                <input type="text" value="{{ $overtime->pegawai->department }}" class="flex-grow border border-gray-300 rounded-md p-2 bg-gray-100" disabled>
            </div>

            <div class="mb-4 flex items-center">
                <label class="text-gray-700 font-medium w-1/3">Keperluan Lembur</label>
                <input type="text" value="{{ $overtime->overtimeReason->title }}" class="flex-grow border border-gray-300 rounded-md p-2 bg-gray-100" disabled>
            </div>

            <div class="mb-4 flex items-center">
                <label class="text-gray-700 font-medium w-1/3">Tugas yang Dikerjakan</label>
                <textarea class="flex-grow border border-gray-300 rounded-md p-2 bg-gray-100" disabled>{{ $overtime->todo_list }}</textarea>
            </div>

            <div class="mb-3 font-bold">Untuk kerja lembur pada :</div>

            <div class="mb-4 flex items-center">
                <label class="text-gray-700 font-medium w-1/3">Hari</label>
                <span class="flex-grow border border-gray-300 rounded-md p-2 bg-gray-100">
                    {{ \Carbon\Carbon::parse($overtime->request_date)->translatedFormat('l') }}
                </span>
            </div>

            <div class="mb-4 flex items-center">
                <label class="text-gray-700 font-medium w-1/3">Tanggal</label>
                <span class="flex-grow border border-gray-300 rounded-md p-2 bg-gray-100">
                    {{ \Carbon\Carbon::parse($overtime->request_date)->translatedFormat('d F Y') }}
                </span>
            </div>

            <div class="mb-4 flex items-center">
                <label class="text-gray-700 font-medium w-1/3">Jam Mulai</label>
                <div class="flex-grow border border-gray-300 rounded-md p-2 bg-gray-100">
                    @php
                        $startTime = $overtime->approved_start_time ? \Carbon\Carbon::parse($overtime->approved_start_time)->format('H:i') : null;
                        $escalationStartTime = $overtime->escalation_approved_start_time ? \Carbon\Carbon::parse($overtime->escalation_approved_start_time)->format('H:i') : null;
                        $hcHeadStartTime = $overtime->hc_head_confirmed_start_time ? \Carbon\Carbon::parse($overtime->hc_head_confirmed_start_time)->format('H:i') : null;
                    @endphp

                    @if($overtime->start_time)
                    @if($overtime->escalation_approved_start_time && $overtime->start_time != $overtime->escalation_approved_start_time)
                        <del class="text-red-500">{{ $overtime->start_time }}</del>
                        <span>{{ $overtime->escalation_approved_start_time }}</span>
                    @elseif($overtime->escalation_approved_start_time === null)
                        <span>{{ $overtime->start_time }}</span> <!-- Display start_time if escalation_approved_start_time is blank -->
                    @else
                        <span>{{ $overtime->escalation_approved_start_time }}</span>
                    @endif
                    @else
                    <span class="text-gray-400">(Belum diisi)</span>
                    @endif


                    @if($hcHeadStartTime)
                        @if($escalationStartTime && $hcHeadStartTime != $escalationStartTime)
                            <del class="text-red-500">{{ $startTime }}</del>
                            <del class="text-red-500">{{ $escalationStartTime }}</del>
                            <span>{{ $hcHeadStartTime }}</span>
                        @else
                            <!-- <span>{{ $hcHeadStartTime }}</span> -->
                        @endif
                    @endif
                </div>
            </div>

            <div class="mb-4 flex items-center">
                <label class="text-gray-700 font-medium w-1/3">Jam Selesai</label>
                <div class="flex-grow border border-gray-300 rounded-md p-2 bg-gray-100">
                    @php
                        $endTime = $overtime->approved_end_time ? \Carbon\Carbon::parse($overtime->approved_end_time)->format('H:i') : null;
                        $escalationEndTime = $overtime->escalation_approved_end_time ? \Carbon\Carbon::parse($overtime->escalation_approved_end_time)->format('H:i') : null;
                        $hcHeadEndTime = $overtime->hc_head_confirmed_end_time ? \Carbon\Carbon::parse($overtime->hc_head_confirmed_end_time)->format('H:i') : null;
                    @endphp


                    @if($overtime->end_time)
                    @if($overtime->escalation_approved_end_time && $overtime->end_time != $overtime->escalation_approved_end_time)
                        <del class="text-red-500">{{ $overtime->end_time }}</del>
                        <span>{{ $overtime->escalation_approved_end_time }}</span>
                    @elseif($overtime->escalation_approved_end_time === null)
                        <span>{{ $overtime->end_time }}</span> <!-- Display end_time if escalation_approved_end_time is blank -->
                    @else
                        <span>{{ $overtime->escalation_approved_end_time }}</span>
                    @endif
                    @else
                    <span class="text-gray-400">(Belum diisi)</span>
                    @endif

                    @if($hcHeadEndTime)
                        @if($escalationEndTime && $hcHeadEndTime != $escalationEndTime)
                            <del class="text-red-500">{{ $endTime }}</del>
                            <del class="text-red-500">{{ $escalationEndTime }}</del>
                            <span>{{ $hcHeadEndTime }}</span>
                        @else
                            <!-- <span>{{ $hcHeadEndTime }}</span> -->
                        @endif
                    @endif
                </div>
            </div>
            <p class="text-gray-600 italic mt-2">Bahwa saya yang bertandatangan di bawah ini bersedia tanpa paksaan untuk melaksanakan kerja lembur sesuai dengan jumlah waktu yang tertera</p>

            <!-- Signature Section -->
            <div class="mt-8">
                <p class="text-right text-gray-700 font-medium mb-2">Jakarta, {{ \Carbon\Carbon::parse($overtime->order_at)->format('d F Y') }}</p>

                <div class="grid grid-cols-3 gap-4 text-center">
                    <!-- HC Signature -->
                    <div>
                        <p class="font-medium">Mengetahui HC,</p>
                        <div class="flex items-center justify-center">
                            @if($overtime->hc_head_confirmed_at)
                                <span class="text-green-500 font-bold text-2xl">(SIGNED)</span>
                            @endif

                            @if($overtime->status === 'Rejected')
                                <span class="text-red-500 font-bold text-2xl">(CANCELLED)</span>
                            @endif

                            @if(!$overtime->hc_head_confirmed_at && $overtime->status !== 'Rejected')
                                <span class="text-gray-500 font-bold text-2xl opacity-50">(NOT SIGNED)</span>
                            @endif
                        </div>
                        <div class="border-t border-gray-300 mt-16">
                            <p class="text-gray-700 mt-2">
                                {{ $hcUser ? $hcUser->name : '(Nama Karyawan HC)' }}
                            </p>
                        </div>
                    </div>

                    <!-- Employee Signature -->
                    <div>
                        <p class="font-medium">Yang bersedia tugas lembur</p>
                        <div class="flex items-center justify-center">
                            @if($overtime->approved_at)
                                <span class="text-green-500 font-bold text-2xl">(SIGNED)</span>
                            @endif

                            @if($overtime->status === 'Rejected by Employee')
                                <span class="text-red-500 font-bold text-2xl">(CANCELLED)</span>
                            @endif

                            @if(!$overtime->approved_at && $overtime->status !== 'Rejected by Employee')
                                <span class="text-gray-500 font-bold text-2xl opacity-50">(NOT SIGNED)</span>
                            @endif
                        </div>
                        <div class="border-t border-gray-300 mt-16">
                            <p class="text-gray-700 mt-2">
                                {{ $overtime->pegawai->nama ?? '(Nama Karyawan)' }}
                            </p>
                        </div>
                    </div>

                    <!-- Manager Signature -->
                    <div>
                        <p class="font-medium">Yang memberi tugas</p>
                        <div class="flex flex-col items-center justify-center">
                            @if($overtime->order_at)
                                <span class="text-green-500 font-bold text-2xl">(SIGNED)</span>
                            @endif

                            @if($overtime->status === 'Rejected by Superior')
                                <span class="text-red-500 font-bold text-2xl">(CANCELLED)</span>
                            @endif

                            @if(!$overtime->order_at && $overtime->status !== 'Rejected by Superior')
                                <span class="text-gray-500 font-bold text-2xl opacity-50">(NOT SIGNED)</span>
                            @endif
                        </div>
                        <div class="border-t border-gray-300 mt-16">
                            <p class="text-gray-700 mt-2">
                                {{ $overtime->orderedBy->name ?? '(Nama Manager)' }}
                            </p>
                        </div>

                        @if($overtime->escalation_approved_at)
                            <span class="text-black font-normal text-sm">
                                Diverifikasi Pada {{ \Carbon\Carbon::parse($overtime->escalation_approved_at)->format('d F Y') }}
                            </span>
                        @endif
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
