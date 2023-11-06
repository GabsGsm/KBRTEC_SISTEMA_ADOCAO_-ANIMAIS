@extends('admin.painel')

@section('conteudo')
<div class="d-flex justify-content-between mb-4">
                <h1 class="h3">Formularios</h1>

                <div class="d-flex gap-2">
                    <a href="{{route('formularioPDF')}}" class="btn btn-light" title="PDF">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                        </svg>
                    </a>

                    <a href="{{route('adocaoEXCEL')}}" class="btn btn-light" title="Excel">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
                            <path d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z"/>
                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                        </svg>
                    </a>

                </div>
            </div>

            <div class="d-flex justify-content-between align-items-end mb-3">
            <form action="{{ route('formularioFiltro') }}" method="GET" class="bg-custom rounded col-12 py-3 px-4">
                <div class="row align-items-end row-gap-4">
                    <div class="col-3 d-flex flex-wrap">
                        <label for="nome_solicitante" class="col-form-label">Solicitante:</label>
                        <div class="col-12">
                            <input type="text" name="nome_solicitante" class="form-control bg-dark text-light border-dark" id="nome_solicitante" placeholder="Ex: Gabriel..">
                        </div>
                    </div>

                    <div class="col-3 d-flex flex-wrap">
                        <label for="nome_animal" class="col-form-label">Pet:</label>
                        <div class="col-12">
                            <input type="text" name="nome_animal" class="form-control bg-dark text-light border-dark" id="nome_animal" placeholder="Ex: Billy...">
                        </div>
                    </div>
                    
                    <div class="col-3 d-flex flex-wrap">
                        <label for="data_envio" class="col-form-label">Data de Solicitação:</label>
                        <div class="col-12">
                            <input type="date" name="data_envio" class="form-control bg-dark text-light border-dark" id="data_envio" placeholder="Ex: 2023/11/05">
                        </div>
                    </div>

                    <div class="col d-flex justify-content-end">
                        <button type="submit" class="btn btn-light w-auto">Filtrar</button>
                    </div>
                </div>
            </form>

            </div>


            <div class="bg-custom rounded overflow-hidden">
                <table class="table mb-0 table-custom table-dark align-middle">
                    <thead>
                        <tr>
                            <th scope="col" class="text-uppercase">Solicitante</th>
                            <th scope="col" class="text-uppercase">E-mail</th>
                            <th scope="col" class="text-uppercase">Animal</th>
                            <th scope="col" class="text-uppercase">Data de Nascimento</th>
                            <th scope="col" class="text-uppercase text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($formularios as $formulario)
                            <tr>
                                <td>{{ $formulario->nome_solicitante}}</td>
                                <td>{{$formulario->email}}</td>
                                <td>{{$formulario->animal->nome}}</td>
                                <td>{{$formulario->data_nascimento}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-light d-flex justify-content-center align-items-center rounded-circle p-2 mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $formulario->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                            </svg>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                         @endforeach
                         @foreach ($formularios as $formulario)
                            <div class="modal fade" id="exampleModal-{{ $formulario->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered text-light">
                                    <div class="modal-content bg-custom">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Usuário</h1>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-wrap row-gap-4">
                                            <div class="col-6">
                                                <div><small>Solicitante:</small></div>
                                                <div>{{ $formulario->nome_solicitante }}</div>
                                            </div>
                                            <div class="col-12">
                                                <div><small>E-mail:</small></div>
                                                <div>{{ $formulario->email }}</div>
                                            </div>

                                            <div class="col-12">
                                                <div><small>CPF:</small></div>
                                                <div>{{ $formulario->cpf}}</div>
                                            </div>

                                            <div class="col-12">
                                                <div><small>Celular:</small></div>
                                                <div>{{ $formulario->celular }}</div>
                                            </div>

                                            <div class="col-12">
                                                <div><small>Data deNascimento:</small></div>
                                                <div>{{ $formulario->data_nascimento }}</div>
                                            </div>
                                            <div class="col-12">
                                                <div><small>Pet:</small></div>
                                                <div>{{ $formulario->animal->nome }}</div>
                                            </div>
                                            <div class="col-12">
                                                <div><small>Especie:</small></div>
                                                <div>{{ $formulario->animal->especie}}</div>
                                            </div>
                                            <div class="col-12">
                                                <div><small>Descrição:</small></div>
                                                <div>{{ $formulario->animal->descricao }}</div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <nav aria-label="navigation">
                <div class="d-flex justify-content-end pt-4 pb-2">
                    {{ $formularios->links('admin.links') }}
                </div>
            </nav>
            
@endsection