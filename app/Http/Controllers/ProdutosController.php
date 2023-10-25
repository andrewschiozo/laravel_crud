<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Facades\View;

class ProdutosController extends Controller
{
    //

    public function index()
    {
        return View::make('produtos.index');
    }

    public function get($id = null)
    {
        return response()->json($id ? Produto::with('categoria')->findOrFail($id) : Produto::with('categoria')->get());
    }

    public function store(Request $request)
    {
        $create = Produto::create([
            'nome' => $request->input('nome'),
            'custo' => $request->input('custo'),
            'preco' => $request->input('preco'),
            'quantidade' => $request->input('quantidade'),
            'categoria_id' => $request->input('categoria_id')
        ]);

        return response()->json($create->id);
    }

    public function update(Request $request, $id)
    {
        Produto::findOrFail($id)->update([
            'nome'=> $request->input('nome'),
            'custo' => $request->input('custo'),
            'preco' => $request->input('preco'),
            'quantidade' => $request->input('quantidade'),
            'categoria_id' => $request->input('categoria_id')
        ]);

        return 'Produto atualizado com sucesso!';
    }

    public function destroy($id)
    {
        return response()->json(Produto::findOrfail($id)->delete());
    }
}
