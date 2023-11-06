@extends('admin.painel')

@section('conteudo')
    <div class="d-flex align-items-end justify-content-between mb-4"> <h1 class="h3">Atualizar Animal</h1>
    </div>

    <form action="{{ route('animal.update', ['id' => $animal->id]) }}" method="post" class="bg-custom rounded col-12 py-3 px-4">
        @csrf
        @method('PUT')

        <div class="mb-3 row">
            <label for="nome" class="col-sm-2 col-form-label">Nome do Animal:</label>
            <div class="col-sm-10">
                <input  name="nome" value="{{$animal->nome}}" required autofocus  type="text" class="form-control bg-dark text-light border-dark" id="nome" >
                <x-input-error :messages="$errors->get('nome')" class="mt-2" />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="especie" class="col-sm-2 col-form-label">Espécie:</label>
            <div class="col-sm-10">
                <input name="especie" value="{{$animal->especie}}" required  type="text" class="form-control bg-dark text-light border-dark" id="especie">
                <x-input-error :messages="$errors->get('especie')" class="mt-2" />          
            </div>
        </div>

        <div class="mb-3 row">
            <label for="raca" class="col-sm-2 col-form-label">Raça:</label>
            <div class="col-sm-10">
                <input type="text" value="{{$animal->raca}}" class="form-control bg-dark text-light border-dark" id="raca" name="raca" required >
                <x-input-error :messages="$errors->get('raca')" class="mt-2" />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="local" class="col-sm-2 col-form-label">Local:</label>
            <div class="col-sm-10">
                <input type="text" value="{{$animal->local}}" class="form-control bg-dark text-light border-dark" id="local" name="local" required >
                <x-input-error :messages="$errors->get('local')" class="mt-2" />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="porte" class="col-sm-2 col-form-label">Porte:</label>
            <div class="col-sm-10">
                <input type="text" value="{{$animal->porte}}" class="form-control bg-dark text-light border-dark" id="porte" name="porte" required >
                <x-input-error :messages="$errors->get('porte')" class="mt-2" />
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="idade" class="col-sm-2 col-form-label">Idade:</label>
            <div class="col-sm-10">
                <input type="number" value="{{$animal->idade}}" class="form-control bg-dark text-light border-dark" id="idade" name="idade" required>
                <x-input-error :messages="$errors->get('idade')" class="mt-2" />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="peso" class="col-sm-2 col-form-label">Peso:</label>
            <div class="col-sm-10">
                <input type="number" value="{{$animal->peso}}" class="form-control bg-dark text-light border-dark" id="peso" name="peso" required>
                <x-input-error :messages="$errors->get('peso')" class="mt-2" />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="descricao" class="col-sm-2 col-form-label">Descricao:</label>
            <div class="col-sm-10">
                <input type="text" value="{{$animal->descricao}}" class="form-control bg-dark text-light border-dark" id="descricao" name="descricao" required>
                <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
            </div>
        </div>

        <div class="mb-3 row">
    <label for="status" class="col-sm-2 col-form-label">Status:</label>
    <div class="col-sm-10">
        <select name="status" value="{{$animal->status}}" class="form-select bg-dark text-light border-dark" id="status" required>
            <option value="Ativo">Ativo</option>
            <option value="Inativo">Inativo</option>
        </select>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
    </div>
</div>


        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-light">Alterar Dados</button>
        </div>
    </form>

    <form id="form-animal" enctype="multipart/form-data" method="POST"action="{{ route('animal.imagem', ['id' => $animal->id]) }}" class="bg-custom rounded col-12 py-3 px-4">
        @csrf
        @method('PUT')

        <div class="mb-3 row">
            <label for="imagens" class="col-sm-2 col-form-label">Imagens:</label>
            <div class="col-sm-10">
                <label for="imagens" class="btn btn-light mb-3">Selecionar</label>
                <input type="file" class="form-control bg-dark text-light border-dark" id="imagens" name="imagens[]" multiple accept=".jpg, .jpeg, .png" onchange="showImagePreview(this)" style="display: none;">
                <x-input-error :messages="$errors->get('imagens')" class="mt-2" />
            </div>
        </div>
        
       
            <div class="mb-3 row d-flex justify-content-center" id="imagem-carregada">
                <div class="col-sm-10 d-flex justify-content-around">
                    <div class="d-flex"  style="width: 100%; justify-content: space-around;">
                        @foreach ($imageUrls as $url)
                        <img src="{{ asset('storage/pets-imagem/' . $url) }}" width="80" height="80">
                         @endforeach
                    </div>
                </div>
            </div>

            <div class="mb-3 row d-flex justify-content-center">
                <div class="col-sm-10 d-flex justify-content-around" id="previa-imagem">
                </div>
            </div>
        


        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-light" id="enviar">Atualizar Imagens</button>
        </div>
    </form>

    <div class="bg-custom rounded overflow-hidden">

    </div>

    <script>
    const imagens = [];
    const maxImagens = 5;

    function showImagePreview(input) {
        const previaImagem = document.getElementById('previa-imagem');
        const imagemCarregada = document.getElementById('imagem-carregada');
        const files = input.files;

        if (imagens.length < maxImagens) {
            if (files.length > maxImagens - imagens.length) {
                alert('Você só pode selecionar mais ' + (maxImagens - imagens.length) + ' imagens.');
                input.value = '';
                return;
            }

            imagemCarregada.innerHTML='';

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (file.type.startsWith('image/')) {
                    const divImagem = document.createElement('div');
                    divImagem.className = 'd-flex';
                    const image = document.createElement('img');
                    image.src = URL.createObjectURL(file);
                    imagens.push(file);
                    image.width = 80;
                    image.height = 80;
                    
                    const spanRemover = document.createElement('span');
                    spanRemover.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16"> <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/> <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/> </svg>';
                    spanRemover.className = 'ms-1';
                    spanRemover.addEventListener('click', () => {
                        spanRemover.className += ' remover-imagem';
                        imagens.splice(imagens.indexOf(file), 1);
                        previaImagem.removeChild(divImagem);
                    });

                    divImagem.appendChild(image);
                    divImagem.appendChild(spanRemover);
                    previaImagem.appendChild(divImagem);
                } else {
                    alert('Por favor, selecione apenas arquivos de imagem.');
                    input.value = '';
                    return;
                }
            }
        }
    }
    document.getElementById('enviar').addEventListener('click', (event) => {
        event.preventDefault(); // Impedir o envio padrão do formulário


        const inputImagens = document.getElementById('imagens');
        inputImagens.value = '';

        const dataTransfer = new DataTransfer();

    imagens.forEach((imagem) => {
        dataTransfer.items.add(imagem);
    });

    inputImagens.files = dataTransfer.files;

    if (inputImagens.files.length > 0) {
        const formAnimal = document.getElementById('form-animal');
        formAnimal.submit();
    } else {
        console.log('Nenhuma imagem selecionada.');
    }

    });
</script>

@endsection