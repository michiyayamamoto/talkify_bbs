<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopicsController;
use App\Models\Topic;


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



// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// 以下掲示板アプリのブログの記述を追加。0330
// Route::get('/', [PagesController::class,'index']);
// Route::post('/', [PagesController::class,'save']);


// 以下CRUD対応型のブログの記述を追加。0330
// Route::resource('/', 'TopicsController');
// Route::resource('/topics', 'TopicsController');
Route::resource('/', TopicsController::class);
Route::resource('/topics', TopicsController::class);


// 多分これがデフォルト。ログイン機能とか
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
