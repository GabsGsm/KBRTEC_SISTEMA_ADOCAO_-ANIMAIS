<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Adocao;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FormularioController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
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
            'animal_id' => $request->input('animal_id'),
        ])->first();

        if ($existingAnimal) {
            return redirect()->route('quero-adotar')->with('error', 'Já existe um animal com as mesmas credenciais.');
        }

        $adocao = Adocao::create([
            'animal_id' => $request->input('animal_id'),
            'nome_solicitante' => $request->input('nome_solicitante'),
            'cpf' => $request->input('cpf'),
            'email' => $request->input('email'),
            'celular'=> $request->input('celular'),
            'data_nascimento' => $request->input('data_nascimento'),
            'data_envio' => now(),
        ]);

        return redirect()->route('quero-adotar')->with('success', 'Formulário de adoção enviado com sucesso.');
    }
    public function view(){
        $formularios = Adocao::paginate(15);

        return view('admin.listagem-formulario', ['formularios'=> $formularios]);
    }
        public function filtro(Request $request){
            $nome_solicitante = $request->input('nome_solicitante');
            $nome_animal = $request->input('nome_animal');
            $data_envio = $request->input('data_envio');
        
            $query = Adocao::query();
        
            if (!empty($nome_solicitante)) {
                $query->where('nome_solicitante', 'LIKE', "%$nome_solicitante%");
            }
        
            if (!empty($nome_animal)) {
                $query->whereHas('animal', function ($q) use ($nome_animal) {
                    $q->where('nome', 'LIKE', "%$nome_animal%");
                });
            }
        
            if (!empty($data_envio)) {
                $query->whereDate('data_envio', '>=', $data_envio)
                      ->whereDate('data_envio', '<=', Carbon::parse($data_envio)->addMonth());
            }
        
            $formularios = $query->paginate(15);
        
            return view('admin.listagem-formulario', ['formularios' => $formularios]);
        }
        
    
}
