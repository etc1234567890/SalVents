@include('partials.admin.adminhead')
<x-admin.sidebar />
<!-- Main Content -->
<div class="flex-1 flex flex-col ml-72">
    <x-admin.navbar />
    <!-- Dashboard Content -->
    <div class="p-4 space-y-4">
        <!-- Statistics Boxes -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-green-200 p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Number of Recent Active Users (30 days)</h2>
                <p class="text-gray-500 text-2xl">{{ $statistics['activeUsers'] }}</p>
            </div>
            <div class="bg-purple-200 p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Number of Users</h2>
                <p class="text-gray-500 text-2xl">{{ $statistics['users'] }}</p>
            </div>
            <div class="bg-yellow-100 p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Number of Upcoming Events</h2>
                <p class="text-gray-500 text-2xl">{{ $statistics['events'] }}</p>
            </div>
            <div class="bg-red-200 p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Number of Reports</h2>
                <p class="text-gray-500 text-2xl">{{ $statistics['reports'] }}</p>
            </div>
        </div>
        <!-- Additional Content -->
        <div class="bg-indigo-100 p-6 rounded-lg shadow mt-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">New User Registrations</h2>
            <ul>
                @foreach ($newUsers as $user)
                    <!-- List of new user registrations -->
                    <li class="py-2 border-b border-gray-200">{{ $user->name }}</li>
                @endforeach
            </ul>
        </div>
        <div class="bg-indigo-100 p-6 rounded-lg shadow mt-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Recently Active Users</h2>
            <ul>
                @foreach ($recentActiveUsers as $user)
                    <!-- List of recently active users -->
                    <li class="py-2 border-b border-gray-200">{{ $user->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
</div>

@include('partials.admin.adminfoot')