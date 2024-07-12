@include('partials.admin.adminhead')
    <x-admin.sidebar />
        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-72">
            <!-- Navbar -->
            <x-admin.navbar/>
            <!-- Event Edit Form -->
            <div class="p-4 space-y-4">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Edit Event</h2>
                    <form action="/save-changes" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $events->id }}">
                        <!-- Event Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700">Event Title</label>
                            <input type="text" id="title" name="title" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter event title" value="{{ $events->title ?? '' }}">
                        </div>
                        <!-- Event Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">Event Description</label>
                            <textarea id="description" name="description" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter event description">{{ $events->description ?? '' }}</textarea>
                        </div>
                        <!-- Event Link -->
                        <div class="mb-4">
                            <label for="link" class="block text-gray-700">Event Link</label>
                            <input type="url" id="link" name="link" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter event link" value="{{ $events->link ?? '' }}">
                        </div>
                        <!-- Event Date -->
                        <div class="mb-4">
                            <label for="date" class="block text-gray-700">Event Link</label>
                            <input type="date" id="date" name="date" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" value="{{  \Carbon\Carbon::parse($events->start_time)->format('Y-m-d') ?? '' }}">
                        </div>
                        <!-- Event Time -->
                        <div class="mb-4">
                            <label for="dates" class="block text-gray-700 mb-2">Event Duration</label>
                            <div class="flex space-x-4">
                                <input type="time" id="start" name="start" class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" value="{{ \Carbon\Carbon::parse($events->start_time)->format('H:i') ?? '' }}">
                                <span class="text-center text-2xl font-bold">-</span>
                                <input type="time" id="end" name="end" class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" value="{{ \Carbon\Carbon::parse($events->end_time)->format('H:i') ?? '' }}">
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-indigo-700 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition duration-300">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.admin.adminfoot')
