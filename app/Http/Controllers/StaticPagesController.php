<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class StaticPagesController extends Controller
{
    public function home()
    {
        $feedItems = Auth::check() ? Auth::user()->feed()->paginate(30) : [];

        return view('static_pages/home', [
            'feedItems' => $feedItems,
        ]);
    }

    public function help()
    {
        return view('static_pages/help');
    }

    public function about()
    {
        return view('static_pages/about');
    }
}
