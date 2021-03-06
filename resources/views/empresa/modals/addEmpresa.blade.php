<!-- Inicio Agregar empresa Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#F2F2F2 !important;">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <i class="fas fw fa-plus-circle"></i>
                    Agregar empresa
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- lo que va en controller --BORRAR LUEGO ESTO-->
                <form action="{{ route('empresa.store') }}" method="POST" name="miForm">
                    @csrf
                    <div class="form-group required">
                        <label for="" class="control-label">Nombre de la empresa: </label>
                        <input maxlength="20" type="text" name="nombre"
                            class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}"
                            placeholder="Ingrese nombre de la empresa" value="{{ old('nombre') }}" required
                            autofocus>

                            @if($errors->has('nombre'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                             @endif

                    </div>

                    <div class="form-group required">
                        <label for="" class="control-label">Nit de la empresa: </label>
                        <input maxlength="20" type="text" name="nit"
                            class="form-control{{ $errors->has('nit') ? ' is-invalid' : '' }}"
                            placeholder="Ingrese nit de la empresa" value="{{ old('nit') }}" required
                            autofocus>

                            @if($errors->has('nit'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nit') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="form-group required">
                        <label for="" class="control-label">Nrc de la empresa: </label>
                        <input maxlength="20" type="text" name="nrc"
                            class="form-control{{ $errors->has('nrc') ? ' is-invalid' : '' }}"
                            placeholder="Ingrese nrc de la empresa" value="{{ old('nrc') }}" required
                            autofocus>

                            @if($errors->has('nrc'))
                                <span class="invalid-feedback" role="alert">
                                     <strong>{{ $errors->first('nrc') }}</strong>
                                </span>
                             @endif
                    </div>
                    <!--LISTA DE SECTORES-->
                    <div class="form-group required">
                        <label for="" class="control-label">Sector: </label>
                        <select maxlength="20"  name="sector_id"
                            class="form-control"
                            value="{{ old('sector_id') }}" required
                            autofocus>
                            <option value="">Seleccione el sector </option>>
                            @foreach ($sectores as $sec)
                            <option value="{{$sec->id}}"> {{$sec->nombre}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group required">
                        <label for="" class="control-label">Usuario: </label>
                        <input maxlength="20" type="text" name="username"
                            class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                            placeholder="Ingrese el usuario de la empresa" value="{{ old('username') }}" required
                            autofocus>

                            @if($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                     <strong>{{ $errors->first('username') }}</strong>
                                </span>
                             @endif
                    </div>

                    <div class="form-group required">
                        <label for="" class="control-label">Contrase??a: </label>
                        <input maxlength="20" type="password" name="password"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                            placeholder="Ingrese el password de la empresa" value="{{ old('password') }}" required
                            autofocus>

                            @if($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                     <strong>{{ $errors->first('password') }}</strong>
                                </span>
                             @endif
                    </div>
                        
                        <div class="form-group required">   
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
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin Agregar  empresa Modal -->