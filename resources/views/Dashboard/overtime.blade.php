<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overtime - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


</head>
<body>
    <x-navbar />
    <x-sidebar />

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Daftar Overtime</h2>

            <!-- Search Bar and Actions -->
            <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 pb-4">
                <div class="flex items-center space-x-2">
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 flex items-center ps-3 pointer-events-none">
                            {{-- <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg> --}}
                        </div>
                        <input type="text" id="table-search" onkeyup="searchTable()" placeholder="Cari Overtime" class="block p-2 pl-10 w-80 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <!-- Filter Options Here -->
                </div>
                <div class="flex space-x-3 mb-4">
                    @role('superadmin|admin|direct_superior|superior|hcs_dept_head|hc_div_head')
                    <a href="{{ route('overtime.create') }}" class="flex items-center px-3 py-2 text-white bg-blue-700 hover:bg-blue-800 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Buat SPL
                    </a>
                    @endrole
                </div>
            </div>

            <!-- Overtime Table -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            {{-- <th scope="col" class="px-6 py-3">ID</th> --}}
                            <th scope="col" class="px-6 py-3">NRP</th>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Request Date</th>
                            <th scope="col" class="px-6 py-3">Start Time</th>
                            <th scope="col" class="px-6 py-3">End Time</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($overtimes as $overtime)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            {{-- <td class="px-6 py-4">{{ $overtime->id }}</td> --}}
                            <td class="px-6 py-4">{{ ($overtime->pegawai)->nrp ?? 'XX' }}</td>
                            <td class="px-6 py-4">{{ optional($overtime->pegawai)->nama ?? 'Unknown' }}</td> <!-- Fix applied here -->
                            <td class="px-6 py-4">{{ $overtime->request_date }}</td>
                            <td class="px-6 py-4">{{ $overtime->start_time }}</td>
                            <td class="px-6 py-4">{{ $overtime->end_time }}</td>
                            <td class="px-6 py-4">{{ $overtime->status }}</td>
                            @role('superadmin|admin|superior|hcs_dept_head|hc_div_head')
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

                                <!-- Edit Icon -->
                                <div class="relative ml-4" style="position: relative; display: inline-block;">
                                    <a href="{{ route('overtime.edit', $overtime->id) }}" class="text-blue-600 hover:text-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                    <span style="position: absolute; bottom: 25px; left: 0; background-color: #E5E7EB; color: #1F2937; padding: 2px 6px; border-radius: 4px; display: none; white-space: nowrap;">Edit</span>
                                </div>

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

            <!-- Pagination -->
            <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0" aria-label="Table navigation">
                {{ $overtimes->links() }}
            </nav>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-1/4 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Are you sure?</h3>
                <p class="mt-2 text-sm text-gray-500">Do you really want to delete this record? This process cannot be undone.</p>
                <div class="mt-4">
                    <button id="cancelButton" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm" onclick="closeDeleteModal()">Cancel</button>
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="mt-2 px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-full shadow-sm">Delete</button>
                    </form>
                </div>
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
                  <label for="approved_note" class="form-label">Approval Note (Optional)</label>
                  <textarea class="form-control" id="approved_note" name="approved_note" rows="3"></textarea>
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
              <div class="mb-3">
                  <label for="verification_note" class="form-label">Verify Note (Optional)</label>
                  <textarea class="form-control" id="verification_note" name="verification_note" rows="3"></textarea>
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
                  <label for="confirmation_note" class="form-label">Confirm Note (Optional)</label>
                  <textarea class="form-control" id="confirmation_note" name="confirmation_note" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-success">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>



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
        function searchTable() {
            let input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById('table-search');
            filter = input.value.toUpperCase();
            table = document.querySelector('table');
            tr = table.getElementsByTagName('tr');

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = 'none';
                td = tr[i].getElementsByTagName('td');
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = '';
                            break;
                        }
                    }
                }
            }
        }
            function openDeleteModal(link) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const url = link.getAttribute('data-url');
            form.action = url;
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
        }

        document.getElementById('cancelButton').addEventListener('click', closeDeleteModal);

        function setApproveAction(action) {
        // Set the action attribute of the approve form dynamically
        document.getElementById('approveForm').action = action;
        }

        function setRejectAction(action) {
            // Set the action attribute of the reject form dynamically
            document.getElementById('rejectForm').action = action;
        }
        function setVerificationAction(action) {
        // Set the action attribute of the verification form dynamically
        document.getElementById('verificationForm').action = action;
        }
        function setConfirmationAction(action) {
        // Set the action attribute of the confirmation form dynamically
        document.getElementById('confirmationForm').action = action;
        }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
