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

    // Rotas que só podem ser acessadas se o usuário estiver autenticado
    Route::group(['middleware' => ['auth']], function ()
    {
        
        Route::prefix('admin')->group(function ()
        { 
            Route::match(['get', 'post'], '/', 'AdminController@index')->name('app.admin.index');
            Route::post('salvar_convenio','AdminController@salvar_convenio')->name('app.admin.salvar_convenio');
        });

    });

});
