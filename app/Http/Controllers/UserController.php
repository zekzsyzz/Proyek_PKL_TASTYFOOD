<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Contact;

class UserController extends Controller
{
    public function home()
    {
        $news = News::latest()->take(3)->get();
        $gallery = Gallery::latest()->take(6)->get();

        $heroImage = asset('asset/img-4.png');          // piring (PNG transparan)
        $featureBg = asset('asset/Group 70@2x.png');   // background gelap section menu

        $features = [
            ['judul' => 'Lorem Ipsum', 'gambar' => asset('asset/img-1.png'), 'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo,'],
            ['judul' => 'Lorem Ipsum', 'gambar' => asset('asset/img-2.png'), 'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo,'],
            ['judul' => 'Lorem Ipsum', 'gambar' => asset('asset/img-3.png'), 'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo,'],
            ['judul' => 'Lorem Ipsum', 'gambar' => asset('asset/img-4.png'), 'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo,'],
        ];

        
        $newsUrl = fn ($item) => Route::has('news.show')
            ? route('news.show', $item->slug ?? $item->id)
            : route('news');

        $mainNews = $news->first();
        $sideNews = $news->slice(1, 4);

        return view('user.home', compact('news', 'gallery', 'heroImage', 'featureBg', 'features', 'newsUrl', 'mainNews', 'sideNews'));
    }

    public function about()
    {
        $img = fn ($n) => asset("images/about-{$n}.jpg");  
        
        return view('user.about', compact('img'));
    }

    public function news()
    {
        $news = News::latest()->paginate(8);

        return view('user.news', compact('news'));
    }

    public function gallery()
    {
        $gallery = Gallery::latest()->paginate(12);

        $gallery = $gallery ?? collect();                       
        $slides  = $slides ?? $gallery->take(5);

        return view('user.gallery', compact('gallery', 'slides'));
    }

    public function contact()
    {
        return view('user.contact');
    }

    public function storeContact(Request $request)
    {
        $data = $request->validate([
            'subject'   => 'required|string|max:255',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'pesan'     => 'required|string',
        ]);

        Contact::create($data);

        return redirect()->route('contact')->with('success', 'Pesan Anda telah dikirim.');
    }
}
