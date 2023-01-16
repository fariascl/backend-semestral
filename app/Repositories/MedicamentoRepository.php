<?php
namespace App\Repositories;

use App\Models\Medicamento;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


class MedicamentoRepository
{
    public function listarMedicamentos()
    {
        $medicamentos = Medicamento::all();
        return response()->json(["medicamentos" => $medicamentos], Response::HTTP_OK);
    }

    public function filtrarMedicamento($request)
    {
        $medicamentos = Medicamento::where('id', $request->id)->get();
        return response()->json(["medicamentos" => $medicamentos], Response::HTTP_OK);
    }

    public function guardarMedicamento($request)
    {
        $medicamentos = Medicamento::create([
            "med_nombre" => $request->nombre,
            "med_compuesto" => $request->compuesto
        ]);

        return response()->json(["medicamento" => $medicamentos], Response::HTTP_OK);
    }

    public function actualizarMedicamento($request)
    {
        try {
            $medicamentos = Medicamento::findorFail($request->id);
            if (isset($request->nombre))
            $medicamentos = Medicamento::where('id', $request->id)
            ->update([
                'med_nombre' => $request->nombre
            ]);

            if (isset($request->direccion))
            $medicamentos = Medicamento::where('id', $request->id)
            ->update([
                'med_compuesto' => $request->compuesto
            ]);

            return response()->json(["medicamento" => $medicamentos], Response::HTTP_OK);
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

    public function eliminarMedicamento($request)
    {
        try {
            $ifexist = Medicamento::where('id', $request->id)->first();
            if ($ifexist != null){
                $medicamentos = Medicamento::find($request->id)->delete();
                return response()->json(["medicamento" => $medicamentos], Response::HTTP_OK);
            }
            return response()->json(["msg" => "el id del medicamento que intenta eliminar no existe"], Response::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }
}

