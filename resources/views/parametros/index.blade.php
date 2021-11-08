@extends('base')
@section('titulo')
Razones financieras
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Listado de razones financieras</li>
    </ol>
</nav>
<!-- Mensaje Exito -->
@if(session('exito'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('exito') }}
</div>
@endif
<!-- Fin Mensaje Exito -->
@if(count($razones) > 0)
<!-- Table -->
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Razón financiera</th>
            <th scope="col">Valor esperado</th>
            <th scope="col">Acciones</th>
        </tr>
        @foreach ($razones as $razon )
        <tr>
            <td>{{$loop->iteration}}</td>
            <td> {{ $razon->parametro }} </td>
            <td> {{ $razon->valor }} </td>
            <td style="display: flex">
                <button type="button" title="Editar" data-toggle="modal" data-target="#editRazonModal"
                    class="fas fa-w fa-edit"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_edit('{{$razon->id}}')"></button>
            </td>
        </tr>
        @endforeach
    </thead>
</table>
<!-- Fin Table -->
<!-- Paginacion de tabla -->
<div class="d-flex justify-content-center">
    {{ $razones->links() }}
</div>
<!-- Fin Paginacion de tabla-->
@include('parametros.modals.editParametro')
@else
<div class="alert alert-danger">
    <strong>¡Opps! Parece que no tienes ninguna tipo cuenta registrada.</strong>
</div>
@endif
<script type="text/javascript">
    function fun_edit(id)
    {
        var view_url = '{{ route("parametros.edit_view", ":id") }}';
        view_url = view_url.replace(':id', id);
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){
                $("#edit_id").val(result.id);
                $('#parametro').val(result.parametro);
                $('#valor').val(result.valor);
                $('#tipo_id').val(result.tipo_id);
                $('#mayor').val(result.mayor);
                $('#menor').val(result.menor);
                $('#entre').val(result.entre);
            }
        });
    }

</script>
@endsection
