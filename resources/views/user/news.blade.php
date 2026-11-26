@extends('layouts.app')

@section('title', 'Berita Kami - Tasty Food')
@section('header_class', 'absolute inset-x-0 top-0 bg-transparent text-white')

@section('content')
    <x-page-hero title="Berita Kami" />

    @php
        $items = $news instanceof \Illuminate\Contracts\Pagination\Paginator
            ? $news->getCollection()
            : collect($news ?? []);
        $featuredItem = $featuredNews ?? $items->first();
        $otherItems = $otherNews ?? ($featuredItem ? $items->skip(1) : collect());
    @endphp

    @if ($featuredItem)
        {{-- ============ BERITA UTAMA ============ --}}
        <section class="bg-[#f4f4f4] px-6 py-20 lg:py-28">
            <div class="mx-auto grid w-full max-w-6xl items-center gap-10 lg:grid-cols-2 lg:gap-12">
                @if (!empty($featuredItem->gambar))
                    <img src="{{ asset('storage/' . $featuredItem->gambar) }}"
                         alt="{{ $featuredItem->judul }}"
                         class="aspect-[16/15] w-full rounded-2xl object-cover shadow-[0_8px_24px_rgba(0,0,0,0.18)]">
                @else
                    <div class="aspect-[16/15] w-full rounded-2xl bg-neutral-200" aria-hidden="true"></div>
                @endif

                <div>
                    <h2 class="line-clamp-3 font-['Montserrat',sans-serif] text-2xl font-bold uppercase leading-snug lg:text-3xl">
                        {{ $featuredItem->judul }}
                    </h2>
                    <p class="mt-6 line-clamp-[10] text-sm leading-relaxed text-neutral-700">
                        {{ Str::limit(strip_tags($featuredItem->deskripsi), 600) }}
                    </p>
                    <a href="{{ isset($newsUrl) ? $newsUrl($featuredItem) : '#' }}"
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

                @if ($otherItems->count())
                    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($otherItems as $other)
                            <article class="flex flex-col overflow-hidden rounded-xl bg-white shadow-[0_4px_16px_rgba(0,0,0,0.1)] ring-1 ring-neutral-100">
                                @if (!empty($other->gambar))
                                    <img src="{{ asset('storage/' . $other->gambar) }}"
                                         alt="{{ $other->judul }}"
                                         class="aspect-[8/5] w-full object-cover"
                                         loading="lazy">
                                @else
                                    <div class="aspect-[8/5] w-full bg-neutral-200" aria-hidden="true"></div>
                                @endif

                                <div class="flex flex-1 flex-col p-5">
                                    <h3 class="line-clamp-2 font-['Montserrat',sans-serif] text-lg font-bold uppercase leading-snug">
                                        {{ $other->judul }}
                                    </h3>
                                    <p class="mt-3 line-clamp-4 text-xs leading-relaxed text-neutral-700">
                                        {{ Str::limit(strip_tags($other->deskripsi), 120) }}
                                    </p>
                                    <div class="mt-auto flex items-center justify-between pt-6">
                                        <a href="{{ isset($newsUrl) ? $newsUrl($other) : '#' }}"
                                           class="text-xs font-medium text-amber-500 transition hover:text-amber-600">
                                            Baca selengkapnya
                                        </a>
                                        <svg class="h-4 w-4 text-neutral-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <circle cx="5" cy="12" r="2" />
                                            <circle cx="12" cy="12" r="2" />
                                            <circle cx="19" cy="12" r="2" />
                                        </svg>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    @if (is_object($news) && method_exists($news, 'hasPages') && $news->hasPages())
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