<div id="terminateModal-{{ $pegawai->id }}" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-sm w-full">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Confirm Termination</h2>
        <p class="text-sm text-gray-600 dark:text-gray-300">Are you sure you want to terminate the account of {{ $pegawai->nama }}?</p>
        <div class="mt-6 flex justify-end">
            <button class="bg-gray-200 text-gray-800 px-4 py-2 rounded mr-2" onclick="closeTerminateModal({{ $pegawai->id }})">Cancel</button>
            <form method="POST" action="{{ route('pegawai.terminate', $pegawai->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Terminate</button>
            </form>
        </div>
    </div>
</div>

