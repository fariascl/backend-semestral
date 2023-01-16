<?php

namespace App\Repositories;

use App\Models\Traspaso;
use App\Models\Detalle_Traspaso;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Models\Stock;


class TraspasoRepository
{
    public function listarTraspasos()
    {
        $traspasos = Traspaso::all();
        return response()->json(["traspasos" => $traspasos]);
    }

    public function guardarTraspaso($request)
    {
        /*
                "$request->tras_cd_origen,
                $request->tras_cd_destino,
                $request->tras_estado
                $request->id_medicamento,
                $request->det_tra_cantidad
         */
        $traspaso = Traspaso::create([
            "tras_cd_origen" => $request->tras_cd_origen,
            "tras_cd_destino" => $request->tras_cd_destino,
            "tras_estado" => $request->tras_estado
        ]);
        $detalleTraspaso = $this->guardarDetallesTraspaso($request, $traspaso->id);
        $stock_origen =  Stock::where('scd_centro_dist', $request->tras_cd_destino)->where('scd_id_medicamento', $request->id_medicamento)->increment('scd_cantidad', $request->det_tra_cantidad);
        
        $ifexist = Stock::where('id', $request->id)->first();
        if ($ifexist != null){
            $stock_destino = Stock::where('scd_centro_dist', $request->tras_cd_origen)->where('scd_id_medicamento', $request->id_medicamento)->decrement('scd_cantidad', $request->det_tra_cantidad);
        }
        else {
            $stock_destino = Stock::create([
                "scd_id_medicamento" => $request-> id_medicamento,
                "scd_cantidad" => $request -> cantidad,
                "scd_centro_dist" => $request -> centro_dist
            ]);
        }


        return response()->json(["traspaso" => $traspaso, "traspaso_detalle" => $detalleTraspaso, "nuevo_stock_origen" => $stock_origen, "nuevo_stock_destino" => $stock_destino], Response::HTTP_OK);
    }

    public function actualizarTraspaso($request)
    {
        try {
            $traspaso = Traspaso::findorFail($request->id);
            if (isset($request->tras_cd_origen))
            $traspaso = Traspaso::where('id', $request->id)
            ->update([
                'tras_cd_origen' => $request->tras_cd_origen
            ]);

            if (isset($request->tras_cd_destino))
            $traspaso = Traspaso::where('id', $request->id)
            ->update([
                'tras_cd_destino' => $request->tras_cd_destino
            ]);

            if (isset($request->tras_estado))
            $traspaso = Traspaso::where('id', $request->id)
            ->update([
                'tras_estado' => $request->tras_estado
            ]);

            return response()->json(["traspaso_actualizado" => $traspaso]);
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

    public function eliminarTraspaso($request)
    {
        try {
            $ifexist = Traspaso::where('id', $request->id)->first();
            if ($ifexist != null){
                $traspaso_detalle = Detalle_Traspaso::where('traspaso_id', $request->id)->delete();
                $traspaso = Traspaso::find($request->id)->delete();
                return response()->json(["traspaso" => $traspaso], Response::HTTP_OK);
            }
            return response()->json(["msg" => "el id del traspaso que intenta eliminar no existe"], Response::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }



        /* DETALLES DE TRASPASO */

        public function mostrarDetallesTraspaso($request)
        {
            $detalleTraspaso = Detalle_Traspaso::where('id', $request->id)->get();
            return response()->json(["detalle_traspaso" => $detalleTraspaso]);
        }

        public function guardarDetallesTraspaso($request, $traspaso_id)
        {
            $detalleTraspaso = Detalle_Traspaso::create([
                "id_medicamento" => $request->id_medicamento,
                "det_tra_cantidad" => $request->det_tra_cantidad,
                "det_traspaso_id" => $traspaso_id
            ]);
            //return response()->json(["detalle_traspaso" => $detalleTraspaso]);
            return $detalleTraspaso;

        }

        public function actualizarDetallesTraspaso($request)
        {
            /*
            "id_medicamento",
        "det_tra_cantidad",
        "det_traspaso_id"
            */
            try {
                $detalleTraspaso = Detalle_Traspaso::findorFail($request->id);
                if (isset($request->id_medicamento))
                $detalleTraspaso = Detalle_Traspaso::where('id', $request->id)
                ->update([
                    "id_medicamento" => $request->id_medicamento
                ]);

                if (isset($request->det_tra_cantidad))
                $detalleTraspaso = Detalle_Traspaso::where('id', $request->id)
                ->update([
                    "det_tra_cantidad" => $request->det_tra_cantidad
                ]);

                if (isset($request->det_traspaso_id))
                $detalleTraspaso = Detalle_Traspaso::where('id', $request->id)
                ->update([
                    "det_traspaso_id" => $request->det_traspaso_id
                ]);

                return response()->json(["detalle_traspaso_actualizado" => $detalleTraspaso]);
            }
            catch (Exception $e)
            {
                Log::info([
                    "error" => $e,
                    "message" => $e->getMessage(),
                    "linea" => $e->getLine(),
                    "archivo" => $e->getFile(),
                ]);
                return response()->json(["error" => $e->getMessage()], Response:HTTP_BAD_REQUEST);
            }
    }

    public function eliminarDetallesTraspaso($request)
    {
        try {
            $ifexist = Detalle_Traspaso::where('id', $request->id)->first();
            if ($ifexist != null){
                $detalleTraspaso = Detalle_Traspaso::find($request->id)->delete();
                return response()->json(["detalle_traspaso" => $detalleTraspaso], Response::HTTP_OK);
            }
            return response()->json(["msg" => "el id del detalle de traspaso que intenta eliminar no existe"], Response::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }
}