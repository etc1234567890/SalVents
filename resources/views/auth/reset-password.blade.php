@include('partials.log')

<div class="bg-cover bg-center h-screen flex items-center justify-center">
    <!-- Form container -->
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
    <div class="flex items-center justify-center mb-6">
        <img src="{{ Vite::asset('/resources/images/weblogo.png')}}" alt="Email Sent" class="w-16 h-16 mr-2">
        <h1 class="text-4xl font-bold">SalVents</h1>
    </div>
    
    <form method="POST" action="{{ route('password.email') }}" class="mb-6">
        @csrf
        <div>
            <label for="email" class="block">Email</label>
            <input id="email" type="email" name="email" value="{{ $email ?? ' '}}" class="block w-full border-gray-300 rounded-lg mt-1" required autofocus>
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="mt-4">
            <button type="submit" class="bg-indigo-800 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition duration-300">Send Password Reset Link</button>
        </div>
    </form>
    </div>
</div>
</body>
</html>
