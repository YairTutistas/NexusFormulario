<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\RolesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/empleados', [EmpleadoController::class, 'index']);
Route::post('/crearEmpleado', [EmpleadoController::class, 'store']);
Route::post('/editarEmpleado', [EmpleadoController::class, 'edit']);
Route::post('/actualizarEmpleado', [EmpleadoController::class, 'update']);
Route::post('/eliminarEmpleado', [EmpleadoController::class, 'destroy']);

Route::get('/roles', [RolesController::class, 'index']);

Route::get('/areas', [AreaController::class, 'index']);
