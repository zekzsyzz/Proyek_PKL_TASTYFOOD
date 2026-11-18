<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Tasty Food</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 flex h-screen overflow-hidden">

    <!-- SIDEBAR ADMIN -->
    <aside class="w-64 bg-black text-white flex flex-col justify-between hidden md:flex">
        <div>
            <div class="px-6 py-5 text-xl font-bold tracking-wider border-b border-gray-800">
                TASTY FOOD <span class="text-xs text-yellow-500 block font-normal">ADMIN PANEL</span>
            </div>
            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('admin.news.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition {{ request()->routeIs('admin.news*') ? 'bg-yellow-500 text-black font-semibold' : 'hover:bg-gray-800 text-gray-300' }}">
                    <i class="fa-solid fa-newspaper w-5"></i> Kelola Berita
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition {{ request()->routeIs('admin.gallery*') ? 'bg-yellow-500 text-black font-semibold' : 'hover:bg-gray-800 text-gray-300' }}">
                    <i class="fa-solid fa-images w-5"></i> Kelola Galeri
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition {{ request()->routeIs('admin.contacts*') ? 'bg-yellow-500 text-black font-semibold' : 'hover:bg-gray-800 text-gray-300' }}">
                    <i class="fa-solid fa-envelope w-5"></i> Pesan Masuk
                </a>
            </nav>
        </div>
        <div class="p-4 border-t border-gray-800">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 text-sm text-gray-400 hover:text-white transition">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Website User
            </a>
        </div>
    </aside>

    <!-- CONTENT AREA -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        <!-- TOPBAR -->
        <header class="bg-black text-white shadow px-6 py-4 flex justify-between items-center md:justify-end">
            <span class="md:hidden text-lg font-bold">TASTY FOOD ADMIN</span>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-300">Halo, <strong>Admin</strong></span>
                <div class="w-9 h-9 bg-yellow-500 text-black font-bold rounded-full flex items-center justify-center">
                    A
                </div>
            </div>
        </header>

        <!-- MAIN CONTAINER -->
        <main class="flex-1 p-6 md:p-10">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>