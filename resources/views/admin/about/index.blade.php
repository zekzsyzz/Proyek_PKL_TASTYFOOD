@extends('layouts.admin')

@section('title', 'Kelola Tentang')

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- Banner Header ala Kelola Berita --}}
    <div class="bg-black text-white px-8 py-7 rounded-2xl mb-8 shadow-md flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-wide uppercase">MANAJEMEN TENTANG KAMI</h1>
            <p class="text-gray-300 text-sm mt-1">Tambah, ubah, atau hapus informasi tentang, visi, dan misi yang tampil di halaman user.</p>
        </div>
        <a href="{{ route('admin.about.create') }}"
           class="bg-white hover:bg-gray-100 text-black font-semibold px-5 py-3 rounded-xl shadow transition flex items-center gap-2 shrink-0">
            <i class="fa-solid fa-plus text-sm"></i>
            <span>Tambah Data Tentang</span>
        </a>
    </div>

    {{-- Tabel Data Tentang --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-gray-500 uppercase text-xs tracking-wider">
                        <th class="py-4 px-6">NO</th>
                        <th class="py-4 px-6">GAMBAR</th>
                        <th class="py-4 px-6">JUDUL & DESKRIPSI</th>
                        <th class="py-4 px-6">VISI</th>
                        <th class="py-4 px-6">MISI</th>
                        <th class="py-4 px-6 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-800">
                    @forelse ($abouts as $index => $item)
                        <tr class="hover:bg-gray-50/70 transition align-top">
                            <td class="py-5 px-6 font-medium">{{ $index + 1 }}</td>
                            <td class="py-5 px-6">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                         alt="{{ $item->judul }}"
                                         class="w-20 h-14 object-cover rounded-lg border border-gray-200">
                                @else
                                    <div class="w-20 h-14 rounded-lg bg-gray-100 text-gray-400 text-xs flex items-center justify-center border border-gray-200">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td class="py-5 px-6 max-w-xs">
                                <div class="font-bold text-gray-900">{{ $item->judul }}</div>
                                <p class="text-gray-500 text-xs mt-1 line-clamp-2">{{ $item->deskripsi }}</p>
                            </td>
                            <td class="py-5 px-6 max-w-xs text-gray-700">
                                <p class="line-clamp-3 text-xs leading-relaxed">{{ $item->visi }}</p>
                            </td>
                            <td class="py-5 px-6 max-w-xs text-gray-700">
                                <p class="line-clamp-3 text-xs leading-relaxed">{{ $item->misi }}</p>
                            </td>
                            <td class="py-5 px-6 text-center">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.about.edit', $item->id) }}"
                                       class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 inline-flex items-center justify-center transition"
                                       title="Edit">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 px-6 text-center text-gray-400">
                                Belum ada data tentang. Klik <strong>+ Tambah Data Tentang</strong> untuk menambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection