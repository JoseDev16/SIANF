<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#F2F2F2 !important;">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <i class="fas fw fa-plus-circle"></i>
                    Agregar Cuenta
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cuenta.store') }}" method="POST" name="miForm">
                    @csrf
                    <div class="form-group required">
                        <label for="" class="control-label">Nombre cuenta: </label>
                        <input maxlength="20" type="text" name="nombre"
                            class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}"
                            placeholder="Ingrese nombre de la cuenta" value="{{ old('nombre') }}" required
                            autofocus>
                        @if($errors->has('nombre'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group required">
                      <label for="" class="control-label">Codigo cuenta: </label>
                      <input maxlength="20" type="text" name="codigo"
                          class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}"
                          placeholder="Ingrese codigo de la cuenta" value="{{ old('codigo') }}" required
                          autofocus>
                      @if($errors->has('codigo'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('codigo') }}</strong>
                      </span>
                      @endif
                  </div>
                  
                    <div class="modal-footer d-flex justify-content-center">
                        <input type="hidden" name="user" value="{{auth()->user()->name}}">
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
