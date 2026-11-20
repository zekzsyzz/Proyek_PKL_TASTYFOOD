<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Contact;

class AdminController extends Controller
{
    public function indexnews()
    {
        $news = News::latest()->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    public function createnews()
    {
        return view('admin.news.create');
    }

    public function storenews(Request $request)
    {
        $data = $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'slug'      => 'nullable|string|max:255|unique:news,slug',
        ]);


        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('news_images', 'public');
        }

        $data['user_id'] = Auth::id();

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita telah ditambahkan.');
    }

    public function editnews($id)
    {
        $news = News::findOrFail($id);

        return view('admin.news.edit', compact('news'));
    }

    public function updatenews(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $data = $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'slug'      => 'nullable|string|max:255|unique:news,slug,' . $news->id,
        ]);

        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['judul'], $news->id);

        if ($request->hasFile('gambar')) {
            if ($news->gambar) {
                Storage::disk('public')->delete($news->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('news_images', 'public');
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita telah diperbarui.');
    }

    public function deletenews($id)
    {
        $news = News::findOrFail($id);

        if ($news->gambar) {
            Storage::disk('public')->delete($news->gambar);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita telah dihapus.');
    }

    /* ===================== GALERI ===================== */

    public function indexgallery()
    {
        $gallery = Gallery::latest()->paginate(10);

        return view('admin.gallery.index', compact('gallery'));
    }

    public function creategallery()
    {
        return view('admin.gallery.create');
    }

    public function storegallery(Request $request)
    {
        $data = $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data['user_id'] = Auth::id();

        $data['gambar'] = $request->file('gambar')->store('gallery_images', 'public');

        Gallery::create($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Galeri telah ditambahkan.');
    }


    public function deletegallery($id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->gambar) {
            Storage::disk('public')->delete($gallery->gambar);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Galeri telah dihapus.');
    }

    /* ===================== KONTAK (PESAN MASUK) ===================== */

    public function indexcontact()
    {
        $contacts = Contact::latest()->paginate(10);

        return view('admin.contact.index', compact('contacts'));
    }

    public function showcontact($id)
    {
        $contact = Contact::findOrFail($id);

        if (! $contact->dibaca) {
            $contact->update(['dibaca' => true]);
        }

        return view('admin.contact.show', compact('contact'));
    }

    public function deletecontact($id)
    {
        Contact::findOrFail($id)->delete();

        return redirect()->route('admin.contact.index')->with('success', 'Pesan telah dihapus.');
    }
}