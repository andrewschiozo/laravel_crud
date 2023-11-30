@extends('layout.app')
@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Categorias</h2>
            <div class="text-end">
                <a class="btn btn-secondary" id="categoria_btn_novo" role="button">Nova categoria</a>
            </div>

            <div class="collapse my-3" id="categoria_collapse">
                <i class="gg-close" id="btn_collapse_close" style="cursor: pointer; position: absolute; z-index: 2; margin-left: 97%"></i>
                <div class="card card-body">
                    <form id="categoria_form" role="form">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-md-1">
                                <label for="categoria_id">#</label>
                                <input type="number" class="form-control" id="categoria_form_id" placeholder="#" name="id" disabled>
                            </div>
                            <div class="col-sm-12 col-md-11dee">
                                <label for="categoria_nome">Nome</label>
                                <input type="text" class="form-control" id="categoria_form_nome" placeholder="Nome" name="nome">
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

        <table class="table table-stripped col-12" id="categoria_tabela">
            <thead>
                <tr>
                    <th class="d-none d-md-table-cell text-end">#</th>
                    <th class="">Nome</th>
                    <th class="d-none d-md-table-cell text-center">Criado em</th>
                    <th class="d-none d-md-table-cell text-center">Atualizado em</th>
                    <th class="d-none d-md-table-cell text-center">Opções</th>
                </tr>
                <tr class="categoria_tr_modelo d-none">
                    <td class="d-none d-md-table-cell categoria_id text-end"></td>
                    <td class="categoria_nome"></td>
                    <td class="d-none d-md-table-cell categoria_created_at text-center"></td>
                    <td class="d-none d-md-table-cell categoria_updated_at text-center"></td>
                    <td class="d-none d-md-table-cell categoria_opcoes text-center">
                        <button class="btn btn-warning categoria_btn_editar" style="padding: 12px"><i class="gg-pen"></i></button>
                         <button class="btn btn-danger categoria_btn_excluir"><i class="gg-trash"></i></button>
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

        class Categoria{
            constructor(){
                this.list()
            }
            list(){
                $.get('/categoria/get', function(response){
                    data = response
                    $('#categoria_tabela tbody').html('')
                    $.each(response, function(index, data){
                        let tr = $('.categoria_tr_modelo').clone().attr('key', index)
                        $.each(data, function(key, val){
                            val = (key == 'created_at' || key == 'updated_at') ? new Date(val).toLocaleString('pt-BR') : val
                            tr.find('.categoria_' + key).text(val)
                        })
                        tr.removeClass('d-none')
                        tr.removeClass('categoria_tr_modelo')
                        $('#categoria_tabela tbody').append(tr)
                    })
                })
            }
            delete(id){
                self = this
                $.post('/categoria/excluir/' + id, function(response){
                    if(response)
                    {
                        alert('Categoria ' + id + ' excluído')
                        self.list()
                        return
                    }
                    alert('Ops')
                })
            }
        }

        Categoria = new Categoria()

        $('#categoria_tabela').on('click', '.categoria_btn_editar', function(){
            let row = data[$(this).closest('tr').attr('key')]
            $.each(row, function(key, val){
                $('#categoria_form_' + key).val(val)
            })
            $('#categoria_collapse').removeClass('collapse').addClass('collapse.show')
        })

        $('#categoria_form').submit(function(e){
            e.preventDefault()
            url = $('#categoria_form_id').val() == '' ?  '/categoria/novo' : '/categoria/editar/' + $('#categoria_form_id').val()
            $.post(url, $(this).serialize(), function(response){
                if(response)
                {
                    alert('Registro salvo!')
                    Categoria.list()
                    $('#categoria_form').each(function(){
                        this.reset()
                    })
                }
            })

        })

        $('#categoria_btn_novo').click(function(){
            $('#categoria_form').each(function(){
                this.reset()
            })
            $('#categoria_collapse').removeClass('collapse').addClass('collapse.show')
        })

        $('#btn_collapse_close').click(function(){
            $('#categoria_collapse').addClass('collapse').removeClass('collapse.show')
        })
    </script>
@stop
