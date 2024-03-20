<?php

use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryBlogController;
use App\Http\Controllers\CountryBlogItemController;
use App\Http\Controllers\FaqController;

Route::get('/', function () {
    return redirect('/login');
})->name('dashboardhome');

Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [Dashboard::class, 'index'])->name('dashboard');
    Route::resources([
        'country-blog'  => CountryBlogController::class,
        'blog-item'     => CountryBlogItemController::class,
        'faq'           => FaqController::class,
    ]);
});
