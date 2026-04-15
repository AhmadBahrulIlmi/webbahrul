<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeramalanController;
use App\Http\Controllers\TransaksiController;

//route login dan logout
Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

//kalau belum login redirect ke login
Route::get('/panel', function () {
    return redirect()->route('auth.index');
})->name('login');

//route setelah login akan dicek dalam middelware
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/about', function () {
        return view('about.about');
    })->name('about');

    Route::get('/transaksi/template-download', function () {
        $file = public_path('download/template-import-transaksi.xlsx');
        return response()->download($file);
    })->name('transaksi.download-template');

    //user
    Route::get('/user', [UserController::class, 'index'])->name('users.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/user', [UserController::class, 'store'])->name('users.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    //produk
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'delete'])->name('produk.delete');

    //transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::put('/transaksi/{id}/update', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('/transaksi/{id}/delete', [TransaksiController::class, 'delete'])->name('transaksi.delete');
    Route::post('/transaksi/import', [TransaksiController::class, 'import'])->name('transaksi.import');

    //peramalan
    Route::match(['get', 'post'], '/peramalan', [PeramalanController::class, 'index'])->name('peramalan.index');
    Route::post('/peramalan/store', [PeramalanController::class, 'store'])->name('peramalan.store');


    //evaluasi hasil
    Route::get('/evaluasi', [EvaluasiController::class, 'index'])->name('evaluasi.index');
    Route::delete('/evaluasi/delete', [EvaluasiController::class, 'delete'])->name('evaluasi.delete');

});