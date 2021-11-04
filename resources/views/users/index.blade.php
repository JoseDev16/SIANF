@extends('base')
@section('title')
Usuarios
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Listado de usuarios</li>
    </ol>
</nav>
<div class="col-md-12">
    <a href="{{route('register')}}" class="btn btn-primary">Agregar usuario</a>
</div>
<div class="col-md-12 pt-4">
    @if(session('eliminar'))
    <div class="alert alert-success mt-3">
        {{session('eliminar')}}
    </div>

    @endif
    @if(session('update'))
    <div class="alert alert-success mt-3">
        {{session('update')}}
    </div>
    @endif
    @if(session('delete'))
    <div class="alert alert-success mt-3">
        {{session('delete')}}
    </div>
    @endif

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>

                <th scope="col">Correo eléctronico</th>

                <th scope="col">Acciones</th>
            </tr>
            @foreach ($usuarios as $usuario )
            <tr>
                <td> {{ $usuario->id }} </td>
                 <td> {{ $usuario->name }} </td>

                <td> {{ $usuario->email }} </td>

                <td>
                    @can('user.show')
                    <a class="fas fa-w fa-eye" title="Mostrar" href="{{route('user.show', $usuario->id)}}"
                        style="color:gray !important; margin-right: 12px"></a>
                    @endcan

                    @can('user.edit')
                    <a class="fas fa-w fa-edit" title="Editar" href="{{route('user.edit', $usuario->id)}}"
                            style="color:gray !important; margin-right: 5px">
                    </a>
                    @endcan
                    
                    @can('user.updatePassword')
                    <a class="fas fa-w fa-unlock-alt" title="Cambiar clave" href="{{route('user.updatePassword', $usuario->id)}}"
                        style="color:gray !important; margin-right: 5px">
                    </a>
                    @endcan
                    @can('user.destroy')
                        <button type="button" title="Eliminar" data-toggle="modal" data-target="#deleteModal"
                            class="fas fa-w fa-trash"
                            style="color:gray !important; background-color:transparent; border: 0px solid;"
                            onclick="fun_delete('{{$usuario->id}}')">
                        </button>
                    @endcan

                </td>
            </tr>
            @endforeach
        </thead>
    </table>
    <!-- Paginacion de tabla -->
    <div class="d-flex justify-content-center">
        {{ $usuarios->links() }}
    </div>
    <!-- Fin Paginacion de tabla-->
    <!-- Eliminar Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body align-self-center">
                    <form action="{{ route('user.delete') }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <div style="text-align: center">
                            <br>
                            <i class='fas fa-exclamation-circle' style='font-size:80px;color: gray;'></i>
                            <br>
                            <br>
                            <strong>
                                <h3>¿Estás seguro que deseas eliminar el usuario?</h3>
                            </strong>
                            <strong>Recuerda que NO podrás revertir esta acción</strong>
                            <input type="hidden" id="delete_id" name="delete_id">
                            <input type="hidden" name="user" value="{{auth()->user()->name}}">
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">
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
</div>
<script type="text/javascript">
    function fun_delete(id)
   {
      $("#delete_id").val(id);
   }
</script>
@endsection
