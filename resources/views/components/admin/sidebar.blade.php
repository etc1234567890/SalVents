<!-- Sidebar -->
<div class="flex h-screen">
    <div class="bg-gradient-to-r from-gray-900 via-indigo-900 to-purple-900 w-72 min-h-screen p-4 flex flex-col fixed">
        <!-- Logo -->
        <div class="flex items-center pl-5 space-x-2 mb-4 sm:pl-10">
            <img src="{{Vite::asset('/resources/images/weblogo.png')}}" alt="Logo" class="w-8 h-8">
            <a href="/" class="text-xl font-mono font-bold text-white">SalVents</a>
        </div>
        <!-- Search Bar -->
        <div class="mb-4">
            <input type="text" placeholder="Search..." class="w-full px-4 py-2 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div>
        <!-- Navigation Links -->
        <nav class="flex-1">
            <ul>
                <li class="mb-4">
                    <a href="/admin-dashboard" class="text-white hover:bg-purple-400 hover:text-purple-900 p-2 rounded-lg block">Dashboard</a>
                </li>
                <li class="mb-4">
                    <a href="/user-management" class="text-white hover:bg-purple-400 hover:text-purple-900 p-2 rounded-lg block">User Management</a>
                </li>
                <li class="mb-4">
                    <a href="/contents-management" class="text-white hover:bg-purple-400 hover:text-purple-900 p-2 rounded-lg block">Content Management</a>
                </li>
                <li class="mb-4">
                    <a href="/comments-management" class="text-white hover:bg-purple-400 hover:text-purple-900 p-2 rounded-lg block">Comment Management</a>
                </li>
                <li class="mb-4">
                    <a href="/filed-reports" class="text-white hover:bg-purple-400 hover:text-purple-900 p-2 rounded-lg block">Reports</a>
                </li>
                <li class="mb-4">
                    <a href="/manage-events" class="text-white hover:bg-purple-400 hover:text-purple-900 p-2 rounded-lg block">Events</a>
                </li>
                <li class="mb-4">
                    <a href="/manage-conditions" class="text-white hover:bg-purple-400 hover:text-purple-900 p-2 rounded-lg block">Conditions</a>
                </li>
            </ul>
        </nav>
    </div>