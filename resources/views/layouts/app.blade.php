<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tasty Food')</title>

    {{-- Font sesuai desain: Montserrat (judul) & Poppins (isi) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- Tailwind via CDN (untuk development). Saat production, ganti dengan build Vite. --}}
    <script src="https://cdn.tailwindcss.com"></script>

    @stack('styles')
</head>
<body class="flex min-h-screen flex-col bg-white font-['Poppins',sans-serif] text-neutral-900 antialiased">

    {{-- ================= HEADER =================
         Halaman bisa mengubah gaya header lewat @section('header_class', '...').
         Contoh: Home memakai header transparan yang menimpa hero. --}}
    <header class="@yield('header_class', 'relative bg-[#f4f4f4] text-black') z-50">
        <div class="mx-auto flex w-full max-w-6xl items-center justify-between px-6 py-8 lg:justify-start">

            {{-- Logo --}}
            <a href="{{ route('home') }}"
               class="font-['Montserrat',sans-serif] text-2xl font-extrabold uppercase tracking-tight lg:text-[28px]">
                Tasty Food
            </a>

            {{-- Menu desktop --}}
            <nav class="hidden lg:ml-10 lg:block" aria-label="Menu utama">
                <ul class="flex items-center gap-7 text-[11px] font-medium uppercase tracking-wide">
                    <li>
                        <a href="{{ route('home') }}"
                           class="transition hover:text-amber-500 {{ request()->routeIs('home') ? 'border-b-2 border-current pb-1 font-semibold' : '' }}">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}"
                           class="transition hover:text-amber-500 {{ request()->routeIs('about*') ? 'border-b-2 border-current pb-1 font-semibold' : '' }}">
                            Tentang
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('news') }}"
                           class="transition hover:text-amber-500 {{ request()->routeIs('news*') ? 'border-b-2 border-current pb-1 font-semibold' : '' }}">
                            Berita
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gallery') }}"
                           class="transition hover:text-amber-500 {{ request()->routeIs('gallery*') ? 'border-b-2 border-current pb-1 font-semibold' : '' }}">
                            Galeri
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}"
                           class="transition hover:text-amber-500 {{ request()->routeIs('contact*') ? 'border-b-2 border-current pb-1 font-semibold' : '' }}">
                            Kontak
                        </a>
                    </li>

                    @auth
                        @if (auth()->user()->role === 'admin')
                            <li>
                                <a href="{{ route('admin.index') }}" class="transition hover:text-amber-500">Dashboard Admin</a>
                            </li>
                        @endif
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="bg-amber-400 px-4 py-2 text-[11px] font-semibold uppercase tracking-wide text-black transition hover:bg-amber-300">
                                    Keluar
                                </button>
                            </form>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}"
                               class="inline-block bg-amber-400 px-4 py-2 text-[11px] font-semibold uppercase tracking-wide text-black transition hover:bg-amber-300">
                                Masuk
                            </a>
                        </li>
                    @endauth
                </ul>
            </nav>

            {{-- Tombol menu mobile --}}
            <button id="menu-toggle" type="button"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-md lg:hidden"
                    aria-label="Buka menu" aria-controls="mobile-menu" aria-expanded="false">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        {{-- Menu mobile --}}
        <nav id="mobile-menu" class="hidden border-t border-neutral-200 bg-[#f4f4f4] px-6 pb-6 text-neutral-900 lg:hidden" aria-label="Menu seluler">
            <ul class="flex flex-col gap-4 pt-4 text-sm font-medium uppercase tracking-wide">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">Tentang</a></li>
                <li><a href="{{ route('news') }}">Berita</a></li>
                <li><a href="{{ route('gallery') }}">Galeri</a></li>
                <li><a href="{{ route('contact') }}">Kontak</a></li>

                @auth
                    @if (auth()->user()->role === 'admin')
                        <li><a href="{{ route('admin.index') }}">Dashboard Admin</a></li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-black px-5 py-2 text-xs font-semibold uppercase text-white">Keluar</button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}" class="inline-block bg-black px-5 py-2 text-xs font-semibold uppercase text-white">Masuk</a>
                    </li>
                @endauth
            </ul>
        </nav>
    </header>

    {{-- ================= KONTEN ================= --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- ================= FOOTER ================= --}}
    <footer class="bg-[#111111] text-white">
        <div class="mx-auto grid w-full max-w-6xl gap-10 px-6 pb-10 pt-16 md:grid-cols-2 lg:grid-cols-[1.4fr_0.7fr_0.7fr_1fr]">

            {{-- Brand + deskripsi + sosial media --}}
            <div>
                <a href="{{ route('home') }}" class="font-['Montserrat',sans-serif] text-2xl font-bold">Tasty Food</a>
                <p class="mt-5 max-w-xs text-[11px] leading-relaxed text-neutral-300">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>

                <div class="mt-6 flex items-center gap-3">
                    <a href="#" aria-label="Facebook"
                       class="flex h-11 w-11 items-center justify-center rounded-full bg-[#1877f2] transition hover:opacity-80">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.5 21v-7.5h2.6l.4-3h-3V8.6c0-.9.3-1.5 1.5-1.5h1.6V4.4c-.3 0-1.2-.1-2.3-.1-2.3 0-3.8 1.4-3.8 3.9v2.3H8v3h2.5V21h3z" />
                        </svg>
                    </a>
                    <a href="#" aria-label="Twitter"
                       class="flex h-11 w-11 items-center justify-center rounded-full bg-[#1d9bf0] transition hover:opacity-80">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Link berguna & privasi (hanya memakai route yang sudah ada; sisanya '#') --}}
            <div class="md:col-span-1 lg:col-span-2">
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-base font-semibold">Link Berguna</h3>
                        <ul class="mt-5 space-y-3 text-[11px] font-medium text-neutral-200">
                            <li><a href="{{ route('news') }}" class="transition hover:text-amber-400">Blog</a></li>
                            <li><a href="#" class="transition hover:text-amber-400">Hewan</a></li>
                            <li><a href="{{ route('gallery') }}" class="transition hover:text-amber-400">Galeri</a></li>
                            <li><a href="#" class="transition hover:text-amber-400">Testimonial</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold">Privasi</h3>
                        <ul class="mt-5 space-y-3 text-[11px] font-medium text-neutral-200">
                            <li><a href="#" class="transition hover:text-amber-400">Karir</a></li>
                            <li><a href="{{ route('about') }}" class="transition hover:text-amber-400">Tentang Kami</a></li>
                            <li><a href="{{ route('contact') }}" class="transition hover:text-amber-400">Kontak Kami</a></li>
                            <li><a href="#" class="transition hover:text-amber-400">Servis</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Informasi kontak --}}
            <div>
                <h3 class="text-base font-semibold">Info Kontak</h3>
                <ul class="mt-5 space-y-4 text-[11px] font-medium text-neutral-200">
                    <li class="flex items-center gap-3">
                        <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4.200-8 5-8-5V6l8 5 8-5v2.200z" />
                        </svg>
                        <a href="mailto:tastyfood@gmail.com" class="transition hover:text-amber-400">tastyfood@gmail.com</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                        </svg>
                        <a href="tel:+628123457890" class="transition hover:text-amber-400">+62 812 3456 7890</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 2a7 7 0 0 0-7 7c0 5.250 7 13 7 13s7-7.750 7-13a7 7 0 0 0-7-7zm0 9.500A2.500 2.500 0 1 1 12 6.500a2.500 2.500 0 0 1 0 5z" />
                        </svg>
                        <span>Kota Bandung, Jawa Barat</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mx-auto max-w-6xl px-6 pb-8 pt-4 text-center text-[10px] text-neutral-300">
            Copyright &copy;{{ date('Y') }} Tasty Food. All rights reserved.
        </div>
    </footer>

    {{-- Toggle menu mobile --}}
    <script>
        (function () {
            const btn = document.getElementById('menu-toggle');
            const menu = document.getElementById('mobile-menu');
            if (!btn || !menu) return;
            btn.addEventListener('click', function () {
                const open = menu.classList.toggle('hidden') === false;
                btn.setAttribute('aria-expanded', open ? 'true' : 'false');
            });
        })();
    </script>

    @stack('scripts')
</body>
</html>