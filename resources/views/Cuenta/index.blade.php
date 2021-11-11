@extends('base')
@section('titulo')
tipo cuenta
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Listado de cuenta</li>
    </ol>
</nav>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <button type="button" class="btn btn-primary" onclick="limpiarCampos()" data-toggle="modal" data-target="#addModal">
        Agregar cuenta
    </button>
    
    <a href="{{ route('tipocuenta.index')}}">
        <button type="button" class="btn btn-primary">
            Agregar tipo de cuenta
        </button>
    </a> 
    
</div>
<!-- Mensaje Exito -->
@if(session('exito'))
    {{-- Mostrar boton de acuerdo al rol que se ha logueado --}}
    @if(Auth::user()->user_role == "empresa")
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
    </div>
    @endif
@endif
@include('cuenta.modals.addCuenta')
<!-- Fin Mensaje Exito -->
@if(count($cuentas) > 0)
<!-- Table -->
<table class="table">
    <thead class="thead-dark">
        <tr>            
            <th scope="col">#</th>
            <th scope="col">Codigo</th>
            <th scope="col">Nombre</th>
            <th scope="col">Acciones</th>
        </tr>
        @foreach ($cuentas as $cuenta )
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $cuenta->codigo }}</td>
            <td> {{ $cuenta->nombre }} </td>
            <td style="display: flex">
                {{-- Fin detalle cuenta --}}
                <button type="button" title="Editar" data-toggle="modal" data-target="#editCuentaModal"
                    class="fas fa-w fa-eye"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_edit('{{$cuenta->id}}')"></button>
                <button type="button" title="Eliminar" data-toggle="modal" data-target="#deleteModal"
                    class="fas fa-w fa-trash"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_delete('{{$cuenta->id}}')"></button>
            </td>
        </tr>
        @endforeach
    </thead>
</table>
<!-- Fin Table -->
<!-- Paginacion de tabla -->
<div class="d-flex justify-content-center">
    {{ $cuentas->links() }}
</div>
<!-- Fin Paginacion de tabla-->
@include('cuenta.modals.editcuenta')
@include('cuenta.modals.deletecuenta')
@else
<div class="alert alert-danger">
    <strong>¡Opps! Parece que no tienes ninguna tipo cuenta registrada.</strong>
</div>
@endif
<script type="text/javascript">    
    /* 
      This function runs with the controller so we need to change what we need inside her fields
    */
    function fun_edit(id)
    {
        var view_url = '{{ route("cuenta.edit_view", ":id") }}';
        view_url = view_url.replace(':id', id);
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){
                $("#edit_id").val(result.id);
                $('#nombre').val(result.nombre);
                $('#codigo').val(result.codigo);
                $('#tipo_id').val(result.tipo_id);
            }
        });
    }

    function add_tipo_cuenta(){
        var view_url = '{ route("tipocuenta.index") }'
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
