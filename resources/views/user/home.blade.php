@extends('layouts.app')

@section('title', 'Tasty Food - Healthy Tasty Food')

{{-- Header transparan & menimpa hero, seperti di desain --}}
@section('header_class', 'absolute inset-x-0 top-0 bg-transparent')

@section('content')
@php
    $news    = $news ?? collect();
    $gallery = $gallery ?? collect();

    $heroImage = asset('asset/img-4.png');          // piring (PNG transparan)
    $featureBg = asset('asset/Group 70@2x.png');   // background gelap section menu

    $features = [
        ['judul' => 'Lorem Ipsum', 'gambar' => asset('asset/img-1.png'), 'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo,'],
        ['judul' => 'Lorem Ipsum', 'gambar' => asset('asset/img-2.png'), 'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo,'],
        ['judul' => 'Lorem Ipsum', 'gambar' => asset('asset/img-3.png'), 'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo,'],
        ['judul' => 'Lorem Ipsum', 'gambar' => asset('asset/img-4.png'), 'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo,'],
    ];

    // Link detail berita: pakai route 'news.show' jika ada, jika tidak ke daftar berita
    $newsUrl = fn ($item) => Route::has('news.show')
        ? route('news.show', $item->slug ?? $item->id)
        : route('news');

    $mainNews = $news->first();
    $sideNews = $news->slice(1, 4);
@endphp

{{-- ============ HERO ============ --}}
<section class="relative overflow-hidden bg-[#f4f4f4]">
    <div class="mx-auto w-full max-w-6xl px-6 pb-12 pt-36 lg:pb-40 lg:pt-52">
        <div class="relative z-10 max-w-xl">
            <span class="block h-[2px] w-20 bg-black" aria-hidden="true"></span>

            <h1 class="mt-10 font-['Montserrat',sans-serif] uppercase leading-tight">
                <span class="block text-4xl font-light sm:text-5xl">Healthy</span>
                <span class="block text-4xl font-extrabold sm:text-5xl">Tasty Food</span>
            </h1>

            <p class="mt-5 max-w-[34rem] text-[13px] leading-relaxed text-neutral-800">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel luctus ex. Fusce sit amet viverra ante.
            </p>

            <a href="#tentang"
               class="mt-6 inline-block min-w-[16rem] bg-black px-10 py-4 text-center text-xs font-semibold uppercase tracking-wide text-white transition hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                Tentang Kami
            </a>
        </div>
    </div>

    {{-- Piring: di mobile di bawah teks, di desktop menempel kanan atas (terpotong) --}}
    <img src="{{ $heroImage }}" alt="Hidangan sehat Tasty Food"
         class="relative mx-auto -mb-16 mt-4 w-72 max-w-full sm:w-96 lg:absolute lg:-right-[5vw] lg:-top-[2.5vw] lg:mx-0 lg:mb-0 lg:mt-0 lg:w-[46vw]">
</section>

{{-- ============ TENTANG KAMI ============ --}}
<section id="tentang" class="bg-white px-6 py-20 lg:py-24">
    <div class="mx-auto max-w-xl text-center">
        <h2 class="font-['Montserrat',sans-serif] text-2xl font-bold uppercase">Tentang Kami</h2>
        <p class="mt-6 text-[13px] leading-relaxed text-neutral-700">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem eget lacus. Nullam vitae dignissim neque, vel luctus ex. Fusce sit amet viverra ante.
        </p>
        <span class="mx-auto mt-8 block h-[2px] w-14 bg-black" aria-hidden="true"></span>
    </div>
</section>

{{-- ============ KEUNGGULAN (kartu dengan gambar bulat) ============ --}}
<section class="relative bg-[#10161d] bg-cover bg-center" style="background-image: url('{{ $featureBg }}');">
    <div class="absolute inset-0 bg-black/30" aria-hidden="true"></div>

    <div class="relative mx-auto grid w-full max-w-6xl gap-x-6 gap-y-24 px-6 pb-16 pt-32 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($features as $feature)
            <article class="relative rounded-xl bg-white px-6 pb-8 pt-24 text-center shadow-lg">
                <img src="{{ $feature['gambar'] }}" alt="{{ $feature['judul'] }}"
                     class="absolute -top-20 left-1/2 h-40 w-40 -translate-x-1/2 rounded-full border-4 border-white object-cover shadow-md">
                <h3 class="font-['Montserrat',sans-serif] text-2xl font-bold uppercase">{{ $feature['judul'] }}</h3>
                <p class="mt-3 text-xs leading-relaxed text-neutral-700">{{ $feature['deskripsi'] }}</p>
            </article>
        @endforeach
    </div>
