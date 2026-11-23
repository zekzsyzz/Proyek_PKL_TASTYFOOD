@extends('layouts.app')

@section('title', 'Galeri Kami - Tasty Food')
@section('header_class', 'absolute inset-x-0 top-0 bg-transparent text-white')

@section('content')


<x-page-hero title="Galeri Kami" />

@if ($gallery->count())

    {{-- ============ SLIDER ============ --}}
    <section class="bg-[#f4f4f4] px-6 py-16 lg:py-20">
        <div id="slider" class="relative mx-auto w-full max-w-6xl" role="region" aria-roledescription="carousel" aria-label="Foto pilihan galeri">
            <div class="overflow-hidden rounded-2xl shadow-[0_8px_24px_rgba(0,0,0,0.15)]">
                <div data-track class="flex transition-transform duration-500 ease-out">
                    @foreach ($slides as $slide)
                        <div class="w-full shrink-0" role="group" aria-roledescription="slide" aria-label="{{ $loop->iteration }} dari {{ $slides->count() }}">
                            <img src="{{ asset('storage/' . $slide->gambar) }}" alt="Foto galeri {{ $loop->iteration }}"
                                 class="aspect-[4/3] w-full object-cover sm:aspect-[2/1] lg:aspect-[5/2]">
                        </div>
                    @endforeach
                </div>
            </div>

            @if ($slides->count() > 1)
                <button type="button" data-prev aria-label="Foto sebelumnya"
                        class="absolute left-0 top-1/2 flex h-12 w-12 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full bg-white shadow-lg transition hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-black">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button type="button" data-next aria-label="Foto berikutnya"
                        class="absolute right-0 top-1/2 flex h-12 w-12 translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full bg-white shadow-lg transition hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-black">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
            @endif
        </div>
    </section>

    {{-- ============ GRID ============ --}}
    <section class="bg-white px-6 py-16 lg:py-24">
        <div class="mx-auto w-full max-w-6xl">
            <div class="grid grid-cols-2 gap-4 lg:grid-cols-4 lg:gap-5">
                @foreach ($gallery as $item)
                    <div class="group aspect-square overflow-hidden rounded-2xl bg-neutral-100 shadow-[0_4px_16px_rgba(0,0,0,0.12)] ring-1 ring-neutral-100">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Galeri Tasty Food"
                             class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                    </div>
                @endforeach
            </div>

            @if (method_exists($gallery, 'hasPages') && $gallery->hasPages())
                <div class="mt-12">{{ $gallery->links() }}</div>
            @endif
        </div>
    </section>

    <script>
        (function () {
            const root = document.getElementById('slider');
            if (!root) return;

            const track  = root.querySelector('[data-track]');
            const slides = Array.from(track.children);
            const total  = slides.length;
            let index = 0, timer = null, startX = 0;

            function go(i) {
                index = (i + total) % total;
                track.style.transform = 'translateX(-' + (index * 100) + '%)';
                slides.forEach((s, k) => s.setAttribute('aria-hidden', k === index ? 'false' : 'true'));
            }

            const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const start   = () => { if (!reduceMotion && total > 1 && !timer) timer = setInterval(() => go(index + 1), 5000); };
            const stop    = () => { clearInterval(timer); timer = null; };
            const restart = () => { stop(); start(); };

            const prev = root.querySelector('[data-prev]');
            const next = root.querySelector('[data-next]');
            if (prev) prev.addEventListener('click', () => { go(index - 1); restart(); });
            if (next) next.addEventListener('click', () => { go(index + 1); restart(); });

            root.addEventListener('mouseenter', stop);
            root.addEventListener('mouseleave', start);
            root.addEventListener('focusin', stop);
            root.addEventListener('focusout', start);

            // geser (swipe) di layar sentuh
            root.addEventListener('touchstart', (e) => { startX = e.touches[0].clientX; stop(); }, { passive: true });
            root.addEventListener('touchend', (e) => {
                const diff = e.changedTouches[0].clientX - startX;
                if (Math.abs(diff) > 40) go(diff < 0 ? index + 1 : index - 1);
                start();
            });

            go(0);
            start();
        })();
    </script>

@else
    <section class="bg-white px-6 py-32 text-center">
        <p class="text-sm text-neutral-500">Belum ada foto di galeri.</p>
    </section>
@endif
@endsection