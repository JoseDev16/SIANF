@extends('base')
@section('titulo')
Productos
@endsection
@section('content')
<!-- Mensaje ocupado -->
@if(session('ocupado'))
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('ocupado') }}
</div>
@endif
<!-- Fin Mensaje ocupado -->
<!-- Mensaje exito -->

<!-- Fin Mensaje exito -->
@if(count($categorias) > 0)
<nav aria-label="breadcrumb">
   <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Listado de Productos</li>
   </ol>
</nav>
<!-- Boton agregar producto modal -->
<!--can('producto.store')-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <button type="button" class="btn btn-primary" onclick="limpiarCampos()" data-toggle="modal" data-target="#addModal">
      Agregar producto
   </button>
</div>
<!--endcan-->
<!-- Fin Boton agregar producto modal -->
@else
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoriaModal">
      Agregar producto
   </button>
</div>
@endif
<div class="modal fade" id="addCategoriaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body align-self-center">
            <div style="text-align: center">
               <br>
               <i class='fas fa-exclamation-circle' style='font-size:0px;color: gray;'></i>
               <br>
               <br>
               <strong>
                  <h4>¡Opps! Parece que no tienes ninguna categoría registrada.</h4>
               </strong>
               <strong>
                  <h5>¿Deseas gestionar una categoría?</h5>
               </strong>
               <strong>Recuerda que debes agregar una categoría antes de realizar esta acción.</strong>
            </div>
            <div class="modal-footer d-flex justify-content-center">
               <a href="{{route('producto.index')}}" class="btn btn-primary">
                  <i class='fas fa-check-circle'></i>
                  Si
               </a>
               <a href="" class="btn btn-primary" data-dismiss="modal">
                  <i class='fa fa-times'></i>
                  No
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Agregar Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header" style="background-color:#F2F2F2 !important;">
            <h5 class="modal-title" id="exampleModalLongTitle">
               <i class="fas fw fa-plus-circle"></i>
               Agregar producto
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ route('producto.store') }}" method="POST" name="miForm">
               @csrf
               <div class="form-group required">
                  <label for="" class="control-label">Nombre de producto: </label>
                  <input  type="text" name="nombre_producto" id="codigo_producto"
                     class="form-control"  placeholder="Ingrese nombre de producto"  required autofocus>

                  <br>
                  <label for="" class="control-label">Codigo de producto: </label>
                  <input  type="text" name="codigo_producto" id="codigo_producto"
                     class="form-control"  placeholder="Ingrese nombre de producto" required autofocus>
                    <br>

                  <label for="" class="control-label">Unidad de medida: </label>
                  <select name="unidad_id" id="unidad_id" class="form-control" required>
                     <option value="">Seleccione la unidad</option>
                     <option value="lb">Libras</option>
                     <option value="unid">Por unidad</option>

                  </select>
                  <br>
                  <label for="" class="control-label">Categoria: </label>
                  <select name="categoria_id" id="categoria_id" class="form-control" required>
                     <option value="">Selecciona la categoría</option>
                     @foreach ($categorias as $categoria)
                     <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="modal-footer d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary">
                     <i class='fas fa-check-circle'></i>
                     Guardar
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
<!-- Fin Agregar Modal -->
<!-- Mensaje Exito -->
@if(session('exito'))
<div class="alert alert-success">
   <button type="button" class="close" data-dismiss="alert">×</button>
   {{ session('exito') }}
</div>
@endif

<!-- Fin Mensaje Exito -->
@if(count($productos) > 0)
<br>

