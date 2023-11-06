<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\ListagemAnimalController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PerfilController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/quero-adotar', [ListagemAnimalController::class, 'queroAdotar'])->name('quero-adotar');
Route::get('/quero-adotar/filtro', [ListagemAnimalController::class, 'queroAdotarFiltro'])->name('queroAdotarFiltro');

Route::get('/integra/{id}', [ListagemAnimalController::class, 'integra'])->name('integra');

Route::get('/formulario/{id}', [ListagemAnimalController::class, 'formulario'])->name('formulario');
Route::post('/formularios', [FormularioController::class, 'store'])->name('novoFormulario');

/*
Aqui ficou as rotas usadas para adptar os layouts fornecidos para usar com o breeze

Route::get('/login-teste', function () {
    return view('admin.login');
});
Route::get('/cadastrar-teste', function () {
    return view('admin.cadastrar');
});
Route::get('/recuperar-senha-teste', function () {
    return view('admin.recuperar-senha');
});
*/

Route::get('/painel', function () {
    $users = User::paginate(5);
    return view('admin.listagem', ['users' => $users]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/cadastrar-usuario', [UserController::class, 'showCadastro']);
    Route::get('/listagem', [UserController::class, 'showListagem'])->name('listagem');
    Route::get('/listagem/filtro', [UserController::class, 'filtroUsuarios'])->name('filtroUsuarios');

    Route::get('/perfil/editar/{id}', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil/{id}', [PerfilController::class,'update'])->name('perfil.update');
    Route::put('/perfil/senha/{id}', [PerfilController::class,'updateSenha'])->name('perfil.updateSenha');
    Route::delete('/usuarios/{id}', [PerfilController::class,'destroy'])->name('perfil.destroy');

    Route::get('/userPDF', [PDFController::class, 'gerarUsersPDF'])->name('userPFD');
    Route::get('/formularioDF', [PDFController::class, 'formularioPDF'])->name('formularioPDF');
    Route::get('/userEXCEL', [ExcelController::class, 'exportUsers'])->name('userEXCEL');
    Route::get('/adocaoEXCEL', [ExcelController::class, 'exportarFormularios'])->name('adocaoEXCEL');

    Route::get('/animais/create', [AnimalController::class, 'create'])->name('animais.create');
    Route::post('/animais', [AnimalController::class,'store'])->name('animais.store');

    Route::get('/listagemAnimal', [ListagemAnimalController::class, 'showListagemAnimal'])->name('listagem.animal');
    Route::get('/listagemAnimal/filtro', [ListagemAnimalController::class, 'filtroAnimal'])->name('filtroAnimal');

    Route::get('/animal/editar/{id}', [ListagemAnimalController::class, 'edit'])->name('animal.edit');
    Route::put('/animal/{id}', [ListagemAnimalController::class,'update'])->name('animal.update');
    Route::put('/animal/imagem/{id}', [ListagemAnimalController::class,'updateImages'])->name('animal.imagem');
    Route::delete('/animal/{id}', [ListagemAnimalController::class,'destroy'])->name('animal.destroy');
    Route::get('/animal/imagem/{id}', [ListagemAnimalController::class, 'imagensById'])->name('animal.imagensById');

    Route::get('list/formulario', [FormularioController::class, 'view'])->name('formulario.create');
    Route::get('list/formulario/filtro', [FormularioController::class, 'filtro'])->name('formularioFiltro');
    
});

require __DIR__.'/auth.php';
