@extends('base')
@section('title')
Editar Usuario
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('user.index')}}">Listado de usuarios</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar Usuario</li>
    </ol>
</nav>
<div class="container">
@if(session('setRole'))
<div class="alert alert-success mt-3">
    {{session('setRole')}}
</div>
@endif
@if(session('deleteRole'))
<div class="alert alert-success mt-3">
    {{session('deleteRole')}}
</div>
@endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <form action="{{ route('user.update', $userActualizar->id) }}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="name1" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name1" type="text" class="form-control" name="name"
                                    value="{{ $userActualizar->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user1" class="col-md-4 col-form-label text-md-right">{{ __('Usuario') }}</label>

                            <div class="col-md-6">
                                <input id="user1" type="text" class="form-control" name="username"
                                    value="{{ $userActualizar->username }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ $userActualizar->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="id" type="hidden" class="form-control" name="id"
                                    value="{{ $userActualizar->id }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rol" class="col-md-4 col-form-label text-md-right">{{ __('Roles asignados') }}</label>
                            @if($userRol)
                            <div class="col-md-6">
                                <select name="rol_id" id="rol_id" class="form-control" required>
                                    @foreach ($userRol as $rol)
                                    <option >{{ $rol }}</option>
                                    @endforeach
                                 </select>
                                <button type="button" name="" id="" class="btn btn-info mt-1" data-toggle="modal" data-target="#editModal">Asignar</button>
                                <button type="button" title="Eliminar" data-toggle="modal" data-target="#deleteModal"
                                    class="fas fa-w fa-trash ml-2"
                                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                                    onclick="fun_delete()">
                                </button>
                            </div>
                            @else
                            <div class="col-md-6">
                                <input id="user1" type="text" class="form-control"

                                    value="Sin roles asignados" disabled>
                                    <button type="button" name="" id="" class="btn btn-info mt-1" data-toggle="modal" data-target="#editModal">Asignar</button>

                            </div>
                            @endif

                        </div>


                        <input type="hidden" name="user" value="{{auth()->user()->name}}">
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class='fas fa-check-circle'></i>
                                    {{ __('Editar Usuario') }}
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

    <!-- Eliminar Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body align-self-center">
                    <form action="{{route('user.deleteRoles')}}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <div style="text-align: center">
                            <br>
                            <i class='fas fa-exclamation-circle' style='font-size:80px;color: gray;'></i>
                            <br>
                            <br>
                            <strong>
                                <h3>¿Estás seguro que deseas eliminar el rol seleccionado ?</h3>
                            </strong>
                            <strong>Recuerda que NO podrás revertir esta acción</strong>
                            <input type="hidden" name="user" value="{{auth()->user()->name}}">
                            <input type="hidden" id="delete_id" name="delete_id">
                            <input type="hidden" id="usr_id" name="usr_id" value="{{$userActualizar->id}}">
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-danger">
                                <i class='fas fa-check-circle'></i>
                                Eliminar
                            </button>
                            <a href="" class="btn btn-primary" data-dismiss="modal">
                                <i class='fa fa-times'></i>
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- asignar Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
aria-hidden="true">
<div class="modal-dialog" role="document">
   <div class="modal-content">
      <div class="modal-header" style="background-color:#F2F2F2 !important;">
         <h5 class="modal-title" id="exampleModalLongTitle">
            <i class="fas fa-w fa-edit"></i>
            Asignar rol
         </h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">
         <form action="{{route('user.setRoles')}}" method="post">
            @csrf

               <label for="rol_id" class="control-label">Rol: </label>
               <select name="rol_id2" id="rol_id2" class="form-control" required>
                  <option value="">Selecciona la Rol</option>
                  @foreach ($rolesQuery as $rol2)
                  <option value="{{ $rol2->id }}">{{ $rol2->name }}</option>
                  @endforeach
               </select>

               <input type="hidden" name="user" value="{{auth()->user()->name}}">
            <div class="modal-footer d-flex justify-content-center">
               <button type="submit" class="btn btn-primary">
                  <i class='fas fa-check-circle'></i>
                  Asignar
               </button>
               <input id="user_id" type="hidden" class="form-control" name="user_id"
               value="{{ $userActualizar->id }}">
               <a href="" class="btn btn-primary" data-dismiss="modal">
                  <i class='fa fa-times'></i>
                  Cancelar
               </a>
            </div>
         </form>
      </div>
   </div>

</div>
<!--fin modal asignar-->
<script  type="text/javascript">
    function fun_delete()
    {
        var combo = document.getElementById("rol_id");
        var selected = combo.options[combo.selectedIndex].text;
        var nombreRol = document.getElementById("name1")
        document.getElementById("delete_id").value = selected;
        console.log(selected);
    }

</script>


@endsection
