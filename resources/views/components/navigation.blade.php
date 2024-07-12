<nav id="navbar" class="bg-transparent shadow-md w-full h-16 fixed top-0 left-0 z-50 transition-colors duration-300">
    <div class="px-4 py-2 flex justify-between items-center h-full">
        <!-- Logo and Website Title -->
        <div class="flex items-center pl-5 space-x-2 sm:pl-10">
            <img src="{{Vite::asset('/resources/images/weblogo.png')}}" alt="Logo" class="w-8 h-8">
            <a href="/" class="text-xl font-mono font-bold text-white">SalVents</a>
        </div>

        <!-- Desktop menu items -->
        <div class="hidden md:flex space-x-8">
            <a href="/home" class="text-white hover:text-gray-500">Home</a>
            <a href="/community" class="text-white hover:text-gray-500">Community</a>
            <a href="/journals" class="text-white hover:text-gray-500">Journals</a>
            <a href="/conditions" class="text-white hover:text-gray-500">Health Care</a>
        </div>

        @auth
        <div class="hidden md:flex items-center space-x-4 pr-10">
            <span class="@if(request()->is('profile')) text-gray-800 @else text-gray-100 @endif"> {{ $user->name }} </span>
            <div class="relative">
                 @php
                    // Generate the DiceBear avatar URL using user's ID or another unique attribute
                    $seed = $user->id;
                    $avatar_default = "https://api.dicebear.com/9.x/thumbs/svg?seed={$seed}";
                @endphp
                <button id="profile-button" class="flex items-center justify-center w-10 h-10 border-2 border-indigo-500 rounded-full hover:border-gray-200 transition duration-300 focus:outline-none">
                    <img src="{{ $user->profile->profile_pic ?? $avatar_default }}" alt="Profile" class="w-8 h-8 rounded-full">
                </button>
                <div id="profile-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
                    <a href="/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">View Profile</a>
                    @if($user->role == "admin") <a href="/admin-dashboard" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Admin Dashboard</a>@endif
                    <button id="logout-button" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 w-full text-left">Logout</button>
                </div>
            </div>
        </div> 
        @else
            <div class="hidden md:flex space-x-4 pr-10">
                <a href="/signup" class="text-white border border-white px-4 py-2 rounded hover:bg-white hover:text-gray-700 transition duration-300">Sign Up</a>
                <a href="/login" class="text-white border border-white px-4 py-2 rounded hover:bg-white hover:text-gray-700 transition duration-300">Login</a>
            </div> 
        @endauth

        <!-- Mobile menu button (hamburger icon) -->
        <div class="md:hidden">
            @auth
                <span class="@if(request()->is('profile')) text-gray-800 @else text-gray-100 @endif"> {{ $user->name }} </span>
            @endauth
            <button id="menu-button" class="text-white hover:text-blue-500 focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile menu items (hidden by default) -->
    <div id="menu" class="hidden md:hidden bg-indigo-900">
        <a href="/home" id="Home" class="block px-4 py-2 text-gray-200 hover:bg-gray-400">Home</a>
        <a href="/community" id="Community" class="block px-4 py-2 text-gray-200 hover:bg-gray-400">Community</a>
        <a href="/journals" id="Journal" class="block px-4 py-2 text-gray-200 hover:bg-gray-400">Journals</a>
        <a href="/conditions" id="Journal" class="block px-4 py-2 text-gray-200 hover:bg-gray-400">Health Care</a>
        @auth
            <a href="/signup" id="Sign Up" class="block px-4 py-2 text-gray-200 hover:bg-gray-400">View Profile</a>
            <a href="#" id="logout-button" class="block px-4 py-2 text-gray-200 hover:bg-gray-400">Logout</a>
            @if($user->role == "admin") <a href="/admin-dashboard" id="logout-button" class="block px-4 py-2 text-gray-200 hover:bg-gray-400">Admin Dashboard</a>@endif
        @else
            <a href="/signup" id="Sign Up" class="block px-4 py-2 text-gray-200 hover:bg-gray-400">Sign Up</a>
            <a href="/login" id="Login" class="block px-4 py-2 text-gray-200 hover:bg-gray-400">Login</a>
        @endauth

    </div>
</nav>

<!-- Modal -->
<div id="logout-modal" class="hidden">
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-80">
            <h2 class="text-lg font-semibold mb-4">Confirm Logout</h2>
            <p class="mb-6">Are you sure you want to logout?</p>
            <div class="flex justify-end space-x-4">
                <button id="cancel-button" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-500">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

