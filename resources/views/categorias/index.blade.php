@extends('layout.app')
@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Categorias</h2>

        </div>

        <table class="table table-stripped col-12" id="categoria_tabela">
            <thead>
                <tr>
                    <th class=" text-end">#</th>
                    <th class="">Nome</th>
                    <th class=" text-center">Criado em</th>
                    <th class=" text-center">Atualizado em</th>
                    <th class=" text-center">Opções</th>
                </tr>
                <tr class="categoria_tr_modelo d-none">
                    <td class="categoria_id text-end"></td>
                    <td class="categoria_nome"></td>
                    <td class="categoria_created_at text-center"></td>
                    <td class="categoria_updated_at text-center"></td>
                    <td class="categoria_opcoes text-center">
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
            }
        }

        Categoria = new Categoria()
    </script>
@stop
