<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FarmaciaController;
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