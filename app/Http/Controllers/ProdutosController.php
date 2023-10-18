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
        return View::make('produtos.list', ['produtos' => Produto::all()]);
    }

    public function create()
    {
        return View::make('produtos.create');
    }

    public function store(Request $request)
    {
        Produto::create([
            'nome' => $request->input('nome'),
            'custo' => $request->input('custo'),
            'preco' => $request->input('preco'),
            'quantidade' => $request->input('quantidade')
        ]);

        return 'Produto criado com sucesso!';
    }

    public function show($id)
    {
        return View::make('produtos.show', ['produto' => Produto::findOrFail($id)]);
    }

    public function edit($id)
    {
        return View::make('produtos.edit', ['produto' => Produto::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        Produto::findOrFail($id)->update([
            'nome'=> $request->input('nome'),
            'custo' => $request->input('custo'),
            'preco' => $request->input('preco'),
            'quantidade' => $request->input('quantidade')
        ]);

        return 'Produto atualizado com sucesso!';
    }

    public function delete($id)
    {
        return View::make('produtos.delete', ['produto' => Produto::findOrFail($id)]);
    }

    public function destroy($id)
    {
        Produto::findOrfail($id)->delete();
        return 'Produto excluído com sucesso';
    }
}
