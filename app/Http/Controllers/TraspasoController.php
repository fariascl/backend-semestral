<?php

namespace App\Http\Controllers;

use App\Http\Requests\TraspasoRequest;
use Illuminate\Http\Request;
use App\Repositories\TraspasoRepository;

class TraspasoController extends Controller
{
    protected TraspasoRepository $traspasoRepo;
    public function __construct(TraspasoRepository $traspasoRepo)
    {
        $this->traspasoRepo = $traspasoRepo;
    }

    public function listarTraspasos()
    {
        return $this->traspasoRepo->listarTraspasos();
    }

    public function guardarTraspaso(TraspasoRequest $request)
    {
        return $this->traspasoRepo->guardarTraspaso($request);
    }

    public function filtrarTraspaso(Request $request)
    {
        return $this->traspasoRepo->filtrarTraspaso($request);
    }

    public function actualizarTraspaso(TraspasoRequest $request)
    {
        return $this->traspasoRepo->actualizarTraspaso($request);
    }

    public function eliminarTraspaso(Request $request)
    {
        return $this->traspasoRepo->eliminarTraspaso($request);
    }

    public function mostrarDetallesTraspaso(Request $request)
    {
        return $this->traspasoRepo->mostrarDetallesTraspaso($request);
    }

    public function guardarDetallesTraspaso(Request $request)
    {
        return $this->traspasoRepo->guardarDetallesTraspaso($request);
    }

    public function actualizarDetallesTraspaso(Request $request)
    {
        return $this->traspasoRepo->actualizarDetallesTraspaso($request);
    }

    public function eliminarDetallesTraspaso(Request $request)
    {
        return $this->traspasoRepo->eliminarDetallesTraspaso($request);
    }
}