@include('partials.admin.adminhead')
@php
    use App\Models\User;
    use Carbon\Carbon;
@endphp
    <x-admin.sidebar />
        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-72">
            <!-- Navbar -->
            <x-admin.navbar/>
            <!-- User Reports Content -->
            <div class="p-4 space-y-4">
                <!-- Search Bar -->
                <div class="mb-4">
                    <input type="text" placeholder="Search Reports..." class="w-full px-4 py-2 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
                <!-- Reports Table -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Reports</h2>
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="py-2 px-4 border-b">Reporter</th>
                                <th class="py-2 px-4 border-b">Reported User</th>
                                <th class="py-2 px-4 border-b">Content Type</th>
                                <th class="py-2 px-4 border-b">Content ID</th>
                                <th class="py-2 px-4 border-b">Violations</th>
                                <th class="py-2 px-4 border-b">Date Reported</th>
                                <th class="py-2 px-4 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                            <tr>
                                @php
                                    $reporter = User::where('id', $report->reporter_id)->firstOrFail();
                                    $reported = User::where('id', $report->reported_id)->firstOrFail();
                                @endphp
                                <td class="py-2 px-4 border-b">{{ $reporter->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $reported->name }}</td>
                                <td class="py-2 px-4 border-b">
                                    @if($report->reportable_type == "App\Models\Post")
                                        Post
                                    @else
                                        Comment/Reply
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b">{{ $report->reportable_id }}</td>
                                <td class="py-2 px-4 border-b">
                                @if($report->reason == "Others")
                                    {{ $report->for_others ?? "" }}
                                @else
                                    {{ $report->reason }}
                                @endif
                                </td>
                                <td class="border px-4 py-2">{{ Carbon::parse($report->created_at)->format('F j, Y - h:ia') }}</td>
                                <td class="py-2 px-4 border-b">
                                    <button onclick="confirmDelete('{{ $report->id }}')" class="bg-red-500 text-white px-2 py-1 mt-2 rounded hover:bg-red-700">Remove</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
<div id="confirmDeleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- Modal content -->
        <div class="inline-block align-middle bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                        <!-- Heroicon name: exclamation -->
                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 3h13.856c1.54 0 2.832-1.24 2.832-2.772V10.772C21.75 9.24 20.458 8 18.918 8H5.082C3.542 8 2.25 9.24 2.25 10.772v9.456c0 1.532 1.292 2.772 2.832 2.772z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Is this Issue Resolved? 
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Are you sure this is resolved? It will be removed from the list. This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form id="deleteForm" action="/delete-Report" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="userId" name="userId">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Remove
                    </button>
                </form>
                <button onclick="closeModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

    <script>
        function confirmDelete(userId) {
            document.getElementById('userId').value = userId;
            // document.getElementById('deleteForm').action = '/admin/users/' + userId; 
            document.getElementById('confirmDeleteModal').classList.remove('hidden');
            document.getElementById('confirmDeleteModal').classList.add('block');
        }
    
        function closeModal() {
            document.getElementById('confirmDeleteModal').classList.remove('block');
            document.getElementById('confirmDeleteModal').classList.add('hidden');
        }
    </script>

@include('partials.admin.adminfoot')