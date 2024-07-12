@include('partials.log')
<!-- Container with background image -->
<div class="bg-cover bg-center h-screen flex items-center justify-center">
    <!-- Form container -->
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
        <!-- App Name and Logo centered -->
        <div class="flex items-center justify-center mb-6">
            <img src="{{ Vite::asset('/resources/images/weblogo.png')}}" alt="App Logo" class="w-10 h-10 mr-2">
            <h1 class="text-4xl font-bold">SalVents</h1>
        </div>

        <!-- Login Form -->
        <form action="/login-process" method="POST" class="space-y-4">
            {{-- Adds csrf token --}}
            @csrf
            <!-- Email -->
            <div>
                <label for="email" class="block mb-1">Email Address:</label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Enter your email address" required>
            </div>

            <!-- Password -->
            <div class="relative">
                <label for="password" class="block mb-1">Password:</label>
                <div class="relative">
                    <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 pr-10" placeholder="Enter your password" required>
                    <button id="password-button" type="button" class="absolute inset-y-0 right-0 flex items-center justify-center px-3 py-2 bg-transparent text-gray-700 focus:outline-none">
                            <svg id="eye-icon-open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hidden" viewBox="0 -960 960 960" fill="#434343"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                            <svg id="eye-icon-close" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 -960 960 960" fill="#434343"><path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/></svg>
                    </button>
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1 ml-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Sign Up Link -->
            <div class="text-center text-sm mt-4">
                <a id="reset-password-link" href="#" class=" text-indigo-800 mb-2 hover:text-indigo-500">Reset Password?</a>
                <p class="text-gray-600">Don't have an account? <a href="/signup" class="font-bold text-indigo-800 hover:text-indigo-500">Create Now</a></p>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between mt-4 space-x-4">
                <button type="button" class="flex-1 bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-300"><a href="/">Cancel</a></button>
                <button type="submit" class="flex-1 bg-indigo-800 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition duration-300">Login</button>
            </div>
        </form>
    </div>
</div>
<script>
    // JavaScript to set the email value in the reset password link
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('reset-password-link').addEventListener('click', function (event) {
            event.preventDefault();
            var email = document.getElementById('email').value.trim(); // Trim to remove extra spaces
            var resetPasswordLink = '{{ route('password-request', ':email') }}';
            resetPasswordLink = resetPasswordLink.replace(':email', encodeURIComponent(email));
            window.location.href = resetPasswordLink;
        });
    });
</script>

</body>
</html>
