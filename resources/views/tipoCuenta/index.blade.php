@extends('base')
@section('titulo')
tipo cuenta
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Listado de tipo cuenta</li>
    </ol>
</nav>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <button type="button" class="btn btn-primary" onclick="limpiarCampos()" data-toggle="modal" data-target="#addModal">
        Agregar tipo cuenta
    </button>
</div>
<!-- Mensaje Exito -->
@if(session('exito'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('exito') }}
</div>
@endif
@include('tipoCuenta.modals.addTipoCuenta')
<!-- Fin Mensaje Exito -->
@if(count($tipoCuentas) > 0)
<!-- Table -->
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Acciones</th>
        </tr>
        @foreach ($tipoCuentas as $tipoCuenta )
        <tr>
            <td>{{$loop->iteration}}</td>
            <td> {{ $tipoCuenta->nombre }} </td>
            <td style="display: flex">
                <button type="button" title="Editar" data-toggle="modal" data-target="#editTipoCuentaModal"
                    class="fas fa-w fa-edit"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_edit('{{$tipoCuenta->id}}')"></button>
                <button type="button" title="Eliminar" data-toggle="modal" data-target="#deleteModal"
                    class="fas fa-w fa-trash"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_delete('{{$tipoCuenta->id}}')"></button>
            </td>
        </tr>
        @endforeach
    </thead>
</table>
<!-- Fin Table -->
<!-- Paginacion de tabla -->
<div class="d-flex justify-content-center">
    {{ $tipoCuentas->links() }}
</div>
<!-- Fin Paginacion de tabla-->
@include('tipoCuenta.modals.editTipoCuenta')
@include('tipoCuenta.modals.deleteTipoCuenta')
@else
<div class="alert alert-danger">
    <strong>¡Opps! Parece que no tienes ninguna tipo cuenta registrada.</strong>
</div>
@endif
<script type="text/javascript">
    function fun_edit(id)
    {
        var view_url = '{{ route("tipocuenta.edit_view", ":id") }}';
        view_url = view_url.replace(':id', id);
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){
                $("#edit_id").val(result.id);
                $('#nombre').val(result.nombre);
            }
        });
    }

    function fun_delete(id)
    {
        $("#delete_id").val(id);
    }
    //Limpiar los campos de la modal de traslados
    function limpiarCampos(){
        $('#nombre cuenta').val(''); //Limpiando el input
    }
</script>
@endsection
