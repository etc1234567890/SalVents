@include('partials.header')
<x-navigation />
<!-- Profile Content -->
<main class="container mx-auto px-4 py-8">
    <form action="/update-profile" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        <!-- Cover Image Section -->
        <section class="cover-image-container bg-gray-800 text-white overflow-hidden relative">
            <img src="https://via.placeholder.com/1600x400" alt="Cover Image" class="cover-image">
            <label for="wallpaper" class="absolute bottom-4 left-4 bg-gray-900 text-white px-4 py-2 rounded-lg cursor-pointer z-20">Change Wallpaper</label>
            <input type="file" id="wallpaper" name="wallpaper" accept="image/*" class="hidden">
        </section>

        <div class="flex flex-wrap -mx-4">
            <!-- Left Column - Profile Picture and Basic Info -->
            <div class="w-full md:w-1/4 px-4 mb-4">
                <div class="bg-white rounded-lg shadow-md p-4 text-center">
                    <label for="profile-picture" class="cursor-pointer block mb-2">
                        <img id="profile-picture-preview" src="https://via.placeholder.com/150" alt="Profile Picture" class="rounded-full w-36 h-36 object-cover border-4 border-white mx-auto"/>
                        <span class="text-blue-500 hover:underline">Change Profile Picture</span>
                        <input type="file" id="profile-picture" name="profile-picture" accept="image/*" class="hidden"/>
                    </label>
                </div>
            </div>

            <!-- Right Column - Personal Information -->
            <div class="w-full md:w-3/4 px-4 mb-4">
                <!-- Personal Information Section -->
                <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                    <h2 class="text-xl font-semibold mb-4">Personal Information</h2>
                    <div class="space-y-4">
                        <!-- User Name -->
                        <div class="flex items-center mb-4">
                            <label for="name" class="w-1/4">User Name:</label>
                            <input type="text" id="name" name="name" class="w-3/4 border border-gray-300 rounded-lg p-2" placeholder="Enter your username" value="{{ $user->name }}" required>
                        </div>

                        <!-- Age and Birthdate -->
                        <div class="flex items-center mb-4">
                            <label for="birthdate" class="w-1/4">Birthdate:</label>
                            <input type="date" id="birthdate" name="birthdate" class="w-1/4 border border-gray-300 rounded-lg p-2" max="{{ date('Y-m-d') }}" value="{{ $user->profile->birthdate ?? ""}}">
                            <label for="age" class="ml-4">Age:</label>
                            <input type="number" id="age" name="age" class="w-1/4 border border-gray-300 rounded-lg p-2 ml-2" disabled>
                        </div>

                        <!-- Location -->
                        <div class="flex items-center mb-4">
                            <label for="location" class="w-1/4">Location:</label>
                            <input type="text" id="location" name="location" class="w-3/4 border border-gray-300 rounded-lg p-2" placeholder="Enter your location" value="{{ $user->profile->location ?? "" }}">
                        </div>

                        <!-- Email Address -->
                        <div class="flex items-center mb-4">
                            <label for="email" class="w-1/4">Email Address:</label>
                            <input type="email" id="email" name="email" class="w-3/4 border border-gray-300 rounded-lg p-2" placeholder="Enter your email address" value="{{ $user->email }}" disabled>
                        </div>

                        <!-- Password -->
                        <div class="flex items-center mb-4">
                            <label for="password" class="w-1/4">Password:</label>
                            <input type="password" id="password" name="password" class="w-3/4 border border-gray-300 rounded-lg p-2" placeholder="Enter your password" value="{{ $user->password }}" disabled>
                            <a href="/reset-request/{{ $user->email }}" class="bg-gray-300 text-gray-700 px-2 py-2 text-center rounded-lg ml-2 hover:bg-gray-400 transition duration-300">Change Password</a>
                        </div>

                        <!-- About Yourself -->
                        <div class="mb-4">
                            <label for="bio" class="block mb-1">About Yourself:</label>
                            <textarea id="bio" name="bio" rows="3" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Write something about yourself" value="{{ $user->profile->bio ?? " " }}"></textarea>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Confirm</button>
                        <a href="/profile" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg ml-4">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>

@include('partials.footer')
