<!-- Navbar -->
<div class="bg-gray-900 text-gray-200 shadow p-4 flex justify-between items-center">
    <h1 class="text-2xl font-semibold text-gray-300">User Management</h1>
    <div class="relative">
        <button id="profileButton" class="flex items-center focus:outline-none">
            <img src="https://cdn-icons-png.freepik.com/512/3177/3177440.png" alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-300">
        </button>
        <!-- Dropdown Menu -->
        <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 z-50 bg-gray-900 text-gray-100 rounded-md shadow-lg py-2">
            <a href="/home" class="block px-4 py-2 text-gray-200 hover:bg-gray-500">Back to SalVents</a>
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-gray-200 hover:bg-gray-500">Logout</button>
            </form>
        </div>
    </div>
</div>