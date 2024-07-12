@include('partials.header')
    <x-navigation/>
    <x-firstsection/>
    <section class="container mx-auto px-4 py-8">
        <div class="flex flex-wrap -mx-4">
            <!-- Post Section -->
            <div class="w-full md:w-2/5 px-4 mb-4">
                <div class="bg-white rounded-lg shadow-md p-4 relative">
                    <!-- Flag Icon and Tooltip -->
                    <div class="absolute top-0 right-0 mt-2 mr-5 group">
                        <div class="relative">
                            <a href="/reports/{{ $posts->user->id }}/post/{{ $posts->id }}" class="block">
                                <!-- Replace with your flag icon SVG or FontAwesome icon -->                            
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#434343 group-hover:text-red-600" >
                                    <path d="M200-120v-680h360l16 80h224v400H520l-16-80H280v280h-80Zm300-440Zm86 160h134v-240H510l-16-80H280v240h290l16 80Z"/>
                                </svg>
                                <!-- Floating Report Tooltip -->
                                <div class="opacity-0 group-hover:opacity-100 bg-gray-800 text-white text-xs rounded py-1 px-2 absolute right-8 -top-4 transform translate-x-full whitespace-nowrap">
                                    Report post
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- User Profile and Post Info -->
                    <div class="flex items-center mb-4">
                        @php
                        // Generate the DiceBear avatar URL using user's ID or another unique attribute
                            $seed = $posts->user->id;
                            $avatar_default = "https://api.dicebear.com/9.x/thumbs/svg?seed={$seed}";
                        @endphp
                        <img src="{{ $posts->user->profile->profile_pic ?? $avatar_default }}" alt="Profile Picture" class="rounded-full w-12 h-12 object-cover">
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold">{{ $posts->user->name ?? 'Invalid Username' }}</h2>
                            <p class="text-gray-600">{{ $posts->created_at ?? '00/00/0000' }}</p>
                        </div>
                    </div>
                    <!-- Post Title and Content -->
                    <h3 class="text-2xl font-bold mb-4">{{ $posts->title }}</h3>
                    <p class="text-gray-700 mb-14">{{ $posts->content }}</p>
                    <!-- Writer's Feelings -->
                    <div class="bg-gray-100 p-2 rounded-lg absolute bottom-4 right-4">
                        <p class="text-gray-700">Feeling: {{ $posts->emotion }}</p>
                    </div>
                </div>
            </div>

            <!-- Discussion Section -->
            <div class="w-full md:w-3/5 px-4 mb-4">
                <div class="bg-white rounded-lg shadow-md p-4 discussion-section">
                    <h3 class="text-xl font-bold mb-4 text-left">Discussion</h3>
                    <!-- Comments -->
                    <div class="mb-4">
                        @foreach($posts->comments->where('parent_id', null) as $comment)
                        <div class="flex items-start mb-2 relative">
                            @php
                                // Generate the DiceBear avatar URL using user's ID or another unique attribute
                                $seed_com = $comment->user->id;
                                $avatar_default_com = "https://api.dicebear.com/9.x/thumbs/svg?seed={$seed_com}";
                            @endphp
                            <img src="{{ $posts->user->profile->profile_pic ?? $avatar_default_com }}" alt="Profile Picture" class="rounded-full w-10 h-10 object-cover">
                            <div class="ml-2 w-full">
                                <div class="absolute top-0 right-0 text-xs text-gray-500">
                                    {{ $comment->created_at }}
                                </div>
                                <p class="text-gray-800"><strong>{{ $comment->user->name }}</strong></p>
                                <p class="text-gray-700">{{ $comment->comment }}</p>
                                <div class="flex items-center space-x-2 text-sm text-gray-500">
                                    <!-- Like button for comment -->
                                    <button class="hover:underline reply-button" data-comment-id="{{ $comment->id }}">Reply</button>
                                    <button class="hover:underline"><a href="/reports/{{ $comment->user->id }}/comment/{{ $comment->id }}">Report</a></button>
                                    @if(Auth::check() && Auth::id() === $comment->user_id)
                                        <form action="/comments/{{ $comment->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>
                                    @endif
                                </div>
                                <!-- Replies -->
                                <div class="replies hidden mt-2" id="replies-{{ $comment->id }}">
                                    @foreach($comment->replies as $reply)
                                        <div class="flex items-start ml-4 mt-2">
                                            @php
                                                // Generate the DiceBear avatar URL using user's ID or another unique attribute
                                                $seed_rep = $reply->user->id;
                                                $avatar_default_rep = "https://api.dicebear.com/9.x/thumbs/svg?seed={$seed_rep}";
                                            @endphp
                                            <img src="{{ $posts->user->profile->profile_pic ?? $avatar_default_rep }}" alt="Profile Picture" class="rounded-full w-10 h-10 object-cover">
                                            <div class="ml-2">
                                                <p class="text-gray-800"><strong>{{ $reply->user->name }}</strong></p>
                                                <p class="text-xs text-gray-500 mb-1">{{ $reply->created_at }}</p>
                                                <p class="text-gray-700">{{ $reply->comment }}</p>
                                                <div class="flex items-center space-x-2 text-sm text-gray-500">
                                                    <!-- Report button for reply -->
                                                    <button class="hover:underline"><a href="/reports">Report</a></button>
                                                    @if(Auth::check() && Auth::id() === $reply->user_id)
                                                        <form action="/replies/{{ $reply->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-500">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Show/Hide Replies Buttons -->
                                @if($comment->replies->count() > 0)
                                    <button class="hover:underline show-replies-button mt-2" data-comment-id="{{ $comment->id }}">Show Replies</button>
                                    <button class="hover:underline hide-replies-button mt-2 hidden" data-comment-id="{{ $comment->id }}">Hide Replies</button>
                                @endif
                                <!-- Reply Form -->
                                <div class="reply-form mt-2 hidden w-full" id="reply-form-{{ $comment->id }}">
                                    <form action="/posts/{{ $posts->id }}/comments/{{ $comment->id }}/reply" method="POST">
                                        @csrf
                                        <input type="text" name="comment" class="border border-gray-300 rounded-lg p-2 mb-2" placeholder="Write a reply...">
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Reply</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
                <!-- Comment Input -->
                <div class="fixed-input bg-white p-4 shadow-md">
                    <form action="/posts/{{ $posts->id }}/comments" method="POST">
                        @csrf
                        <input type="text" name="comment" class="w-full border border-gray-300 rounded-lg p-2 mb-2" placeholder="Write a comment...">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@include('partials.footer')
