@extends('base')
@section('titulo')
tipo cuenta
@endsection
@section('content')

<!-- Aviso para Generar gráficos -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Seleccione las opciones para generar el gráfico</li>
    </ol>
</nav>

<!--Select para opciones de graficos -->
<form action="{{ route('grafratios.index') }}" method="GET" enctype="multipart/form-data" name="miForm">
        <div class="form-group required">
            <div class = "row">
                <div class = "col">
                    <label for="" class="control-label">Periodo de Inicio: </label>
                    <select class="form-control" name="periodo_inicio">
                    <option value="">Seleccionar </option>>
                    @foreach ($periodos as $pinicio)
                    <option value="{{$pinicio->id}}"> {{$pinicio->year}} </option>
                    @endforeach
                    </select>
                </div>
                <div class = "col">
                    <label for="" class="control-label">Periodo de Fin: </label>
                    <select class="form-control" name="periodo_final">
                    <option value="">Seleccionar </option>>
                    @foreach ($periodos as $pfin)
                    <option value="{{$pfin->id}}"> {{$pfin->year}} </option>
                    @endforeach
                    </select>
                </div>
                <div class = "col">
                    <label for="" class="control-label">Razones Financieras: </label>
                    <select class="form-control" name="ratio_id">
                    <option value="">Seleccionar </option>>
                    @foreach ($parametro as $pa)
                    <option value="{{$pa->id}}"> {{$pa->parametro}} </option>
                    @endforeach
                    </select>
                </div>
                <div class = "col">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <button type="submit" class="btn btn-primary">
                            Generar Gráfico
                        </button>
                    </div>
                </div>
            </div>
        </div>
</form>

<!-- Canvas necesario para generar gráfico -->
@if(count($ratios) > 0)
<div class="row col-6">
    <canvas id="myChart" width="400" height="200"></canvas>
</div>
@endif

<!--Aviso meintras no se seleccione ninguna opción para gráfico -->

<!--<canvas id="myChart" width="400" height="400"></canvas>-->


<!-- Libreria necesaria para poder generar el gráfico -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>

<!-- Elementos que deben de ir en el gráfico -->
<script>

const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    //type: 'line',
    data: {
        labels: [@foreach ($ratios as $ratio) 
                        '{{ $ratio->year }}', 
                    @endforeach],
        datasets: [{
            //titulo del gráfico
            label: 'Variación de razones',
            data: [@foreach ($ratios as $ratio) 
                        {{ $ratio->double }},
                    @endforeach],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
@endsection
