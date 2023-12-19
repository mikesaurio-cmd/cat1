<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\NopartesController;
use App\Http\Controllers\PlantasController;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/storage-link', function(){
  $targetFolder = storage_path('app/public');
  $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
  symlink($targetFolder,$linkFolder);
});

Route::get('/registro', function () {
    return view('auth.register');
})->name('register');

Route::resource('empleado', EmpleadoController::class)->middleware('auth');
Auth::routes(['reset' => false]);

Route::get('/home', [EmpleadoController::class, 'index'])->name('home')->middleware('auth');

Route::get('/form', [PageController::class, 'formulario'])->name('formulario')->middleware('auth');

Route::post('enviarInfo', [PageController::class, 'enviarInfo'])->name('enviarInfo')->middleware('auth');

Route::get('registrosVencen', [PageController::class, 'registrosVencen'])->name('registrosVencen')->middleware('auth');

Route::get('registrosTodos', [PageController::class, 'registrosTodos'])->name('registrosTodos')->middleware('auth');

Route::get('imprimir', [PageController::class, 'imprimir'])->name('imprimir');

Route::get('irmtto/{id}', [PageController::class, 'irmtto'])->name('irmtto')->middleware('auth');

Route::get('/mostrarInformacion/{id}', [PageController::class, 'mostrarInformacion'])->name('mostrarInformacion')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('empresas', EmpresasController::class);
    Route::resource('nopartes', NopartesController::class);
    Route::resource('plantas', PlantasController::class);
});

Route::post('validarMtto', [PageController::class, 'validarMtto'])->name('validarMtto')->middleware('auth');


