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

        return view('user.home', compact('news', 'gallery'));
    }

    public function news()
    {
        $news = News::latest()->paginate(8);

        return view('user.news', compact('news'));
    }

    public function gallery()
    {
        $gallery = Gallery::latest()->paginate(12);

        return view('user.gallery', compact('gallery'));
    }

    public function contact()
    {
        return view('user.contact');
    }
}
