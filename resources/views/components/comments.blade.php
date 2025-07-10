<section class="bg-white dark:bg-gray-900 rounded-xl shadow-lg p-8">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 border-b pb-4">Komentar ({{ $post->comments->count() }})</h3>

    @auth
        <!-- Comment Form -->
        <div class="mb-10">
            <form action="{{ route('comments.store', $post->slug) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <textarea
                        id="content"
                        name="content"
                        rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none bg-gray-50 dark:bg-gray-800 dark:text-white"
                        placeholder="Tulis komentar Anda di sini..."
                        required
                    ></textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button
                        type="submit"
                        class="inline-flex items-center px-6 py-2 border border-transparent text-base font-semibold rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition"
                    >
                        Kirim Komentar
                    </button>
                </div>
            </form>
        </div>
    @else
        <div class="mb-10 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg text-center">
            <p class="text-gray-600 dark:text-gray-300">
                Silakan <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500 font-semibold">login</a> untuk menambahkan komentar.
            </p>
        </div>
    @endauth

    <!-- Comments List -->
    <div class="space-y-8">
        @forelse($post->comments as $comment)
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl shadow border border-gray-200 dark:border-gray-700">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        @if($comment->user->avatar)
                            <img class="h-12 w-12 rounded-full object-cover border-2 border-indigo-500" src="{{ asset('storage/' . $comment->user->avatar) }}" alt="{{ $comment->user->name }}">
                        @else
                            <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center border-2 border-indigo-300">
                                <span class="text-indigo-700 font-bold text-lg">{{ substr($comment->user->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center space-x-2 mb-1">
                            <span class="text-base font-semibold text-gray-900 dark:text-white">{{ $comment->user->name }}</span>
                            <span class="text-xs text-gray-400">•</span>
                            <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="text-gray-800 dark:text-gray-200 text-base mb-2">
                            {!! nl2br(e($comment->content)) !!}
                        </div>
                        <div class="flex items-center space-x-4 mt-2">
                            @auth
                                <button
                                    onclick="toggleReplyForm({{ $comment->id }})"
                                    class="text-sm text-indigo-600 hover:text-indigo-500 font-semibold focus:outline-none"
                                >
                                    Balas
                                </button>
                            @endauth
                            @if(auth()->check() && auth()->id() === $comment->user_id)
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')"
                                        class="text-sm text-red-600 hover:text-red-500 font-semibold focus:outline-none ml-2"
                                    >
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        </div>
                        <!-- Reply Form -->
                        @auth
                            <div id="reply-form-{{ $comment->id }}" class="hidden mt-4">
                                <form action="{{ route('comments.reply', $comment) }}" method="POST" class="space-y-3">
                                    @csrf
                                    <textarea
                                        name="content"
                                        rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 resize-none bg-gray-50 dark:bg-gray-700 dark:text-white"
                                        placeholder="Tulis balasan Anda..."
                                        required
                                    ></textarea>
                                    <div class="flex space-x-2">
                                        <button
                                            type="submit"
                                            class="inline-flex items-center px-4 py-1.5 border border-transparent text-sm font-semibold rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        >
                                            Kirim Balasan
                                        </button>
                                        <button
                                            type="button"
                                            onclick="toggleReplyForm({{ $comment->id }})"
                                            class="inline-flex items-center px-4 py-1.5 border border-gray-300 text-sm font-semibold rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        >
                                            Batal
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endauth
                        <!-- Replies -->
                        @if($comment->replies->count() > 0)
                            <div class="mt-6 space-y-4 pl-8 border-l-2 border-indigo-100 dark:border-indigo-700">
                                @foreach($comment->replies as $reply)
                                    <div class="bg-white dark:bg-gray-900 p-4 rounded-lg flex items-start space-x-3 shadow-sm border border-gray-100 dark:border-gray-800">
                                        <div class="flex-shrink-0">
                                            @if($reply->user->avatar)
                                                <img class="h-8 w-8 rounded-full object-cover border border-indigo-400" src="{{ asset('storage/' . $reply->user->avatar) }}" alt="{{ $reply->user->name }}">
                                            @else
                                                <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center border border-indigo-200">
                                                    <span class="text-indigo-700 text-sm font-bold">{{ substr($reply->user->name, 0, 1) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center space-x-2 mb-1">
                                                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $reply->user->name }}</span>
                                                <span class="text-xs text-gray-400">•</span>
                                                <span class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="text-gray-700 dark:text-gray-200 text-sm">
                                                {!! nl2br(e($reply->content)) !!}
                                            </div>
                                            @if(auth()->check() && auth()->id() === $reply->user_id)
                                                <form action="{{ route('comments.destroy', $reply) }}" method="POST" class="inline mt-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="submit"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus balasan ini?')"
                                                        class="text-xs text-red-600 hover:text-red-500 font-semibold focus:outline-none"
                                                    >
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <p class="text-gray-400 text-lg">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
            </div>
        @endforelse
    </div>
</section>

<script>
function toggleReplyForm(commentId) {
    const form = document.getElementById(`reply-form-${commentId}`);
    form.classList.toggle('hidden');
}
</script> 