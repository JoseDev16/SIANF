@extends('base')
@section('titulo')
Promedio empresarial
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Promedio empresarial</li>
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
<form action="{{ route('verpromedio.index') }}" method="GET" enctype="multipart/form-data" name="miForm">
    <div class ="row">
    <label for="" class="control-label">Periodo: </label>
    <div class="col mb-3">
        
        <select class="form-control{{ $errors->has('periodo_id') ? ' is-invalid' : '' }} form-select" aria-label="Default select example" name="periodo_id" id="periodo_id">
            @foreach ($periodos as $periodo )
            <option value="{{ $periodo->year }}">{{ $periodo->year }}</option>
            @endforeach
        </select>
        @if($errors->has('periodo_id'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('periodo_id') }}</strong>
        </span>
        @endif
    </div>
    <div class="col">
    <button type="submit" class="btn btn-primary">Ver ratios</button>
    </div>
</form>
@if(count($ratios) > 0)
<!-- Table -->
<h4 class="mt-4">Promedio empresarial de razones financieras del sector <strong>{{ $sector }}</strong> para el <strong>{{ $año }}</strong></h4>
<table class="table mt-2">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Razón financiera</th>
            <th scope="col">Cálculo</th>
            <th scope="col">Valor</th>
        </tr>
        @foreach ($ratios as $ratio )
        <tr>
            <td>{{$loop->iteration}}</td>
            <td> {{ $ratio->parametro }} </td>
            <td> {{ number_format($ratio->valor_promedio, 3) }} </td>
            <td>  

                @if($ratio->parametro_id==5 || $ratio->parametro_id==7 || $ratio->parametro_id==9)
                {{ number_format($ratio->valor_promedio, 0) }} veces
                
                @elseif($ratio->parametro_id==6 || $ratio->parametro_id==8 || $ratio->parametro_id==10)
                {{ number_format($ratio->valor_promedio, 0) }} dias

                @elseif($ratio->parametro_id==19 || $ratio->parametro_id==21 || $ratio->parametro_id==22|| $ratio->parametro_id==23)
                {{ number_format($ratio->valor_promedio, 4)*100 }}%
                
                @else
                {{ number_format($ratio->valor_promedio, 2) }}
                @endif
            </td>
        </tr>
        @endforeach
    </thead>
</table>
<!-- Fin Table -->
@else
<div class="alert alert-danger">
    <strong>¡Opps! Parece que existe ningun ratio calculado para su sector.</strong>
</div>
@endif

<script type="text/javascript">
   

</script>
@endsection
