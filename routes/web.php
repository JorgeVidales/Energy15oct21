<?php

// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Route;

 Auth::routes();

// Route::group(['middleware'=>['guest']],function(){

//     Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm');
//     Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');

// });

Route::group(['middleware'=>['guest']],function(){
    Route::get('/','App\Http\Controllers\Auth\LoginController@showLoginForm');
    Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
    Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
});

// Route::middleware(['guest'])->group(function () {
//     Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm');
//     Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
//     // Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
// });

Route::middleware(['auth'])->group(function () {

    Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    Route::middleware(['Administrador'])->group(function () {

        Route::get('/cpanel', function () {
            return view('contenido/contenido');
            //return view('/login');
            // return view('pdf/reporteAguaGlicolPdf');
            // return view('welcome');
        })->name('cpanel');

        Route::get('/cliente', 'App\Http\Controllers\ClienteController@index');
        Route::post('/cliente/registrar', 'App\Http\Controllers\ClienteController@store');
        Route::put('/cliente/actualizar', 'App\Http\Controllers\ClienteController@update');
        Route::put('/cliente/desactivar', 'App\Http\Controllers\ClienteController@desactivar');
        Route::put('/cliente/activar', 'App\Http\Controllers\ClienteController@activar');
        Route::get('/cliente/selectCliente', 'App\Http\Controllers\ClienteController@selectCliente');
        
        Route::get('/estacion', 'App\Http\Controllers\EstacionController@index');
        Route::post('/estacion/registrar', 'App\Http\Controllers\EstacionController@store');
        Route::put('/estacion/actualizar', 'App\Http\Controllers\EstacionController@update');
        Route::put('/estacion/desactivar', 'App\Http\Controllers\EstacionController@desactivar');
        Route::put('/estacion/activar', 'App\Http\Controllers\EstacionController@activar');
        Route::get('estacion/selectEstacionId', 'App\Http\Controllers\EstacionController@selectEstacionId');

        // Route::get('/maquinas', 'App\Http\Controllers\MaquinasController@index');
        // Route::post('/estacion/registrar', 'App\Http\Controllers\EstacionController@store');
        // Route::put('/estacion/actualizar', 'App\Http\Controllers\EstacionController@update');
        // Route::put('/estacion/desactivar', 'App\Http\Controllers\EstacionController@desactivar');
        // Route::put('/estacion/activar', 'App\Http\Controllers\EstacionController@activar');
        // Route::get('/maquinas/selectAceite', 'App\Http\Controllers\MaquinasController@selectAceite');
        
        Route::get('/maquina', 'App\Http\Controllers\MaquinasController@index');
        Route::post('/maquina/registrar', 'App\Http\Controllers\MaquinasController@store');
        Route::put('/maquina/actualizar', 'App\Http\Controllers\MaquinasController@update');
        
        Route::get('/aceite', 'App\Http\Controllers\AceiteController@index');
        Route::get('/aceite/selectAceite', 'App\Http\Controllers\AceiteController@selectAceite');
        Route::post('/aceite/registrar', 'App\Http\Controllers\AceiteController@store');
        Route::put('/aceite/actualizar', 'App\Http\Controllers\AceiteController@update');
        
        Route::get('/aceite/reportePDF', 'App\Http\Controllers\AceiteController@reportePDF')->name('reporte_PDF');
        
        
        Route::get('/user', 'App\Http\Controllers\UserController@index');
        Route::post('/user/registrar', 'App\Http\Controllers\UserController@store');
        Route::put('/user/actualizar', 'App\Http\Controllers\UserController@update');
        Route::put('/user/desactivar', 'App\Http\Controllers\UserController@desactivar');
        Route::put('/user/activar', 'App\Http\Controllers\UserController@activar');
    });

    // Route::group(['middleware'=> ['Administrador']], function(){

       
    
    // });

     Route::middleware(['Cliente'])->group(function () {

        // Route::get('/cliente', 'App\Http\Controllers\ClienteController@index');
        // Route::post('/cliente/registrar', 'App\Http\Controllers\ClienteController@store');
        // Route::put('/cliente/actualizar', 'App\Http\Controllers\ClienteController@update');
        // Route::put('/cliente/desactivar', 'App\Http\Controllers\ClienteController@desactivar');
        // Route::put('/cliente/activar', 'App\Http\Controllers\ClienteController@activar');
        // Route::get('/cliente/selectCliente', 'App\Http\Controllers\ClienteController@selectCliente');

    });


});



    


    



// Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm');
// Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');




// Route::post('login', function () {
//     $email = request('email');
//     $password = request('password');
//     // $condicion = 1;
//     // $credentials = request(['email' => $email, 'password' => $password, 'condicion' => '1']);

//     if(Auth::attempt(['email' => $email, 'password' => $password, 'condicion' => '1'])){
//         return view('contenido/contenido');
//     }
//     return view('login');

//     //   print_r($email);
// });
// Route::get('/usuarios', 'App\Http\Controllers\Auth\LoginController@index');
// Route::get('/listUsuarios', 'App\Http\Controllers\HomeController@listUsuarios');
// Route::get('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
// Route::get('/cpanel', [App\Http\Controllers\HomeController::class, 'index'])->name('main');




