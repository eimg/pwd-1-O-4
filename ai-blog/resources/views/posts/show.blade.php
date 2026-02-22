<x-blog-layout>
    <x-slot name="title">{{ $post->title }}</x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Post Header -->
        <article class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <!-- Feature Image -->
            @if($post->feature_image)
                <div class="aspect-video overflow-hidden">
                    <img src="{{ $post->feature_image }}" 
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover">
                </div>
            @endif

            <div class="p-8">
                <!-- Category Badge -->
                <div class="mb-4">
                    <a href="{{ route('categories.show', $post->category) }}" 
                       class="inline-block bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 text-sm font-medium px-3 py-1 rounded">
                        {{ $post->category->name }}
                    </a>
                </div>

                <!-- Title -->
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-6">
                    {{ $post->title }}
                </h1>

                <!-- Meta Information -->
                <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-6 mb-8">
                    <div class="flex items-center text-gray-600 dark:text-gray-400">
                        <span class="font-medium">By {{ $post->user->name }}</span>
                        <span class="mx-3">•</span>
                        <time datetime="{{ $post->created_at->toISOString() }}">
                            {{ $post->created_at->format('F j, Y \a\t g:i A') }}
                        </time>
                        <span class="mx-3">•</span>
                        <span>{{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count()) }}</span>
                    </div>

                    @can('update', $post)
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('posts.edit', $post) }}" 
                               class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to delete this post?')"
                                        class="inline-flex items-center px-3 py-2 border border-red-300 dark:border-red-600 rounded-md text-sm font-medium text-red-700 dark:text-red-300 bg-white dark:bg-gray-700 hover:bg-red-50 dark:hover:bg-red-900 transition duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>

                <!-- Post Content -->
                <div class="text-gray-900 dark:text-gray-100 leading-relaxed text-lg max-w-none">
                    <div class="whitespace-pre-wrap">{{ $post->body }}</div>
                </div>
            </div>
        </article>

        <!-- Comments Section -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                Comments ({{ $post->comments->count() }})
            </h2>

            @auth
                <!-- Comment Form -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8">
                    <form method="POST" action="{{ route('comments.store') }}">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Add a comment
                            </label>
                            <textarea name="content" 
                                      id="content" 
                                      rows="4" 
                                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
                                      placeholder="Share your thoughts..."></textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Post Comment
                        </button>
                    </form>
                </div>
            @else
                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6 mb-8 text-center">
                    <p class="text-gray-600 dark:text-gray-400">
                        <a href="{{ route('login') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">Login</a> 
                        or 
                        <a href="{{ route('register') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">register</a> 
                        to leave a comment.
                    </p>
                </div>
            @endauth

            <!-- Comments List -->
            <div class="space-y-6">
                @forelse($post->comments as $comment)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <span class="font-medium text-gray-900 dark:text-white">{{ $comment->user->name }}</span>
                                <span class="mx-2 text-gray-500 dark:text-gray-400">•</span>
                                <time class="text-sm text-gray-500 dark:text-gray-400" datetime="{{ $comment->created_at->toISOString() }}">
                                    {{ $comment->created_at->format('M j, Y \a\t g:i A') }}
                                </time>
                            </div>

                            @can('delete', $comment)
                                <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Are you sure you want to delete this comment?')"
                                            class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            @endcan
                        </div>
                        
                        <div class="text-gray-700 dark:text-gray-300">
                            {!! nl2br(e($comment->content)) !!}
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No comments yet</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Be the first to share your thoughts!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-blog-layout>