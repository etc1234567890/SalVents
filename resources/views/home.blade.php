@include('partials.header')
    <x-navigation/>
    <x-firstsection/>
    <div class="bg-gray-300 py-8">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($posts->isEmpty())
            <div class="flex justify-center items-center h-60">
                <p class="text-xl text-gray-700">No Recent Post, Create your Memories now!</p>
            </div>
            @else
            <h2 class="text-2xl text-center font-bold text-gray-800 sm:text-3xl">Recent Post</h2>
            <div class="mt-8">
                <div class="relative overflow-hidden rounded-lg sm:block hidden">
                    <div class="carousel-wrapper">
                        <div class="carousel-inner flex transition-transform duration-500 ease-in-out">
                            @foreach($posts as $post)
                            <div class="carousel-item w-full sm:w-1/2 px-4 flex-shrink-0">
                                <div class="bg-white rounded-lg shadow-lg p-6 h-60 overflow-y-auto">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="text-xl font-semibold text-gray-900">{{ $post->title }}</h3>
                                        <p class="text-gray-500 text-sm">{{ $post->created_at }}</p>
                                    </div>
                                    <p class="text-gray-700">{{ $post->content }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Navigation arrows -->
                    <button id="prevSlide" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-700 rounded-full p-2 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button id="nextSlide" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-700 rounded-full p-2 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
                @endif
    
                <!-- Mobile View: Stacked Posts -->
                <div class="mt-8 sm:hidden">
                    @foreach($posts as $post)
                    <!-- Post 1 -->
                    <div class="bg-white rounded-lg shadow-lg p-6 mb-4 h-60 overflow-y-auto">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $post->title }}</h3>
                        <p class="text-gray-500 text-sm">{{ $post->created_at }}</p>
                        <p class="text-gray-700">{{ $post->content }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <x-events/>
@include('partials.footer')