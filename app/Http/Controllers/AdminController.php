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
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'slug' => 'nullable|string|max:255|unique:news,slug',
        ]);

        $news = $request->all();

        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('news_images', 'public');
            $news['gambar'] = $imagePath;
        }
        
        News::create($news);
    
        return redirect()->route('admin.news.index')->with('success', 'Berita Telah di tambahkan.');
    }
    
    public function editnews($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit' , compact('news'));
    }
    
    public function updatenews(Request $request, $id)
    {
        $news = News::findOrFail($id);
    
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'slug' => 'nullable|string|max:255|unique:news,slug',
        ]);
    
        $data = $request->all();
        
        if($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('news_images', 'public');
            $data['gambar'] = $imagePath;
        }
        
        $news->update($data);
    
        return redirect()->route('admin.news.index')->with('success', 'Berita Telah di perbarui.');
    }

    public function deletenews($id)
    {
        $news = News::findOrFail($id);
        if ($news->gambar) {
            \Storage::disk('public')->delete($news->gambar);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita Telah di hapus.');
    }


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
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $gallery = $request->all();

        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('gallery_images', 'public');
            $gallery['gambar'] = $imagePath;
        }
        
        Gallery::create($gallery);
    
        return redirect()->route('admin.gallery.index')->with('success', 'Galeri Telah di tambahkan.');
    }
    
    public function editgallery($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit' , compact('gallery'));
    }
    
    public function updategallery(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
    
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
    
        $data = $request->all();
        
        if($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('gallery_images', 'public');
            $data['gambar'] = $imagePath;
        }
        
        $gallery->update($data);
    
        return redirect()->route('admin.gallery.index')->with('success', 'Galeri Telah di perbarui.');
    }

    public function deletegallery($id)
    {
        $gallery = Gallery::findOrFail($id);
        if ($gallery->gambar) {
            \Storage::disk('public')->delete($gallery->gambar);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Galeri Telah di hapus.');
    }

    
}