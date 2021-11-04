@extends('base')

@section('title')
Registro
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center mt-3 ">
        <div class="col-md-10 mt-5 ">
            <h2 class="text-center"> Registro de usuarios</h2>
            <div class="card-body mt-5">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group row required">
                        <label for="name"
                            class="col-md-4 col-form-label text-md-right control-label">{{ __('Nombre') }}: </label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row required">
                        <label for="username"
                            class="col-md-4 col-form-label text-md-right control-label">{{ __('Usuario') }}:
                        </label>

                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row required">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right control-label">{{ __('Correo eléctronico') }}:
                        </label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row required">
                        <label for="password"
                            class="col-md-4 col-form-label text-md-right control-label">{{ __('Contraseña') }}:
                        </label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row required">
                        <label for="password_confirmation"
                            class="col-md-4 col-form-label text-md-right control-label">{{ __('Confirme su contraseña') }}:
                        </label>

                        <div class="col-md-6">
                            <input id="password_confirmation" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
                                required autocomplete="new-password">

                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <input type="hidden" name="user" value="{{auth()->user()->name}}">


                    </div>
                    <div class="form-group row mb-0">
                        <div class=" text-center col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                <i class='fas fa-check-circle'></i>
                                {{ __('Registrar usuario') }}
                            </button>

                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>





@endsection
