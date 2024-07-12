
    <div class=" bg-gray-900 text-gray-200 p-4 w-full overflow-y-auto sm:w-1/4">
        <h2 class="text-xl font-bold mb-4 text-center sm:text-left">Mental Health Conditions</h2>
        <div class="max-h-200 overflow-y-auto">
            <ul class="text-sm sm:text-md space-y-2" id="sidebar">
                <!-- Your list items here -->
                @foreach ($conditions as $condition)
                <a href="/conditions/{{ $condition }}" class="block p-2 bg-gray-900 rounded transition duration-300 hover:bg-gray-700"
                onclick="handleItemClick(this)">
                {{ $condition }}
            </a>
                @endforeach
                <!-- Repeat items as needed to demonstrate scrolling -->
            </ul>
        </div>
    </div>
