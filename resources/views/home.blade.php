<x-layout title="Home">
    <!-- Search Bar -->
    <div class="max-w-2xl mx-auto px-4 mb-10">
        <form action="/posts" method="get">
            <input type="text" name="search" placeholder="Cari postingan..." class="w-full px-5 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:outline-none text-lg dark:bg-gray-800 dark:text-white" />
        </form>
    </div>

    <!-- Featured Post (Latest) -->
    @php
        $featured = \App\Models\Post::latest()->first();
    @endphp
    @if($featured)
    <section class="max-w-4xl mx-auto px-4 mb-12">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 flex flex-col gap-8 border border-gray-100 dark:border-gray-700">
            @if($featured->thumbnail)
                <img src="{{ asset('storage/' . $featured->thumbnail) }}" alt="Thumbnail" class="w-full h-64 object-cover rounded-xl mb-6 shadow">
            @else
                <img src="https://placehold.co/600x300?text=No+Image" alt="No Thumbnail" class="w-full h-64 object-cover rounded-xl mb-6 shadow">
            @endif
            <div class="flex-1">
                <a href="/posts/{{ $featured->slug }}" class="block mb-2">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white hover:underline mb-2">{{ $featured->title }}</h2>
                </a>
                <div class="flex items-center space-x-2 mb-2">
                    <span class="text-xs text-gray-500 dark:text-gray-300">{{ $featured->created_at->format('d M Y') }}</span>
                    <span class="text-xs text-gray-400">•</span>
                    <a href="/posts?category={{ $featured->category->slug }}" class="px-2 py-1 rounded-full text-xs font-semibold {{ $featured->category->color }} bg-indigo-50 dark:bg-indigo-900 dark:text-indigo-200 border border-indigo-200 dark:border-indigo-700">{{ $featured->category->name }}</a>
                </div>
                <p class="text-gray-700 dark:text-gray-200 mb-4 line-clamp-3">{{ strip_tags(Str::limit($featured->body, 180)) }}</p>
                <a href="/posts/{{ $featured->slug }}" class="inline-block mt-2 px-5 py-2 bg-indigo-600 text-white rounded-lg font-semibold shadow hover:bg-indigo-700 transition">Baca Selengkapnya</a>
            </div>
        </div>
    </section>
    @endif

    <!-- Recent Posts Grid -->
    <section class="max-w-5xl mx-auto px-4 mb-16">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Postingan Terbaru</h3>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach(\App\Models\Post::latest()->take(6)->get() as $post)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-5 flex flex-col">
                    @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail" class="w-full h-40 object-cover rounded-lg mb-3 shadow">
                    @else
                        <img src="https://placehold.co/400x200?text=No+Image" alt="No Thumbnail" class="w-full h-40 object-cover rounded-lg mb-3 shadow">
                    @endif
                    <a href="/posts/{{ $post->slug }}" class="block mb-2">
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white hover:underline mb-1 line-clamp-2">{{ $post->title }}</h4>
                    </a>
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="text-xs text-gray-500 dark:text-gray-300">{{ $post->created_at->format('d M Y') }}</span>
                        <span class="text-xs text-gray-400">•</span>
                        <a href="/posts?category={{ $post->category->slug }}" class="px-2 py-1 rounded-full text-xs font-semibold {{ $post->category->color }} bg-indigo-50 dark:bg-indigo-900 dark:text-indigo-200 border border-indigo-200 dark:border-indigo-700">{{ $post->category->name }}</a>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mb-3 line-clamp-3">{{ strip_tags(Str::limit($post->body, 100)) }}</p>
                    <a href="/posts/{{ $post->slug }}" class="mt-auto text-indigo-600 hover:text-indigo-800 font-semibold text-sm">Selengkapnya &rarr;</a>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="/posts" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold shadow hover:bg-indigo-700 transition">Lihat Semua Postingan</a>
        </div>
    </section>

    <!-- Categories -->
    <section class="max-w-4xl mx-auto px-4 mb-16">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Kategori</h3>
        <div class="flex flex-wrap gap-3">
            @foreach(\App\Models\Category::all() as $category)
                <a href="/posts?category={{ $category->slug }}" class="px-4 py-2 rounded-full text-sm font-semibold {{ $category->color }} bg-indigo-50 dark:bg-indigo-900 dark:text-indigo-200 border border-indigo-200 dark:border-indigo-700 hover:shadow-md transition">{{ $category->name }}</a>
            @endforeach
        </div>
    </section>

    <!-- About Section -->
    <section class="max-w-3xl mx-auto px-4 mb-16 text-center">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Tentang BlogSystem</h3>
        <p class="text-gray-600 dark:text-gray-300">BlogSystem adalah platform blog modern berbasis Laravel, tempat berbagi pengetahuan, inspirasi, dan cerita seputar teknologi, pemrograman, dan dunia digital. Temukan postingan menarik, diskusi seru, dan komunitas yang ramah di sini!</p>
    </section>
</x-layout>
