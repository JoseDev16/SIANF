<!-- Editar Modal -->
<div class="modal fade" id="editRazonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#F2F2F2 !important;">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <i class="fas fa-w fa-edit"></i>
                    Editar razón financiera
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('parametros.edit') }}" method="POST">
                    @csrf
                    <div class="form-group required">
                        <div class="mb-3">
                            <label for="" class="control-label">Nombre de tipo cuenta: </label>
                            <input maxlength="100" type="text" name="parametro" id="parametro"
                                class="form-control{{ $errors->has('parametro') ? ' is-invalid' : '' }}" 
                                disabled>
                            @if($errors->has('parametro'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('parametro') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="" class="control-label">Valor: </label>
                            <input maxlength="100" type="text" name="valor" id="valor"
                                class="form-control{{ $errors->has('valor') ? ' is-invalid' : '' }}" required
                                autofocus>
                            @if($errors->has('valor'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('valor') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="" class="control-label">Tipo de razón: </label>
                            <select class="form-control{{ $errors->has('tipo_id') ? ' is-invalid' : '' }} form-select" aria-label="Default select example" id="tipo_id" name="tipo_id">
                                @foreach ($tiposParametro as $tipoParametro )
                                <option value="{{ $tipoParametro->id }}">{{ $tipoParametro->nombre }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tipo_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('tipo_id') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="" class="control-label">Mensaje si el calculo es mayor: </label>
                            <input maxlength="150" type="text" name="mayor" id="mayor"
                                class="form-control{{ $errors->has('mayor') ? ' is-invalid' : '' }}" required
                                autofocus>
                            @if($errors->has('mayor'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('mayor') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="" class="control-label">Mensaje si el calculo es menor: </label>
                            <input maxlength="100" type="text" name="menor" id="menor"
                                class="form-control{{ $errors->has('menor') ? ' is-invalid' : '' }}" required
                                autofocus>
                            @if($errors->has('menor'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('menor') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="" class="control-label">Mensaje si el calculo es igual: </label>
                            <input maxlength="100" type="text" name="entre" id="entre"
                                class="form-control{{ $errors->has('entre') ? ' is-invalid' : '' }}" required
                                autofocus>
                            @if($errors->has('entre'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('entre') }}</strong>
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
