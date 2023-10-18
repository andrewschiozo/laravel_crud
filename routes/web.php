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

Route::get('/produto', [App\Http\Controllers\ProdutosController::class, 'index']);
Route::get('/produto/novo', [App\Http\Controllers\ProdutosController::class, 'create']);
Route::post('/produto/novo', [App\Http\Controllers\ProdutosController::class, 'store'])->name('registrar_produto');
Route::get('/produto/ver/{id}', [App\Http\Controllers\ProdutosController::class, 'show']);
Route::get('/produto/editar/{id}', [App\Http\Controllers\ProdutosController::class, 'edit']);
Route::post('/produto/editar/{id}', [App\Http\Controllers\ProdutosController::class, 'update'])->name('alterar_produto');
Route::get('/produto/excluir/{id}', [App\Http\Controllers\ProdutosController::class, 'delete']);
Route::post('produto/excluir/{id}', [App\Http\Controllers\ProdutosController::class,'destroy'])->name('excluir_produto');
