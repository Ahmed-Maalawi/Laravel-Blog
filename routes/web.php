<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\sessionsController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\User;



Route::get('/', [PostController::class,'index'])->name('home');

Route::group(['prefix' => 'posts', 'controller' => PostController::class], function() {
    Route::get('create', 'create')->name('post.create')->middleware('isAdmin');
    Route::post('/store', 'store')->name('posts.store')->middleware('isAdmin');
    Route::get('/{post:slug}', 'show')->name('post.view');
});

Route::group(['controller' => RegisterController::class], function() {
    Route::get('register', 'create')->name('register')->middleware('guest');
    Route::post('register', 'store')->name('register.store')->middleware('guest');
});

Route::group(['controller' => sessionsController::class], function() {
    Route::post('logout', 'destroy')->name('logout')->middleware('auth');
    Route::get('login', 'create')->name('login')->middleware('guest');
    Route::post('login', 'store')->name('login')->middleware('guest');
});

Route::post('posts/{post:slug}/comments', [PostCommentController::class, 'store'])->name('comment.store')->middleware('auth');


Route::group(['controller' => AdminPostController::class, 'prefix' => 'admin/posts', 'middleware' => 'isAdmin'], function() {
    Route::get('/', 'index')->name('admin.posts.index');
    Route::get('/{post:slug}/edit', 'edit')->name('admin.posts.edit');
    Route::patch('/update/{post:id}', 'update')->name('admin.posts.update');
    Route::delete('/delete/{post:id}', 'destroy')->name('admin.posts.delete');
});

Route::post('newsletter', NewsletterController::class)->name('newsletter.subscribe');




Route::get('author/{author:name}', function (User $author) {
    return view('posts.index', [
        'posts' => $author->posts
    ]);
});