@extends('base')
@section('titulo')
Subcategorías
@endsection
@section('content')
@if(count($categorias) > 0)
<nav aria-label="breadcrumb">
   <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Listado de subcategorías</li>
   </ol>
</nav>
<!-- Boton agregar Subcategoria modal -->
<!--can('subcategoria.store')-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <button type="button" class="btn btn-primary" onclick="limpiarCampos()" data-toggle="modal" data-target="#addModal">
      Agregar subcategoria
   </button>
</div>
<!--endcan-->
<!-- Fin Boton agregar Subcategoria modal -->
@else
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoriaModal">
      Agregar subcategoría
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
               <a href="{{route('subcategoriaMaterial.index')}}" class="btn btn-primary">
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
               Agregar subcategoría
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ route('subcategoriaMaterial.store') }}" method="POST" name="miForm">
               @csrf
               <div class="form-group required">
                  <label for="" class="control-label">Nombre de subcategoría: </label>
                  <input maxlength="40" type="text" name="nombre_subcategoria" id="nombre_subcategoria"
                     class="form-control{{ $errors->has('nombre_subcategoria') ? ' is-invalid' : '' }}"
                     placeholder="Ingrese nombre de subcategoria" value="{{ old('nombre_subcategoria') }}" required
                     autofocus>
                  @if($errors->has('nombre_subcategoria'))
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('nombre_subcategoria') }}</strong>
                  </span>
                  @endif
                  <br>
                  <label for="" class="control-label">Categoría: </label>
                  <select name="categoria_id" id="categoria_id" class="form-control" required>
                     <option value="">Selecciona la categoría</option>
                     @foreach ($categorias as $categoria)
                     <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoriaMaterial }}</option>
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
@if(count($subcategorias) > 0)
<br>
<!-- Table -->
<table class=" table">
   <thead class="thead-dark">
      <tr>
         <th scope="col">#</th>
         <th scope="col">Nombre subcategoría</th>
         <th scope="col">Categoría</th>
         <th scope="col">Acciones</th>
      </tr>
   </thead>
   <tbody>
      <?php $i = 0 ?>
      @foreach ($subcategorias as $subcategoria )
      <?php $i++ ?>
      <tr>
         <td> {{$i}} </td>
         <td> {{ $subcategoria->nombre_subcategoria_material }} </td>
         @foreach ($categorias as $categoria )
         @if($subcategoria->categoriaMaterial_id === $categoria->id)
         <td> {{ $categoria->nombre_categoriaMaterial }} </td>
         @endif
         @endforeach
         <td style="display: flex">
           <!--can('subcategoria.edit_view')-->
            <button type="button" title="Editar" data-toggle="modal" data-target="#editModal" class="fas fa-w fa-edit"
               style="color:gray !important; background-color:transparent; border: 0px solid;"
               onclick="fun_edit('{{$subcategoria->id}}')"></button>
            <!--endcan-->
            <!--can('subcategoria.destroy')-->
            <button type="button" title="Eliminar" data-toggle="modal" data-target="#deleteModal"
               class="fas fa-w fa-trash" style="color:gray !important; background-color:transparent; border: 0px solid;"
               onclick="fun_delete('{{$subcategoria->id}}')"></button>
            <!---endcan-->
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
<!-- Paginacion de tabla -->
<div class="d-flex justify-content-center">
   {{ $subcategorias->links() }}
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
               Editar subcategoría
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ route('subcategoriaMaterial.edit') }}" method="POST">
               @csrf
               <div class="form-group required">
                  <label for="" class="control-label">Nombre de subcategoría: </label>
                  <input maxlength="20" type="text" name="nomb_subcategoria" id="nomb_subcategoria"
                     class="form-control{{ $errors->has('nomb_subcategoria') ? ' is-invalid' : '' }}" required
                     autofocus>
                  @if($errors->has('nomb_subcategoria'))
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('nomb_subcategoria') }}</strong>
                  </span>
                  @endif
                  <br>
                  <label for="" class="control-label">Categoría: </label>
                  <select name="cat_id" id="cat_id" class="form-control" required>
                     <option value="">Selecciona la categoría</option>
                     @foreach ($categorias as $categoria)
                     <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoriaMaterial }}</option>
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
            <form action="{{ route('subcategoriaMaterial.destroy') }}" method="POST">
               @csrf
               {{ method_field('DELETE') }}
               <div style="text-align: center">
                  <br>
                  <i class='fas fa-exclamation-circle' style='font-size:80px;color: gray;'></i>
                  <br>
                  <br>
                  <strong>
                     <h3>¿Estás seguro que deseas eliminar la subcategoría?</h3>
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
   <strong>¡Opps! Parece que no tienes ninguna subcategoría registrada.</strong>
</div>
@endif
<script type="text/javascript">
   function fun_edit(id)
   {
      var view_url = "/SubCategoriaMaterial/edit/"+id;
      $.ajax({
         url: view_url,
         type:"GET",
         data: {"id":id},
         success: function(result){
            $("#edit_id").val(result.id);
            $('#nomb_subcategoria').val(result.nombre_subcategoria_material );
            $('#cat_id').val(result.categoriaMaterial_id);
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
      $('#nombre_subcategoria').val(''); //Limpiando el input
      $("#categoria_id").val(""); //Seleccionando la primera opción del select
   }
</script>
@endsection
