@extends('layouts.admin')

@section('title', 'Detail Pesan')

@section('content')
@php
    $replySubject = rawurlencode('Re: ' . ($contact->subjek ?: 'Pesan Anda ke Tasty Food'));
@endphp

<div class="mx-auto w-full max-w-3xl px-4 py-8 sm:px-6">

    {{-- Header halaman --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="font-['Montserrat',sans-serif] text-2xl font-extrabold uppercase tracking-tight">Detail Pesan</h1>
            <p class="mt-1 text-sm text-neutral-500">Pesan dari pengunjung lewat halaman Kontak.</p>
        </div>
        <a href="{{ route('admin.contact.index') }}"
           class="inline-flex items-center gap-2 text-sm font-medium text-neutral-600 transition hover:text-black">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke daftar
        </a>
    </div>

    <article class="overflow-hidden rounded-xl bg-white shadow-[0_4px_20px_rgba(0,0,0,0.06)] ring-1 ring-neutral-100">

        {{-- Pengirim --}}
        <div class="flex flex-col gap-4 border-b border-neutral-100 p-6 sm:flex-row sm:items-center sm:justify-between sm:p-8">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-black text-base font-bold text-white" aria-hidden="true">
                    {{ strtoupper(mb_substr($contact->nama, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="truncate font-semibold">{{ $contact->nama }}</p>
                    <a href="mailto:{{ $contact->email }}" class="block truncate text-sm text-neutral-500 underline-offset-2 hover:text-black hover:underline">
                        {{ $contact->email }}
                    </a>
                </div>
            </div>

            <div class="text-sm text-neutral-500 sm:text-right">
                <time datetime="{{ $contact->created_at->toIso8601String() }}">
                    {{ $contact->created_at->translatedFormat('d F Y, H:i') }}
                </time>
                <p class="text-xs text-neutral-400">{{ $contact->created_at->diffForHumans() }}</p>
            </div>
        </div>

        {{-- Isi pesan --}}
        <div class="p-6 sm:p-8">
            <p class="text-xs font-semibold uppercase tracking-wide text-neutral-400">Subjek</p>
            <h2 class="mt-1 text-lg font-bold">{{ $contact->subjek ?: '(Tanpa subjek)' }}</h2>

            <p class="mt-6 text-xs font-semibold uppercase tracking-wide text-neutral-400">Pesan</p>
            <div class="mt-2 whitespace-pre-line break-words rounded-lg bg-neutral-50 p-5 text-sm leading-relaxed text-neutral-800">{{ $contact->pesan }}</div>
        </div>

        {{-- Aksi --}}
        <div class="flex flex-col-reverse gap-3 border-t border-neutral-100 bg-neutral-50/60 px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-8">
            <button type="button"
                    data-delete-url="{{ route('admin.contact.delete', $contact->id) }}"
                    data-delete-name="{{ $contact->nama }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg px-5 py-2.5 text-xs font-semibold uppercase tracking-wide text-red-600 transition hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.35 9m-4.78 0L9.26 9m9.97-3.21c.34.05.68.11 1.02.17m-1.02-.17L18.16 19.67a2.25 2.25 0 01-2.24 2.08H8.08a2.25 2.25 0 01-2.24-2.08L4.77 5.79m14.46 0a48.1 48.1 0 00-3.48-.4m-12 .56c.34-.06.68-.12 1.02-.17m0 0a48.1 48.1 0 013.48-.4m7.5 0v-.92c0-1.18-.91-2.16-2.09-2.2a51.96 51.96 0 00-3.32 0c-1.18.04-2.09 1.02-2.09 2.2v.92m7.5 0a48.67 48.67 0 00-7.5 0" />
                </svg>
                Hapus pesan
            </button>

            <a href="mailto:{{ $contact->email }}?subject={{ $replySubject }}"
               class="inline-flex items-center justify-center gap-2 rounded-lg bg-black px-6 py-3 text-xs font-semibold uppercase tracking-wide text-white transition hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
                Balas via email
            </a>
        </div>
    </article>
</div>

@include('admin.contact._delete-dialog')
@endsection