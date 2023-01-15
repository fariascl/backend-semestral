<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FarmaciaRequest;
use App\Repositories\FarmaciaRepository;

class FarmaciaController extends Controller
{
    protected FarmaciaRepository $farmaciaRepo;

    public function __construct(FarmaciaRepository $farmaciaRepo)
    {
        $this->farmaciaRepo = $farmaciaRepo;
    }

    public function listarFarmacias()
    {
        return $this->farmaciaRepo->listarFarmacias();
    }

    public function guardarFarmacia(FarmaciaRequest $request)
    {
        return $this->farmaciaRepo->guardarFarmacia($request);
    }

    public function filtrarFarmacia(Request $request)
    {
        return $this->farmaciaRepo->filtrarFarmacia($request);
    }

    public function actualizarFarmacia(Request $request)
    {
        return $this->farmaciaRepo->actualizarFarmacia($request);
    }

    public function eliminarFarmacia(Request $request)
    {
        return $this->farmaciaRepo->eliminarFarmacia($request);
    }


}
