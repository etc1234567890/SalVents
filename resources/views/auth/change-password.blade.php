@include('partials.log')

<div class="bg-cover bg-center h-screen flex items-center justify-center">
    <!-- Form container -->
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
        <div class="flex items-center justify-center mb-6">
            <img src="{{ Vite::asset('/resources/images/weblogo.png')}}" alt="Reset Password" class="w-16 h-16 mr-2">
            <h1 class="text-4xl font-bold">SalVents</h1>
        </div>
        
        <!-- Password requirements note -->
        <p class="text-center text-gray-600 mb-6">Please secure your password: It must contain at least 1 uppercase, 1 lowercase, 1 special character, and 1 digit and must be at least 8 characters long.</p>
        
        <form method="POST" action="/password-update" class="mb-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div>
                <label for="password" class="block">Password</label>
                <input id="password" type="password" name="password" class="block w-full border-gray-300 rounded-lg mt-1">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        
            <div class="mt-4">
                <label for="password_confirmation" class="block">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="block w-full border-gray-300 rounded-lg mt-1">
                @error('password_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        
            <div class="mt-4">
                <button type="submit" class="bg-indigo-800 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition duration-300">Proceed</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
