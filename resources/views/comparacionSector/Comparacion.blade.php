@extends('base')
@section('title',"Comparacion Sector {$periodo2["year"]}")
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Comparativo por sector: {{$periodo2["year"]}}</li>
    </ol>
</nav>    

    <table class="table table-striped">
        <thead class="bg-primary">
            <tr>
                <th class="text-white">Ratio</th>
                <th class="text-white">Valor Empresa</th>
                <th class="text-white">Valor Promedio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $dat)
            <tr>                
                <td>{{$dat["nombre_ratio"]}}</td>
                <td>{{number_format($dat["valor_empresa"],4)}}</td>
                <td>{{number_format($dat["valor_promedio"],4)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
    