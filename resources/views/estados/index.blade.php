@extends('base')
@section('titulo')
Estados financieros
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Estados financieros</li>
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
            <td>
                <button type="button" title="Editar" data-toggle="modal" data-target="#editPeriodoModal"
                    class="fas fa-w fa-info-circle"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_info('{{$periodo->id}}')"></button>
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
@else
<div class="alert alert-danger">
    <strong>¡Opps! Parece que no tienes ningun periodo registrado.</strong>
</div>
@endif

<script type="text/javascript">
    fun_info(id){
        var view_url = '{{ route("estadoresultado.info", ":id") }}';
        view_url = view_url.replace(':id', id);
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){  
                $("#tabla").val(result.id);
            }
        });
    }
    /*function  fun_info(id) {
        var view_url = '{{ route("estadoresultado.info", ":id") }}';
        view_url = view_url.replace(':id', id);
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){
                $("#estado_id").val(result.id);
                $("#ventas_netas").val(result.ventas_netas);
                $('#utilidad_bruta').val(result.utilidad_bruta);
                $('#utilidad_operativa').val(result.utilidad_operativa);
                $('#utilidad_antes_de_i').val(result.utilidad_antes_de_i);
                $('#impuestos').val(result.impuestos);
                $("#utilidad_neta").val(result.utilidad_neta);
                $('#gastos_ventas').val(result.gastos_ventas);
                $('#gastos_administracion').val(result.gastos_administracion);
                $('#gastos_financieros').val(result.gastos_financieros);
                $('#intereses').val(result.intereses);
                $("#costo_ventas").val(result.costo_ventas);
                
                
            }
        });


        var view_url = '{{ route("balancegeneral.info", ":id") }}';
        view_url = view_url.replace(':id', id);
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){
                $("#balance_id").val(result.id);
                $("#activos").val(result.ventas_netas);
                $('#activo_corriente').val(result.utilidad_bruta);
                $('#efectivo').val(result.utilidad_operativa);
                $('#cuentas_por_cobrar').val(result.utilidad_antes_de_i);
                $('#inventario').val(result.impuestos);
                $("#activo_no_corriente").val(result.utilidad_neta);
                $('#activo_fijo_neto').val(result.gastos_ventas);
                $('#pasivos').val(result.gastos_administracion);
                $('#pasivo_corriente').val(result.gastos_financieros);
                $('#cuentas_por_pagar').val(result.intereses);
                $("#pasivo_no_corriente").val(result.costo_ventas);
                $('#patrimonio').val(result.gastos_financieros);
                $('#capital_social').val(result.intereses);
                
                
            }
        });
    }*/

</script>
@endsection
