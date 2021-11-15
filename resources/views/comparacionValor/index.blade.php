@extends('base')
@section('title',"Comparacion por Valor")
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Comparacion por valor</li>
    </ol>
</nav>
<form action="{{ route('razon.comparacionValor') }}" method="POST"  name="miForm">
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

    <button type="submit" class="btn btn-primary">Comparar</button>
</form>
@endsection
    
