
@extends('base')
@section('title',"Comparacion Valor {$periodo["year"]}")
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Comparativo por Valor: {{$periodo["year"]}}</li>
    </ol>
</nav>  
    <br>
    <table class="table table-striped">
        <thead class="bg-primary">
            <tr>
                <th class="text-white">Ratio</th>
                <th class="text-white">Valor Empresa</th>
                <th class="text-white">Valor Teorico</th>
                <th class="text-white">Mensaje</th>                
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $dat)
            <tr>                
                <td>{{$dat["nombre_ratio"]}}</td>
                <td>{{number_format($dat["valor"],4)}}</td>
                <td>{{number_format($dat["valor_teorico"],4)}}</td>
                <td>
                    @if($dat["valor"] > $dat["valor_teorico"])
                        {{$dat["msg_mayor"]}}
                    @elseif($dat["valor"] < $dat["valor_teorico"])
                        {{$dat["msg_menor"]}}
                    @endif
                </td>
            </tr> 
            @endforeach
        </tbody>
    </table>
@endsection