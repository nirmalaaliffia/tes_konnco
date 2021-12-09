<?php

use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {


    return view('welcome', [
        'produk' => Produk::all()
    ]);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    // Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/produk', [\App\Http\Controllers\ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [\App\Http\Controllers\ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [\App\Http\Controllers\ProdukController::class, 'store'])->name('produk.store');
    Route::delete('/produk/{id_produk}', [\App\Http\Controllers\ProdukController::class, 'destroy'])->name('produk.destroy');
});
