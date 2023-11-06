<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\ImagemAnimal;
use Illuminate\Support\Str;

class AnimalController extends Controller
{
    public function create()
    {
        return view('admin.cadastrar-animal');
    }

    public function store(Request $request)
{
    $request->validate([
        'nome' => 'required|string|max:255',
        'especie' => 'required|string|max:255',
        'raca' => 'required|string|max:255',
        'local' => 'required|string|max:255',
        'porte' => 'required|string|max:255',
        'idade' => 'required|integer',
        'peso' => 'required|numeric',
        'descricao' => 'required|string',
        'status' => 'required|in:Ativo,Inativo',
        'imagens.*' => 'image|mimes:jpg,jpeg,png', 
    ]);

    $existingAnimal = Animal::where([
        'nome' => $request->input('nome'),
        'especie' => $request->input('especie'),
        'idade' => $request->input('idade'),
    ])->first();

    if ($existingAnimal) {
        return redirect()->route('animais.create')->with('error', 'Já existe um animal com as mesmas credenciais.');
    }

    $animal = new Animal;
    $animal->nome = $request->input('nome');
    $animal->especie = $request->input('especie');
    $animal->raca = $request->input('raca');
    $animal->local = $request->input('local');
    $animal->porte = $request->input('porte');
    $animal->idade = $request->input('idade');
    $animal->peso = $request->input('peso');
    $animal->status = $request->input('status');
    $animal->descricao = $request->input('descricao');

    $animal->save();

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
    
        return redirect()->route('listagem.animal')->with('success', 'Animal cadastrado com sucesso.');
    } else {
        return redirect()->route('listagem.animal')->with('error', 'Erro ao carregar as imagens. Tente novamente mais tarde.');
    }
    
    
}

}
