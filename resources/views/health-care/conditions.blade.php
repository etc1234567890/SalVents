@include('partials.header')
<x-navigation/>
<x-firstsection/>

<section class="flex flex-col sm:h-full sm:flex-row">
    <x-side-bar :conditions="$conditions"/>

    <!-- Main Content -->
    <div class="w-3/4 p-8">
        <!-- Placeholder section -->
        @if(!isset($details))
       <div id="placeholder-section">
            <h1 class="text-lg sm:text-3xl font-bold opacity-45 text-center pt-36 ">Please select an item</h1>
        </div>

        @else
        <div id="placeholder-section">
            <h1 class="text-lg sm:text-3xl font-bold text-center mb-8 ">{{ $details->con_name }}</h1>
        </div>
        <!-- Detailed content section (initially hidden) -->
            <div id="detailed-content-section" class="">
                <!-- Example content for Depression -->
                <div id="depression-content" class="">
                    <div class="mb-8 p-6 bg-white rounded shadow w-72 sm:w-full">
                        <h2 class="text-lg sm:text-2xl font-semibold mb-4">Description</h2>
                        <p class="text-sm sm:text-base">
                            {{ $details->con_description ?? " " }}
                        </p>
                    </div>
                    <div class="mb-8 p-6 bg-white rounded shadow w-72 sm:w-full">
                        <h2 class="text-lg sm:text-2xl font-semibold mb-4">Symptoms</h2>
                        <p class="text-sm sm:text-base">
                            {!! nl2br(e($details->symptoms)) !!}
                        </p>
                    </div>
                    <div class="p-6 bg-white rounded shadow w-72 sm:w-full">
                        <h2 class="text-lg sm:text-2xl font-semibold mb-4">Hospitals/Doctors</h2>
                        <ul class="text-sm sm:text-base space-y-4">
                            <li>
                                <p class="font-bold">Hospital/Doctor Name 1</p>
                                <p>Address: Example Address 1</p>
                                <p>Contact: <a href="tel:+1234567890" class="text-blue-500 hover:underline">+1 234 567 890</a></p>
                            </li>
                            <li>
                                <p class="font-bold">Hospital/Doctor Name 2</p>
                                <p>Address: Example Address 2</p>
                                <p>Contact: <a href="tel:+1234567890" class="text-blue-500 hover:underline">+1 234 567 890</a></p>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
    </div>
</section>
<script>
    // Function to resize sidebar height based on section height
    function resizeSidebarHeight() {
        var sidebar = document.getElementById('sidebar');
        var section = document.querySelector('section');

        if (sidebar && section) {
            var sectionHeight = section.offsetHeight;
            sidebar.style.height = sectionHeight + 'px';
        }
    }

    // Call resizeSidebarHeight initially and on window resize
    window.addEventListener('resize', resizeSidebarHeight);
    window.addEventListener('load', resizeSidebarHeight);
</script>
@include('partials.footer')