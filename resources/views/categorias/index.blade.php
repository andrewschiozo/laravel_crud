@extends('layout.app')
@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Categorias</h2>

        </div>

    </div>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });

        data = []

    </script>
@stop
