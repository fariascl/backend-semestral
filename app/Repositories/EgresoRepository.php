<?php

namespace App\Repositories;

use App\Models\Egreso;
use App\Models\Detalle_Egreso;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


class EgresoRepository
{
    public function listarEgresos()
    {
        $egresos = Egreso::all();
        return response()->json(["egresos" => $egresos]);
    }

    public function guardarEgreso($request)
    {
        $egreso = Egreso::create([
            "egre_fecha" => $request->egre_fecha,
            "egre_centro_dist" => $request->egre_centro_dist,
            "egre_farmacia_id" => $request->egre_farmacia_id
        ]);

        return response()->json(["egreso" => $egreso], Response::HTTP_OK);
    }

    public function actualizarEgreso($request)
    {
        try {
            $egreso = Egreso::findorFail($request->id);
            if (isset($request->egre_fecha))
            $egreso = Egreso::where('id', $request->id)
            ->update([
                'egre_fecha' => $request->egre_fecha
            ]);
            if (isset($request->egre_centro_dist))
            $egreso = Egreso::where('id', $request->id)
            ->update([
                'egre_centro_dist' => $request->egre_centro_dist
            ]);

            if (isset($request->egre_farmacia_id))
            $egreso = Egreso::where('id', $request->id)
            ->update([
                'egre_farmacia_id' => $request->egre_farmacia_id
            ]);

            return response()->json(["egreso_actualizado" => $egreso]);
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

    public function eliminarEgreso($request)
    {
        try {
            $ifexist = Egreso::where('id', $request->id)->first();
            if ($ifexist != null){
                $egreso = Egreso::find($request->id)->delete();
                return response()->json(["egreso" => $egreso], Response::HTTP_OK);
            }
            return response()->json(["msg" => "el id del egreso que intenta eliminar no existe"], Response::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }


        /* DETALLES DE TRASPASO */

        public function mostrarDetallesEgreso($request)
        {
            $detalleEgreso = Detalle_Egreso::where('id', $request->id)->get();
            return response()->json(["detalle_egreso" => $detalleEgreso]);
        }

        public function guardarDetallesEgreso($request)
        {
            $detalleEgreso = Detalle_Egreso::create([
                "id_medicamento" => $request->id_medicamento,
                "det_egr_cantidad" => $request->det_egr_cantidad,
                "det_egreso_id" => $request->det_egreso_id
            ]);
            return response()->json(["detalle_egreso" => $detalleEgreso]);
        }

        public function actualizarDetallesIngreso($request)
        {
            /*
            "id_medicamento",
        "det_tra_cantidad",
        "det_traspaso_id"
            */
            try {
                $detalleEgreso = Detalle_Egreso::findorFail($request->id);
                if (isset($request->id_medicamento))
                $detalleEgreso = Detalle_Egreso::where('id', $request->id)
                ->update([
                    "id_medicamento" => $request->id_medicamento
                ]);

                if (isset($request->det_egr_cantidad))
                $detalleEgreso = Detalle_Egreso::where('id', $request->id)
                ->update([
                    "det_egr_cantidad" => $request->det_ing_cantidad
                ]);

                if (isset($request->det_egreso_id))
                $detalleEgreso = Detalle_Egreso::where('id', $request->id)
                ->update([
                    "det_egreso_id" => $request->det_egreso_id
                ]);

                return response()->json(["detalle_egreso_actualizado" => $detalleEgreso]);
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

    public function eliminarDetalleEgreso($request)
    {
        try {
            $ifexist = Detalle_Egreso::where('id', $request->id)->first();
            if ($ifexist != null){
                $detalleEgreso = Detalle_Egreso::find($request->id)->delete();
                return response()->json(["detalle_egreso" => $detalleEgreso], Response::HTTP_OK);
            }
            return response()->json(["msg" => "el id del detalle de egreso que intenta eliminar no existe"], Response::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }
}