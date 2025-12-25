<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        return view('links');
    }

    public function analytics($id)
    {
        // TODO: Load link data from database
        return view('link-analytics', compact('id'));
    }
}
