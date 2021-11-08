<!-- Editar Modal -->
<div class="modal fade" id="editCuentaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#F2F2F2 !important;">
        <h5 class="modal-title" id="exampleModalLongTitle">
          <i class="fas fa-w fa-edit"></i>
          Editar cuenta
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
          <div class="modal-body">
            <form action="{{ route('cuenta.edit') }}" method="POST">
              @csrf
              {{-- Fields --}}
              <div class="form-group required">
                <label for="" class="control-label">Codigo de la cuenta: </label>
                <input maxlength="20" type="text" name="codigo" id="codigo"
                  class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" required
                  autofocus>
                  @if($errors->has('codigo'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('codigo') }}</strong>
                  </span>
                  @endif
              </div>
              <div class="form-group required">
                <label for="" class="control-label">Nombre de la cuenta: </label>
                <input maxlength="20" type="text" name="nombre" id="nombre"
                  class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" required
                  autofocus>
                  @if($errors->has('nombre'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nombre') }}</strong>
                  </span>
                  @endif
              </div>     
              <div class="form-group required">
                  <label for="" class="control-label">Tipo cuenta: </label>
                  <select class="form-control{{ $errors->has('tipo_id') ? ' is-invalid' : '' }} form-select" aria-label="Default select example" id="tipo_id" name="tipo_id">
                      @foreach ($tiposCuenta as $tipoCuenta )
                      <option value="{{ $tipoCuenta->id }}">{{ $tipoCuenta->nombre }}</option>
                      @endforeach
                  </select>
                  @if($errors->has('tipo_id'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('tipo_id') }}</strong>
                  </span>
                  @endif
              </div> 
              {{-- End of fields --}}
              <input type="hidden" name="user" value="{{auth()->user()->name}}">
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
