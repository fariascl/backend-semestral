<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Egreso extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        "id_medicamento",
        "det_egr_cantidad",
        "det_egreso_id"
    ];

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'id_medicamento');
    }

    public function egreso()
    {
        return $this->belongsTo(Egreso::class, 'det_egreso_id');
    }


}
