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
<form action="{{ route('analisis.vertical') }}" method="GET" enctype="multipart/form-data" name="miForm">
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
<h4 class="mt-4">Analisis vertical {{ $año }}</h4>
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
              <th scope="col" class="text-center">Codigo</th>
              <th scope="col" class="text-center">Cuenta</th>
              {{-- <th scope="col" class="text-center">Monto año {{$año-1}}</th> --}}
              <th scope="col" class="text-center">Monto año {{$año}} ($)</th>
              <th scope="col" class="text-center">Analisis vertical año {{$año}} (%)</th>
              {{-- <th scope="col" class="text-center">%</th> --}}
            </tr>
            @for ($i = 0; $i < count($balancegeneral); $i++)
                <tr>
                {{-- Para el codigo --}}
                <td class="text-center">{{$i+1}}</td>

                {{-- Para el codigo --}}
                <td class="text-center"> 
                    @if($balancegeneral[$i]->codigo == strval(round($i,1)))                      
                        <strong> {{ $balancegeneral[$i]->codigo}} </strong>
                    @else
                        {{ $balancegeneral[$i]->codigo }}
                    @endif
                </td> 

                {{-- Para el nombre --}}
                <td class="text-center"> 
                    @if($balancegeneral[$i]->codigo == strval(round($i,1)))                      
                        <strong> {{ $balancegeneral[$i]->nombre}} </strong>
                    @else
                        {{ $balancegeneral[$i]->nombre }}
                    @endif
                </td> 

                {{-- Para el año seleccionado --}}
                <td class="text-center"> 
                    @if($balancegeneral[$i]->codigo == strval(round($i,1)))                      
                        <strong> {{ $balancegeneral[$i]->total}} </strong>
                    @else
                        {{ $balancegeneral[$i]->total }}
                    @endif
                </td>  

                {{-- Para el analisis V --}}
                <td class="text-center">
                    {{-- {{ strval($i+1)}} --}}

                    @if ($i<7)
                        @if ($balancegeneral[$i]->codigo == strval($i+1))
                            {{ round((($balancegeneral[$i]->total/$balancegeneral[$i]->total)*100),2) }} 
                        @else
                        
                        {{ round((($balancegeneral[$i]->total/$balancegeneral[0]->total)*100),2) }}
                        @endif
                        
                    @endif

                    @if ($i>6 && $i<11)
                        @if($balancegeneral[$i]->codigo == '2')
                            {{ round((($balancegeneral[$i]->total/$balancegeneral[$i]->total)*100),2) }}    
                        @else
                            {{ round((($balancegeneral[$i]->total/$balancegeneral[7]->total)*100),2) }}    
                        @endif
                    @endif

                    @if ($i>10)
                    @if($balancegeneral[$i]->codigo == '3')
                        {{ round((($balancegeneral[$i]->total/$balancegeneral[$i]->total)*100),2) }}    
                    @else
                        {{ round((($balancegeneral[$i]->total/$balancegeneral[11]->total)*100),2) }}    
                    @endif
                @endif
                    {{-- @for ($j = 1; $j < count($balancegeneral); $j++)
                        {{-- {{ strval($j)}} 
                        @if ($balancegeneral[$i]->codigo == strval($j))                
                             @if ($balancegeneral[$i]==$balancegeneral[$j]) 
                                <strong>{{ round((($balancegeneral[$i]->total/$balancegeneral[$i]->total)*100),2) }}</strong>
                            
                            @endif                        
                            
                        @else
                            {{ round((($balancegeneral[$i]->total/$balancegeneral[0]->total)*100),2) }}
                        @endif
                    @endfor  --}}

                    {{-- @for ($j = 1.1; $j < 2; $j++)
                        @if ($balancegeneral[$j]->codigo == strval($j))                    
                            {{-- @if ($balancegeneral[$j]!=$balancegeneral[$j]) --}}
                                {{-- {{ round((($balancegeneral[$j]->total/$balancegeneral[$i]->total)*100),2) }} --}}
                            
                            {{-- @endif                         
                        @endif
                    @endfor --}}

                    {{-- {{$balancegeneral[$i]->total/$balancegeneral}} --}}

                    {{-- @if ($balancegeneral[$i]->codigo == 1)
                        <strong>{{ round((($balancegeneral[$i]->total/$balancegeneral[0]->total)*100),2) }}</strong>
                    @endif                        
                    @if ($balancegeneral[$i]->codigo == 2)
                        <strong>{{ round((($balancegeneral[$i]->total/$balancegeneral[7]->total)*100),2) }}</strong>
                    
                    @endif
                    @if ($balancegeneral[$i]->codigo == 3)
                        <strong>{{ round((($balancegeneral[$i]->total/$balancegeneral[11]->total)*100),2) }}</strong>
                    @endif --}}
                    

                    {{-- @for ($j = 1; $j < count($Padre); $j++)
                    @if ($balancegeneral[$i]->codigo == $Padre[$j]->codigo)
                        Es padre
                    @else
                        No
                    @endif
                    @endfor --}}

                    {{-- @if ($balancegeneral[$i]->codigo == strval($i+1))
                        funcion
                        @continue
                    @else
                       no
                    @endif --}}
                    
                </td>
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


{{-- @if(count($estadoresultados) > 0) --}}
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
          <th scope="col" class="text-center">Monto del año {{$año}} ($)</th>
          {{-- <th scope="col" class="text-center">Monto año {{ $año-1}}</th>                    
          <th scope="col" class="text-center">Monto año {{ $año }}</th> --}}
          <th scope="col" class="text-center">Analisis vertical del año {{ $año }} (%)</th>
          {{-- <th scope="col" class="text-center">%</th> --}}
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
                        
            
            {{-- Monto para el año actual --}}
            <td class="text-center">
              @if($estadoresultados[$i]->tipo_id == 6)
                <strong> {{ $estadoresultados[$i]->total }} </strong>
              @else
                {{ $estadoresultados[$i]->total }}
              @endif
            </td>
            
            <td class="text-center">
                
                    {{round((($estadoresultados[$i]->total/$estadoresultados[0]->total)*100),2)}}               
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
{{-- @else
<div class="alert alert-danger">
    <strong>¡Opps! Parece que no tienes ningun estado resultado registrado.</strong>
</div>
@endif     --}}




<script type="text/javascript">
    
    

</script>
@endsection