<!-- Table -->
<table class=" table">
   <thead class="thead-dark">
      <tr>
         <th scope="col">#</th>
         <th scope="col">Nombre producto</th>
         <th scope="col">Categoría</th>
         <th scope="col">Acciones</th>
      </tr>
   </thead>
   <tbody>
      <?php $i = 0 ?>
      @foreach ($productos as $producto )
      <?php $i++ ?>
      <tr>
         <td> {{$i}} </td>
         <td> {{ $producto->nombre_producto }} </td>
         @foreach ($categorias as $categoria )
         @if($producto->categoria_id === $categoria->id)
         <td> {{ $categoria->nombre_categoria }} </td>
         @endif
         @endforeach
         <td style="display: flex">
           <!--can('producto.edit_view')-->
            <button type="button" title="Editar" data-toggle="modal" data-target="#editModal" class="fas fa-w fa-edit"
               style="color:gray !important; background-color:transparent; border: 0px solid;"
               onclick="fun_edit('{{$producto->id}}')"></button>
            <!--endcan-->
            <!--can('producto.destroy')-->
            <button type="button" title="Eliminar" data-toggle="modal" data-target="#deleteModal"
               class="fas fa-w fa-trash" style="color:gray !important; background-color:transparent; border: 0px solid;"
               onclick="fun_delete('{{$producto->id}}')"></button>
            <!---endcan-->
            <a type="button" title="Receta" fas fa-w fa-clipboard-list
               class="fas fa-w fa-clipboard-list" style="color:gray !important; background-color:transparent; border: 0px solid;"
               href="{{route('producto.setMaterial', $producto->id)}}"></a>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
<!-- Paginacion de tabla -->
<div class="d-flex justify-content-center">
   {{ $productos->links() }}
</div>
<!-- Fin Paginacion de tabla-->
<!-- Fin Table -->
<!-- Editar Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header" style="background-color:#F2F2F2 !important;">
            <h5 class="modal-title" id="exampleModalLongTitle">
               <i class="fas fa-w fa-edit"></i>
               Editar producto
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ route('producto.edit') }}" method="POST">
               @csrf
               <div class="form-group required">
                  <label for="" class="control-label">Nombre de producto: </label>
                  <input  type="text" name="nomb_producto" id="nomb_producto"
                     class="form-control" required
                     autofocus>
                  @if($errors->has('nomb_producto'))
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('nomb_producto') }}</strong>
                  </span>
                  @endif
                  <br>
                  <label for="" class="control-label">Categoría: </label>
                  <select name="cat_id" id="cat_id" class="form-control" required>
                     <option value="">Selecciona la categoría</option>
                     @foreach ($categorias as $categoria)
                     <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="modal-footer d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary">
                     <i class='fas fa-check-circle'></i>
                     Editar
                  </button>
                  <input type="hidden" id="edit_id" name="edit_id">
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
<!-- Fin Editar Modal-->
<!-- Eliminar Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body align-self-center">
            <form action="{{ route('producto.destroy') }}" method="POST">
               @csrf
               {{ method_field('DELETE') }}
               <div style="text-align: center">
                  <br>
                  <i class='fas fa-exclamation-circle' style='font-size:80px;color: gray;'></i>
                  <br>
                  <br>
                  <strong>
                     <h3>¿Estás seguro que deseas eliminar la producto?</h3>
                  </strong>
                  <strong>Recuerda que NO podrás revertir esta acción</strong>
                  <input type="hidden" id="delete_id" name="delete_id">
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
@else
<div class="alert alert-danger">
   <strong>¡Opps! Parece que no tienes ninguna producto registrada.</strong>
</div>
@endif
<script type="text/javascript">
   function fun_edit(id)
   {
      var view_url = "/Producto/edit/"+id;
      $.ajax({
         url: view_url,
         type:"GET",
         data: {"id":id},
         success: function(result){
            $("#edit_id").val(result.id);
            $('#nomb_producto').val(result.nombre_producto );
            $('#cat_id').val(result.categoria_id);
            console.log(result);
         }
      });
   }
   function fun_delete(id)
   {
      $("#delete_id").val(id);
   }
   //Limpiar los campos de la modal de traslados
   function limpiarCampos(){
      $('#nombre_producto').val(''); //Limpiando el input
      $("#categoria_id").val(""); //Seleccionando la primera opción del select
   }
</script>
@endsection
