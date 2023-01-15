<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stocks';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        "scd_id_medicamento",
        "scd_cantidad",
        "scd_centro_dist"
    ];

    public function centro_distribucion()
    {
        return $this->belongsTo(Centro_Distribucion::class, 'scd_centro_dist');
    }

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'scd_id_medicamento');
    }
}
