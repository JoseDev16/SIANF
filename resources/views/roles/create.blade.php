
@extends('base')
@section('title')
Roles
@endsection
@section('content')
@section('extracss')
<link rel="stylesheet" src="{{ asset('dist/bootstrap-duallistbox.css') }}">

@endsection

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"> /Agregar rol</li>
    </ol>
</nav>
<div class="col-md-9">
    @if(session('exito'))
    <div class="alert alert-success mt-3">
        {{ session('exito') }}
    </div>
    @endif
    @if(session('delete'))
    <div class="alert alert-success mt-3">
        {{session('delete')}}
    </div>
    @endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @can('rol.index')
            <table class="table ">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Accion</th>

                    </tr>
                    @foreach ($roles as $rol )
                    <tr>
                        <td> {{ $rol->id }} </td>
                        <td> {{ $rol->name }} </td>
                        <td>
                            @can('rol.edit')
                            <a class="fas fa-w fa-edit" href="{{route('rol.edit', $rol->id)}}"
                            style="color:gray !important; background-color:transparent; border: 0px solid;"></a>
                            @endcan
                            @can('rol.delete')
                            <button type="button" title="Eliminar" data-toggle="modal" data-target="#deleteModal"
                            class="fas fa-w fa-trash"
                            style="color:gray !important; background-color:transparent; border: 0px solid;"
                            onclick="fun_delete('{{$rol->id}}')">
                            @endcan
                        </button>

                        </td>


                    </tr>
                    @endforeach
                </thead>
            </table>
            @endcan
            @can('rol.store')
            <div class="card">
                <div class="card-body">
                    <h4 class=" pb-3 pt-3"> <i class="fas fw fa-plus-circle"></i> Agregar Rol </h4>
                    <form action="{{ route('rol.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nombre del rol:</label>
                            <input type="text" name="name" id="name" class="form-control "
                                placeholder="Ingrese nombre del rol" required>
                            <input type="hidden" name="user" value="{{auth()->user()->name}}">
                        </div>
                        <h5><strong> Lista de permisos </strong></h5>
                        <div class="form-group">
                            <select multiple="multiple" name="permissions[]" id="dual_list">
                                @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"> Guardar Rol </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endcan

        <!-- Eliminar Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body align-self-center">
                    <form action="{{ route('rol.delete') }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <div style="text-align: center">
                            <br>
                            <i class='fas fa-exclamation-circle' style='font-size:80px;color: gray;'></i>
                            <br>
                            <br>
                            <strong>
                                <h3>¿Estás seguro que deseas eliminar el rol?</h3>
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

@section('extrajs')
<script src="{{ asset('dist/jquery.bootstrap-duallistbox.js') }}"></script>

<script type="text/javascript">

$('#dual_list').bootstrapDualListbox({
    // default text
    filterTextClear: 'Mostrar todo',
    filterPlaceHolder: 'Filtrar',
    moveSelectedLabel: 'Mover seleccionado',
    moveAllLabel: 'Mover todo',
    removeSelectedLabel: 'Eliminar seleccionado',
    removeAllLabel: 'Eliminar todo',
    // true/false (forced true on androids, see the comment later)
    moveOnSelect: true,
    // 'all' / 'moved' / false
    preserveSelectionOnMove: false,
    // 'string', false
    selectedListLabel: false,
    // 'string', false
    nonSelectedListLabel: false,
    // 'string_of_postfix' / false
    helperSelectNamePostfix: '_helper',
    // minimal height in pixels
    selectorMinimalHeight: 100,
    // whether to show filter inputs
    showFilterInputs: true,
    // string, filter the non selected options
    nonSelectedFilter: '',
    // string, filter the selected options
    selectedFilter: '',
    // text when all options are visible / false for no info text
    infoText: 'Mostrando todo {0}',
    // when not all of the options are visible due to the filter
    infoTextFiltered: '<span class="badge badge-warning">Fitrado</span> {0} de {1}',
    // when there are no options present in the list
    infoTextEmpty: 'Lista vacia',
    // sort by input order
    sortByInputOrder: false,
    // filter by selector's values, boolean
    filterOnValues: false,
    // boolean, allows user to unbind default event behaviour and run their own instead
    eventMoveOverride: false,
    // boolean, allows user to unbind default event behaviour and run their own instead
    eventMoveAllOverride: false,
    // boolean, allows user to unbind default event behaviour and run their own instead
    eventRemoveOverride: false,
    // boolean, allows user to unbind default event behaviour and run their own instead
    eventRemoveAllOverride: false,
     // sets the button style class for all the buttons
    btnClass: 'btn-outline-secondary',
    // string, sets the text for the "Move" button
    btnMoveText: '&gt;',
    // string, sets the text for the "Remove" button
    btnRemoveText: '&lt;',
    // string, sets the text for the "Move All" button
    btnMoveAllText: '&gt;&gt;',
    // string, sets the text for the "Remove All" button
    btnRemoveAllText: '&lt;&lt;'
    });
    </script>

<script type="text/javascript">
    $('#bootstrap-duallistbox-selected-list_permissions[]')
</script>
<script type="text/javascript">
    function fun_delete(id)
   {
      $("#delete_id").val(id);
   }
</script>


@endsection


@endsection
