<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overtime - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg mt-14 bg-white dark:bg-gray-800 shadow-lg">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Daftar Overtime</h2>
            <!-- Search Bar and Create Overtime Button -->
            <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 pb-4">
                <div class="relative mt-1 w-80">
                    <input type="text" id="table-search" onkeyup="searchTable()" placeholder="Cari Overtime" class="block p-2 pl-10 w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <div class="flex flex-col md:flex-row md:space-x-4">
                    <button id="rejectedOvertimeButton" class="flex items-center px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-lg" onclick="openRejectedModal()">
                        Rejected Overtime (<span id="rejectedCount">{{ $overtimes->whereIn('status', ['Rejected', 'Rejected by Superior', 'Rejected by Employee'])->count() }}</span>)
                    </button>

                @if(in_array(auth()->user()->role_id, [1, 2, 3, 4, 5, 6]))
                <a href="{{ route('overtime.create') }}" class="flex items-center px-4 py-2 text-white bg-blue-700 hover:bg-blue-800 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Buat SPL
                </a>
                @endif
            </div>

               <!-- Overtime Table -->
               <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table id="pegawaiTable" class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="asc" onclick="sortTable(0, this)">NRP <span>&#9650;</span></th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="asc" onclick="sortTable(1, this)">Name <span>&#9650;</span></th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="asc" onclick="sortTable(2, this)">Overtime Date <span>&#9650;</span></th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="asc" onclick="sortTable(3, this)">Start Time <span>&#9650;</span></th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="asc" onclick="sortTable(4, this)">End Time <span>&#9650;</span></th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" data-sort="asc" onclick="sortTable(5, this)">Status <span>&#9650;</span></th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="overtimeTableBody">
                        @foreach($overtimes as $overtime)
                        <tr class="border-b dark:bg-gray-800 dark:border-gray-700 {{ $overtime->is_holiday == 1 ? 'bg-yellow-200' : 'bg-white' }}"
                            style="color: {{ in_array($overtime->status, ['Rejected', 'Rejected by Superior', 'Rejected by Employee']) ? 'red' : 'inherit' }};">                            <td class="px-6 py-4">{{ $overtime->pegawai->nrp ?? 'XX' }}</td>
                            <td class="px-6 py-4">{{ optional($overtime->pegawai)->nama ?? 'Unknown' }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($overtime->request_date)->translatedFormat('d M Y') }}</td>
                            <td class="px-6 py-4">
                                @if($overtime->status == 'Need HC Approval' || $overtime->status == 'Approved')
                                    {{ $overtime->escalation_approved_start_time }}
                                @else
                                    {{ $overtime->start_time }}
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($overtime->status == 'Need HC Approval' || $overtime->status == 'Approved')
                                    {{ $overtime->escalation_approved_end_time }}
                                @else
                                    {{ $overtime->end_time }}
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $overtime->status }}</td>
                            @role('superadmin|admin|superior|direct_superior|hcs_dept_head|hc_div_head|pegawai')
                            <td class="flex px-6 py-4">
                                <!-- View Icon -->
                                <div class="relative" style="position: relative; display: inline-block;">
                                    <a href="{{ route('overtime.show', $overtime->id) }}" class="text-blue-600 hover:text-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>
                                    <span style="position: absolute; bottom: 25px; left: 0; background-color: #E5E7EB; color: #1F2937; padding: 2px 6px; border-radius: 4px; display: none; white-space: nowrap;">View</span>
                                </div>
                            @endrole
                            @role('superadmin|admin')
                                <!-- Edit Icon -->
                                <div class="relative ml-4" style="position: relative; display: inline-block;">
                                    <a href="{{ route('overtime.edit', $overtime->id) }}" class="text-blue-600 hover:text-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                    <span style="position: absolute; bottom: 25px; left: 0; background-color: #E5E7EB; color: #1F2937; padding: 2px 6px; border-radius: 4px; display: none; white-space: nowrap;">Edit</span>
                                </div>
                            @endrole
                            @role('superadmin|admin')
                                <!-- Delete Icon -->
                                <div class="relative ml-4" style="position: relative; display: inline-block;">
                                    <a href="#" class="text-red-600 hover:text-red-800" data-modal-target="deleteModal" data-url="{{ route('overtime.destroy', $overtime->id) }}" onclick="openDeleteModal(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </a>
                                    <span style="position: absolute; bottom: 25px; left: 0; background-color: #E5E7EB; color: #1F2937; padding: 2px 6px; border-radius: 4px; display: none; white-space: nowrap;">Delete</span>
                                </div>
                            </td>
                            @endrole

                            @if(isset($overtime))
                            @role('pegawai')
                            <td class="flex px-6 py-4 space-x-2">
                            @if ($overtime->status == 'Plan')
                            <!-- Trigger Approve Modal -->
                            <button type="button" data-bs-toggle="modal" data-bs-target="#approveModal"
                            onclick="setApproveAction('{{ route('overtime.approve', $overtime->id) }}')">
                            <span class="bg-green-500 text-white py-1 px-3 rounded-full">Approve</span>
                        </button>


                            <!-- Trigger Reject Modal -->
                            <button type="button"  data-bs-toggle="modal" data-bs-target="#rejectModal"
                                onclick="setRejectAction('{{ route('overtime.reject', $overtime->id) }}')">
                                <span class="bg-red-500 text-white py-1 px-3 rounded-full">Reject</span>
                            </button>
                            @else

                            @endif
                            @endrole
                        @else
                            <p> </p>
                        @endif

                        @if(isset($overtime))
                            @role('direct_superior')
                            <td class="flex px-6 py-4 space-x-2">
                            @if ($overtime->status == 'Need Verification')
                            <!-- Trigger Verification Modal -->
                            <button type="button" data-bs-toggle="modal" data-bs-target="#verificationModal"
                                onclick="setVerificationAction('{{ route('overtime.verify', $overtime->id) }}')">
                                <span class="bg-green-500 text-white py-1 px-3 rounded-full">Verify</span>
                            </button>

                            <!-- Trigger Reject Modal -->
                            <button type="button"  data-bs-toggle="modal" data-bs-target="#rejectModal"
                                onclick="setRejectAction('{{ route('overtime.reject', $overtime->id) }}')">
                                <span class="bg-red-500 text-white py-1 px-3 rounded-full">Reject</span>
                            </button>
                            @else

                            @endif
                            @endrole
                        @else
                            <p> </p>
                        @endif

                        @if(isset($overtime))
                            @role('hcs_dept_head')
                            <td class="flex px-6 py-4 space-x-2">
                            @if ($overtime->status == 'Need HC Approval')
                            <!-- Trigger Confirmation Modal -->
                            <button type="button" data-bs-toggle="modal" data-bs-target="#confirmationModal"
                                onclick="setConfirmationAction('{{ route('overtime.confirm', $overtime->id) }}')">
                                <span class="bg-green-500 text-white py-1 px-3 rounded-full">Confirm</span>
                            </button>

                            <!-- Trigger Reject Modal -->
                            <button type="button"  data-bs-toggle="modal" data-bs-target="#rejectModal"
                                onclick="setRejectAction('{{ route('overtime.reject', $overtime->id) }}')">
                                <span class="bg-red-500 text-white py-1 px-3 rounded-full">Reject</span>
                            </button>
                            @else

                            @endif
                            @endrole
                        @else
                            <p> </p>
                        @endif


                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex items-center space-x-2 mt-4">
            <span class="w-4 h-4 bg-yellow-200 inline-block"></span>
            <span class="text-sm text-gray-500 dark:text-gray-400">Outside Work Days</span>
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

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-700 w-96">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Are you sure?</h3>
            <p class="text-sm text-gray-500 dark:text-gray-300 mb-6">Do you really want to delete this record? This action cannot be undone.</p>
            <div class="flex justify-end space-x-3">
                <button id="cancelButton" class="px-4 py-2 bg-gray-500 text-white rounded-md" onclick="closeDeleteModal()">Cancel</button>
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Notes Modal -->
    <!-- Approve Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel">Approve Overtime</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="approveForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">To Do:</label>
                            <p class="text-muted">{{ $overtime->todo_list ?? 'No note available' }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="verificationNote" class="form-label">Approval Note</label>
                            <textarea class="form-control" id="verificationNote" name="approved_note" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

  <!-- Reject Modal -->
  <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rejectModalLabel">Reject Overtime</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST" id="rejectForm">
              @csrf
              <div class="mb-3">
                  <label for="rejected_note" class="form-label">Rejection Note (Optional)</label>
                  <textarea class="form-control" id="rejected_note" name="rejected_note" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-danger">Reject</button>
          </form>
        </div>
      </div>
    </div>
  </div>
 <!-- Verification Modal -->
<div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verificationModalLabel">Verify Overtime</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="verificationForm">
                    @csrf
                    <!-- Display approved_note -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Approved Note:</label>
                        <p id="approvedNoteText" class="text-muted">{{ $overtime->approved_note ?? 'No note available' }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="verificationNote" class="form-label">Verification Note</label>
                        <textarea class="form-control" id="verificationNote" name="verification_note" rows="3"></textarea>
                    </div>

                    <!-- Fillable start and end times -->
                    <div class="mb-3">
                        <label for="approvedStartTime" class="form-label">Approved Start Time</label>
                        <input type="time" class="form-control" id="approvedStartTime" name="approved_start_time" value="{{ $overtime->approved_start_time ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label for="approvedEndTime" class="form-label">Approved End Time</label>
                        <input type="time" class="form-control" id="approvedEndTime" name="approved_end_time" value="{{ $overtime->approved_end_time ?? '' }}">
                    </div>

                    <button type="submit" class="btn btn-success">Verify</button>
                </form>

            </div>
        </div>
    </div>
</div>

      <!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmationModalLabel">Confirm Overtime</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST" id="confirmationForm">
              @csrf
              <div class="mb-3">
                <label class="form-label fw-bold">Approved Note:</label>
                <p id="approvedNoteText" class="text-muted">{{ $overtime->escalation_approved_note ?? 'No note available' }}</p>
            </div>
              <div class="mb-3">
                  <label for="confirmation_note" class="form-label">Confirm Note (Optional)</label>
                  <textarea class="form-control" id="confirmation_note" name="confirmation_note" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-success">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Rejected Overtime Modal -->
<div id="rejectedOvertimeModal" class="hidden fixed z-50 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-4xl">
            <div class="flex justify-between items-center pb-4 border-b dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Rejected Overtime</h3>
                <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200" onclick="closeRejectedModal()">
                    &times;
                </button>
            </div>
            <div class="mt-4">
                <table class="min-w-full text-sm text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3">NRP</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Overtime Date</th>
                            <th class="px-6 py-3">Start Time</th>
                            <th class="px-6 py-3">End Time</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($overtimes->whereIn('status', ['Rejected', 'Rejected by Superior', 'Rejected by Employee']) as $overtime)
                        <tr class="border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ $overtime->pegawai->nrp ?? 'XX' }}</td>
                            <td class="px-6 py-4">{{ optional($overtime->pegawai)->nama ?? 'Unknown' }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($overtime->request_date)->translatedFormat('d M Y') }}</td>
                            <td class="px-6 py-4">{{ $overtime->start_time }}</td>
                            <td class="px-6 py-4">{{ $overtime->end_time }}</td>
                            <td class="px-6 py-4">{{ $overtime->status }}</td>
                            <td class="px-6 py-4">
                                <div class="relative" style="position: relative; display: inline-block;">
                                    <a href="{{ route('overtime.show', $overtime->id) }}" class="text-blue-600 hover:text-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>
                                    <span style="position: absolute; bottom: 25px; left: 0; background-color: #E5E7EB; color: #1F2937; padding: 2px 6px; border-radius: 4px; display: none; white-space: nowrap;">View</span>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Debugging the rejectedOvertimes -->





    <script>
        document.querySelectorAll('td div').forEach(function(div) {
            div.addEventListener('mouseover', function() {
                this.querySelector('span').style.display = 'block';
            });
            div.addEventListener('mouseout', function() {
                this.querySelector('span').style.display = 'none';
            });
        });
    </script>
    <script>
        function openRejectedModal() {
    document.getElementById('rejectedOvertimeModal').classList.remove('hidden');
}

function closeRejectedModal() {
    document.getElementById('rejectedOvertimeModal').classList.add('hidden');
}

        function searchTable() {
            const input = document.getElementById('table-search');
            const filter = input.value.toUpperCase();
            const table = document.querySelector('table');
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const cells = Array.from(row.getElementsByTagName('td'));
                const isVisible = cells.some(cell => cell.textContent.toUpperCase().includes(filter));
                row.style.display = isVisible ? '' : 'none';
            });
        }

        function openDeleteModal(link) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = link.getAttribute('data-url');
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        document.getElementById('cancelButton').addEventListener('click', closeDeleteModal);

        function setApproveAction(url) {
        document.getElementById('approveForm').action = url;
        }

        function setRejectAction(url) {
            document.getElementById('rejectForm').action = url;
        }
        function setVerificationAction(url) {
            // Set the form action to the correct route
            document.getElementById('verificationForm').action = url;
        }
        function setConfirmationAction(url) {
            // Set the form action to the correct route
            document.getElementById('confirmationForm').action = url;
        }



        // Similar functions for setRejectAction, setVerificationAction, and setConfirmationAction

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

        })
        function sortTable(columnIndex, headerElement) {
        const tableBody = document.getElementById("overtimeTableBody");
        const rows = Array.from(tableBody.querySelectorAll("tr"));
        const currentSortOrder = headerElement.getAttribute("data-sort");
        const isAscending = currentSortOrder === "asc";

        // Sort rows based on the selected column and current order
        const sortedRows = rows.sort((a, b) => {
            const aText = a.cells[columnIndex].innerText.trim();
            const bText = b.cells[columnIndex].innerText.trim();

            if (isNaN(aText) || isNaN(bText)) {
                return isAscending ? aText.localeCompare(bText) : bText.localeCompare(aText);
            } else {
                return isAscending ? aText - bText : bText - aText;
            }
        });

        // Toggle the sort order attribute and update arrow
        headerElement.setAttribute("data-sort", isAscending ? "desc" : "asc");
        headerElement.querySelector("span").innerHTML = isAscending ? "&#9660;" : "&#9650;"; // ▼ for desc, ▲ for asc

        // Clear current table body and re-add sorted rows
        tableBody.innerHTML = "";
        sortedRows.forEach(row => tableBody.appendChild(row));
    }
    document.addEventListener('DOMContentLoaded', function() {
            // Pagination variables
            const rows = document.querySelectorAll('#pegawaiTable tbody tr'); // Select all rows from the table
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

    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>

