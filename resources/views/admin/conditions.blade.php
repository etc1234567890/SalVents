@include('partials.admin.adminhead')
<x-admin.sidebar />
    <!-- Main Content -->
    <div class="flex-1 flex flex-col ml-72">
        <!-- Navbar -->
        <x-admin.navbar/>
        <!-- Condition Content -->
        <div class="p-4 space-y-4">
            <!-- Conditions List -->
            <div class="bg-white p-4 rounded-lg shadow relative -z-50">
                <h2 class="text-xl font-semibold mb-4">List of Mental Health Conditions</h2>
                <div class="absolute top-4 right-4">
                    <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700"><a href="/add-condition">Add Health Condition</a></button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @if($conditions->isEmpty())
                        <div class="flex text-center items-center h-32">
                            <p class="text-gray-400 ">No Conditions on the List</p>
                        </div>
                    @else
                    @foreach ($conditions as $condition)
                        <!-- Condition Tile -->
                        <div class="bg-gray-200 p-4 rounded-lg max-w-96 shadow">
                            <h3 class="text-lg font-semibold mb-2">{{ $condition->con_name }}</h3>
                            <a href="/condition-details/{{ $condition->id }}" class="text-indigo-700 hover:underline">View Condition</a>
                            <a href="#" class="text-red-700 ml-8 hover:underline" onclick="confirmDelete('{{ $condition->id }}')">Delete</a>
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<x-admin.delete-modal :message="'Condition'"/>

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
