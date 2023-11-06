<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Adocao;
use App\Models\Animal;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ListagemAnimalController extends Controller
{
    public function showListagemAnimal()
    {
        $animals = Animal::paginate(5); 
        return view('admin.listagem-animal', ['animals' => $animals]);
    }

    public function filtroAnimal(Request $request)
    {
        $nome = $request->input('nome');
        $especie = $request->input('especie');
        $local = $request->input('local');
        $status = $request->input('status');

        $query = Animal::query();

        if ($nome) {
            $query->where('nome', 'like', "%$nome%");
        }

        if ($especie) {
            $query->where('especie', 'like', "%$especie%");
        }

        if ($local) {
            $query->where('local', 'like', "%$local%");
        }

        if ($status) {
            $query->where('status', 'like', "%$status%");
        }

        $animals = $query->paginate(5);

        return view('admin.listagem-animal', ['animals' => $animals]);
    }

    public function queroAdotar()
    {
        $animals = Animal::paginate(15); 
        
        return view('animais-adotar', ['animals' => $animals]);
    }

    public function queroAdotarFiltro(Request $request)
    {
        $especie = $request->input('especie');
        $raca = $request->input('raca');
        $local = $request->input('local');
        $porte = $request->input('porte');
    
        $query = Animal::query();
    
        if (!empty($raca)) {
            $query->where('raca', 'like', "%$raca%");
        }
    
        if (!empty($especie)) {
            $query->where('especie', 'like', "%$especie%");
        }
    
        if (!empty($local)) {
            $keywords = explode(' ', $local);
    
            $query->where(function($q) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $q->orWhere('local', 'like', "%$keyword%");
                }
            });
        }
    
        if (!empty($porte)) {
            $query->where('porte', 'like', "%$porte%");
        }
    
        $animals = $query->paginate(15);
    
        return view('animais-adotar', ['animals' => $animals]);
    }

    public function formulario($id){
        $animal = Animal::find($id);
    
        if (!$animal) {
            return redirect()->route('/')->with('error', 'Usuário não encontrado.');
        }
    
        return view('componente-formulario', ['animal' => $animal]);
    }
    
    public function novoFormulario(Request $request){
        $request->validate([
            'animal_id' => 'required|exists:animais,id',
            'nome_solicitante' => 'required|string',
            'cpf' => 'required|string',
            'email' => 'required|email',
            'celular' => 'required|string',
            'data_nascimento' => 'required|date',
        ]);
    
        $existingAnimal = Adocao::where([
            'nome_solicitante' => $request->input('nome_solicitante'),
            'cpf' => $request->input('cpf'),
            'email' => $request->input('email'),
        ])->first();
    
        if ($existingAnimal) {
            return redirect()->route('quero-adotar')->with('error', 'Já existe um animal com as mesmas credenciais.');
        }
    
        $adocao = new Adocao();
        $adocao->animal_id = $request->input('animal_id');
        $adocao->nome_solicitante = $request->input('nome_solicitante');
        $adocao->cpf = $request->input('cpf');
        $adocao->email = $request->input('email');
        $adocao->celular = $request->input('celular');
        $adocao->data_nascimento = $request->input('data_nascimento');
        $adocao->data_envio = now();
       
    
        $adocao->save();
    
        return redirect()->route('quero-adotar')->with('success', 'Formulário de adoção enviado com sucesso.');
    }
    public function edit($id)
{
    $animal = Animal::find($id);

    if (!$animal) {
        return redirect()->route('listagem-animal')->with('error', 'Usuário não encontrado.');
    }

    $imageUrls = $animal->imagens->pluck('url');

    return view('admin.editar-animal', ['animal' => $animal, 'imageUrls' => $imageUrls]);
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'especie' => ['required', 'string', 'max:255'],
            'raca' => ['required', 'string', 'max:255'],
            'idade' => ['required', 'integer'],
            'peso' => ['required', 'numeric'],
            'porte' => ['required', 'string', 'max:255'],
            'local' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        $animal = Animal::find($id);

        if (!$animal) {
            return redirect()->route('listagem.animal')->with('error', 'Animal não encontrado.');
        }

        $animal->nome = $request->nome;
        $animal->especie = $request->especie;
        $animal->raca = $request->raca;
        $animal->idade = $request->idade;
        $animal->peso = $request->peso;
        $animal->porte = $request->porte;
        $animal->local = $request->local;
        $animal->descricao = $request->descricao;
        $animal->status = $request->status;

        $animal->save();

        return redirect()->route('listagem.animal')->with('success', 'Animal atualizado com sucesso.');
    }

    public function destroy(Request $request, $id)
{
    $animal = Animal::find($id);

    if (!$animal) {
        return redirect()->route('listagem-imagem')->with('error', 'Animal não encontrado.');
    }

    foreach ($animal->imagens as $imagem) {
        $path = public_path('storage'. DIRECTORY_SEPARATOR . 'pets-imagem'. DIRECTORY_SEPARATOR . $imagem->url);

        if (file_exists($path)) {
            unlink($path);
        }
    }

    $animal->imagens()->delete();
    $animal->delete();

    return redirect()->route('listagem.animal')->with('success', 'Animal e imagens excluídos com sucesso.');
}

public function updateImages(Request $request, $id)
{
    $request->validate([
        'imagens.*' => 'image|mimes:jpg,jpeg,png', 
    ]);

    $animal = Animal::find($id);

    if (!$animal) {
        return redirect()->route('listagem-imagem')->with('error', 'Animal não encontrado.');
    }

    foreach ($animal->imagens as $imagem) {
        $path = public_path('storage'. DIRECTORY_SEPARATOR . 'pets-imagem'. DIRECTORY_SEPARATOR . $imagem->url);

        if (file_exists($path)) {
            unlink($path);
            $animal->imagens()->delete();
        }
    }

    if ($request->hasFile('imagens')) {
        $i = 1; // Contador para numerar as imagens

        foreach ($request->file('imagens') as $imagem) {
            $nomeImagem = $animal->nome . '_' .$animal->especie.'_'.$animal->raca.'_'.$animal->porte.'_'. $i . '.' . $imagem->getClientOriginalExtension();
            $caminhoImagem = $imagem->storeAs('public/pets-imagem', $nomeImagem);

            // Salvar o caminho da imagem no banco de dados
            $animal->imagens()->create([
                'url' => $nomeImagem
            ]);

            $i++; // Incrementar o contador
        }

        return redirect()->route('listagem.animal')->with('success', 'Imagens atualizadas com sucesso.');
    }

    return redirect()->route('listagem.animal')->with('success', 'Nenhuma imagem foi enviada para atualização.');
}

public function integra($id){
    $animal = Animal::find($id);

    if (!$animal) {
        return redirect()->route('/')->with('error', 'Usuário não encontrado.');
    }

    return view('integra', ['animal' => $animal]);
}

}
