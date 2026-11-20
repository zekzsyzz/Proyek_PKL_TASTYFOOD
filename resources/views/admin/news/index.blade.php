@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header Banner ala Tasty Food -->
    <div class="relative bg-black text-white p-8 rounded-2xl mb-8 overflow-hidden shadow-lg">
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold tracking-wide">MANAJEMEN BERITA KAMI</h1>
                <p class="text-gray-400 text-sm mt-1">Tambah, ubah, atau hapus artikel berita yang tampil di halaman user.</p>
            </div>
            <a href="{{ route('admin.news.create') }}" class="bg-yellow-500 hover:bg-yellow-400 text-black font-semibold px-5 py-2.5 rounded-xl shadow transition flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Berita Baru
            </a>
        </div>
    </div>

    <!-- Tabel Data Berita -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider border-b">
                        <th class="py-4 px-6">No</th>
                        <th class="py-4 px-6">Gambar</th>
                        <th class="py-4 px-6">Judul Berita</th>
                        <th class="py-4 px-6">Tanggal</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($news as $index => $item)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-4 px-6 font-medium">{{ $index + 1 }}</td>
                        <td class="py-4 px-6">
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="News" class="w-16 h-12 object-cover rounded-lg shadow-sm">
                        </td>
                        <td class="py-4 px-6 font-semibold text-gray-900">{{ Str::limit($item->judul, 40) }}</td>
                        <td class="py-4 px-6 text-gray-500">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="py-4 px-6 text-center space-x-2">
                            <a href="{{ route('admin.news.edit', $item->id) }}" class="inline-flex items-center justify-center w-8 h-8 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition" title="Edit">
                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                            </a>
                            <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center w-8 h-8 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition" title="Hapus">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-400">Belum ada data berita tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection