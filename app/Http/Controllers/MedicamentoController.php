<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MedicamentoRequest;
use App\Repositories\MedicamentoRepository;

class MedicamentoController extends Controller
{
    protected MedicamentoRepository $medicamentoRepo;

    public function __construct(MedicamentoRepository $medicamentoRepo)
    {
        $this->medicamentoRepo = $medicamentoRepo;
    }

    public function listarMedicamentos()
    {
        return $this->medicamentoRepo->listarMedicamentos();
    }

    public function guardarMedicamento(Request $request)
    {
        return $this->medicamentoRepo->guardarMedicamento($request);
    }

    public function filtrarMedicamentos(Request $request)
    {
        return $this->medicamentoRepo->filtrarMedicamentos($request);
    }

    public function actualizarMedicamento(Request $request)
    {
        return $this->medicamentoRepo->actualizarMedicamento($request);
    }

    public function eliminarMedicamento(Request $request)
    {
        return $this->medicamentoRepo->eliminarMedicamento($request);
    }
}
