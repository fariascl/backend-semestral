<?php
namespace App\Repositories;

use App\Models\Farmacia;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


class FarmaciaRepository
{
    public function listarFarmacias()
    {
        $farmacias = Farmacia::all();
        return response()->json(["farmacias" => $farmacias], Response::HTTP_OK);
    }

    public function filtrarFarmacia($request)
    {
        $farmacias = Farmacia::where('id', $request->id)->get();
        return response()->json(["farmacias" => $farmacias], Response::HTTP_OK);
    }

    public function guardarFarmacia($request)
    {
        $farmacia = Farmacia::create([
            "farm_nombre" => $request->nombre,
            "farm_direccion" => $request->direccion,
            "farm_mail" => $request->mail
        ]);

        return response()->json(["farmacia" => $farmacia], Response::HTTP_OK);
    }

    public function actualizarFarmacia($request)
    {
        try {
            $farmacias = Farmacia::findorFail($request->id);
            if (isset($request->nombre) &&  $farmacias->nombre)
            $farmacias = Farmacia::where('id', $request->id)
            ->update([
                'farm_nombre' => $request->nombre
            ]);

            if (isset($request->direccion) &&  $farmacias->direccion)
            $farmacias = Farmacia::where('id', $request->id)
            ->update([
                'farm_direccion' => $request->direccion
            ]);

            if (isset($request->mail) && $farmacias->mail)
            $farmacias = Farmacia::where('id', $request->id)
            ->update([
                'farm_mail' => $request->mail
            ]);
            return response()->json(["farmacias" => $farmacias], Response::HTTP_OK);
        } catch (Exception $e)
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

    public function eliminarFarmacia($request)
    {
        try {
            $ifexist = Farmacia::where('id', $request->id)->first();
            if ($ifexist != null){
                $farmacias = Farmacia::find($request->id)->delete();
                return response()->json(["farmacias" => $farmacias], Response::HTTP_OK);
            }
            return response()->json(["msg" => "el id de la farmacia que intenta eliminar no existe"], Response::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }
}

