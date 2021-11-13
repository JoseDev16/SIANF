@extends('base')
@section('title')
Mostrar Empresa
@endsection

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('empresa.index')}}">Listado de empresas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Mostrar Empresa</li>
  </ol>
</nav>

<div class="container px-4">

  {{-- Gutters for enterprises info --}}
  <div class="row gx-5">
    <div class="col-sm-6 col-md-8">
     <div class="p-3 border bg-light">

      {{-- card-body for enterprises info --}}
      <div class="card-body">
        <div class="col-md-12 row">
          <h3 class="text-center">Empresa {{$empresaShow->nombre}}</h3>
        </div>        

        <br>
        <div class="form-group row">
          <label for="user" class="col-md-5 col-form-label text-md-right">{{ __('ID:') }}</label>
          <div class="col-md-6">
            <label id="user" class="col-md-10 col-form-label text-md-left">{{ $empresaShow->id }}</label>
          </div>
        </div>
        
        <div class="form-group row">
          <label for="user" class="col-md-5 col-form-label text-md-right">{{ __('NIT:') }}</label>
          <div class="col-md-6">
            <label id="user" class="col-md-10 col-form-label text-md-left">{{ $empresaShow->nit }}</label>
          </div>
        </div>

        <div class="form-group row">
          <label for="email"
            class="col-md-5 col-form-label text-md-right">{{ __('NRC:') }}</label>
          <div class="col-md-6">
            <label id="email"
              class="col-md-10 col-form-label text-md-leftt">{{ $empresaShow->nrc }}</label>
          </div>
        </div>  
        <div class="form-group row">
          <label for="email"
            class="col-md-5 col-form-label text-md-right">{{ __('Sector:') }}</label>
          <div class="col-md-6">
            <label id="email"
              class="col-md-10 col-form-label text-md-leftt">{{ $empresaShow->sector_id }}</label>
          </div>
        </div>        
      </div>
      {{-- End of card-body for enterprises information --}}
     </div>
    </div>

    {{-- gutter for enterprises accounts --}}
    <div class="col-6 col-md-4">
      <div class="p-3  bg-light">
        @can('cuenta.index')
          <a title="Mostrar" href="{{route('cuenta.index', $empresaShow->id)}}"
            style="color:gray !important; margin-right: 12px">
            <button type="button" class="btn btn-info">Cuentas de la empresa</button>
          </a>
          @endcan 
      </div>
    </div>
    {{-- end of gutters --}}
  </div>
  {{-- End of gutters --}}
</div>

@endsection
