<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/', [\App\Http\Controllers\LandingController::class, 'index'])->name('landing');
    Route::get('/registration', [\App\Http\Controllers\AuthController::class, 'show_register'])->name('show_registration');
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'show_login'])->name('show_login');

    Route::post('/registration', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::post('/adding-post-photo', [\App\Http\Controllers\PostController::class, 'create_post_photo'])->name('create_post_photo');
    Route::post('/adding-post-video', [\App\Http\Controllers\PostController::class, 'create_post_video'])->name('create_post_video');
    Route::post('/adding-post-text', [\App\Http\Controllers\PostController::class, 'create_post_text'])->name('create_post_text');
    Route::post('/adding-post-quote', [\App\Http\Controllers\PostController::class, 'create_post_quote'])->name('create_post_quote');
    Route::post('/adding-post-link', [\App\Http\Controllers\PostController::class, 'create_post_link'])->name('create_post_link');
    Route::post('/user/{id}/subscribe', [\App\Http\Controllers\SubscribeController::class, 'subscribe'])->name('subscribe');
    Route::post('/user/{id}/unsubscribe', [\App\Http\Controllers\SubscribeController::class, 'unsubscribe'])->name('unsubscribe');
    Route::post('/post/{post_id}/comment', [\App\Http\Controllers\CommentController::class, 'create'])->name('create_comment');
    Route::post('/post/{post_id}/like', [\App\Http\Controllers\LikeController::class, 'create'])->name('like');

    Route::get('/adding-post-photo', [\App\Http\Controllers\PostController::class, 'show_adding_post_photo'])->name('show_adding_post_photo');
    Route::get('/adding-post-video', [\App\Http\Controllers\PostController::class, 'show_adding_post_video'])->name('show_adding_post_video');
    Route::get('/adding-post-text', [\App\Http\Controllers\PostController::class, 'show_adding_post_text'])->name('show_adding_post_text');
    Route::get('/adding-post-quote', [\App\Http\Controllers\PostController::class, 'show_adding_post_quote'])->name('show_adding_post_quote');
    Route::get('/adding-post-link', [\App\Http\Controllers\PostController::class, 'show_adding_post_link'])->name('show_adding_post_link');
    Route::get('/feed', [\App\Http\Controllers\FeedController::class, 'index'])->name('feed');
    Route::get('/post/{post}', [\App\Http\Controllers\PostController::class, 'show'])->name('show_post');
    Route::get('/profile/{user}', [\App\Http\Controllers\UserController::class, 'show_profile'])->name('profile');
    Route::get('/messages', [\App\Http\Controllers\UserController::class, 'show_messages'])->name('messages');
    Route::get('/popular', [\App\Http\Controllers\PopularController::class, 'index'])->name('popular');
    Route::get('/feed/{category}', [\App\Http\Controllers\SearchController::class, 'search_by_category'])->name('search_by_category');
    Route::get('/search/', [\App\Http\Controllers\SearchController::class, 'search_by_tag_or_content'])->name('search_by_tag_or_content');
});
