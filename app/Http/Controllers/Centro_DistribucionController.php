<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Centro_DistribucionRepository;

class Centro_DistribucionController extends Controller
{
    protected Centro_DistribucionRepository $cdRepo;

    public function __construct(Centro_DistribucionRepository $cdRepo)
    {
        $this->cdRepo = $cdRepo;
    }

    public function listarCentrosDistribucion()
    {
        return $this->cdRepo->listarCentrosDistribucion();
    }

    public function guardarCentroDistribucion(Request $request)
    {
        return $this->cdRepo->guardarCentroDistribucion($request);
    }

    public function filtrarCentroDistribucion(Request $request)
    {
        return $this->cdRepo->filtrarCentroDistribucion($request);
    }

    public function actualizarCentroDistribucion(Request $request)
    {
        return $this->cdRepo->actualizarCentroDistribucion($request);
    }

    public function eliminarCentroDistribucion(Request $request)
    {
        return $this->cdRepo->eliminarCentroDistribucion($request);
    }
}
