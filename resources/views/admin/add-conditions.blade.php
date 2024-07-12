@include('partials.admin.adminhead')
    <x-admin.sidebar />
        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-72">
            <!-- Navbar -->
            <x-admin.navbar/>
            <!-- Condition Form -->
            <div class="p-4 space-y-4">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Add Condition</h2>
                    <form action="/save-condition" method="POST">
                        @csrf
                        <!-- Condition -->
                        <div class="mb-4">
                            <label for="condition" class="block text-gray-700">Condition Name:</label>
                            <input type="text" id="condition" name="condition" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter here" value="{{ old('condition') }}">
                            @error('condition')
                                <p class="text-red-500 text-xs mt-1 ml-1">
                                    {{ $message }}
                                </p>   
                            @enderror
                        </div>
                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">Description:</label>
                            <textarea id="description" name="description" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter description">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1 ml-1">
                                    {{ $message }}
                                </p>   
                            @enderror
                        </div>
                        <!-- Symptoms -->
                        <div class="mb-4">
                            <label for="symptoms" class="block text-gray-700">Symptoms:</label>
                            <textarea id="symptoms" name="symptoms" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter possible symptoms">{{ old('symptoms') }}</textarea>
                            @error('symptoms')
                                <p class="text-red-500 text-xs mt-1 ml-1">
                                    {{ $message }}
                                </p>   
                            @enderror
                        </div>
                        <!-- health Practices -->
                        <div class="mb-4">
                            <label fpr="practices" class="block text-gray-700">Health Practice:</label>
                            <textarea id="practices" name="practices" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter here">{{ old('practice') }}</textarea>
                            @error('practices')
                                <p class="text-red-500 text-xs mt-1 ml-1">
                                    {{ $message }}
                                </p>   
                            @enderror
                        </div>
                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-indigo-700 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition duration-300">Save Condition</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.admin.adminfoot')
