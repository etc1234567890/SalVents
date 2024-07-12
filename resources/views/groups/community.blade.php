@include('partials.header')
    <x-navigation/>
    <x-firstsection/>
    <section class="bg-white py-6 px-4 md:px-8">
        <div class="max-w-3xl w-full mx-auto flex flex-col items-center md:flex-row md:items-center md:justify-between">
            <!-- Search Bar -->
            <div class="relative w-full mb-4 md:mb-0 md:flex-1">
                <input type="text" placeholder="Search groups..." class="w-full px-4 py-2 border border-gray-300 rounded-l-md md:rounded-md focus:outline-none focus:border-blue-500">
                <button class="absolute right-0 top-0 h-full px-4 bg-blue-500 text-white rounded-r-md md:rounded-md flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.207 13.207a6 6 0 111.414-1.414l3.585 3.585a1 1 0 11-1.414 1.414l-3.586-3.586zM10 16a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <!-- Category Dropdown -->
            <div class="w-full flex justify-center md:w-auto md:ml-4">
                <div class="relative">
                    <button id="categoryButton" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md focus:outline-none">
                        Categories 
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-1 -mt-1" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="m260-520 220-360 220 360H260ZM700-80q-75 0-127.5-52.5T520-260q0-75 52.5-127.5T700-440q75 0 127.5 52.5T880-260q0 75-52.5 127.5T700-80Zm-580-20v-320h320v320H120Zm580-60q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29Zm-500-20h160v-160H200v160Zm202-420h156l-78-126-78 126Zm78 0ZM360-340Zm340 80Z"/></svg>
                    </button>
                    <ul id="categoryDropdown" class="absolute left-0 mt-2 w-40 bg-white shadow-lg rounded-md overflow-hidden hidden z-10">
                        <li class="cursor-pointer px-4 py-2 hover:bg-gray-100">Category 1</li>
                        <li class="cursor-pointer px-4 py-2 hover:bg-gray-100">Category 2</li>
                        <li class="cursor-pointer px-4 py-2 hover:bg-gray-100">Category 3</li>
                        <!-- Add more categories as needed -->
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Groups Section -->
    <section class="container mx-auto px-4 md:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Group Card 1 -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden relative flex">
                <img src="https://via.placeholder.com/400x300" alt="Group Wallpaper" class="w-1/2 object-cover">
                <div class="flex-1 p-4">
                    <div class="flex items-center mb-2">
                        <img src="https://via.placeholder.com/50" alt="Group Profile" class="max-sm:hidden rounded-full w-10 h-10 object-cover mr-2">
                        <div>
                            <h3 class="text-lg font-semibold">Group Name</h3>
                            <p class="text-gray-500 text-sm">Group description Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel mauris eu arcu maximus dictum.</p>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center text-sm text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 4a2 2 0 100 4 2 2 0 000-4zm0 8a2 2 0 100 4 2 2 0 000-4zm0-8a6 6 0 00-6 6c0 2.492 1.525 4.743 3.883 5.727A8.961 8.961 0 011 10c0-4.963 4.037-9 9-9s9 4.037 9 9c0 3.333-1.833 6.226-4.548 7.774A6.002 6.002 0 0010 12z" clip-rule="evenodd" />
                        </svg>
                        <p>100 members</p>
                    </div>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md block mt-4">Join Now</button>
                </div>
            </div>

            <!-- Group Card 2 -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden relative flex">
                <img src="https://via.placeholder.com/400x300" alt="Group Wallpaper" class="w-1/2 object-cover">
                <div class="flex-1 p-4">
                    <div class="flex items-center mb-2">
                        <img src="https://via.placeholder.com/50" alt="Group Profile" class="max-sm:hidden rounded-full w-10 h-10 object-cover mr-2">
                        <div>
                            <h3 class="text-lg font-semibold">Group Name</h3>
                            <p class="text-gray-500 text-sm">Group description Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel mauris eu arcu maximus dictum.</p>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center text-sm text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 4a2 2 0 100 4 2 2 0 000-4zm0 8a2 2 0 100 4 2 2 0 000-4zm0-8a6 6 0 00-6 6c0 2.492 1.525 4.743 3.883 5.727A8.961 8.961 0 011 10c0-4.963 4.037-9 9-9s9 4.037 9 9c0 3.333-1.833 6.226-4.548 7.774A6.002 6.002 0 0010 12z" clip-rule="evenodd" />
                        </svg>
                        <p>150 members</p>
                    </div>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md block mt-4">Join Now</button>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-8">
            <nav class="block">
                <ul class="flex pl-0 rounded list-none flex-wrap">
                    <li>
                        <a class="block hover:bg-gray-200 px-3 py-2 rounded-md mx-1" href="#">&laquo;</a>
                    </li>
                    <li>
                        <a class="block hover:bg-gray-200 px-3 py-2 rounded-md mx-1" href="#">1</a>
                    </li>
                    <li>
                        <a class="block hover:bg-gray-200 px-3 py-2 rounded-md mx-1" href="#">2</a>
                    </li>
                    <li>
                        <a class="block hover:bg-gray-200 px-3 py-2 rounded-md mx-1" href="#">3</a>
                    </li>
                    <li>
                        <a class="block hover:bg-gray-200 px-3 py-2 rounded-md mx-1" href="#">&raquo;</a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
@include('partials.footer')
