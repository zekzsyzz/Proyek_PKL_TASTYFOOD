@extends('layouts.admin')

@section('title', 'Kelola Galeri')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header Banner -->
    <div class="relative bg-black text-white p-8 rounded-2xl mb-8 overflow-hidden shadow-lg">
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold tracking-wide">MANAJEMEN GALERI KAMI</h1>
                <p class="text-gray-400 text-sm mt-1">Kelola foto-foto makanan yang tampil di halaman galeri user.</p>
            </div>
            <a href="{{ route('admin.gallery.create') }}" class="bg-white hover:bg-white text-black font-semibold px-5 py-2.5 rounded-xl shadow transition flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Foto Galeri
            </a>
        </div>
    </div>

    <!-- Grid Foto Galeri -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @forelse($gallery as $gallery)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group">
            <div class="relative h-48 overflow-hidden bg-gray-100">
                <img src="{{ asset('storage/' . $gallery->gambar) }}" alt="Gallery" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
            </div>
            <div class="p-4 flex justify-between items-center bg-white">
                <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-xs font-semibold hover:bg-red-100 transition">
                        <i class="fa-solid fa-trash mr-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 bg-white rounded-2xl border text-gray-400">
            Belum ada foto galeri yang diunggah.
        </div>
        @endforelse
    </div>
</div>
@endsection