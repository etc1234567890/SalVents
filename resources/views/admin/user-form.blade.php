@include('partials.admin.adminhead')
    <x-admin.sidebar />
        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-72">
            <!-- Navbar -->
            <x-admin.navbar/>
            <!-- User Management Form -->
            <div class="p-4 space-y-4">
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Add New User</h2>
                    <form action="/adding-user" method="POST" class="space-y-4">
                        @csrf
                        <!-- Name -->
                        <div>
                            <label for="name" class="block mb-1">Username:</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter user's name" required>
                        </div>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </p>
                        @enderror
                        <!-- Email -->
                        <div>
                            <label for="email" class="block mb-1">Email Address:</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter user's email address" required>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </p>
                        @enderror
                        <!-- Role -->
                        <div>
                            <label for="role" class="block mb-1">Role:</label>
                            <select id="role" name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        @error('role')
                            <p class="text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </p>
                        @enderror
                        <!-- Verification -->
                        <div>
                            <label for="verify" class="block mb-1">Verify:</label>
                            <select id="verify" name="verify" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                                <option value="0">Do not Verify User</option>
                                <option value="1">Verify User</option>
                            </select>
                        </div>
                        @error('verify')
                            <p class="text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </p>
                        @enderror
                        <!-- Password -->
                        <div>
                            <label for="password" class="block mb-1">Password:</label>
                            <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter password" required>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </p>
                        @enderror
                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block mb-1">Confirm Password:</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Confirm password" required>
                        </div>
                        @error('password_confirmation')
                            <p class="text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </p>
                        @enderror
                        <!-- Form Buttons -->
                        <div class="flex justify-between mt-4 space-x-4">
                            <a href="/user-management" class="flex-1 bg-gray-500 text-center text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-300"> Cancel </a>
                            <button type="submit" class="flex-1 bg-indigo-800 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition duration-300">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.admin.adminfoot')