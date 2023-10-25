<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\View;

class CategoriasController extends Controller
{
    public function index()
    {
        return View::make('categorias.index');
    }

    public function get($id = null)
    {
        return response()->json($id ? Categoria::findOrFail($id) : Categoria::all());
    }
}
