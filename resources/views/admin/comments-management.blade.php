@include('partials.admin.adminhead')
@php
    use Carbon\Carbon;
@endphp
<x-admin.sidebar />
    <!-- Main Content -->
    <div class="flex-1 flex flex-col ml-72">
        <!-- Navbar -->
        <x-admin.navbar/>
        <!-- User Management Content -->
        <div class="p-4 space-y-4">
            <div class="bg-white p-4 rounded-lg shadow">
                <!-- Search Bar -->
                <form action="/contents-management" method="GET" class="mb-4">
                    <input type="text" name="search" value="{{ request()->input('search') }}" placeholder="Search comments..." class="w-full px-4 py-2 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <button type="submit" class="hidden">Search</button>
                </form>
                <!-- User Table -->
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="w-1/16 py-2">ID</th>
                            <th class="w-1/4 py-2">Creator</th>
                            <th class="w-1/4 py-2">Creator Email</th>
                            <th class="w-1/4 py-2">Reply or Comment</th>
                            <th class="w-1/4 py-2">Status</th>
                            <th class="w-1/4 py-2">Posted At</th>
                            <th class="w-1/4 py-2">Remove Post</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                        <tr>
                            <td class="border px-4 py-2">{{ $comment->id }}</td>
                            <td class="border px-4 py-2">{{ $comment->user->name }}</td>
                            <td class="border px-4 py-2">{{ $comment->user->email }}</td>
                            <td class="border px-4 py-2">{{ $comment->parent_id ? 'Reply' : 'Comment'}}</td>
                            <td class="border px-4 py-2">@if($comment->is_reported == 0) Not Reported @else Reported @endif</td>
                            <td class="border px-4 py-2">{{ Carbon::parse($comment->created_at)->format('F j, Y - h:ia') }}</td>
                            <td class="border px-4 py-2">
                                <a href="/view-comment/{{ $comment->id }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-700 mb-4">View</a>
                                <button onclick="confirmDelete('{{ $comment->id }}')" class="bg-red-500 text-white px-2 py-1 mt-2 rounded hover:bg-red-700">Remove</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>

    <x-admin.delete-modal :message="'Comment/Reply'"/>

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
