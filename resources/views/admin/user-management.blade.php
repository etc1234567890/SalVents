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
        <div class="p-2 space-y-4">
            <div class="bg-white p-3 rounded-lg shadow">
                <!-- Search Bar -->
                <div class="mb-4">
                    <div class="mb-4">
                        <form action="/user-management" method="GET">
                            <input type="text" name="search" value="{{ request()->input('search') }}" placeholder="Search users..." class="w-full px-4 py-2 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <button type="submit" class="hidden">Search</button>
                        </form>
                    </div>
                </div>
                <!-- User Table -->
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="w-1/16 py-2">Profile</th>
                            <th class="w-1/16 py-2">Username</th>
                            <th class="w-1/16 py-2">Email</th>
                            <th class="w-1/16 py-2">Location</th>
                            <th class="w-1/16 py-2">Birthdate</th>
                            <th class="w-1/16 py-2">Verified</th>
                            <th class="w-1/16 py-2">LastLoggedin</th>
                            <th class="w-1/16 py-2">CreatedAt</th>
                            <th class="w-1/16 py-2">UpdatedAt</th>
                            <th class="w-1/16 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        @php
                            //For Profile Picture
                            $seed = $user->id;
                            $avatar_default = "https://api.dicebear.com/9.x/thumbs/svg?seed={$seed}";
                            $wallpaper_default = "https://via.placeholder.com/600x150";
                        @endphp
                        <tr>
                            <td class="border text-center py-2">
                                <img src="{{ $user->profile->profile_pic ?? $avatar_default }}" alt="Profile Picture" class="rounded-full border-indigo-800 border-2 w-10 h-10 object-cover mx-auto cursor-pointer hover:opacity-80"/>
                            </td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">{{ $user->profile->location ?? "NOT SET" }}</td>
                            <td class="border px-4 py-2">{{ $user->profile->birthdate ?? "NOT SET" }}</td>
                            <th class="w-1/16 py-2 @if($user->email_verified_at) text-green-600 @else text-red-600 @endif">{{ $user->email_verified_at ? 'Verified' : 'Not Yet' }}</th>
                            <td class="border px-4 py-2">{{ Carbon::parse($user->last_login)->format('F j, Y - h:ia') }}</td>
                            <td class="border px-4 py-2">{{ Carbon::parse($user->created_at)->format('F j, Y - h:ia') }}</td>
                            <td class="border px-4 py-2">{{ Carbon::parse($user->updated_at)->format('F j, Y - h:ia') }}</td>
                            <td class="border px-4 py-2">
                                <form action="/update-user/{{$user->id}}" method="GET">
                                    @csrf
                                    <button class="bg-indigo-700 text-white px-2 py-1 mb-2 rounded hover:bg-indigo-500">Edit</button>
                                </form>
                                <button onclick="confirmDelete('{{ $user->id }}')" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-700">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
                <!-- Add User Button -->
                <div class="mt-4">
                    <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700"><a href="/add-user">Add User</a></button>
                </div>
                <div class="mt-4">
                    {{ $users->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
</div>

<x-admin.delete-modal :message="'User'"/>

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
