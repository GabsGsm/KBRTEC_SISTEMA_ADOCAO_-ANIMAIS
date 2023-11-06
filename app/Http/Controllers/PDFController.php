<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Adocao;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;


class PDFController extends Controller
{
    

public function gerarUsersPDF()
{
    $users = User::all();

    $pdf = PDF::loadView('pdf.pdf_user', ['data' => $users]); 
    return $pdf->download('lista_de_usuarios.pdf');
}

public function formularioPDF()
{
    $formularios = Adocao::all();

        $pdf = PDF::loadView('pdf.pdf_adocao', ['data' => $formularios]); 
        return $pdf->download('formulario_de_adocao.pdf');
}
}
