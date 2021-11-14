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
    <div class="col">
      {{-- <div class="col-sm-6" style="float:left"> --}}
        <table class="table col-sm-6" style="float:left">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Cuenta</th>
              <th scope="col">Monto año {{$año-1}}</th>                    
            </tr>
            @foreach ($balanceAnterior as $balance)
            @if($balance->tipo_id == 1 || $balance->tipo_id == 2 || $balance->tipo_id == 3)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                  @if($balance->nombre == "Activo")
                    <strong> {{ $balance->nombre }} </strong>
                  @else
                    {{ $balance->nombre }}
                  @endif
                </td>                    
                <td> 
                  @if($balance->nombre == "Activo")
                      <strong> {{ $balance->total }} </strong>
                  @else
                      {{ $balance->total }}
                  @endif
                </td>                    
              </tr>
            @endif
            @endforeach             
          </thead>
        </table>
      {{-- </div> --}}
      {{-- <div class="col-sm-2" style="float: left"> --}}
        <table class="table col-sm-2" style="float:left">
          <thead class="thead-dark">
              <tr>                  
                <th scope="col">Monto año {{$año}}</th>                    
              </tr>
              @foreach ($balancegeneral as $balance)
              @if($balance->tipo_id == 1 || $balance->tipo_id == 2 || $balance->tipo_id == 3)
                <tr>                                     
                  <td> 
                    @if($balance->nombre == "Activo")
                        <strong> {{ $balance->total }} </strong>
                    @else
                        {{ $balance->total }}
                    @endif
                  </td>                    
                </tr>
              @endif
              @endforeach
          </thead>
        </table>
        <table class="table col-sm-2" style="float:left">
          <thead class="thead-dark">
              <tr>                  
                <th scope="col">Variacion absoluta</th>                    
              </tr>
              @foreach ($balancegeneral as $balance)
              @if($balance->tipo_id == 1 || $balance->tipo_id == 2 || $balance->tipo_id == 3)
                <tr>                                     
                  <td> 
                    @if($balance->nombre == "Activo")
                        <strong> {{ $balance->total }} </strong>
                    @else
                        {{ $balance->total }}
                    @endif
                  </td>                    
                </tr>
              @endif
              @endforeach
          </thead>
        </table>
        <table class="table col-sm-2" style="float:left">
          <thead class="thead-dark">
              <tr>                  
                <th scope="col">%</th>                    
              </tr>
              @foreach ($balancegeneral as $balance)
              @if($balance->tipo_id == 1 || $balance->tipo_id == 2 || $balance->tipo_id == 3)
                <tr>                                     
                  <td> 
                    @if($balance->nombre == "Activo")
                        <strong> {{ $balance->total }} </strong>
                    @else
                        {{ $balance->total }}
                    @endif
                  </td>                    
                </tr>
              @endif
              @endforeach
          </thead>
        </table>
      {{-- </div> --}}
        
        <!-- Fin Table -->
        <!-- Paginacion de tabla -->
    </div> 

    {{-- <div class="col">
    <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cuenta</th>
                    <th scope="col">Monto</th>
                    <th scope="col">Variacion</th>
                    <th scope="col">%</th>
                </tr>
                @foreach ($balancegeneral as $balance)
                @if($balance->tipo_id == 2 || $balance->tipo_id == 3)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>  
                        @if($balance->nombre == "Pasivo" || $balance->nombre == "Patrimonio")
                            <strong> {{ $balance->nombre }} </strong>
                        @else
                            {{ $balance->nombre }}
                        @endif
                    </td>
                    <td>
                        @if($balance->nombre == "Pasivo" || $balance->nombre == "Patrimonio")
                            <strong> {{ $balance->total }} </strong>
                        @else
                            {{ $balance->total }}
                        @endif
                    </td>
                    <td>

                    </td>
                </tr>
                @endif
                @endforeach
            </thead>
        </table>
        <!-- Fin Table -->
        <!-- Paginacion de tabla -->
    </div> 
</div>  --}}
@else
<div class="alert alert-danger">
    <strong>¡Opps! Parece que no tienes ningun estado registrado.</strong>
</div>
@endif   


@if(count($estadoresultados) > 0)
<!-- Table -->
<div class="container-fluid"> 
    <div class="row">
            <div class="col-sm-12 d-flex justify-content-center">
                <h5 class="mt-4 mb-4">Estado de resultados</h5>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-2">
    </div> 
    <div class="col">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cuenta</th>
                    <th scope="col">Monto del periodo {{ $año-1}}</th>                    
                    <th scope="col">Monto del periodo {{ $año }}</th>
                    <th scope="col">Variacion</th>
                    <th scope="col">%</th>
                </tr>
                @foreach ($estadoresultados as $estado )
                @if($estado->tipo_id == 4 || $estado->tipo_id == 5 || $estado->tipo_id == 6)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td> 
                        @if($estado->tipo_id == 6)
                            <strong> (=) {{ $estado->nombre }} </strong>
                        @else
                            {{ $estado->nombre }} 
                        @endif
                    </td>     
                                  
                    <td>  
                        @if($estado->tipo_id == 6)
                            <strong> {{ $estado->total }} </strong>
                        @else
                            {{ $estado->total }}
                        @endif
                    </td>
                </tr>
                @endif
                @endforeach   
                
                <td>
                  @foreach ($estadoAnterior as $anterior)
                    @if($anterior->tipo_id == 6)
                      <strong> {{ $anterior->total }} </strong>
                    @else
                      {{ $anterior->total }}
                    @endif
                  @endforeach
                </td>
            </thead>
        </table>
        <!-- Fin Table -->
        <!-- Paginacion de tabla -->
        @else
        <div class="alert alert-danger">
            <strong>¡Opps! Parece que no tienes ningun estado registrado.</strong>
        </div>
        @endif
    </div>
    <div class="col-2">
    </div>
</div>



<script type="text/javascript">
    
    

</script>
@endsection
