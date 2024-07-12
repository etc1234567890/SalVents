<section class="bg-gray-200 py-10">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-8 text-center sm:text-3xl">Articles and Events</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Card 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transform transition-transform duration-300">
                <img src="{{ Vite::asset('/resources/images/article1.png') }}" alt="Article Image" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Article Title 1</h3>
                    <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum.</p>
                    <a href="#" class="text-blue-500 hover:text-blue-700">Follow Link</a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transform transition-transform duration-300">
                <img src="{{ Vite::asset('/resources/images/article2.png') }}" alt="Article Image" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Article Title 2</h3>
                    <p class="text-gray-700 mb-4">Cras venenatis euismod malesuada. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <a href="#" class="text-blue-500 hover:text-blue-700">Follow Link</a>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transform transition-transform duration-300">
                <img src="{{ Vite::asset('/resources/images/article3.png') }}" alt="Article Image" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Article Title 3</h3>
                    <p class="text-gray-700 mb-4">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                    <a href="#" class="text-blue-500 hover:text-blue-700">Follow Link</a>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transform transition-transform duration-300">
                <img src="{{ Vite::asset('/resources/images/article4.png') }}" alt="Article Image" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Article Title 4</h3>
                    <p class="text-gray-700 mb-4">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
                    <a href="#" class="text-blue-500 hover:text-blue-700">Follow Link</a>
                </div>
            </div>
        </div>
    </div>
</section>