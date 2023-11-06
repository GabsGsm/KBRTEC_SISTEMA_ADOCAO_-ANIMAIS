<?php

namespace App\Http\Controllers;

use App\Models\Adocao;
use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelWriter;
use App\Models\User;

class ExcelController extends Controller
{
    public function exportUsers()
    {
        $users = User::all();

        $writer = SimpleExcelWriter::streamDownload('lista-Usuarios.xlsx');

        $header = ['ID', 'Nome', 'Email'];

        $writer->addRow($header);

        foreach ($users as $user) {
            $rowData = [$user->id, $user->name, $user->email];
            $writer->addRow($rowData);
        }

        return $writer->toResponse();
    }
    
    public function exportarFormularios(Request $request)
    {
        $formularios = Adocao::all();

        $writer = SimpleExcelWriter::streamDownload('formularios_de_adocao.xlsx');

        $header = ['ID', 'Solicitante', 'Nome_Pet', 'Email', 'CPF', 'Celular', 'Data_Nascimento', 'Data_Envio'];

        $writer->addRow($header);

        foreach ($formularios as $formulario) {
            $rowData = [$formulario->id, $formulario->nome_solicitante, $formulario->animal->nome, $formulario->email, $formulario->cpf, $formulario->celular, $formulario->data_nascimento, $formulario->data_envio];
            $writer->addRow($rowData);
        }

        return $writer->toResponse();
    }
    
}

