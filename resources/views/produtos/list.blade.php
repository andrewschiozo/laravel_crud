<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar um novo produto</title>
</head>
<body>
    <h2>Produtos</h2>
    <a href="#">Novo produto</a>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>nome</th>
                <th>custo</th>
                <th>preco</th>
                <th>quantidade</th>
                <th>created_at</th>
                <th>updated_at</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $p)
            <tr>
                <td>{{$p->id}}</td>
                <td>{{$p->nome}}</td>
                <td>{{$p->custo}}</td>
                <td>{{$p->preco}}</td>
                <td>{{$p->quantidade}}</td>
                <td>{{$p->created_at}}</td>
                <td>{{$p->updated_at}}</td>
                <td><a href="#">Editar</a> <a href="#">Excluir</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
