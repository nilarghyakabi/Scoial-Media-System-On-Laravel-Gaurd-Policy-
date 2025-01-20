<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\FollowController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth:web,admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{id}',[ProfileController::class,'view'])->name('profile.view');
    Route::get('userList',[ProfileController::class,'userList'])->name('profile.userList');
});
Route::middleware('auth:admin')->group(function () {
Route::get('allUsers',[ProfileController::class,'allUsers'])->name('profile.allUsers');
});
Route::prefix('posts')->middleware('auth:web,admin')->group(function(){
    Route::get('/view',[PostController::class,'view'])->name('post.view');
    Route::get('/form',[PostController::class,'form'])->name('post.form');
    Route::post('/store',[PostController::class,'store'])->name('post.store');
    Route::get('/edit/{id}',[PostController::class,'edit'])->name('post.edit');
    Route::post('/update/{id}',[PostController::class,'update'])->name('post.update');
    Route::get('/delete/{id}',[PostController::class,'delete'])->name('post.delete');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
    Route::delete('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');
});

require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';