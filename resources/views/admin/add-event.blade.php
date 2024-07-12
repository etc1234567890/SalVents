@include('partials.admin.adminhead')
    <x-admin.sidebar />
        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-72">
            <!-- Navbar -->
            <x-admin.navbar/>
            <!-- Event Form -->
            <div class="p-4 space-y-4">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Add Event</h2>
                    <form action="/save-event" method="POST">
                        @csrf
                        <!-- Event Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700">Event Title</label>
                            <input type="text" id="title" name="title" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter event title" value="{{ old('title') }}">
                            @error('title')
                                <p class="text-red-500 text-xs mt-1 ml-1">
                                    {{ $message }}
                                </p>   
                            @enderror
                        </div>
                        <!-- Event Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">Event Description</label>
                            <textarea id="description" name="description" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter event description">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1 ml-1">
                                    {{ $message }}
                                </p>   
                            @enderror
                        </div>
                        <!-- Event Link -->
                        <div class="mb-4">
                            <label for="link" class="block text-gray-700">Event Link</label>
                            <input type="url" id="link" name="link" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter event link" value="{{ old('link') }}">
                            @error('link')
                                <p class="text-red-500 text-xs mt-1 ml-1">
                                    {{ $message }}
                                </p>   
                            @enderror
                        </div>
                        <!-- Event Date -->
                        <div class="mb-4">
                            <label for="date" class="block text-gray-700">Event Date</label>
                            <input type="date" id="date" name="date" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            @error('date')
                                <p class="text-red-500 text-xs mt-1 ml-1">
                                    {{ $message }}
                                </p>   
                            @enderror
                        </div>
                        <!-- Event Time -->
                        <div class="mb-4">
                            <label for="dates" class="block text-gray-700 mb-2">Event Duration</label>
                            <div class="flex space-x-4">
                                <input type="time" id="start" name="start" class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <span class="text-center text-2xl font-bold">-</span>
                                <input type="time" id="end" name="end" class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            @error('end')
                                <p class="text-red-500 text-xs mt-1 ml-1">
                                    {{ $message }}
                                </p>   
                            @enderror
                        </div>
                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-indigo-700 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition duration-300">Save Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.admin.adminfoot')
