<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllView extends Controller
{
    public function about(){
        return view('about');
    }
    public function blog_single(){
        return view('blog-single');
    }
    public function blog(){
        return view('blog');
    }
    public function contact(){
        return view('contact');
    }
    public function footer(){
        return view('footer');
    }
    public function index(){
        return view('index');
    }
    public function navbar(){
        return view('navbar');
    }
    public function restaurant(){
        return view('restaurant');
    }
    public function rooms_single(){
        return view('rooms-single');
    }
    public function rooms(){
        return view('rooms');
    }

}
