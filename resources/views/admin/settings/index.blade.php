@extends('adminlte::page')

@section('title', 'Configurações')
    
@section('content_header')
    <h1>Configurações </h1>    
@endsection

@section('content')
   <div class="card">
       <div class="card-body">
            <form action="{{route('settings.save')}}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 form-label">Título do Site</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control">

                    </div>
                </div><!--FIM DA DIV TITLE -->

                <div class="form-group row">
                    <label class="col-sm-2 form-label">Subtítulo</label>
                    <div class="col-sm-10">
                        <input type="text" name="subtitle" class="form-control">
                    </div>
                </div><!--FIM DA DIV SUBTITLE -->

                <div class="form-group row">
                    <label class="col-sm-2 form-label">E-mail para Contato</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control">
                    </div>
                </div><!--FIM DA DIV EMAIL -->
                
                <div class="form-group row">
                    <label class="col-sm-2 form-label">Cor de Fundo</label>
                    <div class="col-sm-10">
                        <input type="color" name="bgcolor" class="form-control">
                    </div>
                </div><!--FIM DA DIV BGCOLOR -->

                <div class="form-group row">
                    <label class="col-sm-2 form-label">Cor do Texto</label>
                    <div class="col-sm-10">
                        <input type="color" name="textcolor" class="form-control">
                    </div>
                </div><!--FIM DA DIV TEXTCOLOR -->

                <div class="form-group row">            
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Salvar" class="btn btn-success"/>
                    </div>            
                </div> 
            </form>
       </div>
   </div> 
@endsection