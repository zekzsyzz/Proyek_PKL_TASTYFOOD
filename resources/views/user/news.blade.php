@extends('layouts.app')

@section('title', 'Berita Kami - Tasty Food')
@section('header_class', 'absolute inset-x-0 top-0 bg-transparent text-white')

@section('content')
@php
    $featured = $featured ?? null;   // berita utama (terbaru)
    $news     = $news ?? collect();  // berita lainnya (paginate)

    $newsUrl = fn ($item) => Route::has('news.show')
        ? route('news.show', $item->slug ?? $item->id)
        : '#';
@endphp

<x-page-hero title="Berita Kami" />

@if ($featured)
    {{-- ============ BERITA UTAMA ============ --}}
    <section class="bg-[#f4f4f4] px-6 py-20 lg:py-28">
        <div class="mx-auto grid w-full max-w-6xl items-center gap-10 lg:grid-cols-2 lg:gap-12">
            @if ($featured->gambar)
                <img src="{{ asset('storage/' . $featured->gambar) }}" alt="{{ $featured->judul }}"
                     class="aspect-[16/15] w-full rounded-2xl object-cover shadow-[0_8px_24px_rgba(0,0,0,0.18)]">
            @else
                <div class="aspect-[16/15] w-full rounded-2xl bg-neutral-200" aria-hidden="true"></div>
            @endif

            <div>
                <h2 class="line-clamp-3 font-['Montserrat',sans-serif] text-2xl font-bold uppercase leading-snug lg:text-3xl">
                    {{ $featured->judul }}
                </h2>
                <p class="mt-6 line-clamp-[10] text-sm leading-relaxed text-neutral-700">
                    {{ Str::limit(strip_tags($featured->deskripsi), 600) }}
                </p>
                <a href="{{ $newsUrl($featured) }}"
                   class="mt-8 inline-block min-w-[16rem] bg-black px-10 py-4 text-center text-xs font-semibold uppercase tracking-wide text-white transition hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                    Baca Selengkapnya
                </a>
            </div>
        </div>
    </section>

    {{-- ============ BERITA LAINNYA ============ --}}
    <section class="bg-white px-6 py-20 lg:py-24">
        <div class="mx-auto w-full max-w-6xl">
            <h2 class="mb-12 font-['Montserrat',sans-serif] text-2xl font-bold uppercase lg:text-3xl">Berita Lainnya</h2>

            @if ($news->count())
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($news as $item)
                        <article class="flex flex-col overflow-hidden rounded-xl bg-white shadow-[0_4px_16px_rgba(0,0,0,0.1)] ring-1 ring-neutral-100">
                            @if ($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="aspect-[8/5] w-full object-cover" loading="lazy">
                            @else
                                <div class="aspect-[8/5] w-full bg-neutral-200" aria-hidden="true"></div>
                            @endif

                            <div class="flex flex-1 flex-col p-5">
                                <h3 class="line-clamp-2 font-['Montserrat',sans-serif] text-lg font-bold uppercase leading-snug">{{ $item->judul }}</h3>
                                <p class="mt-3 line-clamp-4 text-xs leading-relaxed text-neutral-700">
                                    {{ Str::limit(strip_tags($item->deskripsi), 120) }}
                                </p>
                                <div class="mt-auto flex items-center justify-between pt-6">
                                    <a href="{{ $newsUrl($item) }}" class="text-xs font-medium text-amber-500 transition hover:text-amber-600">Baca selengkapnya</a>
                                    <svg class="h-4 w-4 text-neutral-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="5" cy="12" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/></svg>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if (method_exists($news, 'hasPages') && $news->hasPages())
                    <div class="mt-12">{{ $news->links() }}</div>
                @endif
            @else
                <p class="text-sm text-neutral-500">Belum ada berita lainnya.</p>
            @endif
        </div>
    </section>
@else
    <section class="bg-white px-6 py-32 text-center">
        <p class="text-sm text-neutral-500">Belum ada berita yang dipublikasikan.</p>
    </section>
@endif
@endsection