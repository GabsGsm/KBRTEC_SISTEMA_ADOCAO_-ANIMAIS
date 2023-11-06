<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use  Illuminate\Database\Eloquent\Collection;


class UserController extends Controller
{
    public function showCadastro()
    {
        return view('admin.cadastrar-usuario');
    }

    public function showListagem(): View
    {
        $users = User::paginate(5);

        return view('admin.listagem', ['users' => $users]);
    }

    public function filtroUsuarios(Request $request)
    {
        $nome = $request->input('nome');
        $email = $request->input('email');

        $query = User::query();

        if ($nome) {
            $query->where('name', 'like', "%$nome%");
        }

        if ($email) {
            $query->where('email', 'like', "%$email%");
        }

        $users = $query->paginate(5);

        return view('admin.listagem', ['users' => $users]);
    }
}
