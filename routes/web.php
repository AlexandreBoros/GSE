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

Route::get('/home', 'HomeController@index')->name('home');

// Rotas do sistema com o prefixo "app"
Route::prefix('app')->group(function ()
{ 

    Route::get('sair','HomeController@sair')->name('app.sair');

    // Rotas que só podem ser acessadas se o usuário estiver autenticado
    Route::group(['middleware' => ['auth']], function ()
    {
        
        Route::prefix('admin')->group(function ()
        { 
            Route::match(['get', 'post'], '/', 'AdminController@index')->name('app.admin.index');
            Route::post('salvar_convenio','AdminController@salvar_convenio')->name('app.admin.salvar_convenio');
            Route::post('status_processo','AdminController@status_processo')->name('app.admin.status_processo');
            Route::post('alterar_status_processo','AdminController@alterar_status_processo')->name('app.admin.alterar_status_processo');
            Route::post('adicionar_pendecia','AdminController@adicionar_pendecia')->name('app.admin.adicionar_pendecia');
            Route::post('salvar_pendecia','AdminController@salvar_pendecia')->name('app.admin.salvar_pendecia');

        });

    });

});
