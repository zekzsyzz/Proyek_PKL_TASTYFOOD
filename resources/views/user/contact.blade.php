@extends('layouts.app')

@section('title', 'Kontak Kami - Tasty Food')
@section('header_class', 'absolute inset-x-0 top-0 bg-transparent text-white')

@section('content')
@php
    // Form dikirim ke route contact.store; jika belum ada, kirim ke URL halaman ini (POST)
    $formAction = Route::has('contact.store') ? route('contact.store') : url()->current();
    $mapQuery   = urlencode('Kota Bandung, Jawa Barat');

    $field = 'block w-full rounded-xl border-2 bg-white px-6 py-6 text-sm text-neutral-900 placeholder-neutral-500 transition focus:border-black focus:outline-none focus:ring-0';
@endphp

<x-page-hero title="Kontak Kami" />

{{-- ============ FORM ============ --}}
<section class="bg-white px-6 pb-8 pt-16 lg:pt-20">
    <div class="mx-auto w-full max-w-6xl">
        <h2 class="font-['Montserrat',sans-serif] text-2xl font-bold uppercase lg:text-3xl">Kontak Kami</h2>

        @if (session('success'))
            <div role="status" class="mt-8 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ $formAction }}" method="POST" novalidate class="mt-8">
            @csrf

            {{-- Honeypot anti-spam (jangan dihapus) --}}
            <div class="hidden" aria-hidden="true">
                <label for="website">Website</label>
                <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <div class="grid gap-4 lg:grid-cols-2">
                {{-- Kolom kiri: subjek, nama, email --}}
                <div class="space-y-4">
                    <div>
                        <label for="subjek" class="sr-only">Subjek</label>
                        <input type="text" id="subjek" name="subjek" value="{{ old('subjek') }}" placeholder="Subjek (opsional)"
                               class="{{ $field }} {{ $errors->has('subjek') ? 'border-red-500' : 'border-neutral-400' }}">
                        @error('subjek') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="nama" class="sr-only">Nama</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama" required
                               class="{{ $field }} {{ $errors->has('nama') ? 'border-red-500' : 'border-neutral-400' }}">
                        @error('nama') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required
                               class="{{ $field }} {{ $errors->has('email') ? 'border-red-500' : 'border-neutral-400' }}">
                        @error('email') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Kolom kanan: pesan --}}
                <div class="flex flex-col">
                    <label for="pesan" class="sr-only">Pesan</label>
                    <textarea id="pesan" name="pesan" placeholder="Pesan" required
                              class="{{ $field }} min-h-[14rem] flex-1 resize-none {{ $errors->has('pesan') ? 'border-red-500' : 'border-neutral-400' }}">{{ old('pesan') }}</textarea>
                    @error('pesan') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <button type="submit"
                    class="mt-4 w-full rounded-xl bg-black px-6 py-5 text-sm font-semibold uppercase tracking-wide text-white transition hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                Kirim
            </button>
        </form>
    </div>
</section>

{{-- ============ INFO KONTAK ============ --}}
<section class="bg-white px-6 py-16 lg:py-24">
    <div class="mx-auto grid w-full max-w-6xl gap-12 text-center sm:grid-cols-3">
        <div>
            <span class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-black text-white">
                <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4.2-8 5-8-5V6l8 5 8-5v2.2z"/></svg>
            </span>
            <h3 class="mt-4 font-['Montserrat',sans-serif] text-xl font-bold uppercase">Email</h3>
            <a href="mailto:tastyfood@gmail.com" class="mt-2 block text-base text-neutral-800 hover:underline">tastyfood@gmail.com</a>
        </div>
        <div>
            <span class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-black text-white">
                <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
            </span>
            <h3 class="mt-4 font-['Montserrat',sans-serif] text-xl font-bold uppercase">Telepon</h3>
            <a href="tel:+628123457890" class="mt-2 block text-base text-neutral-800 hover:underline">+62 812 3456 7890</a>
        </div>
        <div>
            <span class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-black text-white">
                <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5z"/></svg>
            </span>
            <h3 class="mt-4 font-['Montserrat',sans-serif] text-xl font-bold uppercase">Lokasi</h3>
            <p class="mt-2 text-base text-neutral-800">Kota Bandung, Jawa Barat</p>
        </div>
    </div>
</section>

{{-- ============ PETA ============ --}}
<section class="bg-[#f4f4f4] px-6 py-16 lg:py-24">
    <div class="mx-auto w-full max-w-6xl overflow-hidden rounded-xl shadow-[0_4px_20px_rgba(0,0,0,0.12)]">
        <iframe title="Lokasi Tasty Food di Kota Bandung"
                src="https://www.google.com/maps?q={{ $mapQuery }}&output=embed"
                class="block h-[22rem] w-full border-0 lg:h-[30rem]"
                loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
    </div>
</section>
@endsection