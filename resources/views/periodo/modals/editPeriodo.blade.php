<!-- Editar Modal -->
<div class="modal fade" id="editPeriodoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#F2F2F2 !important;">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <i class="fas fa-w fa-edit"></i>
                    Editar periodo
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('periodo.edit') }}" method="POST">
                    @csrf
                    <div class="form-group required">
                    <div class="mb-3">
                            <label for="" class="control-label">Año: </label>
                            <input maxlength="20" type="text" name="year" id="year"
                                class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese el año" value="{{ old('year') }}" required
                                autofocus>
                            @if($errors->has('year'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('year') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="" class="control-label">Acciones: </label>
                            <input maxlength="20" type="text" name="acciones" id="acciones"
                                class="form-control{{ $errors->has('acciones') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese las acciones" value="{{ old('acciones') }}" required
                                autofocus>
                            @if($errors->has('acciones'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('acciones') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div>
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
