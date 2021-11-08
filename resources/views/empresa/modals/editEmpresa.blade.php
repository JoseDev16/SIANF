<!-- Editar Modal de empresa-->
<div class="modal fade" id="editEmpresaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#F2F2F2 !important;">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <i class="fas fa-w fa-edit"></i>
                    Editar empresa
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('empresa.edit') }}" method="POST">
                    @csrf
                    <div class="form-group required">
                        <label for="" class="control-label">Nombre de la empresa: </label>
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
                        <label for="" class="control-label">Nit de la empresa: </label>
                        <input maxlength="20" type="text" name="nit" id="nit"
                            class="form-control{{ $errors->has('nit') ? ' is-invalid' : '' }}" required
                            autofocus>
                        @if($errors->has('nit'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nit') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group required">
                        <label for="" class="control-label">Nrc de la empresa: </label>
                        <input maxlength="20" type="text" name="nrc" id="nrc"
                            class="form-control{{ $errors->has('nrc') ? ' is-invalid' : '' }}" required
                            autofocus>
                        @if($errors->has('nrc'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nrc') }}</strong>
                        </span>
                        @endif
                    </div>
                    <!-- LISTA SECTORES-->
                    <div class="form-group required">
                        <label for="" class="control-label">Sector: </label>
                        <select maxlength="20" type="text" name="sector_id"
                            class="form-control"
                            value="{{ old('sector_id') }}" required
                            autofocus>
                            @foreach ($sectores as $sec)
                            <option value="{{$sec->id}}"> {{$sec->nombre}} </option>
                        @endforeach
                        
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
<!-- Fin Editar Modal empresa-->
