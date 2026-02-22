<x-blog-layout>
    <x-slot name="title">Home</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Welcome to Our Blog
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Discover amazing stories, insights, and knowledge from our community of writers.
            </p>
        </div>

        <!-- Categories -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Categories</h2>
            <div class="flex flex-wrap gap-3">
                @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category) }}" 
                       class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                        {{ $category->name }}
                        <span class="ml-2 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 px-2 py-1 text-xs rounded-full">
                            {{ $category->posts_count }}
                        </span>
                    </a>
                @endforeach
            </div>
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
                        <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
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

                        <!-- Read More Button -->
                        <div class="mt-4">
                            <a href="{{ route('posts.show', $post) }}" 
                               class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 font-medium">
                                Read more
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
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