@extends('base')
@section('titulo')
Analisis vertical
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Analisis vertical</li>        
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
<form action="{{ route('razon.store') }}" method="POST" enctype="multipart/form-data" name="miForm">
    @csrf
    <div class="mb-3">
      
      
        <label for="" class="control-label">Periodo: </label>        
        <select class="form-control{{ $errors->has('periodo_id') ? ' is-invalid' : '' }} form-select" aria-label="Default select example" name="periodo_id">
            @foreach ($periodos as $periodo )
            <option value="{{ $periodo->id }}">{{ $periodo->year }}</option>
            @endforeach
        </select>
        @if($errors->has('periodo_id'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('periodo_id') }}</strong>
        </span>
        @endif
    </div>
    <label for="">Una vez seleccionado el periodo se calculara automaticamente con el periodo del año anterior</label>
    <br>
    <button type="submit" class="btn btn-primary">Calcular ratios</button>
</form>

<script type="text/javascript">


</script>
@endsection
