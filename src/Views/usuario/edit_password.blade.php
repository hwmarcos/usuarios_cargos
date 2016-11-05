@extends('interbits::template.master')
@section('content')
    <div class="container">
        <a href="{{url('interbits/usuarios/editar/'.$id)}}" class="btn btn-default">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
            Voltar
        </a>
        <br/><br/>

        <form action="{{url('interbits/usuarios/salvar_senha')}}" method="POST">

            {{csrf_field()}}

            <input type="hidden" name="id" value="{{$id}}">

            <div class="form-group">
                <label for="senha">Nova senha</label>
                <input type="password" class="form-control" name="senha" id="senha" maxlength="15">
            </div>

            <div class="form-group">
                <label for="confirma">Confirmar Senha:</label>
                <input type="password" class="form-control" name="confirma" id="confirma" maxlength="15">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-block btn-default">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                    Salvar
                </button>
            </div>

        </form>
    </div>
@endsection