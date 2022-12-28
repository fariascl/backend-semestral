<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FarmaciaController;
use App\Http\Controllers\Centro_DistribucionController;
use App\Http\Controllers\MedicamentoController;
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
    $router->put('/actualizar', [FarmaciaController::class, 'actualizarFarmacia']);
    $router->delete('/eliminar', [FarmaciaController::class, 'eliminarFarmacia']);
    $router->get('/all', [FarmaciaController::class, 'listarFarmacias']);
    $router->get('/ver/{id}', [FarmaciaController::class, 'filtrarFarmacia']);
});

Route::prefix('/centros_distribucion')->group(function () use ($router) {
    $router->post('/agregar', [Centro_DistribucionController::class, 'guardarCentroDistribucion']);
    $router->put('/actualizar', [Centro_DistribucionController::class, 'actualizarCentroDistribucion']);
    $router->delete('/eliminar', [Centro_DistribucionController::class, 'eliminarCentroDistribucion']);
    $router->get('/all', [Centro_DistribucionController::class, 'listarCentrosDistribucion']);
    $router->get('/ver/{id}', [Centro_DistribucionController::class, 'filtrarCentroDistribucion']);
});

Route::prefix('/medicamentos')->group(function () use ($router) {
    $router->post('/agregar', [MedicamentoController::class, 'guardarMedicamento']);
    $router->put('/actualizar', [MedicamentoController::class, 'actualizarMedicamento']);
    $router->delete('/eliminar', [MedicamentoController::class, 'eliminarMedicamento']);
    $router->get('/all', [MedicamentoController::class, 'listarMedicamentos']);
    $router->get('/ver/{id}', [MedicamentoController::class, 'filtrarMedicamentos']);
});
