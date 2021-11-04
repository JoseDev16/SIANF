@extends('base')
@section('title')
Mostrar Usuario
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('user.index')}}">Listado de usuarios</a></li>
        <li class="breadcrumb-item active" aria-current="page">Mostrar Usuario</li>
    </ol>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    <div class="form-group row">
                        <label for="name" class="col-md-5 col-form-label text-md-right">{{ __('Nombre:') }}</label>
                        <div class="col-md-6">
                            <label id="name" class="col-md-10 col-form-label text-md-left">{{ $userShow->name }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="user" class="col-md-5 col-form-label text-md-right">{{ __('Usuario:') }}</label>
                        <div class="col-md-6">
                            <label id="user" class="col-md-10 col-form-label text-md-left">{{ $userShow->username }}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email"
                            class="col-md-5 col-form-label text-md-right">{{ __('Correo eléctronico:') }}</label>
                        <div class="col-md-6">
                            <label id="email"
                                class="col-md-10 col-form-label text-md-leftt">{{ $userShow->email }}</label>
                        </div>
                    </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
