@include('partials.header')
    <x-navigation/>
    <x-firstsection/>

    <!-- Search Bar Section -->
    <section class="bg-white py-6 px-4 md:px-8">
        <div class="max-w-3xl w-full mx-auto flex flex-col items-center md:flex-row md:items-center md:justify-between">
            <!-- Search Bar -->
            <div class="relative w-full mb-4 md:mb-0 md:flex-1">
                <form action="/journals" method="GET">
                @csrf 
                <input type="text" name="search" placeholder="Search groups..." class="w-full px-4 py-2 border border-gray-300 rounded-l-md md:rounded-md focus:outline-none focus:border-blue-500">
                <button type="submit" class="absolute right-0 top-0 h-full px-4 bg-indigo-700 text-gray-200 rounded-r-md md:rounded-md flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.207 13.207a6 6 0 111.414-1.414l3.585 3.585a1 1 0 11-1.414 1.414l-3.586-3.586zM10 16a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <!-- Category Dropdown -->
            <div class="w-full flex justify-center md:w-auto md:ml-4">
                <div class="relative">
                    <select name="category" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md pr-10 focus:outline-none">
                        <option value="" disabled>
                            Search by
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-1 -mt-1" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="m260-520 220-360 220 360H260ZM700-80q-75 0-127.5-52.5T520-260q0-75 52.5-127.5T700-440q75 0 127.5 52.5T880-260q0 75-52.5 127.5T700-80Zm-580-20v-320h320v320H120Zm580-60q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29Zm-500-20h160v-160H200v160Zm202-420h156l-78-126-78 126Zm78 0ZM360-340Zm340 80Z"/></svg>
                        </option>
                        <option value="Username">Username</option>
                        <option value="Title">Title</option>
                        <option value="Tags">Tags</option>
                        <!-- Add more categories as needed -->
                    </select>
                </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Groups Section -->
    <section class="container mx-auto px-4 md:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @if($posts->isEmpty())
                <div class="flex text-center items-center h-32 pd-left">
                    <p class="text-gray-400 ">No Results Found</p>
                </div>
            @else
            <!-- Card 1 -->
                @foreach($posts as $post)
                    <div class="relative">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <!-- Card Content Grid -->
                            <div class="grid grid-cols-12 gap-4 p-4">
                                @php
                                // Generate the DiceBear avatar URL using user's ID or another unique attribute
                                    $seed = $post->user->id;
                                    $avatar_default = "https://api.dicebear.com/9.x/thumbs/svg?seed={$seed}";
                                    $wallpaper_default = "https://via.placeholder.com/600x150";
                                @endphp
                                <!-- User Profile -->
                                <div class="col-span-2 flex items-center justify-end relative group profile-picture" data-name="{{ $post->user->name }}" 
                                    data-bio="{{ $post->user->profile->bio ?? 'No bio yet' }}" data-wallpaper="{{ $post->user->profile->wallpaper ?? $wallpaper_default }}">
                                    <img src="{{ $post->user->profile->profile_pic ?? $avatar_default }}" alt="Profile Picture" class="rounded-full border-indigo-800 border-2 w-10 h-10 object-cover cursor-pointer hover:opacity-80">
                                </div>
                                <!-- Journal Post Content -->
                                <div class="col-span-10">
                                    <!-- Title -->
                                    <h3 class="text-xl font-semibold mt-2">{{ $post->title }}</h3>
                                    <!-- Paragraph -->
                                    {{-- <p class="text-gray-700 mb-4">{{ $post->content }}</p> --}}
                                    <!-- View Post Button -->
                                    <a href="/contents/{{ $post->id }}" class="text-blue-500 hover:text-blue-700 xl:pl-96">View Post</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $posts->links('pagination::tailwind') }}
        </div>

        <!-- Floating Window -->
        <div id="floatwindow" class="hidden absolute w-64 bg-white border border-gray-300 shadow-lg rounded-lg p-4 z-50">
            <!-- Author's Wallpaper -->
            <div class="h-24 bg-gray-200 rounded-t-lg mb-2 author-wallpaper"></div>
            <!-- Author's Details -->
            <div>
                <h3 class="font-semibold" id="authorName"></h3>
                <p class="text-sm text-gray-700" id="authorDescription"></p>
            </div>
        </div>
    </section>
@include('partials.footer')

