<?php
namespace App\Repositories;

use App\Models\Centro_Distribucion;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CentroDistribucionRequest;
use App\Repositories\Centro_DistribucionRepository;

class Centro_DistribucionRepository
{
    public function listarCentrosDistribucion()
    {
        $cd = Centro_Distribucion::all();
        return response()->json(["centros_distribucion" => $cd], Response::HTTP_OK);
    }

    public function filtrarCentrosDistribucion($request)
    {
        $cd = Centro_Distribucion::where('id', $request->id)->get();
        return response()->json(["centros_distribucion" => $cd], Response::HTTP_OK);
    }

    public function guardarCentroDistribucion($request)
    {
        $cd = Centro_Distribucion::create([
            "cd_codigo" => $request->codigo,
            "cd_direccion" => $request->direccion,
            "cd_telefono" => $request->telefono
        ]);

        return response()->json(["centro_distribucion" => $cd], Response::HTTP_OK);
    }

    public function actualizarCentroDistribucion($request)
    {
        try {
            $cd = Centro_Distribucion::findorFail($request->id);
            if (isset($request->codigo) &&  $cd->cd_codigo = $request->codigo)
            $cd = Centro_Distribucion::where('id', $request->id)
            ->update([
                'cd_codigo' => $request->codigo
            ]);

            if (isset($request->direccion) &&  $cd->cd_direccion = $request->direccion)
            $cd = Centro_Distribucion::where('id', $request->id)
            ->update([
                'cd_direccion' => $request->direccion
            ]);

            if (isset($request->telefono) && $cd->cd_telefono = $request->telefono)
            $cd = Centro_Distribucion::where('id', $request->id)
            ->update([
                'cd_telefono' => $request->telefono
            ]);
            return response()->json(["centro_distribucion" => $cd], Response::HTTP_OK);
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

    public function eliminarCentroDistribucion($request)
    {
        try {
            $ifexist = Centro_Distribucion::where('id', $request->id)->first();
            if ($ifexist != null){
                $cd = Centro_Distribucion::find($request->id)->delete();
                return response()->json(["centro_distribucion" => $cd], Response::HTTP_OK);
            }
            return response()->json(["msg" => "el id de la farmacia que intenta eliminar no existe"], Response::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }
}

