<?php

use Illuminate\Support\Facades\Route;

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

Route::match(['get', 'post'],'/home', 'HomeController@index')->name('home');
Route::match(['get', 'post'],'/desativada', 'HomeController@clinica_desativada')->name('clinica_desativada');

// Rotas do sistema com o prefixo "app"
Route::prefix('app')->group(function ()
{

    Route::get('sair','HomeController@sair')->name('app.sair');

    // Rotas que só podem ser acessadas se o usuário estiver autenticado
    Route::group(['middleware' => ['auth']], function ()
    {

        Route::post('generate-pdf','PDFController@generate_pdf')->name('app.generate-pdf');
        Route::post('generate-pdf-clinica','PDFController@generate_pdf_clinica')->name('app.generate-pdf-clinica');


        Route::prefix('admin')->group(function ()
        {
            Route::match(['get', 'post'], '/', 'AdminController@index')->name('app.admin.index');
            Route::post('salvar_convenio','AdminController@salvar_convenio')->name('app.admin.salvar_convenio');
            Route::post('status_processo','AdminController@status_processo')->name('app.admin.status_processo');
            Route::post('alterar_status_processo','AdminController@alterar_status_processo')->name('app.admin.alterar_status_processo');
            Route::post('adicionar_pendecia','AdminController@adicionar_pendecia')->name('app.admin.adicionar_pendecia');
            Route::post('salvar_pendecia','AdminController@salvar_pendecia')->name('app.admin.salvar_pendecia');
            Route::post('upload','AdminController@upload')->name('app.admin.upload');
            Route::post('salvar_upload','AdminController@salvar_upload')->name('app.admin.salvar_upload');
            Route::post('lista_upload','AdminController@lista_upload')->name('app.admin.lista_upload');
            Route::match(['get', 'post'], 'download/{id_processo_arquivo}','AdminController@download')->name('app.admin.download');
            Route::post('dados_processo', 'AdminController@dados_processo')->name('app.admin.dados_processo');
            Route::post('atualizar_processo', 'AdminController@atualizar_processo')->name('app.admin.atualizar_processo');
            Route::post('excluir_processo', 'AdminController@excluir_processo')->name('app.admin.excluir_processo');
            Route::post('deletar_clinica', 'AdminController@deletar_clinica')->name('app.admin.deletar_clinica');

            Route::match(['get', 'post'], 'processo_pdf', 'AdminController@processo_pdf')->name('app.admin.processo_pdf');

            Route::post('salvar_clinica', 'AdminController@salvar_clinica')->name('app.admin.salvar_clinica');
            Route::post('salvar_clinica_usuario', 'AdminController@salvar_clinica_usuario')->name('app.admin.salvar_clinica_usuario');

            Route::match(['get', 'post'], 'clinicas', 'AdminController@clinicas')->name('app.admin.clinicas');
            Route::get('ativar_desativar_clinica', 'AdminController@ativar_desativar_clinica')->name('app.admin.ativar_desativar_clinica');
            Route::post('salvar_ativar_desativar_clinica', 'AdminController@salvar_ativar_desativar_clinica')->name('app.admin.salvar_ativar_desativar_clinica');

            Route::match(['get', 'post'], 'relatorio_usuario', 'AdminController@relatorio_usuario')->name('app.admin.relatorio_usuario');
            Route::get('ativar_desativar_usuario', 'AdminController@ativar_desativar_usuario')->name('app.admin.ativar_desativar_usuario');
            Route::post('salvar_ativar_desativar_usuario', 'AdminController@salvar_ativar_desativar_usuario')->name('app.admin.salvar_ativar_desativar_usuario');

            Route::get('alterar_senha_usuario', 'AdminController@alterar_senha_usuario')->name('app.admin.alterar_senha_usuario');
            Route::post('salvar_alterar_senha_usuario', 'AdminController@salvar_alterar_senha_usuario')->name('app.admin.salvar_alterar_senha_usuario');

            Route::post('salvar_clinicas_colaboradores', 'AdminController@salvarClinicasColaboradores')->name('app.admin.salvar_clinicas_colaboradores');
        });

        Route::prefix('clinica')->group(function ()
        {
            Route::post('adicionar_pendecia','ClinicaController@adicionar_pendecia')->name('app.clinica.adicionar_pendecia');
            Route::post('upload','ClinicaController@upload')->name('app.clinica.upload');
            Route::post('salvar_upload','ClinicaController@salvar_upload')->name('app.clinica.salvar_upload');
            Route::post('lista_upload','ClinicaController@lista_upload')->name('app.clinica.lista_upload');
            Route::match(['get', 'post'], 'download/{id_processo_arquivo}','ClinicaController@download')->name('app.clinica.download');
        });
        
        Route::prefix('clinica_admin')->group(function ()
        {
            Route::match(['get', 'post'], 'index','ClinicaAdminController@index')->name('app.clinica_admin.index');
            Route::post('adicionar_pendecia','ClinicaAdminController@adicionar_pendecia')->name('app.clinica_admin.adicionar_pendecia');
            Route::post('upload','ClinicaAdminController@upload')->name('app.clinica_admin.upload');
            Route::post('salvar_upload','ClinicaAdminController@salvar_upload')->name('app.clinica_admin.salvar_upload');
            Route::post('lista_upload','ClinicaAdminController@lista_upload')->name('app.clinica_admin.lista_upload');
            Route::match(['get', 'post'], 'download/{id_processo_arquivo}','ClinicaAdminController@download')->name('app.clinica_admin.download');
            Route::match(['get', 'post'], 'dashboard','ClinicaAdminController@dashboard')->name('app.clinica_admin.dashboard');

        });

    });

});
