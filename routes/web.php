<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LangController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\Auth2\RegisterController;
use App\Http\Controllers\Auth2\LoginController;
use App\Http\Controllers\Adm\UserController;

Route::get('/',function(){
    return redirect()->route('musics.index');
});

Route::get('/lang/{lang}',[LangController::class,'switchLang'])->name('switch.lang');

Route::middleware('auth')->group(function (){
    Route::get('/selected',[MusicController::class,'selected'])->name('selected');
    Route::post('/musics/{music}/subscribe',[MusicController::class,'subscribe'])->name('musics.subscribe');
    Route::post('/musics/{music}/like',[MusicController::class,'like'])->name('musics.like');
    Route::post('/musics/{music}/rate',[MusicController::class,'rate'])->name('musics.rate');
    Route::post('/musics/{music}/unrate',[MusicController::class,'unrate'])->name('musics.unrate');
    Route::resource('musics',MusicController::class)->except('index','show');
    Route::post('/logout',[LoginController::class,'logout'])->name('logout');

    Route::prefix('adm')->as('adm.')->middleware('hasrole:admin,moderator')->group(function (){
        Route::get('comments',[CommentController::class,'index'])->name('comments');
        Route::resource('users/categories',CategoryController::class);
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/search',[UserController::class, 'index'])->name('users.search');
        Route::get('/users/{user}/edit',[UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}',[UserController::class, 'update'])->name('users.update');
        Route::put('/users/{user}/ban',[UserController::class, 'ban'])->name('users.ban');
        Route::put('/users/{user}/unban',[UserController::class, 'unban'])->name('users.unban');
    });

});
Route::get('/musics/category/{category}', [MusicController::class, 'musicsByCategory'])->name('musics.category')->middleware('auth')->middleware('hasrole:moderator');
Route::resource('musics',MusicController::class)->only('index','show');
Route::resource('comments',CommentController::class);

//
//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/register',[RegisterController::class,'create'])->name('register.form');
Route::post('/register',[RegisterController::class,'register'])->name('register');
Route::get('/login',[LoginController::class,'create'])->name('login.form');
Route::post('/login',[LoginController::class,'login'])->name('login');
