<?php

use App\Http\Controllers\EditarProfessorTurmaController;
use App\Http\Controllers\EditarTurmaController;
use App\Http\Controllers\ProfessorTurmaController;
use App\Http\Controllers\RemoverMensagemController;
use App\Http\Controllers\RemoverTurmaController;
use App\Models\Administrador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ApostilaController;
use App\Http\Controllers\MensagemController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\CadastrarAdministradorController;
use App\Http\Controllers\CadastrarAlunoController;
use App\Http\Controllers\NovaApostilaController;
use App\Http\Controllers\CadastrarProfessorController;
use App\Http\Controllers\CadastrarTurmaController;
use App\Http\Controllers\NovaMensagemController;
use App\Http\Controllers\EditarProfessorController;
use App\Http\Controllers\RemoverProfessorController;
use App\Http\Controllers\EditAdministradorController;
use App\Http\Controllers\RemoverAdministradorController;
use App\Http\Controllers\RemoverApostilaController;
use App\Http\Controllers\EditarAlunoController;
use App\Http\Controllers\RemoverAlunoController;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/listar/administradores', [AdministradorController::class, 'listar']);

Route::get('/listar/alunos', [AlunoController::class, 'listar']);

Route::get('/listar/apostilas', [ApostilaController::class, 'listar']);

Route::get('/listar/mensagens', [MensagemController::class, 'listar']);

Route::get('/listar/professores', [ProfessorController::class, 'listar']);

Route::get('/listar/turmas', [TurmaController::class, 'listar']);

Route::get('/admin/listar/professores', [ProfessorController::class, 'listarAdmin']);

Route::get('/admin/listar/turmas', [TurmaController::class, 'listarAdmin']);

Route::get('/admin/listar/alunos', [AlunoController::class, 'listarAdmin']);

Route::get('/admin/listar/administradores', [AdministradorController::class, 'listarAdmins']);

Route::get('/admin/listar/apostilas', [ApostilaController::class, 'listarAdmin']);

Route::get('/prof/listar/apostilas', [ApostilaController::class, 'listarProf']);

Route::get('/cadastrar/administrador', [CadastrarAdministradorController::class, 'prepararCadastro'])->name('administrador.cadastrar');

Route::post('/cadastrar/administrador', [CadastrarAdministradorController::class, 'cadastrar'])->name('administrador.create');

Route::get('/cadastrar/aluno', [CadastrarAlunoController::class, 'prepararCadastro'])->name('aluno.cadastrar');

Route::post('/cadastrar/aluno', [CadastrarAlunoController::class, 'cadastrar'])->name('aluno.create');

Route::get('/cadastrar/apostila', [NovaApostilaController::class, 'prepararEnvio'])->name('apostila.cadastrar');

Route::post('/cadastrar/apostila', [NovaApostilaController::class, 'enviar'])->name('apostila.create');

Route::get('/cadastrar/professor', [CadastrarProfessorController::class, 'prepararCadastro'])->name('professor.cadastrar');

Route::post('/cadastrar/professor', [CadastrarProfessorController::class, 'cadastrar'])->name('professor.create');

Route::get('/cadastrar/turma', [CadastrarTurmaController::class, 'prepararCadastro'])->name('turma.cadastrar');

Route::post('/cadastrar/turma', [CadastrarTurmaController::class, 'cadastrar'])->name('turma.create');

Route::get('/mensagem/nova', [NovaMensagemController::class, 'prepararEnvio'])->name('mensagem.nova');

Route::post('/mensagem/nova', [NovaMensagemController::class, 'enviar'])->name('mensagem.create');

Route::get('/editar/professor/{id}', [EditarProfessorController::class, 'prepararAtualizacao'])->name('professor.editar');

Route::post('/editar/professor/{id}', [EditarProfessorController::class, 'atualizar'])->name('professor.update');

Route::get('/editar/aluno/{id}', [EditarAlunoController::class, 'prepararAtualizacao'])->name('aluno.editar');

Route::post('/editar/aluno/{id}', [EditarAlunoController::class, 'atualizar'])->name('aluno.update');

Route::get('/editar/administrador/{id}', [EditAdministradorController::class, 'prepararAtualizacao'])->name('administrador.editar');

Route::post('/editar/administrador/{id}', [EditAdministradorController::class, 'atualizar'])->name('administrador.update');

Route::get('/editar/turma/{id}', [EditarTurmaController::class, 'prepararAtualizacao'])->name('turma.editar');

Route::post('/editar/turma/{id}', [EditarTurmaController::class, 'atualizar'])->name('turma.update');

Route::get('/editar/turmaprofessor/{id}', [EditarProfessorTurmaController::class, 'prepararAdicao'])->name('addProfessorTurma.editar');

Route::post('/adicionar/turmaprofessor/{idp}/{idt}', [EditarProfessorTurmaController::class, 'adicionarProfessor'])->name('addProfessorTurma.update');

Route::post('/remover/turmaprofessor/{idp}/{idt}', [EditarProfessorTurmaController::class, 'removerProfessor'])->name('removeProfessorTurma.update')->middleware('auth:admin');

