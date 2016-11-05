@extends('interbits::template.master')
@section('content')
    <div class="container">
        <a href="{{url('interbits/funcoes')}}" class="btn btn-default">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
            Voltar
        </a>
        <br/><br/>
        <form action="{{url('interbits/funcoes/salvar')}}" method="POST">

            {{csrf_field()}}

            <input type="hidden" id="id" name="id" value="{{isset($cargo->id)?$cargo->id:null}}">

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control" autofocus="autofocus"
                       value="{{isset($cargo->nome)?$cargo->nome:null}}">
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