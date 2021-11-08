<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#F2F2F2 !important;">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <i class="fas fw fa-plus-circle"></i>
                    Agregar periodo
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('periodo.store') }}" method="POST" name="miForm">
                    @csrf
                    <div class="form-group required">
                        <div class="mb-3">
                            <label for="" class="control-label">Año: </label>
                            <input maxlength="20" type="text" name="year"
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
                            <input maxlength="20" type="text" name="acciones"
                                class="form-control{{ $errors->has('acciones') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese las acciones" value="{{ old('acciones') }}" required
                                autofocus>
                            @if($errors->has('acciones'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('acciones') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="" class="control-label">Gastos financieros: </label>
                            <input maxlength="20" type="text" name="gastos_financieros"
                                class="form-control{{ $errors->has('gastos_financieros') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese el gasto financiero" value="{{ old('gastos_financieros') }}" required
                                autofocus>
                            @if($errors->has('gastos_financieros'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('gastos_financieros') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="" class="control-label">Inversión inicial: </label>
                            <input maxlength="20" type="text" name="inversion_inicial"
                                class="form-control{{ $errors->has('inversion_inicial') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese la inversion inicial" value="{{ old('inversion_inicial') }}" required
                                autofocus>
                            @if($errors->has('inversion_inicial'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('inversion_inicial') }}</strong>
                            </span>
                            @endif
                        </div>
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
