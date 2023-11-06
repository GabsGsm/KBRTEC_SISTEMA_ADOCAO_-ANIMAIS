<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class PerfilController extends Controller
{
    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('listagem-usuarios')->with('error', 'Usuário não encontrado.');
        }

        return view('admin.editar', ['user' => $user]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $id],
        ]);

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('listagem-usuarios')->with('error', 'Usuário não encontrado.');
        }

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect()->route('listagem')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function updateSenha(Request $request, $id)
    {
        $request->validate([
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('listagem-usuarios')->with('error', 'Usuário não encontrado.');
        }

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('listagem')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroy(Request $request , $id): RedirectResponse
        {
            $user = User::find($id);

            if (!$user) {
                return redirect()->route('listagem')->with('error', 'Usuário não encontrado.');
            }

            if ($user->id === Auth::id()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                $user->delete();
                return redirect()->to('/');
            }

            $user->delete();

            return redirect()->route('listagem')->with('success', 'Usuário excluído com sucesso.');
        }
}
