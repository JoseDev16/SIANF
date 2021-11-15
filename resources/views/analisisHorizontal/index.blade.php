@extends('base')
@section('titulo')
Analisis horizontal
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Analisis horizontal</li>
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
<form action="{{ route('analisis.horizontal') }}" method="GET" enctype="multipart/form-data" name="miForm">
    <div class ="row">
    <label for="" class="control-label">Periodo: </label>
    <div class="col mb-3">
        
        <select class="form-control{{ $errors->has('periodo_id') ? ' is-invalid' : '' }} form-select" aria-label="Default select example" name="periodo_id" id="periodo_id">
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
    <div class="col">
      <button type="submit" class="btn btn-primary">Ver</button>
    </div>
</form>
<h4 class="mt-4">Analisis horizontal {{ $año }}</h4>
@if(count($balancegeneral) > 0)
<!-- Table -->
<div class="container-fluid"> 
    <div class="row">
            <div class="col-sm-12 d-flex justify-content-center">
                <h5 class="mt-4 mb-4">Balance General</h5>
            </div>
        </div>
    </div>
</div>

<div class="row">  
  <div class="col-12">
      <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col" class="text-center">#</th>
              <th scope="col" class="text-center">Cuenta</th>
              <th scope="col" class="text-center">Monto año {{$año-1}}</th>
              <th scope="col" class="text-center">Monto año {{$año}}</th>
              <th scope="col" class="text-center">Variacion absoluta</th>
              <th scope="col" class="text-center">%</th>
            </tr>

            @for($i=0; $i<count($balancegeneral); $i++)
              @if($balancegeneral[$i]->tipo_id == 1 || $balancegeneral[$i]->tipo_id == 2 || $balancegeneral[$i]->tipo_id == 3)
                <tr>
                  {{-- Para el codigo --}}
                  <td class="text-center">{{$i+1}}</td>
                  
                  {{-- Para el nombre --}}
                  <td class="text-center"> 
                    @if($balancegeneral[$i]->nombre == "Activo")                      
                        <strong> {{ $balancegeneral[$i]->nombre}} </strong>
                    @else
                        {{ $balancegeneral[$i]->nombre }}
                    @endif
                  </td>       
                  
                  {{-- Para el monto del año anterior --}}
                  <td class="text-center"> 
                    @if($balanceAnterior[$i]->nombre == "Activo")                      
                        <strong> {{ $balanceAnterior[$i]->total}} </strong>
                    @else
                        {{ $balanceAnterior[$i]->total }}
                    @endif
                  </td> 

                  {{-- Para el año seleccionado --}}
                  <td class="text-center"> 
                    @if($balancegeneral[$i]->nombre == "Activo")                      
                        <strong> {{ $balancegeneral[$i]->total}} </strong>
                    @else
                        {{ $balancegeneral[$i]->total }}
                    @endif
                  </td>       
                  
                  {{-- Para el la variacion abs --}}
                  <td class="text-center"> 
                    @if($balancegeneral[$i]->nombre == "Activo")                      
                        <strong> {{ round(($balancegeneral[$i]->total - $balanceAnterior[$i]->total),2) }} </strong>
                    @else
                        {{ round(($balancegeneral[$i]->total - $balanceAnterior[$i]->total),2) }}
                    @endif
                  </td>    
                  
                  {{-- Para la variacion porc --}}
                  <td class="text-center"> 
                    @if($balancegeneral[$i]->nombre == "Activo")                      
                        <strong> {{ round(($balancegeneral[$i]->total - $balanceAnterior[$i]->total)/ ($balanceAnterior[$i]->total),2) }} </strong>
                    @else
                        {{ round(($balancegeneral[$i]->total - $balanceAnterior[$i]->total)/ ($balanceAnterior[$i]->total),2) }}
                    @endif
                  </td>               
                </tr>
              @endif
            @endfor
          </thead>
        </table>
    </div>
</div> 

@else
<div class="alert alert-danger">
    <strong>¡Opps! Parece que no tienes ningun balance general registrado.</strong>
</div>
@endif   


@if(count($estadoresultados) > 0)
<!-- Table -->
<div class="container-fluid"> 
  <div class="row">
          <div class="col-sm-12 d-flex justify-content-center">
              <h5 class="mt-4 mb-4">Estado resultado</h5>
          </div>
      </div>
  </div>
</div>

<div class="row">  
  <div class="col-12">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col" class="text-center">#</th>
          <th scope="col" class="text-center">Cuenta</th>
          <th scope="col" class="text-center">Monto año {{ $año-1}}</th>                    
          <th scope="col" class="text-center">Monto año {{ $año }}</th>
          <th scope="col" class="text-center">Variacion absoluta</th>
          <th scope="col" class="text-center">%</th>
        </tr>
        @for($i=0; $i<count($estadoresultados); $i++)
          @if($estadoresultados[$i]->tipo_id == 4 || $estadoresultados[$i]->tipo_id == 5 || $estadoresultados[$i]->tipo_id == 6)
          <tr>
            <td class="text-center">{{ $i +1}}</td>
            <td class="text-center"> 
              @if($estadoresultados[$i]->tipo_id == 6)
                <strong> (=) {{ $estadoresultados[$i]->nombre }} </strong>
              @else
                {{ $estadoresultados[$i]->nombre }} 
              @endif
            </td>     
            
            {{-- MOnto para el año anterior --}}
            <td class="text-center">
              @if($estadoAnterior[$i]->tipo_id == 6)
                <strong> {{ $estadoAnterior[$i]->total }} </strong>
              @else
                {{ $estadoAnterior[$i]->total }}
              @endif
            </td>
            
            {{-- Monto para el año actual --}}
            <td class="text-center">
              @if($estadoresultados[$i]->tipo_id == 6)
                <strong> {{ $estadoresultados[$i]->total }} </strong>
              @else
                {{ $estadoresultados[$i]->total }}
              @endif
            </td>

            {{-- Para la variacion abs --}}
            <td class="text-center"> 
              @if($estadoresultados[$i]->tipo_id == 6)                      
                  <strong> {{ round(($estadoresultados[$i]->total - $estadoAnterior[$i]->total),2) }} </strong>
              @else
                  {{ round(($estadoresultados[$i]->total - $estadoAnterior[$i]->total),2) }}
              @endif
            </td> 

            {{-- Para la variacion porc --}}
            <td class="text-center"> 
              @if($estadoresultados[$i]->tipo_id == 6)
                @if($estadoAnterior[$i]->total!=0)
                  <strong> {{ round((($estadoresultados[$i]->total - $estadoAnterior[$i]->total)/$estadoAnterior[$i]->total),2) }} </strong>
                @else
                  No afectado
                @endif                                              
              @else
                @if($estadoAnterior[$i]->total!=0)
                  {{ round((($estadoresultados[$i]->total - $estadoAnterior[$i]->total)/$estadoAnterior[$i]->total),2) }}
                @else
                  No afectado
                @endif
              @endif
            </td>  
          </tr>
          @endif
        @endfor
      </thead>
    </table>
  </div>
</div> 
<!-- Fin Table -->
<!-- Paginacion de tabla -->
@else
<div class="alert alert-danger">
    <strong>¡Opps! Parece que no tienes ningun estado resultado registrado.</strong>
</div>
@endif    




<script type="text/javascript">
    
    

</script>
@endsection
