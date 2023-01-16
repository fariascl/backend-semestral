<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FarmaciaController;
use App\Http\Controllers\CentroDistribucionController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\EgresoController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TraspasoController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/farmacias')->group(function () use ($router) {
    $router->post('/agregar', [FarmaciaController::class, 'guardarFarmacia']);
    $router->put('/actualizar/{id}', [FarmaciaController::class, 'actualizarFarmacia']);
    $router->delete('/eliminar/{id}', [FarmaciaController::class, 'eliminarFarmacia']);
    $router->get('/all', [FarmaciaController::class, 'listarFarmacias']);
    $router->get('/ver/{id}', [FarmaciaController::class, 'filtrarFarmacia']);
});

Route::prefix('/centros_distribucion')->group(function () use ($router) {
    $router->post('/agregar', [CentroDistribucionController::class, 'guardarCentroDistribucion']);
    $router->put('/actualizar/{id}', [CentroDistribucionController::class, 'actualizarCentroDistribucion']);
    $router->delete('/eliminar/{id}', [CentroDistribucionController::class, 'eliminarCentroDistribucion']);
    $router->get('/all', [CentroDistribucionController::class, 'listarCentrosDistribucion']);
    $router->get('/ver/{id}', [CentroDistribucionController::class, 'filtrarCentrosDistribucion']);
});

Route::prefix('/medicamentos')->group(function () use ($router) {
    $router->post('/agregar', [MedicamentoController::class, 'guardarMedicamento']);
    $router->put('/actualizar/{id}', [MedicamentoController::class, 'actualizarMedicamento']);
    $router->delete('/eliminar/{id}', [MedicamentoController::class, 'eliminarMedicamento']);
    $router->get('/all', [MedicamentoController::class, 'listarMedicamentos']);
    $router->get('/ver/{id}', [MedicamentoController::class, 'filtrarMedicamentos']);
});

Route::prefix('/traspaso')->group(function () use ($router) {
    $router->post('/agregar', [TraspasoController::class, 'guardarTraspaso']);
    $router->put('/actualizar/{id}', [TraspasoController::class, 'actualizarTraspaso']);
    $router->delete('/eliminar/{id}', [TraspasoController::class, 'eliminarTraspaso']);
    $router->get('/all', [TraspasoController::class, 'listarTraspasos']);
    $router->get('/ver/{id}', [TraspasoController::class, 'filtrarTraspasos']);
});


Route::prefix('/ingreso')->group(function () use ($router) {
    $router->post('/agregar', [IngresoController::class, 'guardarIngreso']);
    $router->put('/actualizar/{id}', [IngresoController::class, 'actualizarIngreso']);
    $router->delete('/eliminar/{id}', [IngresoController::class, 'eliminarIngreso']);
    $router->get('/all', [IngresoController::class, 'listarIngresos']);
    $router->get('/ver/{id}', [IngresoController::class, 'filtrarIngresos']);
});

Route::prefix('/egreso')->group(function () use ($router) {
    $router->post('/agregar', [EgresoController::class, 'guardarEgreso']);
    $router->put('/actualizar/{id}', [EgresoController::class, 'actualizarEgreso']);
    $router->delete('/eliminar/{id}', [EgresoController::class, 'eliminarEgreso']);
    $router->get('/all', [EgresoController::class, 'listarEgresos']);
    $router->get('/ver/{id}', [EgresoController::class, 'filtrarEgresos']);
});

Route::prefix('/stock')->group(function () use ($router) {
    $router->post('/agregar', [StockController::class, 'guardarStock']);
    $router->put('/actualizar/{id}', [StockController::class, 'actualizarStock']);
    $router->delete('/eliminar/{id}', [StockController::class, 'eliminarStock']);
    $router->get('/all', [StockController::class, 'listarStock']);
    $router->get('/verporcd/{id}', [StockController::class, 'filtrarporCD']);
    $router->get('/verpormedicamento/{id}', [StockController::class, 'filtrarporMedicamento']);
});

