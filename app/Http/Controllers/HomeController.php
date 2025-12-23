<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function shorten(Request $request)
    {
        $request->validate([
            'target_url' => 'required|url',
            'custom_slug' => 'nullable|alpha_dash|unique:urls,slug',
        ]);

        // Generate random slug if custom slug not provided
        $slug = $request->custom_slug ?? Str::random(6);

        // For now, just return success message
        // TODO: Save to database
        $shortUrl = url($slug);

        return redirect()->route('home')->with('success', 'URL berhasil diperpendek!')->with('short_url', $shortUrl);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }
}
