@extends('admin.painel')

@section('conteudo')
    <div class="d-flex align-items-end justify-content-between mb-4"> <h1 class="h3">Editar Usuário</h1>
    <a href="/painel" class="btn btn-light">Voltar</a>
    </div>

    <form method="POST"action="{{ route('perfil.update', ['id' => $user->id]) }}" class="bg-custom rounded col-12 py-3 px-4">
        @csrf
        @method('PUT')

        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nome:</label>
            <div class="col-sm-10">
                <input  name="name" value="{{$user->name}}" required autocomplete="name"  type="text" class="form-control bg-dark text-light border-dark" id="name" >
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">E-mail:</label>
            <div class="col-sm-10">
                <input name="email" value="{{$user->email}}" required autocomplete="username"  type="email" class="form-control bg-dark text-light border-dark" id="email">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />          
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-light">Salvar</button>
        </div>
    </form>

    <form method="POST"action="{{ route('perfil.updateSenha', ['id' => $user->id]) }}" class="bg-custom rounded col-12 py-3 px-4">
        @csrf
        @method('PUT')

        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Senha:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control bg-dark text-light border-dark" id="password" name="password" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="password_confirmation" class="col-sm-2 col-form-label">Confirmar Senha:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control bg-dark text-light border-dark" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-light">Alterar senha</button>
        </div>
    </form>

    <div class="bg-custom rounded overflow-hidden">

    </div>
@endsection