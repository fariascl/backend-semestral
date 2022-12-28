<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Ingreso extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        "id_medicamento",
        "det_ing_cantidad",
        "det_ingreso_id"
    ];

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'id_medicamento');
    }

    public function ingreso()
    {
        return $this->belongsTo(Ingreso::class, 'det_ingreso_id');
    }

}
