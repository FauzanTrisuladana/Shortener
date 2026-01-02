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
        try {
            $request->validate([
                'target_url' => 'required|url',
                'custom_alias' => 'nullable|alpha_dash|unique:links,new_link',
            ], [
                'target_url.required' => 'URL tujuan wajib diisi.',
                'target_url.url' => 'Format URL tujuan tidak valid.',
                'custom_alias.alpha_dash' => 'Alias khusus hanya boleh berisi huruf, angka, strip (-), dan garis bawah (_).',
                'custom_alias.unique' => 'Alias khusus sudah digunakan. Silakan pilih yang lain.',
            ]);

            // Generate random slug if custom slug not provided
            $slug = $request->custom_alias ?? Str::random(6);
            // For now, just return success message
            // TODO: Save to database
            $shortUrl = url($slug);

            return redirect()->route('home')->with('success', 'URL berhasil diperpendek!')->with('short_url', $shortUrl);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('home')->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->route('home')->withErrors(['form' => "Terjadi kesalahan: " . $e->getMessage() . ". Silakan coba lagi."])->withInput();
        }
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
