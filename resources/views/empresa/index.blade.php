@extends('base')
@section('titulo')
Empresas
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Listado de Empresas</li>
    </ol>
</nav>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <button type="button" class="btn btn-primary" onclick="limpiarCampos()" data-toggle="modal" data-target="#addModal">
        Agregar empresa
    </button>
</div>
<!-- Mensaje de Exito -->
@if(session('exito'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('exito') }}
</div>
@endif
@include('empresa.modals.addEmpresa')
<!-- Fin Mensaje Exito -->

@if(count($empresas) > 0)
<!-- Table a mostrarse cuando se crea la empresa -->
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre de la empresa</th>
            <th scope="col">Nit</th>
            <th scope="col">Nrc</th>
            <th scope="col">Sector</th>
            <th scope="col">Acciones</th>
        </tr>
    
         <!--Botones de edit and delete-->
        
        @foreach ($empresas as $empresa )
        
        <tr>
            <td>{{$loop->iteration}}</td>
            <td> {{ $empresa->nombre }} </td>
            <td> {{ $empresa->nit }} </td>
            <td> {{ $empresa->nrc }} </td>
            <td> {{ $empresa->sector_id }} </td>
            <td style="display: flex">
                <button type="button" title="Editar" data-toggle="modal" data-target="#editEmpresaModal"
                    class="fas fa-w fa-edit"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_edit('{{$empresa->id}}')"></button>

                <button type="button" title="Eliminar" data-toggle="modal" data-target="#deleteModal"
                    class="fas fa-w fa-trash"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_delete('{{$empresa->id}}')"></button>
            </td>
        </tr>
        @endforeach
    </thead>
</table>
<!-- Fin Table -->

<!-- Paginacion de tabla -->
<div class="d-flex justify-content-center">
    {{ $empresas->links() }}
</div>
<!-- Fin Paginacion de tabla-->
@include('empresa.modals.editEmpresa')
@include('empresa.modals.deleteEmpresa')

<!--Mensaje-->
@else
<div class="alert alert-danger">
    <strong>¡Opps! Parece que no tienes ninguna empresa registrada.</strong>
</div>
@endif
<script type="text/javascript">
    //EDITAR
    function fun_edit(id)
    {
        var view_url = '{{ route("empresa.edit_view", ":id") }}';
        view_url = view_url.replace(':id', id);
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){
                $("#edit_id").val(result.id);
                $('#nombre').val(result.nombre);
                $('#nit').val(result.nit);
                $('#nrc').val(result.nrc);
                $('#sector_id').val(result.sector_id);
            }
        });
    }

    //ELIMINAR
    function fun_delete(id)
    {
        $("#delete_id").val(id);
    }
    //Limpiar los campos de la modal de traslados
    function limpiarCampos(){
        $('#nombre Empresa').val(''); //Limpiando el input
        $('#nit Empresa').val(''); //Limpiando el input
        $('#nrc Empresa').val('');
        $('#sector_id Empresa').val('');
    }
</script>
@endsection