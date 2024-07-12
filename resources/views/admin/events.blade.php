@include('partials.admin.adminhead')
<x-admin.sidebar />
    <!-- Main Content -->
    <div class="flex-1 flex flex-col ml-72">
        <!-- Navbar -->
        <x-admin.navbar/>
        <!-- Events Content -->
        <div class="p-4 space-y-4">
            <!-- Events List -->
            <div class="bg-white p-4 rounded-lg shadow relative -z-50">
                <h2 class="text-xl font-semibold mb-4">Upcoming Events</h2>
                <div class="absolute top-4 right-4">
                    <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700"><a href="/add-event">Add Event</a></button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @if($events->isEmpty())
                        <div class="flex text-center items-center h-32">
                            <p class="text-gray-400 ">No Events on the List</p>
                        </div>
                    @else
                    @foreach ($events as $event)
                        <!-- Event Tile -->
                        <div class="bg-gray-200 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">{{ $event->title }}</h3>
                            <p class="text-gray-700 font-semibold text-base mb-2">{{\Carbon\Carbon::parse($event->start_time)->format('Y-m-d')}}</p>
                            <p class="text-gray-700 italic text-sm mb-2">{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') ?? '' }}</p>
                            <a href="/event-details/{{ $event->id }}" class="text-indigo-700 hover:underline">View Event</a>
                            <a href="#" class="text-red-700 ml-8 hover:underline" onclick="confirmDelete('{{ $event->id }}')">Delete Event</a>
                        </div>
                    @endforeach
                    @endif
                    <!-- Repeat similar tiles for other events -->
                </div>
            </div>
        </div>
    </div>
</div>

<x-admin.delete-modal :message="'Event'"/>

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
