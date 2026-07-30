<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

/*
|--------------------------------------------------------------------------
| Blog — Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [NewsController::class, 'index'])->name('home');
Route::get('/news', function () {
    return redirect()->route('home');
})->name('news.index');
Route::get('/news/{post}', [NewsController::class, 'show'])->name('news.show');

Route::get('/sitemap.xml', function () {
    $posts = \App\Models\NewsPost::published()->get();

    return response()->view('sitemap', [
        'posts' => $posts,
    ])->header('Content-Type', 'text/xml');
});

