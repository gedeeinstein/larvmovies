<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::all();
        return view('post', compact('data'));

    }

    public function rtf()
    {
        $data = Post::findOrFail(1);
        require('htmlToRtf');

        
    }
}
