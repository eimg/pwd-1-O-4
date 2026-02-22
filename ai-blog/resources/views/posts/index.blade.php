<x-blog-layout>
    <x-slot name="title">All Posts</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">All Posts</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $posts->total() }} posts found</p>
            </div>
            @auth
                <a href="{{ route('posts.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Create Post
                </a>
            @endauth
        </div>

        <!-- Posts Grid - Responsive: 3 columns (lg), 2 columns (md), 1 column (sm) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @forelse($posts as $post)
                <article class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <!-- Feature Image -->
                    @if($post->feature_image)
                        <div class="aspect-video overflow-hidden">
                            <img src="{{ $post->feature_image }}" 
                                 alt="{{ $post->title }}"
                                 class="w-full h-full object-cover hover:scale-105 transition duration-300">
                        </div>
                    @endif

                    <div class="p-6">
                        <!-- Category Badge -->
                        <div class="mb-3">
                            <a href="{{ route('categories.show', $post->category) }}" 
                               class="inline-block bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 text-xs font-medium px-2.5 py-0.5 rounded">
                                {{ $post->category->name }}
                            </a>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                            <a href="{{ route('posts.show', $post) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition duration-150">
                                {{ $post->title }}
                            </a>
                        </h3>

                        <!-- Excerpt -->
                        <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($post->body), 120) }}
                        </p>

                        <!-- Meta Information -->
                        <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 mb-4">
                            <div class="flex items-center">
                                <span class="font-medium">{{ $post->user->name }}</span>
                                <span class="mx-2">•</span>
                                <time datetime="{{ $post->created_at->toISOString() }}">
                                    {{ $post->created_at->format('M j, Y') }}
                                </time>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <span>{{ $post->comments->count() }}</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between">
                            <a href="{{ route('posts.show', $post) }}" 
                               class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 font-medium">
                                Read more
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>

                            @can('update', $post)
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('posts.edit', $post) }}" 
                                       class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Are you sure you want to delete this post?')"
                                                class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No posts</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new post.</p>
                    @auth
                        <div class="mt-6">
                            <a href="{{ route('posts.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Create Post
                            </a>
                        </div>
                    @endauth
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
            <div class="flex justify-center">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</x-blog-layout>