<x-layout title="Kontak">
    <section class="max-w-xl mx-auto px-4 py-16">
        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-4">Hubungi Kami</h1>
        <p class="text-lg text-gray-700 dark:text-gray-300 mb-8">Punya pertanyaan, saran, atau ingin berkolaborasi? Silakan kirim pesan melalui form di bawah ini atau hubungi kami langsung melalui email.</p>
        <form action="#" method="POST" class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 space-y-5">
            <div>
                <label for="name" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Nama</label>
                <input type="text" id="name" name="name" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:outline-none dark:bg-gray-700 dark:text-white" required>
            </div>
            <div>
                <label for="email" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:outline-none dark:bg-gray-700 dark:text-white" required>
            </div>
            <div>
                <label for="message" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Pesan</label>
                <textarea id="message" name="message" rows="5" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:outline-none dark:bg-gray-700 dark:text-white" required></textarea>
            </div>
            <button type="submit" class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700 transition">Kirim Pesan</button>
        </form>
        <div class="mt-8 text-center text-gray-600 dark:text-gray-300">
            <p>Email: <a href="mailto:cahya@codemind.id" class="text-indigo-600 hover:underline">cahya@codemind.id</a></p>
            <p>GitHub: <a href="https://github.com/cahyaapriyana" target="_blank" class="text-indigo-600 hover:underline">cahyaapriyana</a></p>
        </div>
    </section>
</x-layout>
