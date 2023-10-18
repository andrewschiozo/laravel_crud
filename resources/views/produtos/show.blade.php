@extends('layout.app')
@section('content')

    <label for="">Nome</label> <br />
    <input type="text" name="nome" value="{{$produto->nome}}"> <br />

    <label for="">Custo</label> <br />
    <input type="text" name="custo" value="{{$produto->custo}}"> <br />

    <label for="">Preco</label> <br />
    <input type="text" name="preco" value="{{$produto->preco}}"> <br />

    <label for="">quantidade</label> <br />
    <input type="text" name="quantidade" value="{{$produto->quantidade}}"> <br />

@stop
