<x-layout :title="$title">
<main class="pt-2 pb-8 lg:pt-4 lg:pb-12 antialiased min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="/posts" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-semibold text-sm transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                Kembali ke semua postingan
            </a>
        </div>

        <!-- Post Card -->
        <article class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 mb-12 border border-gray-100 dark:border-gray-700">
            <!-- Author & Category -->
            <div class="flex items-center mb-6">
                <img class="w-14 h-14 rounded-full object-cover border-2 border-indigo-500 shadow" src="{{ $post->author->avatar ? asset('storage/' . $post->author->avatar) : asset('img/default-profile.png') }}" alt="{{ $post->author->name }}">
                <div class="ml-4">
                    <div class="flex items-center space-x-2 mb-1">
                        <a href="/posts?author={{ $post->author->username }}" class="text-lg font-bold text-gray-900 dark:text-white hover:underline">{{ $post->author->name }}</a>
                        <span class="text-xs text-gray-400">•</span>
                        <span class="text-xs text-gray-500 dark:text-gray-300">{{ $post->created_at->format('d M Y') }}</span>
                    </div>
                    <a href="/posts?category={{ $post->category->slug }}" class="inline-block mt-1">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $post->category->color }} bg-indigo-50 dark:bg-indigo-900 dark:text-indigo-200 shadow-sm border border-indigo-200 dark:border-indigo-700">
                            {{ $post->category->name }}
                        </span>
                    </a>
                </div>
            </div>

            <!-- Title -->
            <h1 class="text-4xl font-extrabold leading-tight text-gray-900 dark:text-white mb-6 tracking-tight">{{ $post['title'] }}</h1>

            <!-- Featured Image (optional, placeholder if not available) -->
            {{-- <img src="{{ $post->featured_image_url ?? 'https://source.unsplash.com/800x400/?blog,writing' }}" alt="Featured" class="w-full h-64 object-cover rounded-xl mb-8"> --}}

            <!-- Content -->
            <div class="prose prose-lg max-w-none text-gray-800 dark:prose-invert dark:text-gray-200 leading-relaxed">
                {!! $post['body'] !!}
            </div>
        </article>

        <!-- Comments Section -->
        <div class="mt-12">
            <x-comments :post="$post" />
        </div>
    </div>
</main>
</x-layout>
    