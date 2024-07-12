@include('partials.header')
    <x-navigation />
    <!-- Cover Image Section -->
    <section class="cover-image-container bg-gray-800 text-white overflow-hidden relative">
        <img src="https://via.placeholder.com/1600x400" alt="Cover Image" class="cover-image">
        <button class="change-wallpaper-btn"><a href="/edit"> Manage Profile </a></button>
        
    </section>

    <!-- Profile Content -->
    <main class="container mx-auto px-4 py-8">
        <section class="flex flex-wrap -mx-4">
            <!-- Left Column - About -->
            <div class="w-full md:w-1/4 px-4 mb-4">
                <div class="bg-white rounded-lg shadow-md p-4 text-center">
                    @php
                    // Generate the DiceBear avatar URL using user's ID or another unique attribute
                        $seed = $user->id;
                        $avatar_default = "https://api.dicebear.com/9.x/thumbs/svg?seed={$seed}";
                    @endphp
                    <img src="{{ $user->profile->profile_pic ?? $avatar_default }}" alt="Profile Picture" class="about-profile-img mx-auto border- border-indigo-800 mb-4">
                    <h2 class="text-xl font-semibold">{{$user->name}}</h2>
                    <p class="text-gray-600 text-sm"> {{ $user->email }}</p>
                    <p class="text-gray-600 text-xs"> {{ $user->profile->location ?? 'Unknown Location' }}</p>
                    <p class="text-gray-600 text-xs"> {{ $user->profile->birthdate ?? '00/00/0000' }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-4 mt-4">
                    <h3 class="text-xl font-semibold">About</h3>
                    @if ($user->profile && $user->profile->bio)
                        <p class="text-gray-700 text-center pt-4 pb-4">{{ $user->profile->bio }}</p>
                    @else
                        <p class="flex justify-center items-center h-20 font-bold opacity-45 italic">Set your bio now</p>
                    @endif
                </div>
            </div>

            <!-- Right Column - Posts and Updates -->
            <div class="w-full md:w-3/4 px-4 mb-4">
                <!-- Post Creation Section -->
                <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                    <h2 class="text-xl font-semibold mb-4">What's on your mind, {{$user->name}}?</h2>
                    <form action="/post-store" method="POST">
                        @csrf
                        <input type="text" name="title" class="w-full border rounded-lg p-2 mb-2" maxlength="50" placeholder="Title" value="{{ old('title') }}">
                        @error('title')
                            <p class="text-red-500 text-xs mb-1 ml-1">
                                {{ $message }}
                            </p>
                        @enderror
                        <textarea name="content" class="w-full border rounded-lg p-2 mb-2" rows="3" placeholder="Write something..." value="{{ old('content') }}"></textarea>
                        @error('content')
                            <p class="text-red-500 text-xs mb-2 ml-1">
                                {{ $message }}
                            </p>
                        @enderror
                        <div class="flex col-span-4">
                            <span class="text-2xl pr-4 pl-1 pt-1">#</span>
                            <input type="text" name="tag" id="tagInput" class="w-full border rounded-lg p-2 mb-2" maxlength="50" placeholder="Tags" pattern="[a-zA-Z0-9]+" title="Please enter only letters and numbers (no spaces or special characters)" value="{{ old('tag') }}">
                            @error('tag')
                                <p class="text-red-500 text-xs mt-1 ml-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-4">
                                <select name="is_public" class="border rounded-lg p-2 pr-8">
                                    <option value="1">Public</option>
                                    <option value="0">Private</option>
                                </select>
                                <select name="emotion" class="border rounded-lg p-2 pr-10">
                                    <option value="" selected disabled>How do you feel?</option>
                                    <!-- Add your categories here -->
                                    <option value="Happy">Happy</option>
                                    <option value="Frustrated">Frustrated</option>
                                    <option value="Sad">Sad</option>
                                    <option value="Afraid">Afraid</option>
                                    <option value="Unbothered">Unbothered</option>
                                    <!-- Repeat for more categories -->
                                </select>
                                @error('emotion')
                                <p class="text-red-500 text-xs mt-1 ml-1">
                                    {{ $message }}
                                </p>
                            @enderror
                            </div>
                            <button type="submit" class="bg-indigo-700 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition duration-300">Post</button>
                        </div>
                    </form>
                </div>

                <!-- Posts Section -->
                <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Posts</h2>
                    </div>
                    @if($posts->isEmpty())
                        <div class="flex justify-center items-center h-32">
                            <p class="text-gray-500">Come on! Share how's your day went!</p>
                        </div>
                    @else
                        <!-- Example Post -->
                        @foreach($posts as $post)
                        <div class="bg-gray-100 p-4 ring-2 ring-gray-400 rounded-lg mb-4 relative">
                            <div class="flex justify-between items-center mb-2">
                                <div>
                                    <h3 class="font-semibold text-lg">{{ $post->title }}</h3>
                                    <p class="text-sm text-gray-500">Posted on {{ $post->created_at->format('F j, Y, g:i a') }}</p>
                                </div>
                                <div class="relative">
                                    <button id="dropdownMenuButton-{{ $post->id }}" class="text-gray-500 hover:text-gray-700">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v.01M12 12v.01M12 18v.01"></path>
                                        </svg>
                                    </button>
                                    <div id="dropdownMenu-{{ $post->id }}" class="hidden absolute right-0 w-48 bg-white border border-gray-300 rounded-lg shadow-lg z-50">
                                        <form method="POST" action="/posts/{{ $post->id }}" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                            @csrf
                                            @method('DELETE');
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Delete Post</button>
                                        </form>
                                        <a class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100" href="/contents/{{ $post->id }}">View Post</a>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-800 mb-16 sm:mb-7">{{ $post->content }}</p>
                            <div class="absolute bottom-2 right-2 flex items-center space-x-2">
                                <select class="border-gray-400 rounded-lg p-2 pr-10"
                                        onchange="updatePostStatus(this, {{ $post->id }})">
                                    <option value="1" {{ $post->is_public ? 'selected' : '' }}>Public</option>
                                    <option value="0" {{ !$post->is_public ? 'selected' : '' }}>Private</option>
                                </select>
                                <div class="border rounded-lg p-2 bg-white">{{$post->emotion}}</div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>

                <!-- Friends Section -->
                <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                    <h2 class="text-xl font-semibold mb-4">Friends</h2>
                    <!-- Example Friend List -->
                    <ul>
                        <li class="flex items-center mb-2">
                            <img src="https://via.placeholder.com/40" alt="Friend" class="rounded-full w-8 h-8 object-cover">
                            <span class="ml-2">Friend Name</span>
                        </li>
                        <!-- Repeat friend list items -->
                    </ul>
                </div>
            </div>
        </section>
    </main>
    <script>
        function updatePostStatus(selectElement, postId) {
            const status = selectElement.value; // Get the selected status (1 for public, 0 for private)

            // Send AJAX request to update post status
            fetch(`/update-post-status/${postId}`, {
                method: 'PUT', // Use PUT method for update
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token
                },
                body: JSON.stringify({ status }) // Send selected status in JSON format
            })
            .then(response => response.json())
            .then(data => {
                // Handle success response (if needed)
                console.log('Post status updated successfully:', data);
            })
            .catch(error => {
                // Handle error (if needed)
                console.error('Error updating post status:', error);
            });
        }    
    </script>  
    
@include('partials.footer')
