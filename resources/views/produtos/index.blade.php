@extends('layout.app')
@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Produtos</h2>
            <div class="text-end">
                <a class="btn btn-secondary" id="produto_btn_novo" role="button">Novo produto</a>
            </div>

            <div class="collapse my-3" id="produto_collapse">
                <i class="gg-close" id="btn_collapse_close" style="cursor: pointer; position: absolute; z-index: 2; margin-left: 97%"></i>
                <div class="card card-body">
                    <form id="produto_form" role="form">
                        @csrf
                        <div class="row">
                            <div class="col-1">
                                <label for="produto_id">#</label>
                                <input type="number" class="form-control" id="produto_form_id" placeholder="#" name="id" disabled>
                            </div>
                            <div class="col">
                                <label for="produto_nome">Nome</label>
                                <input type="text" class="form-control" id="produto_form_nome" placeholder="Nome" name="nome">
                            </div>

                            <div class="col">
                                <label for="">Custo</label> <br />
                                <input type="number" class="form-control" id="produto_form_custo" name="custo">
                            </div>

                            <div class="col">
                                <label for="">Preço</label> <br />
                                <input type="number" class="form-control" id="produto_form_preco" name="preco">
                            </div>

                            <div class="col">
                                <label for="">Qtd</label> <br />
                                <input type="number" class="form-control" id="produto_form_quantidade" name="quantidade">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button class="w-100 btn btn-success">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table table-stripped col-12" id="produto_tabela">
            <thead>
                <tr>
                    <th class=" text-end">#</th>
                    <th class="">Nome</th>
                    <th class="text-end">Custo <small>(R$)</small></th>
                    <th class="text-end">Preço <small>(R$)</small></th>
                    <th class="text-center">Categoria</th>
                    <th class="text-end">Qtd</th>
                    <th class="text-center">Criado em</th>
                    <th class="text-center">Atualizado em</th>
                    <th class="text-center">Opções</th>
                </tr>
                <tr class="produto_tr_modelo d-none">
                    <td class="produto_id text-end"></td>
                    <td class="produto_nome"></td>
                    <td class="produto_custo text-end"></td>
                    <td class="produto_preco text-end"></td>
                    <td class="produto_categoria text-center">Categoria</td>
                    <td class="produto_quantidade text-end"></td>
                    <td class="produto_created_at text-center"></td>
                    <td class="produto_updated_at text-center"></td>
                    <td class="produto_opcoes text-center">
                        <button class="btn btn-warning produto_btn_editar" style="padding: 12px"><i class="gg-pen"></i></button>
                         <button class="btn btn-danger produto_btn_excluir"><i class="gg-trash"></i></button>
                    </td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });

        data = []

        class Produto{
            constructor(){
                this.list()
            }
            list(){
                $.get('/produto/get', function(response){
                    data = response
                    $('#produto_tabela tbody').html('')
                    $.each(response, function(index, data){
                        let tr = $('.produto_tr_modelo').clone().attr('key', index)
                        $.each(data, function(key, val){
                            val = (key == 'created_at' || key == 'updated_at') ? new Date(val).toLocaleString('pt-BR') : val
                            tr.find('.produto_' + key).text(val)
                        })
                        tr.find('.produto_categoria').text(data.categoria.nome)
                        tr.removeClass('d-none')
                        tr.removeClass('produto_tr_modelo')
                        $('#produto_tabela tbody').append(tr)
                    })
                })
            }
            delete(id){
                self = this
                $.post('/produto/excluir/' + id, function(response){
                    if(response)
                    {
                        alert('Produto ' + id + ' excluído')
                        self.list()
                        return
                    }
                    alert('Ops')
                })
            }
        }

        Produto = new Produto()

        $('#produto_tabela').on('click', '.produto_btn_editar', function(){
            let row = data[$(this).closest('tr').attr('key')]
            $.each(row, function(key, val){
                $('#produto_form_' + key).val(val)
            })
            $('#produto_collapse').removeClass('collapse').addClass('collapse.show')
        })

        $('#produto_tabela').on('click', '.produto_btn_excluir', function(){
            let id = data[$(this).closest('tr').attr('key')].id
            Produto.delete(id)
        })

        $('#produto_form').submit(function(e){
            e.preventDefault()
            url = $('#produto_form_id').val() == '' ?  '/produto/novo' : '/produto/editar/' + $('#produto_form_id').val()
            $.post(url, $(this).serialize(), function(response){
                if(response)
                {
                    alert('Registro salvo!')
                    Produto.list()
                    $('#produto_form').each(function(){
                        this.reset()
                    })
                }
            })

        })

        $('#produto_btn_novo').click(function(){
            $('#produto_form').each(function(){
                this.reset()
            })
            $('#produto_collapse').removeClass('collapse').addClass('collapse.show')
        })

        $('#btn_collapse_close').click(function(){
            $('#produto_collapse').addClass('collapse').removeClass('collapse.show')
        })
    </script>
@stop
