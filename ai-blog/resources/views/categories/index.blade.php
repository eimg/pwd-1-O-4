<x-blog-layout>
    <x-slot name="title">Categories</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Categories</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Browse posts by category</p>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category) }}" 
                   class="group bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition duration-300 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition duration-150">
                                {{ $category->name }}
                            </h3>
                            <span class="bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 text-sm font-medium px-3 py-1 rounded-full">
                                {{ $category->posts_count }} {{ Str::plural('post', $category->posts_count) }}
                            </span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">
                            Discover {{ $category->posts_count }} {{ Str::plural('post', $category->posts_count) }} in {{ $category->name }}
                        </p>
                        <div class="mt-4 flex items-center text-indigo-600 dark:text-indigo-400 group-hover:text-indigo-500 dark:group-hover:text-indigo-300">
                            <span class="text-sm font-medium">View posts</span>
                            <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition duration-150" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-blog-layout>