<?php

namespace App\Http\Controllers;

use App\Repositories\StockRepository;
use Illuminate\Http\Request;

class StockController extends Controller
{
    protected StockRepository $stockrepo;

    public function __construct(StockRepository $stockrepo)
    {
        $this->stockrepo = $stockrepo;
    }

    public function guardarStock(Request $request)
    {
        return $this->stockrepo->guardarStock($request);
    }

    public function listarStock()
    {
        return $this->stockrepo->listarStock();
    }

    public function filtrarporCD(Request $request)
    {
        return $this -> stockrepo ->filtrarporCD($request);
    }

    public function filtrarporMedicamento(Request $request)
    {
        return $this -> stockrepo -> filtrarporMedicamento($request);
    }

    public function actualizarStock(Request $request)
    {
        return $this -> stockrepo -> actualizarStock($request);
    }

    public function eliminarStock(Request $request)
    {
        return $this -> stockrepo ->eliminarStock($request);
    }

}
