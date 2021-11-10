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
<div class="form-group required">
    <div class = "row">
        <div class = "col">
            <label for="" class="control-label">Periodo de Inicio: </label>
            <input maxlength="20" type="date" name="PInicio"
            class="form-control"
            placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31" value="" required
            autofocus>
        </div>
        <div class = "col">
            <label for="" class="control-label">Periodo de Fin: </label>
            <input maxlength="20" type="date" name="PInicio"
            class="form-control"
            placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31" value="" required
            autofocus>
            </select>
        </div>
        <div class = "col">
            <label for="" class="control-label">Razones Financieras: </label>
            <select class="form-control" name="razon">
            <option value="">Seleccionar </option>>
            </select>
        </div>
        <div class = "col">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <button type="button" class="btn btn-primary">
                    Generar Gráfico
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Canvas necesario para generar gráfico -->
<div class="row col-8">
    <canvas id="myChart" width="400" height="400"></canvas>
</div>

<!--Aviso meintras no se seleccione ninguna opción para gráfico -->
<!--@if(count($GraficosRatio) > 0)-->
<!--<canvas id="myChart" width="400" height="400"></canvas>-->
<!--@else
<div class="alert alert-danger">
    <strong>¡Opps! Parece que no has seleccionado las opciones para generar los gráficos.</strong>
</div>
@endif-->

<!-- Libreria necesaria para poder generar el gráfico -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>

<!-- Elementos que deben de ir en el gráfico -->
<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    //type: 'line',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            //titulo del gráfico
            label: 'Variación de razones',
            data: [12, 19, 3, 5, 2, 3],
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
