@extends('adminlte::page')

@section('title','Editar Usuário')
    
@section('content_header')

    <h1> Editar Usuário </h1>
    
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <h5>
                <i class="icon fas fa-ban"></i>
                Ocorreu um erro
            </h5>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        
    @endif

<div class="card">
    <div class="card-body">
        <form action="{{route('users.update',['user'=>$user->id])}}" method="post" class="form-horizontal">
            @method('PUT')
            @csrf
            <div class="form-group row">            
                    <label class="col-sm-2 col-form-label">Nome Completo</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{$user->name}}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Informe o seu nome" />
                    </div>            
            </div> <!--FIM DA DIV NOME COMPLETO -->
            <div class="form-group row">            
                    <label class="col-sm-2 col-form-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" value="{{$user->email}}"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Informe o seu e-mail"/>
                    </div>            
            </div> <!--FIM DA DIV E-MAIL -->
            <div class="form-group row">            
                    <label class="col-sm-2 col-form-label">Nova Senha</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" 
                                class="form-control @error('password') is-invalid @enderror" placeholder="Insira a nova senha"/>
                    </div>            
            </div> <!--FIM DA DIV SENHA -->
            <div class="form-group row">            
                    <label class="col-sm-2 col-form-label">Confirmação de Senha</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation" 
                                class="form-control @error('password') is-invalid @enderror" placeholder="Confirme a nova senha"/>
                    </div>            
            </div> <!--FIM DA DIV CONFIRMAR SENHA -->
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