</section>

{{-- ============ BERITA KAMI ============ --}}
<section id="berita" class="bg-[#f4f4f4] px-6 py-20 lg:py-24">
    <div class="mx-auto w-full max-w-6xl">
        <h2 class="mb-12 text-center font-['Montserrat',sans-serif] text-2xl font-bold uppercase">Berita Kami</h2>

        @if ($mainNews)
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

                {{-- Berita utama (besar) --}}
                <article class="flex flex-col overflow-hidden rounded-xl bg-white shadow-[0_4px_16px_rgba(0,0,0,0.08)] sm:col-span-2 lg:row-span-2">
                    @if ($mainNews->gambar)
                        <img src="{{ asset('storage/' . $mainNews->gambar) }}" alt="{{ $mainNews->judul }}" class="aspect-[3/2] w-full object-cover">
                    @else
                        <div class="aspect-[3/2] w-full bg-neutral-200" aria-hidden="true"></div>
                    @endif

                    <div class="flex flex-1 flex-col p-5 lg:p-6">
                        <h3 class="line-clamp-2 font-['Montserrat',sans-serif] text-lg font-bold uppercase leading-snug">{{ $mainNews->judul }}</h3>
                        <p class="mt-4 line-clamp-5 text-xs leading-relaxed text-neutral-700">
                            {{ Str::limit(strip_tags($mainNews->deskripsi), 320) }}
                        </p>
                        <div class="mt-auto flex items-center justify-between pt-6">
                            <a href="{{ $newsUrl($mainNews) }}" class="text-xs font-medium text-amber-500 transition hover:text-amber-600">Baca selengkapnya</a>
                            <svg class="h-4 w-4 text-neutral-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="5" cy="12" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/></svg>
                        </div>
                    </div>
                </article>

                {{-- Berita lain (kecil) --}}
                @foreach ($sideNews as $item)
                    <article class="flex flex-col overflow-hidden rounded-xl bg-white shadow-[0_4px_16px_rgba(0,0,0,0.08)]">
                        @if ($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="aspect-[3/2] w-full object-cover">
                        @else
                            <div class="aspect-[3/2] w-full bg-neutral-200" aria-hidden="true"></div>
                        @endif

                        <div class="flex flex-1 flex-col p-4">
                            <h3 class="line-clamp-2 font-['Montserrat',sans-serif] text-base font-bold uppercase leading-snug">{{ $item->judul }}</h3>
                            <p class="mt-3 line-clamp-4 text-[11px] leading-relaxed text-neutral-700">
                                {{ Str::limit(strip_tags($item->deskripsi), 120) }}
                            </p>
                            <div class="mt-auto flex items-center justify-between pt-5">
                                <a href="{{ $newsUrl($item) }}" class="text-[11px] font-medium text-amber-500 transition hover:text-amber-600">Baca selengkapnya</a>
                                <svg class="h-4 w-4 text-neutral-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="5" cy="12" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/></svg>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <p class="text-center text-sm text-neutral-500">Belum ada berita.</p>
        @endif
    </div>
</section>

{{-- ============ GALERI KAMI ============ --}}
<section id="galeri" class="bg-white px-6 py-20 lg:py-24">
    <div class="mx-auto w-full max-w-6xl">
        <h2 class="mb-12 text-center font-['Montserrat',sans-serif] text-2xl font-bold uppercase">Galeri Kami</h2>

        @if ($gallery->isNotEmpty())
            <div class="grid grid-cols-2 gap-4 lg:grid-cols-3 lg:gap-5">
                @foreach ($gallery->take(6) as $item)
                    <div class="group aspect-square overflow-hidden rounded-xl bg-neutral-100 shadow-[0_4px_16px_rgba(0,0,0,0.1)]">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Galeri Tasty Food {{ $loop->iteration }}"
                             class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                    </div>
                @endforeach
            </div>

            <div class="mt-14 text-center">
                <a href="{{ route('gallery') }}"
                   class="inline-block min-w-[16rem] bg-black px-10 py-4 text-xs font-semibold uppercase tracking-wide text-white transition hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                    Lihat Lebih Banyak
                </a>
            </div>
        @else
            <p class="text-center text-sm text-neutral-500">Belum ada foto di galeri.</p>
        @endif
    </div>
</section>
@endsection