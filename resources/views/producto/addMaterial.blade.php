@extends('base')
@section('titulo')
materiales
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">

        <li class="breadcrumb-item"><a href="{{route('producto.index')}}">Listado de productos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Materiales</li>
    </ol>
</nav>
<div class="h2 text-center">
    {{$producto->nombre_producto}}
</div>
<!--can('material.store')--->
<!-- Boton agregar material modal -->

<!--endcan-->
<!-- Fin Boton agregar material modal -->

<!-- Mensaje Exito -->
@if(session('exito'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('exito') }}
</div>
@endif

    
<!-- Fin Mensaje Exito -->
<div class="row mb-3">
    <label for="producto" class="col-form-label">Codigo Material</label>
    <div class="col-md-2">
      <input type="text" class="form-control" id="autocomplete-search">


    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary" onclick="fun_load()"> Cargar </button>
    </div>
</div>
<br>
<form action="{{ route('producto.addMaterial') }}" method="POST">
    @csrf
    <div class="form-row">
        <div class="col-md-2">
            <label for="codigo_material" class="col-form-label">Codigo</label>
            <input type="text" class="form-control" disabled name="codigo_material" id="codigo_material">
          </div>
      <div class="col-md">
        <label for="nombre_material" class="col-form-label">Material</label>
        <input type="text" class="form-control" disabled name="nombre_material" id="nombre_material">
      </div>
      <div class="col-md-2">
        <label for="unidad_medida" class="col-form-label">Unidad de medida</label>
        <input type="text" class="form-control" disabled name="unidad_medida" id="unidad_medida">
      </div>
      <div class="col-md-2">
        <label for="cantidad" class="col-form-label">cantidad</label>
        <input type="number" class="form-control" name="cantidad_material" id="cantidad_material" min="1" required>
      </div>
      <div class="col-md-1 text-center">
        <label for="activo" class="col-form-label ">Activo</label>
        <input type="checkbox" class="form-control" name="activo" id="activo">
      </div>
      <div class="col-md-1">
          <br>
          <input type="hidden" name="id_producto" value="{{ $producto->id }}">
          <input type="hidden" name="id_material" id="id_material">
          <input type="hidden" name="edit" id="edit">
        <button type="submit" class="btn btn-primary">Agregar</button>
      </div>

    </div>
  </form>
<br>
<br>
<!-- Table -->
<table class="table">
    <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Codigo</th>
            <th scope="col">Material</th>
            <th scope="col"> Cantidad </th>
            <th scope="col"> Estado </th>
            <th scope="col"> Acciones </th>

        </tr>
    </thead>
    <tbody>
        <?php $i = 0 ?>
        @foreach ($materiales as $material )
        <?php $i++ ?>
        <tr class="text-center">
            <td> {{ $i}} </td>
            <td> {{ $material->codigo_material }} </td>
            <td> {{ $material->nombre_material }} </td>
            <td>{{ $material->cantidad}}</td>
            @if($material->activo)
            <td  class=" text-success">Activo</td>
            @else
            <td class="text-warning">No incluido</td>
            @endif





            <td >
                <!--can('material.edit_view')-->
                <a type="button" title="Editar"  class="fas fa-w fa-plus-circle"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_edit('{{$material->id}}')"> </a>
                <!--endcan-->
               <!-- can('material.destroy')-->

               <button type="button" title="Eliminar" data-toggle="modal" data-target="#deleteModal"
                    class="fas fa-w fa-trash"
                    style="color:gray !important; background-color:transparent; border: 0px solid;"
                    onclick="fun_delete('{{$material->id}}')">
                </button>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- Fin Table -->
<!-- Paginacion de tabla -->

<!-- Fin Paginacion de tabla-->
<!-- Eliminar Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body align-self-center">
                <form action="{{ route('producto.destroyMaterial') }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div style="text-align: center">
                        <br>
                        <i class='fas fa-exclamation-circle' style='font-size:80px;color: gray;'></i>
                        <br>
                        <br>
                        <strong>
                            <h3>¿Estás seguro que deseas eliminar este material?</h3>
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
<script type="text/javascript">
    function fun_load()
    {
        var id = document.getElementById("autocomplete-search").value;
        var view_url = '{{ route("material.load", ":id") }}';

        view_url = view_url.replace(':id', id);
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){

                $("#codigo_material").val(result[0].codigo_material);
                $('#nombre_material').val(result[0].nombre_material);
                $('#unidad_medida').val(result[0].unidad_medida);
                console.log(result[0].id);
                $('#id_material').val(result[0].id);


            }
        });
    }

    function fun_edit(id)
    {
      ///  var id = document.getElementById("autocomplete-search").value;
       // var view_url = '{{ route("producto.editload", ":id") }}';
        console.log(id);
        view_url = "/Producto/editload/"+id;///view_url.replace(':id', id);
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){
                console.log(result[0].nombre_material);
                $("#codigo_material").val(result[0].codigo_material);
                $('#nombre_material').val(result[0].nombre_material);
                $('#unidad_medida').val(result[0].unidad_medida);
                $('#cantidad_material').val(result[0].cantidad);
                if(result[0].activo)
                {
                    $('#activo').prop('checked', true);
                }else{
                    $('#activo').prop('checked', false);
                }
                $('#id_material').val(result[0].idMaterial);
                $('#edit').val(1);


            }
        });
    }


    function fun_delete(id)
    {
        $("#delete_id").val(id);
    }
    //Limpiar los campos de la modal de traslados
    function limpiarCampos(){
        $('#nombre_material').val(''); //Limpiando el input
    }
</script>

@section('extrajs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>

<script type="text/javascript">

    $("#autocomplete-search").easyAutocomplete({
        url: function(search) {
            return "/search?search=" + search;



        },


        getValue: "codigo_material"

     });

     var path = "{{ route('posts.search') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });

    function fun_delete(id)
    {
        $("#delete_id").val(id);
    }

</script>

@endsection
@endsection
