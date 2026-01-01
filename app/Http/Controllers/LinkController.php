<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        // TODO: tampilkan daftar link milik user
        return view('links');
    }

    public function analytics($id)
    {
        // TODO: tampilkan analytics untuk link tertentu
        return view('link-analytics', compact('id'));
    }

    public function create()
    {
        // TODO: tampilkan form tambah link
    }

    public function store(Request $request)
    {
        // TODO: simpan link baru
    }

    public function edit($id)
    {
        // TODO: tampilkan form edit link
    }

    public function update(Request $request, $id)
    {
        // TODO: update data link
    }

    public function destroy($id)
    {
        // TODO: hapus link
    }

    public function redirect(Request $request, $new_link)
    {
        // TODO: redirect ke original url berdasarkan short link
    }

    public function makeVisitor(Request $request)
    {
        // TODO: implementasi logika asinkron untuk membuat visitor
    }
}
