@include('partials.header')
    <x-navigation/>
    <x-firstsection/>
    
    <section class="bg-gray-100 py-8">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <!-- Left Column (Picture) -->
            <div class="w-full md:w-1/3 mb-4 md:mb-0 flex md:ml-28 justify-center md:justify-end">
                <img src="{{ Vite::asset('/resources/images/landingpage_pic1.png') }}" alt="Placeholder Image" class="w-4/5 md:w-full h-auto">
            </div>
            <!-- Right Column (Text with border) -->
            <div class="w-full md:w-2/3 flex justify-center">
                <div class="bg-white p-6 border border-gray-300 rounded-lg max-w-2xl mx-4 flex flex-col justify-center h-72">
                    <h2 class="text-2xl font-bold mb-4">Join Us Now For Free! We Have a Very Welcome Community</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="py-16 bg-gradient-to-r from-gray-900 via-indigo-900 to-purple-900 ...">
        <div class="container mx-auto px-4 text-gray-100">
            <h2 class="text-5xl font-bold mb-12 text-center sm:pl-16 sm:mb-40 sm:text-left">Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="text-center pb-8 border-b-2 sm:border-r-2 sm:border-b-0 ">
                    <div class="flex justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="feature-icon" viewBox="0 -960 960 960" width="24px" fill="#EFEFEF"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm0-80h480v-400H240v400Zm240-120q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80ZM240-160v-400 400Z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Secured Identity</h3>
                    <p class="mx-auto" style="max-width: 80%;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum.</p>
                </div>
                <!-- Feature 2 -->
                <div class="text-center pb-8 border-b-2 sm:border-r-2 sm:border-b-0 text-gray-100 sm:pr-8">
                    <div class="flex justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="feature-icon" viewBox="0 -960 960 960" width="24px" fill="#EFEFEF"><path d="M240-400h480v-80H240v80Zm0-120h480v-80H240v80Zm0-120h480v-80H240v80ZM880-80 720-240H160q-33 0-56.5-23.5T80-320v-480q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v720ZM160-320h594l46 45v-525H160v480Zm0 0v-480 480Z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Share Your Thoughts</h3>
                    <p class="mx-auto" style="max-width: 80%;">Cras venenatis euismod malesuada. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    
                </div>
                <!-- Feature 3 -->
                <div class="text-center">
                    <div class="flex justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="feature-icon" viewBox="0 -960 960 960" width="24px" fill="#EFEFEF"><path d="M38-428q-18-36-28-73T0-576q0-112 76-188t188-76q63 0 120 26.5t96 73.5q39-47 96-73.5T696-840q112 0 188 76t76 188q0 38-10 75t-28 73q-11-19-26-34t-35-24q9-23 14-45t5-45q0-78-53-131t-131-53q-81 0-124.5 44.5T480-616q-48-56-91.5-100T264-760q-78 0-131 53T80-576q0 23 5 45t14 45q-20 9-35 24t-26 34ZM0-80v-63q0-44 44.5-70.5T160-240q13 0 25 .5t23 2.5q-14 20-21 43t-7 49v65H0Zm240 0v-65q0-65 66.5-105T480-290q108 0 174 40t66 105v65H240Zm540 0v-65q0-26-6.5-49T754-237q11-2 22.5-2.5t23.5-.5q72 0 116 26.5t44 70.5v63H780ZM480-210q-57 0-102 15t-53 35h311q-9-20-53.5-35T480-210Zm-320-70q-33 0-56.5-23.5T80-360q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T160-280Zm640 0q-33 0-56.5-23.5T720-360q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T800-280Zm-320-40q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-440q0 50-34.5 85T480-320Zm0-160q-17 0-28.5 11.5T440-440q0 17 11.5 28.5T480-400q17 0 28.5-11.5T520-440q0-17-11.5-28.5T480-480Zm0 40Zm1 280Z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Make Friends</h3>
                    <p class="mx-auto" style="max-width: 80%;">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                    <!-- No line after the last feature -->
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-100 py-20 text-center sm:text-left">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4">
            <!-- Text content (left side on mobile, top on desktop) -->
            <div class="md:w-1/2 md:pr-10">
                <h2 class="text-3xl text-center font-bold mb-6">How the Web Application Works?</h2>
                <p class="mb-6 sm:pl-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada.</p>
                <p class="mb-6 sm:pl-14">Donec ullamcorper nulla non metus auctor fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum.</p>
            </div>
            
            <!-- Photo (right side on mobile, bottom on desktop) -->
            <div class="md:w-1/2 md:pl-10 mt-10 md:mt-0">
                <img src="{{ Vite::asset('/resources/images/landingpage_pic2.png') }}" alt="Placeholder Image" class="rounded-lg">
            </div>
        </div>
    </section>

    <section class="bg-gray-100 pb-8 md:pb-16 ">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4">
            <!-- Photo (left side on mobile, top on desktop) -->
            <div class="md:w-1/2 md:pl-16 order-2 md:order-1 mb-6 md:mb">
                <img src="{{ Vite::asset('/resources/images/landingpage_pic3.png') }}" alt="Placeholder Image" class="rounded-sm">
            </div>
            
            <!-- Paragraph (right side on mobile, bottom on desktop) -->
            <div class="md:w-1/2 md:pl-10 order-1 md:order-2 text-center sm:text-right">
                <p class="pb-8 text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada. Donec ullamcorper nulla non metus auctor fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
    </section>
    <x-events/>
@include('partials.footer')