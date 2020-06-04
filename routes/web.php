<?php

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
})->name('/')->middleware('roles:1');;
//Usuarios
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('users', 'UsersController@index')->middleware('roles:1');
Route::get('users/{id}', 'PersonasController@seePerson')->name('users/')->middleware('roles:1');
Route::post('modificar_persona', 'PersonasController@updatePerson')->name('modificar_persona')->middleware('roles:1');
Route::post('login_user', 'Auth\LoginController@login')->name('login_user');

// Cotizaciones
Route::get('filtrar_carreras', 'CotizacionesController@filtrarCarreras')->name('filtrar_carreras')->middleware('auth');
Route::get('cotizaciones', 'CotizacionesController@index')->name('cotizaciones')->middleware('auth');
Route::get('buscarCotizaciones', 'CotizacionesController@buscarCotizaciones')->middleware('auth')->name('buscarCotizaciones');
Route::get('cotizacion/{id}', 'CotizacionesController@buscarCotizacion')->middleware('auth')->name('cotizacion');

Route::post('modificar_cotizacion', 'CotizacionesController@modificarCotizacion')->middleware('roles:1')->name('modificar_cotizacion');
Route::post('guardarCotizacion', 'CotizacionesController@guardarCotizacion')->name('guardarCotizacion')->middleware('roles:1');

//Fichas
Route::get('fichas_academicas', 'FichasAcademicasController@index')->middleware('auth')->name('fichas_academicas');
Route::get('fichas_academicas/{id}', 'FichasAcademicasController@verFicha')->middleware('auth')->name('ver_ficha');
Route::get('fichas_economica/{id}', 'FichasEconomicasController@verFicha')->name('ficha_economica')->middleware('roles:1');

Route::post('crear_ficha', 'FichasAcademicasController@crearFicha')->name('crear_ficha')->middleware('roles:1');


Route::post('agregar_observacion', 'FichasAcademicasController@agregarObservacion')->name('agregar_observacion')->middleware('roles:1');

Route::post('editar_ficha', 'FichasAcademicasController@editarFicha')->name('editar_ficha')->middleware('roles:1');


Route::post('actualizar_pago', 'FichasEconomicasController@actualizarFicha')->name('actualizar_pago')->middleware('roles:1');

Route::post('pagar_asesor', 'FichasEconomicasController@pagarAsesor')->name('pagar_asesor')->middleware('roles:1');

Route::post('pagar_cliente', 'FichasEconomicasController@pagarCliente')->name('pagar_cliente')->middleware('roles:1');

//Contratos
Route::get('contratos','ContratosController@index')->name('contratos')->middleware('roles:1');
Route::post('crear_contrato','ContratosController@crearContrato')->name('crear_contrato')->middleware('roles:1');
Route::get('buscar_contratos','ContratosController@buscarContrato')->name('buscar_contratos')->middleware('roles:1');

//Asesores
Route::get('buscarAsesorAjax', 'AsesoresController@buscarAsesorAjax')->name('buscarAsesorAjax')->middleware('roles:1');


//Movimientos
Route::get('movimientos', 'CajaChicaController@index')->name('movimientos')->middleware('roles:1');
Route::post('crear_carga', 'CajaChicaController@crearCarga')->name('crear_carga')->middleware('roles:1');
Route::post('retirar_monto', 'CajaChicaController@retirarMonto')->name('retirar_monto')->middleware('roles:1');
Route::post('crear_ingreso', 'CajaChicaController@crearIngreso')->name('crear_ingreso')->middleware('roles:1');
Route::post('crear_egreso', 'CajaChicaController@crearEgreso')->name('crear_egreso')->middleware('roles:1');

Route::get('buscar_carga', 'CajaChicaController@buscarCarga')->name('buscar_carga')->middleware('roles:1');
Route::get('buscar_retiro', 'CajaChicaController@buscarRetiro')->name('buscar_retiro')->middleware('roles:1');
Route::get('buscar_ingreso', 'CajaChicaController@buscarIngreso')->name('buscar_ingreso')->middleware('roles:1');
Route::get('buscar_egreso', 'CajaChicaController@buscarEgreso')->name('buscar_egreso')->middleware('roles:1');


Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('users', 'UsersController@sphinx_sap')->name('users')->middleware('roles:1');

Route::get('buscar_personas', 'PersonasController@buscarPersonas')->name('buscar_personas')->middleware('roles:1');
Route::post('edit_person', 'PersonasController@edit_person')->name('edit_person')->middleware('roles:1');
Route::post('change_state', 'PersonasController@change_state')->name('change_state')->middleware('roles:1');


Route::get('buscarCliente', 'ClientesController@buscarCliente')->name('buscarCliente')->middleware('roles:1');

Route::get('exportPdf/{id}', 'CotizacionesController@exportPdf')->name('cotizacion.pdf')->middleware('roles:1');
Route::get('exportPdffichaA/{id}', 'FichasAcademicasController@exportPdffichaA')->name('ficha_academica_pdf')->middleware('roles:1');
Route::get('exportPdffichaE/{id}', 'FichasEconomicasController@exportPdffichaE')->name('ficha_economica.pdf')->middleware('roles:1');

// Registration Routes...
if ($options['register'] ?? true) {
    Route::post('register', 'Auth\RegisterController@register');
}

//Route::get('cotizaciones/{id}', 'CotizacionesController@buscar_cotizacion')->name('buscar_cotizacion');
//Route::get('ver_ficha/{id}', 'FichasAcademicasController@ver_ficha')->name('ver_ficha');

// Password Reset Routes...
if ($options['reset'] ?? true) {
    Route::resetPassword();
}

// Email Verification Routes...
if ($options['verify'] ?? false) {
    Route::emailVerification();
}

//Ruta nueva
//Route::get('/customer/print-pdf', [ 'as' => 'customer.printpdf, 'uses' => 'CustomerController@printPDF']);