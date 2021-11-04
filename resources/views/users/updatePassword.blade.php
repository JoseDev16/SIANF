@extends('base')
@section('title')
Actualizar contraseña
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('user.index')}}">Listado de usuarios</a></li>
        <li class="breadcrumb-item active" aria-current="page">Actualizar contraseña</li>
    </ol>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ($errors->any())
                     <div class="alert alert-danger">
                          <ul>
                            @foreach ($errors->all() as $error)
                                 <li>{{ $error }}</li>
                            @endforeach
                         </ul>
                     </div>
                @endif
                @if(session('updatePass'))
                <div class="alert alert-success mt-3">
                    {{session('updatePass')}}
                </div>
                @endif

                <div class="card-body">
                    <form action="{{ route('user.updatePasswordPost', $userPass->id) }}" method="POST">
                        @csrf
                  <div class="pt-3 py-3 mt-4 my-4 font-weight-bold alert alert-warning">
                      Recuerde que esta accion puede realizarse solo con la autorizacion de Gerencia y debe notificarse
                      al departamento de informatica.
                  </div>

                        <div class="form-group row">
                           <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                             <div class="col-md-6">
                                 <input id="name" type="text" class="form-control" name="name" disabled
                                 value="{{ $userPass->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>




                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="id" type="hidden" class="form-control" name="id"
                                    value="{{ $userPass->id }}">
                            </div>
                            <input type="hidden" name="user" value="{{auth()->user()->name}}">
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class='fas fa-check-circle'></i>
                                    {{ __('Cambiar contraseña') }}
                                </button>
                                <a href="{{url('/')}}" class="btn btn-primary" data-dismiss="modal">
                                    <i class='fa fa-times'></i>
                                    Cancelar
                                </a>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
