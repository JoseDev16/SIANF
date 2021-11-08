@extends('base')
@section('titulo')
Registro de cuentas
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Registro de cuentas</li>
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
