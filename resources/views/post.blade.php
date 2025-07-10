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

            @if($post->thumbnail)
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail" class="w-full h-72 object-cover rounded-xl mb-8 shadow">
            @else
                <img src="https://placehold.co/800x400?text=No+Image" alt="No Thumbnail" class="w-full h-72 object-cover rounded-xl mb-8 shadow">
            @endif
            <!-- Title -->
            <h1 class="text-4xl font-extrabold leading-tight text-gray-900 dark:text-white mb-6 tracking-tight">{{ $post['title'] }}</h1>

            <!-- Featured Image (optional, placeholder if not available) -->
            {{-- <img src="{{ $post->featured_image_url ?? 'https://source.unsplash.com/800x400/?blog,writing' }}" alt="Featured" class="w-full h-64 object-cover rounded-xl mb-8"> --}}

            <!-- Content -->
            <div class="prose prose-lg max-w-none text-gray-800 dark:prose-invert dark:text-gray-200 leading-relaxed">
                {!! $post['body'] !!}
            </div>

            <!-- Related Posts -->
            @php
                $relatedPosts = \App\Models\Post::where('category_id', $post->category_id)
                    ->where('id', '!=', $post->id)
                    ->latest()
                    ->take(3)
                    ->get();
            @endphp
            @if($relatedPosts->count())
            <div class="mt-16">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Related Posts</h3>
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach($relatedPosts as $related)
                        <a href="/posts/{{ $related->slug }}" class="block bg-gray-50 dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-4 hover:shadow-lg transition">
                            @if($related->thumbnail)
                                <img src="{{ asset('storage/' . $related->thumbnail) }}" alt="Thumbnail" class="w-full h-32 object-cover rounded-lg mb-3 shadow">
                            @else
                                <img src="https://placehold.co/400x200?text=No+Image" alt="No Thumbnail" class="w-full h-32 object-cover rounded-lg mb-3 shadow">
                            @endif
                            <div class="text-sm text-gray-500 mb-1">{{ $related->created_at->format('d M Y') }}</div>
                            <div class="font-semibold text-gray-900 dark:text-white line-clamp-2 mb-1">{{ $related->title }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-300 line-clamp-2">{{ strip_tags(Str::limit($related->body, 60)) }}</div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
        </article>

        <!-- Comments Section -->
        <div class="mt-12" x-data="{ open: false }">
            <button @click="open = !open" class="px-6 py-2 rounded-lg bg-indigo-600 text-white font-semibold shadow hover:bg-indigo-700 transition mb-4">
                <span x-show="!open">Lihat Komentar</span>
                <span x-show="open">Sembunyikan Komentar</span>
            </button>
            <div x-show="open" x-transition>
                <x-comments :post="$post" />
            </div>
        </div>
    </div>
</main>
</x-layout>
    