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

        <!-- Additional Information Title and Message -->
        <h2 class="text-2xl font-semibold text-center mb-4">You are now a verified user!</h2>
        <p class="text-center mb-6">You can skip and edit this information in your profile later.</p>

        <!-- Additional Information Form -->
        <form action="#" method="POST" class="space-y-4">
            <!-- Address -->
            <div>
                <label for="address" class="block mb-1">Address (optional):</label>
                <input type="text" id="address" name="address" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Enter your address">
            </div>

            <!-- Birthdate -->
            <div>
                <label for="birthdate" class="block mb-1">Birthdate (optional):</label>
                <input type="date" id="birthdate" name="birthdate" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Enter your birthdate">
            </div>

            <!-- About Yourself -->
            <div>
                <label for="about" class="block mb-1">About Yourself (optional):</label>
                <textarea id="about" name="about" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Tell us something about yourself" rows="4"></textarea>
            </div>

            <!-- Submit Button inside the form -->
            <div class="text-right mr-20 pt-1">
                <button type="submit" class="bg-purple-800 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition duration-300">Submit</button>
            </div>
        </form>
        <!-- Skip Button outside the form -->
        <div class="absolute ml-80 bottom-24">
            <a href="/home" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-300">Skip</a>
        </div>
    </div>
</div>

</body>
</html>