@include('partials.admin.adminhead')
    <x-admin.sidebar />
        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-72">
            <!-- Navbar -->
            <x-admin.navbar/>
            <!-- User Management Form -->
            <div class="p-8 space-y-4">
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold  mb-4 text-center">Post Contents</h2>
                    <div class="text-justify">
                        <p class="font-bold">{{ $comment->parent_id ? 'Reply' : 'Comment'}}</p>
                        <p>{{$comment->comment}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.admin.adminfoot')