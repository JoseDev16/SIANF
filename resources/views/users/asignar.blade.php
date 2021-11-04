
@extends('base')
@section('title')
Asignar
@endsection
@section('extracss')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
<script src="{{ asset('js/customdt.js') }}"></script>

@endsection
@section('content')
@if(session('setRole'))
<div class="alert alert-success mt-3">
    {{session('setRole')}}
</div>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3><strong>Asignar rol a usuario</strong></h3>
                </div>
            </div>

            <table id="users-table" class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

 <!-- Editar Modal -->
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

               <label for="" class="control-label">Rol: </label>
               <select name="rol_id" id="rol_id" class="form-control" required>
                  <option value="">Selecciona la Rol</option>
                  @foreach ($roles as $rol)
                  <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                  @endforeach
               </select>


            <div class="modal-footer d-flex justify-content-center">
               <button type="submit" class="btn btn-primary">
                  <i class='fas fa-check-circle'></i>
                  Asignar
               </button>
               <input type="hidden" id="user_id" name="user_id">
               <a href="" class="btn btn-primary" data-dismiss="modal">
                  <i class='fa fa-times'></i>
                  Cancelar
               </a>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Fin Editar Modal-->
  <script type="text/javascript">
    $(function () {
      var table = $('.data-table').DataTable({


          processing: true,
          serverSide: true,
          ajax: "{{ route('users.asignarList') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'action', name: 'action', value:'id', orderable: false, searchable: false},
          ]




      });

    });

    function fun_edit(id)
   {
      var view_url = "/usuarios/getroles/"+id
      $.ajax({
         url: view_url,
         type:"GET",
         data: {"id":id},
         success: function(result){
             console.log(result)
            $("#user_id").val(result);


         }
      });
   }



  </script>
</body>


@endsection

