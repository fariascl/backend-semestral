<?php

namespace App\Repositories;

use App\Models\Stock;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


class StockRepository
{

    public function guardarStock($request)
    {

        $stock = Stock::create([
            "scd_id_medicamento" => $request-> id_medicamento,
            "scd_cantidad" => $request -> cantidad,
            "scd_centro_dist" => $request -> centro_dist
        ]);

        return response()->json(["stocks" => $stock], Response::HTTP_OK);

    }


    public function listarStock()
    {
        $stock = Stock::all();
        return response()->json(["stocks" => $stock], Response::HTTP_OK);
    }

    public function filtrarporCD($request)
    {
        $stock = Stock::where('scd_centro_dist', $request->scd_centro_dist)->get();
        return response()->json(["stock" => $stock]);
    }

    public function filtrarporMedicamento($request)
    {
        $stock = Stock::where('scd_id_medicamento', $request->scd_id_medicamento);
        return response()->json(["stock" => $stock]);
    }

    public function actualizarStock($request)
    {
        try {
            $stock = Stock::findorFail($request->id);
            if (isset($request->scd_id_medicamento))
          $stock = Stock::where('id', $request->id)
            ->update([
                'scd_id_medicamento' => $request->scd_id_medicamento
            ]);

            if (isset($request->scd_cantidad))
            $stock = Stock::where('id', $request->id)
            ->update([
                'scd_cantidad' => $request->scd_cantidad
            ]);

            if (isset($request->scd_centro_dist))
            $stock = Stock::where('id', $request->id)
            ->update([
                'scd_centro_dist' => $request->scd_centro_dist
            ]);

            return response()->json(["stock_actualizado" => $stock]);
        }
        catch (Exception $e) {
            Log::info([
                "error" => $e,
                "message" => $e->getMessage(),
                "linea" => $e->getLine(),
                "archivo" => $e->getFile(),
            ]);
            return response()->json(["error" => $e->getMessage()], Response:HTTP_BAD_REQUEST);
        }
    }

    public function eliminarStock($request)
    {
        try {
            $ifexist = Stock::where('id', $request->id)->first();
            if ($ifexist != null){
                $stock = Stock::find($request->id)->delete();
                return response()->json(["stock_eliminado" => $stock], Response::HTTP_OK);
            }
        }
        catch (Exception $e){
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }

}