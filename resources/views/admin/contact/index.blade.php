@extends('layouts.admin')

@section('title', 'Pesan Masuk User')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header Banner -->
    <div class="relative bg-black text-white p-8 rounded-2xl mb-8 overflow-hidden shadow-lg">
        <h1 class="text-2xl md:text-3xl font-bold tracking-wide">PESAN MASUK DARI USER</h1>
        <p class="text-gray-400 text-sm mt-1">Daftar pesan dan pertanyaan yang dikirimkan melalui form kontak website.</p>
    </div>

    <!-- Tabel Pesan -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider border-b">
                        <th class="py-4 px-6">No</th>
                        <th class="py-4 px-6">Nama Pengirim</th>
                        <th class="py-4 px-6">Email / Telepon</th>
                        <th class="py-4 px-6">Pesan</th>
                        <th class="py-4 px-6">Tanggal</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($contacts as $index => $contact)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-4 px-6 font-medium">{{ $index + 1 }}</td>
                        <td class="py-4 px-6 font-semibold text-gray-900">{{ $contact->name }}</td>
                        <td class="py-4 px-6 text-gray-600">
                            <div>{{ $contact->email }}</div>
                            <div class="text-xs text-gray-400">{{ $contact->phone ?? '-' }}</div>
                        </td>
                        <td class="py-4 px-6 text-gray-700 max-w-xs truncate">{{ $contact->message }}</td>
                        <td class="py-4 px-6 text-gray-500 text-xs">{{ $contact->created_at->format('d M Y, H:i') }}</td>
                        <td class="py-4 px-6 text-center">
                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center w-8 h-8 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition" title="Hapus Pesan">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-400">Belum ada pesan masuk dari user.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection