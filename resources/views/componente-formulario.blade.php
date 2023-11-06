@extends('formulario')

@section('formulario')
<form method="POST" action="{{ route('novoFormulario') }}" class="bg-custom rounded col-12 py-3 px-4">
        @csrf

        <div class="mb-3 row">
            <label for="nome_solicitante" class="col-sm-2 col-form-label">Seu Nome:</label>
            <div class="col-sm-10">
                <input  name="nome_solicitante" :value="old('name')" required autofocus autocomplete="nome_solicitante"  type="text" class="form-control bg-dark text-light border-dark" id="nome_solicitante" >
                <x-input-error :messages="$errors->get('nome_solicitante')" class="mt-2" />
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Nome do Animal::</label>
            <div class="col-sm-10">
                <label class="form-control bg-dark text-light border-dark"  >{{$animal->nome}}</label>
                <x-input-error :messages="$errors->get('nome_solicitante')" class="mt-2" />
            </div>
        </div>

        <div>
                <input  name="animal_id" value="{{$animal->id}}" required autocomplete="animal_id"  type="text" class="form-control bg-dark text-light border-dark" id="animal_id" style="display: none;">
                <x-input-error :messages="$errors->get('animal_id')" class="mt-2" />
        </div>
        

        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">E-mail:</label>
            <div class="col-sm-10">
                <input name="email" :value="old('email')" required autocomplete="email"  type="email" class="form-control bg-dark text-light border-dark" id="email">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />          
            </div>
        </div>

        <div class="mb-3 row">
            <label for="cpf" class="col-sm-2 col-form-label">CPF:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control bg-dark text-light border-dark" id="cpf" name="cpf" required autocomplete="cpf">
                <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="celular" class="col-sm-2 col-form-label">Celular:</label>
            <div class="col-sm-10">
                <input type="phone" class="form-control bg-dark text-light border-dark" id="celular" name="celular" required autocomplete="celular">
                <x-input-error :messages="$errors->get('celular')" class="mt-2" />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="data_nascimento" class="col-sm-2 col-form-label">Data de Nascimento:</label>
            <div class="col-sm-10">
                <input type="date" class="form-control bg-dark text-light border-dark" id="data_nascimento" name="data_nascimento" required autocomplete="data_nascimento">
                <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-light">Cadastrar</button>
        </div>
    </form>
@endsection
