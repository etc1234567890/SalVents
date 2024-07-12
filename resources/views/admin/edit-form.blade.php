@include('partials.admin.adminhead')
    <x-admin.sidebar />
        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-72">
            <!-- Navbar -->
            <x-admin.navbar/>
            <!-- User Management Form -->
            <div class="p-8 space-y-4">
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Update User Info</h2>
                    <form action="/updating" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                        <div>
                            <label for="name" class="block mb-1">Username:</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter user's name" value="{{ $user->name }}" required>
                            @error('name')
                            <p class="text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <!-- Email -->
                        <div>
                            <label for="email" class="block mb-1">Email Address:</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter user's email address" value="{{ $user->email }}" required>
                            @error('email')
                            <p class="text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <!-- Location -->
                        <div>
                            <label for="location" class="block mb-1">Location:</label>
                            <input type="text" id="location" name="location" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="" value="{{ $user->profile->location ?? 'NONE' }}">
                            @error('location')
                            <p class="text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <!-- Birthdate -->
                        <div>
                            <label for="date" class="block mb-1">Birthdate:</label>
                            <input type="date" id="birthdate" name="birthdate" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" max="{{ date('Y-m-d') }}" value="{{ $user->profile->birthdate ?? "" }}">
                            @error('birthdate')
                            <p class="text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <!-- Bio -->
                        <div>
                            <label for="bio" class="block mb-1">Bio:</label>
                            <input type="textarea" id="bio" name="bio" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="" value="{{ $user->profile->bio ?? "NONE"}}">
                            @error('bio')
                            <p class="text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <!-- Verification -->
                        <div>
                            <label for="verify" class="block mb-1">Verify:</label>
                            <select id="verify" name="verify" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                                <option value="0">Not Verified</option>
                                <option value="1"  @if($user->email_verified_at) selected @endif>Verified User</option>
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
                            <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter password" value="{{ $user->password }}" required>
                            @error('password')
                            <p class="text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </p>
                            @enderror
                            <input type="text" id="uid" name="uid" value="{{ $user->id }}" hidden>
                        </div>
                        <!-- Form Buttons -->
                        <div class="flex justify-between mt-4 space-x-4">
                            <a href="/user-management" class="flex-1 bg-gray-500 text-white text-center px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-300">Cancel</a>
                            <button type="submit" class="flex-1 bg-indigo-800 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition duration-300">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.admin.adminfoot')