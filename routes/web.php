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

Route::get('/', function () {
    return view('welcome');
});

// Auth
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    // Produto
    Route::get('/produto', [App\Http\Controllers\ProdutosController::class, 'index']);
    Route::get('/produto/get/{id?}', [App\Http\Controllers\ProdutosController::class, 'get']);
    Route::post('/produto/novo', [App\Http\Controllers\ProdutosController::class, 'store']);
    Route::post('/produto/editar/{id}', [App\Http\Controllers\ProdutosController::class, 'update']);
    Route::post('/produto/excluir/{id}', [App\Http\Controllers\ProdutosController::class,'destroy']);

    // Categoria
    Route::get('/categoria', [App\Http\Controllers\CategoriasController::class, 'index']);
    Route::get('/categoria/get/{id?}', [App\Http\Controllers\CategoriasController::class, 'get']);
    Route::post('/categoria/novo', [App\Http\Controllers\CategoriasController::class, 'store']);
    Route::post('/categoria/editar/{id}', [App\Http\Controllers\CategoriasController::class, 'update']);
    Route::post('/categoria/excluir/{id}', [App\Http\Controllers\CategoriasController::class,'destroy']);
});

require __DIR__.'/auth.php';
