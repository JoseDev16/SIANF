@extends('base')
@section('title')
Editar Rol
@endsection
@section('extracss')
<link rel="stylesheet" src="{{ asset('dist/bootstrap-duallistbox.css') }}">

@endsection
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('rol.index')}}">Listado de roles</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar Rol</li>
    </ol>
</nav>
<div class="container">
    @if(session('exito'))
    <div class="alert alert-success mt-3">
        {{ session('exito') }}
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <form action="{{ route('rol.update') }}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{$rol->name}}">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="" class="control-label">Seleccione los autores</label> <br>
                            <div class="">
                                <select multiple="multiple" size="10" id="dual_list" name="permisos[]"  required>
                                    @foreach ($permisos as $permiso)

                                            <option selected=true value="{{$permiso->id}}">{{$permiso->name}}</option>
                                    @endforeach
                                    @foreach ($permisosNoAsignados as $noAsignado)

                                    <option  value="{{$noAsignado->id}}">{{$noAsignado->name}}</option>
                                     @endforeach

                                     <input id="rol_id" type="hidden" class="form-control" name="rol_id" value="{{$rol->id}}">
                                     <input type="hidden" name="user" value="{{auth()->user()->name}}">

                                </select>
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class='fas fa-check-circle'></i>
                                    {{ __('Editar Rol') }}
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
        $('#bootstrap-duallistbox-selected-list_autores[]')
    </script>

    <script type="text/javascript">
        function fun_delete(id)
       {
          $("#delete_id").val(id);
       }
    </script>

@endsection


@endsection
