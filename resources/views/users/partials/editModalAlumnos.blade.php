<!-- Mostrar Modal -->
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
         <div class="modal-header" style="background-color:#F2F2F2 !important;">
            <h5 class="modal-title" id="exampleModalLongTitle">
               <i class="fas fw fa-plus-circle"></i>
               Editar Usuario
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <!--  -->
            <form id="form_alumno_edit" action="{{ route('alumno.edit') }}" method="POST">
               @csrf
               <input type="hidden" id="AlumId" name="AlumId">
               <div class="form-group required">
                  <label for="carnet_e" class="control-label">Carnet del alumno: </label>
                  <input type="text" name="carnet_e" class="form-control" name="" id="carnet_e"
                     placeholder="Ingrese la descripcion del alumno" required readonly>
               </div>
               <div class="form-group required">
                  <label for="nombre_alumno" class="control-label">Nombre del alumno: </label>
                  <input type="text" name="nombre_alumno_e" class="form-control" id="nombre_alumno_e"
                     placeholder="Ingrese el nombre del alumno" required>
               </div>
               <div class="form-group required">
                  <label for="apellido_alumno_e" class="control-label">Apellido del alumno: </label>
                  <input type="text" name="apellido_alumno_e" class="form-control" name="" id="apellido_alumno_e"
                     placeholder="Ingrese la descripcion del alumno" required>
               </div>
               <div class="form-group required">
                  <label for="nombre_alumno" class="control-label">Carrera del alumno: </label>
                  <select name="carrera_id_e" id="carrera_id_e" class="form-control" required>
                     @foreach ($carreras as $carrera)
                     <option value="{{$carrera->id}}">{{$carrera->nombre_carrera}}</option>
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
<!-- Fin Mostrar Modal -->
