@extends('base')
@section('titulo')
materiales
@endsection
@section('content')
@if(count($subcategorias) > 0)
<nav aria-label="breadcrumb">
   <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Listado de materiales</li>
   </ol>
</nav>
<!-- Boton agregar material modal -->
<!--can('material.store')-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <button type="button" class="btn btn-primary" onclick="limpiarCampos()" data-toggle="modal" data-target="#addModal">
      Agregar material
   </button>
</div>
<!--endcan-->
<!-- Fin Boton agregar material modal -->
@else
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoriaModal">
      Agregar material
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
               <a href="{{route('material.index')}}" class="btn btn-primary">
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
               Agregar material
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ route('material.store') }}" method="POST" name="miForm">
               @csrf
               <div class="form-group required">
                  <label for="" class="control-label">Nombre de material: </label>
                  <input  type="text" name="nombre_material" id="nombre_material"
                     class="form-control" placeholder="Ingrese nombre de material"  required  autofocus>
                  @if($errors->has('nombre_material'))
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('nombre_material') }}</strong>
                  </span>
                  @endif
                  <br>
                  <label for="codigo_material" class="control-label">Codigo material: </label>
                  <input  type="text" name="codigo_material" id="codigo_material"
                  class="form-control" placeholder="Ingrese nombre de material"  required  autofocus>

                  <br>
                  <label for="" class="control-label">Unidad de medida: </label>
                  <select name="unidad_id" id="unidad_id" class="form-control" required>
                     <option value="">Seleccione la unidad</option>
                     <option value="lb">Libras</option>
                     <option value="unid">Por unidad</option>

                  </select>
                  <br>
                  <label for="" class="control-label">Sub Categoría: </label>
                  <select name="subcat_id" id="subcat_id" class="form-control" required>
                     <option value="">Selecciona la Sub categoría</option>
                     @foreach ($subcategorias as $subcategoria)
                     <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre_subcategoria_material }}</option>
                     @endforeach
                  </select>
                  <br>
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
@if(count($materiales) > 0)
<br>
<!-- Table -->
<table class=" table">
   <thead class="thead-dark">
      <tr>
         <th scope="col">#</th>
         <th scope="col">Codigo Material</th>
         <th scope="col">Nombre material</th>
         <th scope="col">Unidad medida</th>
         <th scope="col">Categoría</th>
         <th scope="col">Subcategoría</th>

         <th scope="col">Acciones</th>
      </tr>
   </thead>
   <tbody>
      <?php $i = 0 ?>
      @foreach ($materiales as $material )
      <?php $i++ ?>
      <tr>
         <td> {{$i}} </td>
         <td> {{ $material->codigo_material }} </td>
         <td> {{ $material->nombre_material }} </td>
         <td> {{ $material->unidad_medida }} </td>
         @foreach ($subcategorias as $scategoria )

         <td> {{ $scategoria->categoria->nombre_categoriaMaterial }} </td>

         @endforeach
         @foreach ($subcategorias as $subcategoria )
         @if($material->subcategoria_material_id === $subcategoria->id)
         <td> {{ $subcategoria->nombre_subcategoria_material }} </td>
         @endif
         @endforeach
      
         <td style="display: flex">
           <!--can('material.edit_view')-->
            <button type="button" title="Editar" data-toggle="modal" data-target="#editModal" class="fas fa-w fa-edit"
               style="color:gray !important; background-color:transparent; border: 0px solid;"
               onclick="fun_edit('{{$material->id}}')"></button>
            <!--endcan-->
            <!--can('material.destroy')-->
            <button type="button" title="Eliminar" data-toggle="modal" data-target="#deleteModal"
               class="fas fa-w fa-trash" style="color:gray !important; background-color:transparent; border: 0px solid;"
               onclick="fun_delete('{{$material->id}}')"></button>
            <!---endcan-->
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
<!-- Paginacion de tabla -->
<div class="d-flex justify-content-center">
   {{ $materiales->links() }}
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
               Editar material
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ route('material.edit') }}" method="POST">
               @csrf
               <div class="form-group required">
                <label for="" class="control-label">Nombre de material: </label>
                <input  type="text" name="nombre_material" id="nomb_material"
                   class="form-control" placeholder="Ingrese nombre de material"  required  autofocus>
                 <br>
                <label for="codigo_material" class="control-label">Codigo material: </label>
                <input  type="text" name="codigo_material" id="cod"
                class="form-control" placeholder="Ingrese nombre de material"  required  autofocus>

                <br>
                <label for="" class="control-label">Unidad de medida: </label>
                <select name="unidad_id" id="unidad_id" class="form-control" required>
                   <option value="">Seleccione la unidad</option>
                   <option value="lb">Libras</option>
                   <option value="unid">Por unidad</option>

                </select>
                <br>
                <label for="" class="control-label">Sub Categoría: </label>
                <select name="subcat_id" id="cat_id" class="form-control" required>
                   <option value="">Selecciona la Sub categoría</option>
                   @foreach ($subcategorias as $subcategoria)
                   <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre_subcategoria_material }}</option>
                   @endforeach
                </select>
                <br>
                <label for="" class="control-label">Composicion: </label>
                <select name="comp_id" id="comp_id" class="form-control" required>
                   <option value="">Selecciona la Composicion</option>
                   @foreach ($composiciones as $composicion)
                   <option value="{{ $composicion->id }}">{{ $composicion->nombre_composicion }}</option>
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
            <form action="{{ route('material.destroy') }}" method="POST">
               @csrf
               {{ method_field('DELETE') }}
               <div style="text-align: center">
                  <br>
                  <i class='fas fa-exclamation-circle' style='font-size:80px;color: gray;'></i>
                  <br>
                  <br>
                  <strong>
                     <h3>¿Estás seguro que deseas eliminar la material?</h3>
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
   <strong>¡Opps! Parece que no tienes ninguna material registrada.</strong>
</div>
@endif
<script type="text/javascript">
   function fun_edit(id)
   {
      var view_url = "/Material/edit/"+id;
      $.ajax({
         url: view_url,
         type:"GET",
         data: {"id":id},
         success: function(result){
            $("#edit_id").val(result.id);
            $("#cod").val(result.codigo_material);
            $('#nomb_material').val(result.nombre_material );
            $('#cat_id').val(result.subcategoria_material_id);
            $("#unidad_id  option[value='"+result.unidad_medida+"']").attr("selected",true);
            $('#comp_id').val(result.composicion_id)
            console.log(result.unidad_medida);
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
      $('#nombre_material').val(''); //Limpiando el input
      $("#categoria_id").val(""); //Seleccionando la primera opción del select
   }
</script>
@endsection
