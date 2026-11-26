@extends('layouts.admin')

@section('title', 'Tambah Galeri')

@section('content')
    
@php
    $isEdit   = isset($gallery);
    $imageUrl = $isEdit && $gallery->gambar ? asset('storage/' . $gallery->gambar) : null;
@endphp

<div class="mx-auto w-full max-w-3xl px-4 py-8 sm:px-6">

    {{-- Header halaman --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <a href="{{ route('admin.gallery.index') }}"
           class="inline-flex items-center gap-2 text-sm font-medium text-neutral-600 transition hover:text-black">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke daftar
        </a>
    </div>

    {{-- Ringkasan error --}}
    @if ($errors->any())
        <div role="alert" class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
            <p class="font-semibold">Terdapat {{ $errors->count() }} kesalahan pada isian Anda:</p>
            <ul class="mt-1 list-inside list-disc space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $isEdit ? route('admin.gallery.update', $gallery->id) : route('admin.gallery.store') }}"
          method="POST" enctype="multipart/form-data" novalidate
          class="rounded-xl bg-white p-6 shadow-[0_4px_20px_rgba(0,0,0,0.06)] ring-1 ring-neutral-100 sm:p-8">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <p class="mb-1.5 text-sm font-semibold">
            Gambar @unless ($isEdit)<span class="text-red-500" aria-hidden="true">*</span>@endunless
        </p>

        {{-- Area unggah (klik atau seret file) --}}
        <label id="dropzone" for="gambar"
               class="group flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed px-6 py-14 text-center transition hover:border-black hover:bg-neutral-50 has-[:focus-visible]:ring-2 has-[:focus-visible]:ring-black {{ $errors->has('gambar') ? 'border-red-500' : 'border-neutral-300' }} {{ $imageUrl ? 'hidden' : '' }}">
            <span class="flex h-14 w-14 items-center justify-center rounded-full bg-neutral-100 transition group-hover:bg-black group-hover:text-white">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                </svg>
            </span>
            <span class="mt-4 text-sm font-medium">
                <span class="underline decoration-amber-500 decoration-2 underline-offset-4">Klik untuk memilih</span> atau seret gambar ke sini
            </span>
            <span class="mt-1.5 text-xs text-neutral-500">JPG, PNG, atau WEBP. Maksimal 2 MB.</span>
        </label>

        <input type="file" id="gambar" name="gambar" accept="image/jpeg,image/png,image/webp" class="sr-only">

        {{-- Pratinjau --}}
        <div id="preview-wrap" class="{{ $imageUrl ? '' : 'hidden' }}">
            <div class="relative mx-auto aspect-square w-full max-w-sm overflow-hidden rounded-xl bg-neutral-100 ring-1 ring-neutral-200">
                <img id="preview" src="{{ $imageUrl }}" alt="Pratinjau gambar galeri" class="h-full w-full object-cover">
            </div>
            <p class="mt-3 text-center text-xs text-neutral-500">Di galeri, gambar tampil berbentuk kotak (dipotong otomatis di tepinya).</p>

            <div class="mt-4 flex flex-wrap items-center justify-center gap-3 text-sm">
                <span id="file-meta" class="max-w-full truncate text-neutral-600">
                    {{ $isEdit ? 'Gambar saat ini' : '' }}
                </span>
                <label for="gambar"
                       class="cursor-pointer rounded-lg border border-neutral-300 px-4 py-2 text-xs font-semibold uppercase tracking-wide transition hover:bg-neutral-50">
                    Ganti gambar
                </label>
                <button type="button" id="remove-btn"
                        class="{{ $isEdit ? 'hidden' : '' }} rounded-lg px-4 py-2 text-xs font-semibold uppercase tracking-wide text-red-600 transition hover:bg-red-50">
                    Hapus pilihan
                </button>
            </div>
        </div>

        <p id="file-error" class="mt-3 hidden text-sm text-red-600" role="alert"></p>
        @error('gambar') <p class="mt-3 text-sm text-red-600">{{ $message }}</p> @enderror

        {{-- Tombol aksi --}}
        <div class="mt-8 flex flex-col gap-3 border-t border-neutral-100 pt-6 sm:flex-row sm:justify-end">
            <a href="{{ route('admin.gallery.index') }}"
               class="rounded-lg border border-neutral-300 bg-white px-8 py-3 text-center text-xs font-semibold uppercase tracking-wide text-neutral-700 transition hover:bg-neutral-50 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                Batal
            </a>
            <button type="submit"
                    class="rounded-lg bg-black px-8 py-3 text-xs font-semibold uppercase tracking-wide text-white transition hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                {{ $isEdit ? 'Simpan Perubahan' : 'Unggah Gambar' }}
            </button>
        </div>
    </form>
</div>

<script>
    (function () {
        const MAX_SIZE = 5 * 1024 * 1024; // 2 MB, sama dengan validasi server
        const TYPES = ['image/jpeg', 'image/png', 'image/webp'];

        const input    = document.getElementById('gambar');
        const zone     = document.getElementById('dropzone');
        const wrap     = document.getElementById('preview-wrap');
        const preview  = document.getElementById('preview');
        const meta     = document.getElementById('file-meta');
        const removeBt = document.getElementById('remove-btn');
        const errBox   = document.getElementById('file-error');

        const originalSrc = preview.getAttribute('src') || '';
        const isEdit = originalSrc !== '';

        const fmtSize = (b) => b >= 1048576 ? (b / 1048576).toFixed(1) + ' MB' : Math.round(b / 1024) + ' KB';

        function showError(msg) {
            errBox.textContent = msg;
            errBox.classList.remove('hidden');
        }

        function reset() {
            input.value = '';
            if (isEdit) {
                preview.src = originalSrc;
                meta.textContent = 'Gambar saat ini';
                removeBt.classList.add('hidden');
            } else {
                preview.removeAttribute('src');
                wrap.classList.add('hidden');
                zone.classList.remove('hidden');
            }
        }

        function handle(file) {
            errBox.classList.add('hidden');
            if (!file) return;

            if (!TYPES.includes(file.type)) {
                input.value = '';
                return showError('Format tidak didukung. Gunakan JPG, PNG, atau WEBP.');
            }
            if (file.size > MAX_SIZE) {
                input.value = '';
                return showError('Ukuran gambar melebihi 2 MB. Pilih gambar yang lebih kecil.');
            }

            preview.src = URL.createObjectURL(file);
            meta.textContent = file.name + ' (' + fmtSize(file.size) + ')';
            removeBt.classList.remove('hidden');
            zone.classList.add('hidden');
            wrap.classList.remove('hidden');
        }

        input.addEventListener('change', () => handle(input.files[0]));
        removeBt.addEventListener('click', reset);

        /* Seret & lepas */
        ['dragenter', 'dragover'].forEach((ev) => zone.addEventListener(ev, (e) => {
            e.preventDefault();
            zone.classList.add('border-black', 'bg-neutral-50');
        }));
        ['dragleave', 'drop'].forEach((ev) => zone.addEventListener(ev, (e) => {
            e.preventDefault();
            zone.classList.remove('border-black', 'bg-neutral-50');
        }));
        zone.addEventListener('drop', (e) => {
            const file = e.dataTransfer.files[0];
            if (!file) return;
            const dt = new DataTransfer();
            dt.items.add(file);
            input.files = dt.files;
            handle(file);
        });
    })();
</script>
@endsection