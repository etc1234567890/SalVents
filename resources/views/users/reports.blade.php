@include('partials.header')
    <x-navigation />
    <x-firstsection/>
    <section class="container mx-auto px-4 py-8">
        <div class="flex flex-wrap -mx-4">
            <!-- Left Section (Title and Paragraphs) -->
            <div class="w-full md:w-3/5 px-4 mb-4">
                <div class="bg-white rounded-lg shadow-md p-4 h-full">
                    <h2 class="text-2xl font-bold mb-4">Report Section</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Paragraphs -->
                        <div class="col-span-3 md:col-span-1">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                        <div class="col-span-3 md:col-span-1">
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                        <div class="col-span-3 md:col-span-1">
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Right Section (Report Form) -->
            <div class="w-full md:w-2/5 px-4 mb-4">
                <div class="bg-white rounded-lg shadow-md p-4 h-full">
                    <h2 class="text-2xl font-bold mb-4">Report Form</h2>
                    <!-- Form -->
                    <form action="/report" method="POST" class="space-y-4">
                        @csrf
                        <!-- Author's Name -->
                        <div>
                            <label for="reported" class="block mb-1">Reported Username:</label>
                            <input type="text" id="reported" name="reported" class="w-full border border-gray-300 rounded-lg p-2"
                                placeholder="Enter author's name" value="{{ $this_user->name ?? " " }}" disabled>
                            <input type="hidden" name="reportable_id" id="reportable_id" value="{{ $reportableId ?? " "}}">
                            <input type="hidden" name="reported_id" id="reported_id" value="{{ $this_user->id ?? " "}}">
                        </div>

                        <div>
                            <label for="reportable" class="block mb-1">Content being Reported:</label>
                            <input type="text" id="reportable_type" name="reportable_type" class="w-full border border-gray-300 rounded-lg p-2"
                                placeholder="Enter author's name" value="{{ $reportableType ?? " " }}" hidden>
                            <input type="text" id="reportable" name="reportable" class="w-full border border-gray-300 rounded-lg p-2"
                                placeholder="Enter author's name" value="@if($reportableType === 'App\Models\Post') Post @else Comments/Replies @endif" disabled>
                        </div>
    
                        <!-- Category Dropdown -->
                        <div>
                            <label for="reason" class="block mb-1">Category of Issue:</label>
                            <select id="reason" name="reason" class="w-full border border-gray-300 rounded-lg p-2">
                                <option value="" selected disabled>Choose One</option>
                                <option value="Discrimination">Discrimination</option>
                                <option value="Act of Violence">Hate speech, violence, or threats</option>
                                <option value="Uncivil or Unkind">Uncivil or Unkind</option>
                                <option value="Spam">Spam</option>
                                <option value="Illegal Activities">Illegal Activities (e.g. Posting illegal links)</option>
                                <option value="Explicit Content">Sexually explicit content</option>
                                <option value="Misinformation">Spreading Misinformation</option>
                                <option value="Others">Others (provide the details below)</option> 
                            </select>
                        </div>
    
                        <!-- Other Issues -->
                        <div>
                            <label for="others" class="block mb-1">Others (Please State here):</label>
                            <textarea id="others" name="others" rows="3" class="w-full border border-gray-300 rounded-lg p-2"
                                placeholder="" disabled></textarea>
                        </div>
    
                        <!-- Submit and Cancel Buttons -->
                        <div class="flex justify-end space-x-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Submit</button>
                            <a href="{{ url()->previous() }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
@include('partials.footer')