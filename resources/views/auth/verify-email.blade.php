@include('partials.log')
<!-- Container with background image -->
<div class="bg-cover bg-center h-screen flex items-center justify-center">
    <!-- Form container -->
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
        <!-- App Name and Logo centered -->
        <div class="flex items-center justify-center mb-6">
            <img src="{{ Vite::asset('/resources/images/weblogo.png')}}" alt="Email Sent" class="w-16 h-16 mr-2">
            <h1 class="text-4xl font-bold">SalVents</h1>
        </div>

        <!-- Message -->
        <p class="text-center mb-1">We've sent you an email. Please check and verify your account.</p>

        <!-- Re-send Email Section -->
        <div class="text-center">
            <p class="text-gray-600">If the email is not received, click the button below.</p>
            <p class="text-sm text-gray-600">Only 5 attempts per minute.</p>
            <form method="POST" action="{{ route('resend-verification-email') }}">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') }}">
                <button type="submit" class="bg-gray-700 text-white px-4 py-2 mt-7 text-base rounded-lg hover:bg-gray-800 transition duration-300">Re-send Verification Email</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>