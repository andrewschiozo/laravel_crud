<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutosController extends Controller
{
    //

    public function index()
    {
        return view('produtos.list', ['produtos' => Produto::all()]);
    }

    public function create()
    {
        return view('produtos.create');
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
        return view('produtos.show', ['produto' => Produto::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view('produtos.edit', ['produto' => Produto::findOrFail($id)]);
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
        return view('produtos.delete', ['produto' => Produto::findOrFail($id)]);
    }

    public function destroy($id)
    {
        Produto::findOrfail($id)->delete();
        return 'Produto excluído com sucesso';
    }
}
