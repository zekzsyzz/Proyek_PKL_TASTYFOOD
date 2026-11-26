@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')
    
@php
    $isEdit   = isset($news);
    $imageUrl = $isEdit && $news->gambar ? asset('storage/' . $news->gambar) : null;
    $inputBase = 'w-full rounded-lg border bg-white px-4 py-2.5 text-sm text-neutral-900 placeholder-neutral-400 transition focus:border-black focus:outline-none focus:ring-2 focus:ring-black/20';
@endphp

<div class="mx-auto w-full max-w-6xl px-4 py-8 sm:px-6">

    {{-- Header halaman --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <a href="{{ route('admin.news.index') }}"
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

    <form action="{{ $isEdit ? route('admin.news.update', $news->id) : route('admin.news.store') }}"
          method="POST" enctype="multipart/form-data" novalidate
          class="grid gap-6 lg:grid-cols-[1.6fr_1fr]">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        {{-- ============ KOLOM KIRI: konten ============ --}}
        <div class="space-y-6 rounded-xl bg-white p-6 shadow-[0_4px_20px_rgba(0,0,0,0.06)] ring-1 ring-neutral-100 sm:p-8">

            {{-- Judul --}}
            <div>
                <label for="judul" class="mb-1.5 block text-sm font-semibold">
                    Judul <span class="text-red-500" aria-hidden="true">*</span>
                </label>
                <input type="text" id="judul" name="judul" required maxlength="255"
                       value="{{ old('judul', $news->judul ?? '') }}"
                       placeholder="Contoh: Resep sehat untuk sarapan keluarga"
                       class="{{ $inputBase }} {{ $errors->has('judul') ? 'border-red-500' : 'border-neutral-300' }}">
                @error('judul') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Slug --}}
            <div>
                <label for="slug" class="mb-1.5 block text-sm font-semibold">
                    Slug <span class="font-normal text-neutral-400">(opsional)</span>
                </label>
                <div class="flex overflow-hidden rounded-lg border focus-within:border-black focus-within:ring-2 focus-within:ring-black/20 {{ $errors->has('slug') ? 'border-red-500' : 'border-neutral-300' }}">
                    <span class="flex items-center bg-neutral-50 px-3 text-sm text-neutral-500">/berita/</span>
                    <input type="text" id="slug" name="slug" maxlength="255"
                           value="{{ old('slug', $news->slug ?? '') }}"
                           placeholder="dibuat-otomatis-dari-judul"
                           class="w-full border-0 bg-white px-3 py-2.5 text-sm placeholder-neutral-400 focus:outline-none focus:ring-0">
                </div>
                <p class="mt-1.5 text-xs text-neutral-500">Kosongkan untuk dibuat otomatis dari judul.</p>
                @error('slug') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <div class="mb-1.5 flex items-center justify-between">
                    <label for="deskripsi" class="block text-sm font-semibold">
                        Deskripsi <span class="text-red-500" aria-hidden="true">*</span>
                    </label>
                    <span id="deskripsi-count" class="text-xs text-neutral-400" aria-live="polite">0 karakter</span>
                </div>
                <textarea id="deskripsi" name="deskripsi" rows="12" required
                          placeholder="Tulis isi berita di sini..."
                          class="{{ $inputBase }} resize-y leading-relaxed {{ $errors->has('deskripsi') ? 'border-red-500' : 'border-neutral-300' }}">{{ old('deskripsi', $news->deskripsi ?? '') }}</textarea>
                @error('deskripsi') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- ============ KOLOM KANAN: gambar + aksi ============ --}}
        <div class="space-y-6 lg:sticky lg:top-6 lg:self-start">

            <div class="rounded-xl bg-white p-6 shadow-[0_4px_20px_rgba(0,0,0,0.06)] ring-1 ring-neutral-100">
                <p class="mb-1.5 text-sm font-semibold">Gambar</p>

                {{-- Preview --}}
                <div id="preview-wrap" class="{{ $imageUrl ? '' : 'hidden' }} mb-4 overflow-hidden rounded-lg bg-neutral-100">
                    <img id="preview" src="{{ $imageUrl }}" alt="Pratinjau gambar berita"
                         class="aspect-[4/3] w-full object-cover">
                </div>

                {{-- Area unggah --}}
                <label for="gambar"
                       class="group flex cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed px-4 py-8 text-center transition hover:border-black hover:bg-neutral-50 has-[:focus-visible]:ring-2 has-[:focus-visible]:ring-black {{ $errors->has('gambar') ? 'border-red-500' : 'border-neutral-300' }}">
                    <svg class="h-8 w-8 text-neutral-400 transition group-hover:text-black" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>
                    <span id="file-label" class="mt-3 text-sm font-medium">
                        {{ $imageUrl ? 'Klik untuk mengganti gambar' : 'Klik untuk memilih gambar' }}
                    </span>
                    <span class="mt-1 text-xs text-neutral-500">JPG, PNG, atau WEBP. Maksimal 2 MB.</span>
                    <input type="file" id="gambar" name="gambar" accept="image/jpeg,image/png,image/webp" class="sr-only">
                </label>

                <p id="file-error" class="mt-2 hidden text-xs text-red-600" role="alert"></p>
                @error('gambar') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Tombol aksi --}}
            <div class="flex flex-col gap-3 sm:flex-row lg:flex-col xl:flex-row">
                <button type="submit"
                        class="flex-1 rounded-lg bg-black px-6 py-3 text-xs font-semibold uppercase tracking-wide text-white transition hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                    {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Berita' }}
                </button>
                <a href="{{ route('admin.news.index') }}"
                   class="flex-1 rounded-lg border border-neutral-300 bg-white px-6 py-3 text-center text-xs font-semibold uppercase tracking-wide text-neutral-700 transition hover:bg-neutral-50 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                    Batal
                </a>
            </div>
        </div>
    </form>
</div>

<script>
    (function () {
        const MAX_SIZE = 5 * 1024 * 1024; 

        const judul   = document.getElementById('judul');
        const slug    = document.getElementById('slug');
        const desk    = document.getElementById('deskripsi');
        const count   = document.getElementById('deskripsi-count');
        const file    = document.getElementById('gambar');
        const wrap    = document.getElementById('preview-wrap');
        const preview = document.getElementById('preview');
        const label   = document.getElementById('file-label');
        const errBox  = document.getElementById('file-error');

        /* Slug otomatis dari judul, berhenti jika slug diedit manual */
        const slugify = (t) => t.toLowerCase().trim()
            .replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');

        let slugTouched = slug.value.trim() !== '';
        slug.addEventListener('input', () => { slugTouched = slug.value.trim() !== ''; });
        judul.addEventListener('input', () => { if (!slugTouched) slug.value = slugify(judul.value); });

        /* Penghitung karakter */
        const updateCount = () => { count.textContent = desk.value.length.toLocaleString('id-ID') + ' karakter'; };
        desk.addEventListener('input', updateCount);
        updateCount();

        /* Pratinjau gambar + validasi ukuran */
        file.addEventListener('change', () => {
            errBox.classList.add('hidden');
            const f = file.files[0];
            if (!f) return;

            if (f.size > MAX_SIZE) {
                errBox.textContent = 'Ukuran gambar melebihi 2 MB. Pilih gambar yang lebih kecil.';
                errBox.classList.remove('hidden');
                file.value = '';
                return;
            }

            preview.src = URL.createObjectURL(f);
            wrap.classList.remove('hidden');
            label.textContent = f.name;
        });
    })();
</script>
@endsection