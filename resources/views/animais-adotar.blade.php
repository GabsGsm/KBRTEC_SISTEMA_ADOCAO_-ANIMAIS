@extends('quero-adotar')

@section('animaisAdotar')

    @foreach ($animals as $animal)
            @if ($animal->status == 'Ativo')
                <div class="col-xxl-3 col-4">
                    <div class="card rounded overflow-hidden">
                        <a href="{{ route('integra', ['id' => $animal->id]) }}">
                            <img src="{{ asset('storage/pets-imagem/' . $animal->imagens[0]->url) }}" alt="" class="w-100 object-fit-cover" height="320">
                        </a>

                        <div class="p-3">
                            <p class="m-0 fs-sm">Cód. {{ $animal->id }}</p>

                            <div class="d-flex align-items-center gap-2 mt-2 py-2">
                                <h3 class="h4 m-0">{{ $animal->nome }}</h3>
                            </div>

                            <p class="mb-4 fs-md">{{ $animal->local }}</p>

                            <a href="{{ route('integra', ['id' => $animal->id]) }}" class="btn btn-custom-2 d-flex align-items-center justify-content-center gap-2 w-100">
                                Quero Adotar

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
@endsection