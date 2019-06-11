<?php

namespace App\Http\Controllers;

use App\Image;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $images = Image::with('tags', 'user', 'albums')->where('is_public', 1);

        if (auth()->check()) {
            $images = $images->orWhere('user_id', auth()->id());
        }

        // if (auth()->user()->hasRole('relest')) {
        //     $images = $images->orWhere('is_public', 0);
        // }

        $images = $images->latest()->take(4)->get();


        return view('home', compact('images'));
    }
}
