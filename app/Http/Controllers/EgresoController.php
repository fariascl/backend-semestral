<?php

namespace App\Http\Controllers;

use App\Http\Requests\EgresoRequest;
use Illuminate\Http\Request;
use App\Repositories\EgresoRepository;

class EgresoController extends Controller
{
    protected EgresoRepository $egresoRepo;
    public function __construct(EgresoRepository $egresoRepo)
    {
        $this->egresoRepo = $egresoRepo;
    }

    public function listarEgresos()
    {
        return $this->egresoRepo->listarEgresos();
    }

    public function guardarEgreso(EgresoRequest $request)
    {
        return $this->egresoRepo->guardarEgreso($request);
    }

    public function filtrarEgreso(Request $request)
    {
        return $this->egresoRepo->filtrarEgreso($request);
    }

    public function actualizarEgreso(EgresoRequest $request)
    {
        return $this->egresoRepo->actualizarEgreso($request);
    }

    public function eliminarEgreso(Request $request)
    {
        return $this->egresoRepo->eliminarEgreso($request);
    }

    public function mostrarDetallesEgreso(Request $request)
    {
        return $this->egresoRepo->mostrarDetallesEgreso($request);
    }

    public function guardarDetallesEgreso(Request $request)
    {
        return $this->egresoRepo->guardarDetallesEgreso($request);
    }

    public function actualizarDetallesEgreso(Request $request)
    {
        return $this->egresoRepo->actualizarDetallesEgreso($request);
    }

    public function eliminarDetallesEgreso(Request $request)
    {
        return $this->egresoRepo->eliminarDetallesEgreso($request);
    }


}
