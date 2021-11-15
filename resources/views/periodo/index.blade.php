@extends('base')
@section('titulo')
Periodos
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Listado de periodos</li>
    </ol>
</nav>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <button type="button" class="btn btn-primary" onclick="limpiarCampos()" data-toggle="modal" data-target="#addModal">
        Agregar periodo
    </button>
</div>
<!-- Mensaje Exito -->
@if(session('exito'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('exito') }}
</div>
@endif
@include('periodo.modals.addPeriodo')
<!-- Fin Mensaje Exito -->
@if(count($periodos) > 0)
<!-- Table -->
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Año</th>
            <th scope="col">Acciones empresa</th>
            <th scope="col" width="20%">Acciones</th>
        </tr>
        @foreach ($periodos as $periodo )
        <tr>
            <td>{{$loop->iteration}}</td>
            <td> {{ $periodo->year }} </td>
            <td> {{ $periodo->acciones }} </td>
            <td style="display: flex">
                <button type="button" title="Editar" data-toggle="modal" data-target="#editPeriodoModal"
                    class="fas fa-w fa-edit"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_edit('{{$periodo->id}}')"></button>
                    <button type="button" title="Eliminar" data-toggle="modal" data-target="#deleteModal"
                    class="fas fa-w fa-trash"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_delete('{{$periodo->id}}')"></button>
            </td>
        </tr>
        @endforeach
    </thead>
</table>
<!-- Fin Table -->
<!-- Paginacion de tabla -->
<div class="d-flex justify-content-center">
    {{ $periodos->links() }}
</div>
<!-- Fin Paginacion de tabla-->
@include('periodo.modals.editPeriodo')
@include('periodo.modals.deletePeriodo')
@else
<div class="alert alert-danger">
    <strong>¡Opps! Parece que no tienes ningun periodo registrado.</strong>
</div>
@endif
<script type="text/javascript">
    function fun_edit(id)
    {
        var view_url = '{{ route("periodo.edit_view", ":id") }}';
        view_url = view_url.replace(':id', id);
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){
                $("#edit_id").val(result.id);
                $('#year').val(result.year);
                $('#acciones').val(result.acciones);
                $('#gastos_financieros').val(result.gastos_financieros);
                $('#inversion_inicial').val(result.inversion_inicial);
                
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
