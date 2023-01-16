<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualizarCDRequest;
use App\Http\Requests\CentroDistribucionRequest;
use Illuminate\Http\Request;
use App\Repositories\CentroDistribucionRepository;

class CentroDistribucionController extends Controller
{
    protected CentroDistribucionRepository $cdRepo;

    public function __construct(CentroDistribucionRepository $cdRepo)
    {
        $this->cdRepo = $cdRepo;
    }

    public function listarCentrosDistribucion()
    {
        return $this->cdRepo->listarCentrosDistribucion();
    }

    public function guardarCentroDistribucion(CentroDistribucionRequest $request)
    {
        return $this->cdRepo->guardarCentroDistribucion($request);
    }

    public function filtrarCentrosDistribucion(Request $request)
    {
        return $this->cdRepo->filtrarCentrosDistribucion($request);
    }

    public function actualizarCentroDistribucion(ActualizarCDRequest $request)
    {
        return $this->cdRepo->actualizarCentroDistribucion($request);
    }

    public function eliminarCentroDistribucion(Request $request)
    {
        return $this->cdRepo->eliminarCentroDistribucion($request);
    }
}
