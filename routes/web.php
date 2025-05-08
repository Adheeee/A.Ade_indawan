<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllView;

Route::get('/', function () {
    return view('index');
});

Route::get('/about', [AllView::class, 'about']);
Route::get('/blog-single', [AllView::class, 'blog-single']);
Route::get('/blog', [AllView::class, 'blog']);
Route::get('/contact', [AllView::class, 'contact']);
Route::get('/footer', [AllView::class, 'footer']);
Route::get('/index', [AllView::class, 'index']);
Route::get('/navbar', [AllView::class, 'navbar']);
Route::get('/restaurant', [AllView::class, 'restaurant']);
Route::get('/rooms_single', [AllView::class, 'rooms-single']);
Route::get('/rooms', [AllView::class, 'rooms']);