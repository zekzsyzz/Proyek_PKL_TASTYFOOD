@extends('layouts.admin')

@section('title', 'Tambah Data Tentang')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header Banner --}}
    <div class="bg-black text-white px-8 py-6 rounded-2xl mb-8 shadow-md flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-extrabold uppercase tracking-wide">TAMBAH DATA TENTANG</h1>
            <p class="text-gray-300 text-sm mt-1">Tambahkan informasi tentang, gambar, visi, dan misi Tasty Food.</p>
        </div>
        <a href="{{ route('admin.about.index') }}"
           class="bg-white/10 hover:bg-white/20 text-white text-sm font-medium px-4 py-2 rounded-xl transition shrink-0">
            ← Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm">
                <p class="font-semibold mb-1">Terjadi kesalahan input:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="judul" class="block text-sm font-semibold text-gray-800 mb-2">Judul</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required
                       placeholder="Contoh: Tasty Food"
                       class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:border-black focus:outline-none">
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-semibold text-gray-800 mb-2">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" required
                          placeholder="Tuliskan deskripsi tentang Tasty Food..."
                          class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:border-black focus:outline-none">{{ old('deskripsi') }}</textarea>
            </div>

            <div>
                <label for="gambar" class="block text-sm font-semibold text-gray-800 mb-2">Gambar</label>
                <input type="file" id="gambar" name="gambar" accept="image/*"
                       onchange="previewCreateImage(event)"
                       class="w-full rounded-xl border border-gray-300 px-4 py-2 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-black file:text-white hover:file:bg-gray-800">
                <p class="text-xs text-gray-400 mt-1">Format: JPG, JPEG, PNG, WEBP. Maksimal 2MB.</p>

                {{-- Preview Gambar Baru --}}
                <div id="create-image-preview-wrapper" class="mt-3 hidden">
                    <p class="text-xs text-gray-500 mb-1.5">Preview Gambar:</p>
                    <img id="create-image-preview" src="#" alt="Preview Gambar"
                         class="w-32 h-24 object-cover rounded-xl border border-gray-200">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="visi" class="block text-sm font-semibold text-gray-800 mb-2">Visi</label>
                    <textarea id="visi" name="visi" rows="4" required
                              placeholder="Tuliskan visi..."
                              class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:border-black focus:outline-none">{{ old('visi') }}</textarea>
                </div>

                <div>
                    <label for="misi" class="block text-sm font-semibold text-gray-800 mb-2">Misi</label>
                    <textarea id="misi" name="misi" rows="4" required
                              placeholder="Tuliskan misi..."
                              class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:border-black focus:outline-none">{{ old('misi') }}</textarea>
                </div>
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <a href="{{ route('admin.about.index') }}"
                   class="px-5 py-2.5 rounded-xl border border-gray-300 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-black hover:bg-gray-800 text-white text-sm font-semibold transition cursor-pointer">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewCreateImage(event) {
        const file = event.target.files[0];
        const wrapper = document.getElementById('create-image-preview-wrapper');
        const img = document.getElementById('create-image-preview');

        if (file) {
            img.src = URL.createObjectURL(file);
            wrapper.classList.remove('hidden');
        } else {
            img.src = '#';
            wrapper.classList.add('hidden');
        }
    }
</script>
@endsection