<?php

namespace App\Repositories;

use App\Models\Ingreso;
use App\Models\Detalle_Ingreso;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


class IngresoRepository
{
    public function listarIngresos()
    {
        $ingresos = Ingreso::all();
        return response()->json(["ingresos" => $ingresos]);
    }

    public function guardarIngreso($request)
    {
        $ingreso = Ingreso::create([
            "ingr_fecha" => $request->ingr_fecha,
            "ingr_centro_dist" => $request->ingr_centro_dist,
        ]);

        return response()->json(["ingreso" => $ingreso], Response::HTTP_OK);
    }

    public function actualizarIngreso($request)
    {
        try {
            $ingreso = Ingreso::findorFail($request->id);
            if (isset($request->ingr_fecha) && $ingreso->ingr_fecha = $request->ingr_fecha)
            $ingreso = Ingreso::where('id', $request->id)
            ->update([
                'ingr_fecha' => $request->ingr_fecha
            ]);

            if (isset($request->ingr_centro_dist))
            $ingreso = Ingreso::where('id', $request->id)
            ->update([
                'ingr_centro_dist' => $request->ingr_centro_dist
            ]);
            return response()->json(["ingreso_actualizado" => $ingreso]);
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

    public function filtrarIngreso($request)
    {
        $ingreso = Ingreso::where('id', $request->id)->get();
        return response()->json(["ingreso" => $ingreso], Response::HTTP_OK);
    }
    public function eliminarIngreso($request)
    {
        try {
            $ifexist = Ingreso::where('id', $request->id)->first();
            if ($ifexist != null){
                $ingreso = Ingreso::find($request->id)->delete();
                return response()->json(["ingreso" => $ingreso], Response::HTTP_OK);
            }
            return response()->json(["msg" => "el id del ingreso de traspaso que intenta eliminar no existe"], Response::HTTP_OK);
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

        public function guardarDetallesIngreso($request)
        {
            $detalleIngreso = Detalle_Ingreso::create([
                "id_medicamento" => $request->id_medicamento,
                "det_ing_cantidad" => $request->det_ing_cantidad,
                "det_ingreso_id" => $request->det_ingreso_id
            ]);
            return response()->json(["detalle_ingreso" => $detalleIngreso]);
        }

        public function actualizarDetallesIngreso($request)
        {
            /*
            "id_medicamento",
        "det_tra_cantidad",
        "det_traspaso_id"
            */
            try {
                $detalleIngreso = Detalle_Ingreso::findorFail($request->id);
                if (isset($request->id_medicamento))
                $detalleIngreso = Detalle_Ingreso::where('id', $request->id)
                ->update([
                    "id_medicamento" => $request->id_medicamento
                ]);

                if (isset($request->det_ingr_cantidad))
                $detalleIngreso = Detalle_Ingreso::where('id', $request->id)
                ->update([
                    "det_ing_cantidad" => $request->det_ing_cantidad
                ]);

                if (isset($request->det_ingreso_id))
                $detalleIngreso = Detalle_Ingreso::where('id', $request->id)
                ->update([
                    "det_ingreso_id" => $request->det_ingreso_id
                ]);

                return response()->json(["detalle_ingreso_actualizado" => $detalleIngreso]);
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

    public function eliminarDetallesIngreso($request)
    {
        try {
            $ifexist = Detalle_Ingreso::where('id', $request->id)->first();
            if ($ifexist != null){
                $detalleIngreso = Detalle_Traspaso::find($request->id)->delete();
                return response()->json(["detalle_ingreso" => $detalleIngreso], Response::HTTP_OK);
            }
            return response()->json(["msg" => "el id del detalle de traspaso que intenta eliminar no existe"], Response::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }
}