Route::post('/editar/turmaaluno/{id}', [EditarAlunoController::class, 'adicionarTurma'])->name('addTurmaAluno.update')->middleware('auth:admin');

Route::post('/remover/turmaaluno/{id}', [EditarAlunoController::class, 'removerTurma'])->name('removeTurmaAluno.update')->middleware('auth:admin');

Route::get('/admin/visualizar/aluno/{id}', [AlunoController::class, 'visualizar'])->name('aluno.visualizar')->middleware('auth:admin');

Route::get('/admin/visualizar/mensagem/{id}', [MensagemController::class, 'visualizar'])->name('mensagem.visualizar')->middleware('auth:admin');

Route::get('/admin/visualizar/professor/{id}', [ProfessorController::class, 'visualizar'])->name('professor.visualizar')->middleware('auth:admin');

Route::get('/visualizar/turma/{id}', [TurmaController::class, 'visualizar'])->name('turma.visualizar');

Route::get('/admin/visualizar/turma/{id}', [TurmaController::class, 'visualizarAdmin'])->name('turma.visualizarAdmin')->middleware('auth:admin');

Route::get('/aluno/visualizar/turma/{id}', [AlunoController::class, 'visualizarTurma'])->name('turma.visualizarAluno');

Route::get('/visualizar/professorturma/{id}', [ProfessorTurmaController::class, 'visualizarProfessores'])->name('turma.visualizarProfessores');

Route::get('/admin/visualizar/professorturma/{id}', [ProfessorTurmaController::class, 'visualizarProfessoresAdmin'])->name('turma.visualizarProfessoresAdmin')->middleware('auth:admin');

#Route::get('/visualizar/administrador/{id}', [AdministradorController::class, 'visualizar'])->name('administrador.visualizar');

Route::get('/remover/professor/{id}', [RemoverProfessorController::class, 'prepararRemocao'])->name('professor.remover');

Route::post('/remover/professor/{id}', [RemoverProfessorController::class, 'remover'])->name('professor.delete');

Route::get('/remover/aluno/{id}', [RemoverAlunoController::class, 'prepararRemocao'])->name('aluno.remover');

Route::post('/remover/aluno/{id}', [RemoverAlunoController::class, 'remover'])->name('aluno.delete');

Route::get('/remover/administrador/{id}', [RemoverAdministradorController::class, 'prepararRemocao'])->name('administrador.remover');

Route::post('/remover/administrador/{id}', [RemoverAdministradorController::class, 'remover'])->name('administrador.delete');

Route::get('/remover/apostila/{id}', [RemoverApostilaController::class, 'prepararRemocao'])->name('apostila.remover');

Route::post('/remover/apostila/{id}', [RemoverApostilaController::class, 'remover'])->name('apostila.delete');

Route::get('/download/apostila/{id}', [ApostilaController::class, 'download'])->name('apostila.download');

Route::get('/remover/turma/{id}', [RemoverTurmaController::class, 'prepararRemocao'])->name('turma.remover');

Route::post('/remover/turma/{id}', [RemoverTurmaController::class, 'remover'])->name('turma.delete');

Route::get('/remover/mensagem/{id}', [RemoverMensagemController::class, 'prepararRemocao'])->name('mensagem.remover');

Route::post('/remover/mensagem/{id}', [RemoverMensagemController::class, 'remover'])->name('mensagem.delete');

Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('menu/administrador', function () {
    if(Auth::guard('admin')->check()) {
        return view('menuAdministrador')->with('id', Auth::guard('admin')->user()->id);
    }
    else{
        return view('permissaoNegada');
    }
})->name('admin.home');

Route::get('menu/professor', function(){
    if(Auth::guard('professor')->check()) {
        return view('menuProfessor')->with('id', Auth::guard('professor')->user()->id);
    }
    else{
        return view('permissaoNegada');
    }
})->name('professor.home');

Route::get('menu/aluno', function(){
    if(Auth::guard('aluno')->check()) {
        return view('menuAluno')->with('id', Auth::guard('aluno')->user()->id);;
    }
    else{
        return view('permissaoNegada');
    }
})->name('aluno.home');

Route::get('/visualizar/aluno/{aluno}',  function(){
    if(Auth::guard('aluno')->check()){
        return view('visualizarAluno')->with('aluno', Auth::guard('aluno')->user());
    }
    else{
        return view('permissaoNegada');
    }
});

Route::get('/visualizar/professor/{professor}',  function(){
    if(Auth::guard('professor')->check()){
        return view('visualizarProfessor')->with('professor', Auth::guard('professor')->user());
    }
    else{
        return view('permissaoNegada');
    }
});

Route::get('/visualizar/administrador/{administrador}',  function(){
    if(Auth::guard('admin')->check()){
        return view('visualizarAdministrador')->with('administrador', Auth::guard('admin')->user());
    }
    else{
        return view('permissaoNegada');
    }
});

Route::post('/password/email', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('new.password.email');
Route::post('/password/reset', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('passwords.reset');
Route::post('/password/reset', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('passwords.update');
