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

// Produto
Route::get('/produto', [App\Http\Controllers\ProdutosController::class, 'index']);
Route::get('/produto/get/{id?}', [App\Http\Controllers\ProdutosController::class, 'get']);
Route::post('/produto/novo', [App\Http\Controllers\ProdutosController::class, 'store']);
Route::post('/produto/editar/{id}', [App\Http\Controllers\ProdutosController::class, 'update']);
Route::post('/produto/excluir/{id}', [App\Http\Controllers\ProdutosController::class,'destroy']);

// Categoria
Route::get('/categoria', [App\Http\Controllers\CategoriasController::class, 'index']);
