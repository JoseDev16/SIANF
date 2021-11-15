@extends('base')
@section('title',"Comparacion anual {$periodosList[0]["year"]} - {$periodosList[1]["year"]}")
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Comparativo por años {{$periodosList[0]["year"]}} - {{$periodosList[1]["year"]}}</li>
    </ol>
</nav>
    <table class="table table-striped">
        <thead class="bg-primary">
            <tr>
                <th class="text-white">Ratio</th>
                <th class="text-white">{{$periodosList[0]["year"]}}</th>
                <th class="text-white">{{$periodosList[1]["year"]}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $dat)
            <tr>                
                <td>{{$dat["nombre_ratio"]}}</td>
                <td>{{number_format($dat["valor_prom1"],4)}}</td>
                <td>{{number_format($dat["valor_prom2"],4)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
    