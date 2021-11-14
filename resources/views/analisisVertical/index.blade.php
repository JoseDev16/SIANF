@extends('base')
@section('titulo')
Analisis vertical
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-8">
                <h2 class="card-title">Análisis Vertical</h2>
                <p>Una vez seleccionado el periodo se comparara automaticamente con el periodo del año anterior</p>
            </div>
            <div class="col-md-4">
                    <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" id="AverticalPeriodo" class="form-control">
                        <option value=-1>Seleccione un período...</option>
                        @foreach ($periodos as $periodo)                            
                            <option value="{{ route( 'analisis_vertical.show', $periodo->id)}}">{{$periodo->year}}</option>                            
                        @endforeach
                    </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        @yield('cuerpo_analisis')
    </div>
    <div class="card-footer">

    </div>
</div>
@endsection
