@extends('base')
@section('titulo')
tipo cuenta
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Listado de sectores</li>
    </ol>
</nav>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <button type="button" class="btn btn-primary" onclick="limpiarCampos()" data-toggle="modal" data-target="#addSectorModal">
        Agregar sector
    </button>
</div>
<!-- Mensaje Exito -->
@if(session('exito'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('exito') }}
</div>
@endif
@include('sectores.modals.addSector')
<!-- Fin Mensaje Exito -->
@if(count($sectores) > 0)
<!-- Table -->
<table class="table">
    <thead class="thead-dark">
        <tr>            
            <th scope="col">Codigo</th>
            <th scope="col">Nombre</th>
        </tr>
        @foreach ($sectores as $sector )
        <tr>
            <td>{{$loop->iteration}}</td>
            <td> {{ $sector->nombre }} </td>
            <td style="display: flex">
                <button type="button" title="Editar" data-toggle="modal" data-target="#editSectorModal"
                    class="fas fa-w fa-edit"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_edit('{{$sector->id}}')"></button>
                <button type="button" title="Eliminar" data-toggle="modal" data-target="#deleteSectorModal"
                    class="fas fa-w fa-trash"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_delete('{{$sector->id}}')"></button>
            </td>
        </tr>
        @endforeach
    </thead>
</table>
<!-- Fin Table -->
<!-- Paginacion de tabla -->
<div class="d-flex justify-content-center">
    {{ $sectores->links() }}
</div>
<!-- Fin Paginacion de tabla-->
@include('sectores.modals.editsector')
@include('sectores.modals.deletesector')
@else
<div class="alert alert-danger">
    <strong>¡Opps! Parece que no tienes ninguna tipo de sector registrado.</strong>
</div>
@endif
<script type="text/javascript">
    function fun_edit(id)
    {
        var view_url = '{{ route("sectores.edit_view", ":id") }}';
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
        $('#nombre sector').val(''); //Limpiando el input
    }
</script>
@endsection
