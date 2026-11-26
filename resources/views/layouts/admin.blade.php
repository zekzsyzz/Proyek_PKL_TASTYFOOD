<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Tasty Food</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Font sama dengan halaman user: Montserrat (judul) & Poppins (isi) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>

    @stack('styles')
</head>
<body class="flex h-screen overflow-hidden bg-[#f4f4f4] text-neutral-900 antialiased">
@php
    // Gaya menu: aktif = putih, tidak aktif = abu terang di atas hitam
    $linkBase = 'flex items-center gap-3 rounded-lg px-4 py-2.5 text-sm transition focus:outline-none focus-visible:ring-2 focus-visible:ring-white';
    $on       = 'bg-white font-semibold text-black';
    $off      = 'text-neutral-300 hover:bg-neutral-800 hover:text-white';

    $adminName = auth()->user()->name ?? 'Admin';
@endphp

    <!-- Overlay (mobile) -->
    <div id="sidebar-overlay" class="fixed inset-0 z-30 hidden bg-black/50 md:hidden"></div>

    <!-- SIDEBAR ADMIN -->
    <aside id="sidebar"
           class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col justify-between bg-[#111111] text-white transition-transform duration-200 md:static md:translate-x-0">
        <div class="overflow-y-auto">
            <div class="flex items-start justify-between border-b border-neutral-800 px-6 py-5">
                <a href="{{ route('admin.news.index') }}" class="block">
                    <span class="block font-['Montserrat',sans-serif] text-xl font-extrabold uppercase tracking-tight">Tasty Food</span>
                    <span class="mt-1 block text-[11px] font-medium uppercase tracking-[0.2em] text-neutral-400">Admin Panel</span>
                </a>
                <button id="sidebar-close" type="button" class="rounded-md p-1 text-neutral-400 hover:text-white md:hidden" aria-label="Tutup menu">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <nav class="mt-6 space-y-2 px-4" aria-label="Menu admin">
                <a href="{{ route('admin.news.index') }}"
                   class="{{ $linkBase }} {{ request()->routeIs('admin.news*') ? $on : $off }}">
                    <i class="fa-solid fa-newspaper w-5"></i> Kelola Berita
                </a>
                <a href="{{ route('admin.gallery.index') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('admin.gallery*') ? $on : $off }}">
                    <i class="fa-solid fa-images w-5"></i> Kelola Galeri
                </a>
                <a href="{{ route('admin.about.index') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('admin.about*') ? $on : $off }}">
                    <i class="fa-solid fa-circle-info w-5"></i> Kelola Tentang
                </a>

                <a href="{{ route('admin.contacts.index') }}"
                   class="{{ $linkBase }} {{ request()->routeIs('admin.contacts*') ? $on : $off }}">
                    <i class="fa-solid fa-envelope w-5"></i> Pesan Masuk
                </a>
            </nav>
        </div>

        <div>
            <div class="border-t border-neutral-800 p-4">
                <a href="{{ route('home') }}" target="_blank" rel="noopener"
                   class="flex items-center gap-2 rounded-lg border border-neutral-700 px-4 py-2.5 text-sm text-neutral-300 transition hover:border-white hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Website User
                </a>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="border-t border-neutral-800 p-4">
                @csrf
                <button type="submit"
                        class="flex w-full items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-black transition hover:bg-neutral-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- CONTENT AREA -->
    <div class="flex flex-1 flex-col overflow-y-auto">
        <!-- TOPBAR -->
        <header class="sticky top-0 z-20 flex items-center justify-between border-b border-neutral-200 bg-white px-6 py-4 md:justify-end">
            <div class="flex items-center gap-3 md:hidden">
                <button id="sidebar-open" type="button" class="rounded-md p-1 text-neutral-800" aria-label="Buka menu" aria-controls="sidebar">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <span class="font-['Montserrat',sans-serif] text-base font-extrabold uppercase">Tasty Food</span>
            </div>

            <div class="flex items-center gap-3">
                <span class="hidden text-sm text-neutral-600 sm:inline">Halo, <strong class="font-semibold text-black">{{ $adminName }}</strong></span>
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-black font-bold text-white" aria-hidden="true">
                    {{ strtoupper(mb_substr($adminName, 0, 1)) }}
                </div>
            </div>
        </header>

        <!-- MAIN CONTAINER -->
        <main class="flex-1 p-6 md:p-10">
            {{--
                Notifikasi. Jika view yang Anda pakai sudah menampilkan notifikasi sendiri
                (mis. index berita/galeri/pesan versi terbaru), hapus blok ini agar tidak dobel.
            --}}
            @if (session('success'))
                <div role="status" class="mb-6 rounded-lg border-l-4 border-black bg-white p-4 text-sm text-neutral-900 shadow-sm ring-1 ring-neutral-200">
                    <i class="fa-solid fa-circle-check mr-2"></i>{{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        (function () {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const open  = () => { sidebar.classList.remove('-translate-x-full'); overlay.classList.remove('hidden'); };
            const close = () => { sidebar.classList.add('-translate-x-full'); overlay.classList.add('hidden'); };

            document.getElementById('sidebar-open').addEventListener('click', open);
            document.getElementById('sidebar-close').addEventListener('click', close);
            overlay.addEventListener('click', close);
            document.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); });
        })();
    </script>

    @stack('scripts')
</body>
</html>