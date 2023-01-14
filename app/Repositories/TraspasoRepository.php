<?php

namespace App\Repositories;

use App\Models\Traspaso;
use App\Models\Detalle_Traspaso;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


class TraspasoRepository
{
    public function listarTraspasos()
    {
        $traspasos = Traspaso::all();
        return response()->json(["traspasos" => $traspasos]);
    }

    public function guardarTraspaso($request)
    {
        $traspaso = Traspaso::create([
            "tras_cd_origen" => $request->tras_cd_origen,
            "tras_cd_destino" => $request->tras_cd_destino,
            "tras_estado" => $request->tras_estado
        ]);

        return response()->json(["traspaso" => $traspaso], Response::HTTP_OK);
    }

    public function actualizarTraspaso($request)
    {
        try {
            $traspaso = Traspaso::findorFail($request->id);
            if (isset($request->tras_cd_origen) && $traspaso->tras_cd_origen = $request->tras_cd_origen)
            $traspaso = Traspaso::where('id', $request->id)
            ->update([
                'tras_cd_origen' => $request->tras_cd_origen
            ]);

            if (isset($request->tras_cd_destino) && $traspaso->tras_cd_destino = $request->tras_cd_destino)
            $traspaso = Traspaso::where('id', $request->id)
            ->update([
                'tras_cd_destino' => $request->tras_cd_destino
            ]);

            if (isset($request->tras_estado) && $traspaso->tras_estado = $request->tras_estado)
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



        /* DETALLES DE TRASPASO */

        public function mostrarDetallesTraspaso($request)
        {
            $detalleTraspaso = Detalle_Traspaso::where('id', $request->id)->get();
            return response()->json(["detalle_traspaso" => $detalleTraspaso]);
        }

        public function guardarDetallesTraspaso($request)
        {
            $detalleTraspaso = Detalle_Traspaso::create([
                "id_medicamento" => $request->id_medicamento,
                "det_tra_cantidad" => $request->det_tra_cantidad,
                "det_traspaso_id" => $request->det_traspaso_id
            ]);
            return response()->json(["detalle_traspaso" => $detalleTraspaso]);
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
                if (isset($request->id_medicamento) && $detalleTraspaso->id_medicamento = $request->id_medicamento)
                $detalleTraspaso = Detalle_Traspaso::where('id', $request->id)
                ->update([
                    "id_medicamento" => $request->id_medicamento
                ]);

                if (isset($request->det_tra_cantidad) && $detalleTraspaso->det_tra_cantidad = $request->det_tra_cantidad)
                $detalleTraspaso = Detalle_Traspaso::where('id', $request->id)
                ->update([
                    "det_tra_cantidad" => $request->det_tra_cantidad
                ]);

                if (isset($request->det_traspaso_id) && $detalleTraspaso->det_traspaso_id = $request->det_traspaso_id)
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