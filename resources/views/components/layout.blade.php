<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full">

<div class="min-h-full">
   <x-navbar/>
  
   <x-header :title="$title" />
   <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
  {{-- konten --}}
 
   {{ $slot }}
</div>
</main>
 <!-- Footer -->
 <footer class="bg-gray-900 border-t-4 border-indigo-600 mt-16">
  <div class="max-w-5xl mx-auto px-4 py-10 flex flex-col md:flex-row items-center justify-between gap-4">
      <div class="text-gray-200 text-sm text-center md:text-left">
          &copy; {{ date('Y') }} <span class="font-semibold text-indigo-400">BlogSystem</span>. All rights reserved.
      </div>
      <div class="flex gap-6 text-sm justify-center md:justify-end">
          <a href="/about" class="text-gray-300 hover:text-indigo-400 transition">About</a>
          <a href="/contact" class="text-gray-300 hover:text-indigo-400 transition">Contact</a>
          <a href="https://github.com/cahyaapriyana" target="_blank" class="text-gray-300 hover:text-indigo-400 transition">GitHub</a>
      </div>
  </div>
</footer>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>