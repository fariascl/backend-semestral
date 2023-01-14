<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\IngresoRepository;

class IngresoController extends Controller
{
    protected IngresoRepository $ingresoRepo;
    public function __construct(IngresoRepository $ingresoRepo)
    {
        $this->ingresoRepo = $ingresoRepo;
    }

    public function listarIngresos()
    {
        return $this->ingresoRepo->listarIngresos();
    }

    public function guardarIngreso(Request $request)
    {
        return $this->ingresoRepo->guardarIngreso($request);
    }

    public function filtrarIngreso(Request $request)
    {
        return $this->ingresoRepo->filtrarIngreso($request);
    }

    public function actualizarIngreso(Request $request)
    {
        return $this->ingresoRepo->actualizarIngreso($request);
    }

    public function eliminarIngreso(Request $request)
    {
        return $this->ingresoRepo->eliminarIngreso($request);
    }

    public function mostrarDetallesIngreso(Request $request)
    {
        return $this->ingresoRepo->mostrarDetallesIngreso($request);
    }

    public function guardarDetallesIngreso(Request $request)
    {
        return $this->ingresoRepo->guardarDetallesIngreso($request);
    }

    public function actualizarDetallesIngreso(Request $request)
    {
        return $this->ingresoRepo->actualizarDetallesIngreso($request);
    }

    public function eliminarDetallesIngreso(Request $request)
    {
        return $this->ingresoRepo->eliminarDetallesIngreso($request);
    }
}