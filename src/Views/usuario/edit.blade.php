@extends('interbits::template.master')
@section('content')
    <div class="container">
        <a href="{{url('interbits/usuarios')}}" class="btn btn-default">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
            Voltar
        </a>
        @if(isset($usuario) && $usuario->id  > 0)
            <a href="{{url('interbits/usuarios/editar_senha', ['id'=>$usuario->id])}}" class="btn btn-default">
                <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                Alterar Senha
            </a>
        @endif
        <br/><br/>
        <form action="{{url('interbits/usuarios/salvar')}}" method="POST">

            {{csrf_field()}}

            <input type="hidden" name="id" id="id" value="{{isset($usuario->id)?$usuario->id:null}}">

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control"
                       value="{{isset($usuario->nome)?$usuario->nome:null}}">
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="text" name="email" id="email" class="form-control"
                       value="{{isset($usuario->email)?$usuario->email:null}}">
            </div>

            <div class="form-group">
                <label for="cargo_id">Função:</label>
                <select name="cargo_id" id="cargo_id" class="form-control">
                    @foreach($cargos as $cargo_id => $cargo)
                        @if(isset($usuario->cargo_id) && $usuario->cargo_id == $cargo_id)
                            <option value="{{$cargo_id}}" selected>{{$cargo}}</option>
                        @else
                            <option value="{{$cargo_id}}">{{$cargo}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    <label for="ddd">DDD</label>
                    <input type="text" name="ddd" id="ddd" class="form-control"
                           value="{{isset($usuario->ddd)?$usuario->ddd:null}}" maxlength="2">
                </div>
                <div class="col-md-9 form-group">
                    <label for="celular">Celular:</label>
                    <input type="text" name="celular" id="celular" class="form-control"
                           value="{{isset($usuario->celular)?$usuario->celular:null}}" maxlength="9">
                </div>
            </div>

            @if(!isset($usuario) || $usuario->id  == 0)
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" name="senha" id="senha" maxlength="15">
                </div>
                <div class="form-group">
                    <label for="confirma">Confirma senha:</label>
                    <input type="password" class="form-control" name="confirma" id="confirma" maxlength="15">
                </div>
            @endif

            <div class="form-group">
                <button type="submit" class="btn btn-block btn-default">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Salvar
                </button>
            </div>

        </form>
    </div>
@endsection