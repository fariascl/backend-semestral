<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traspaso extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        "tras_cd_origen",
        "tras_cd_destino",
        "tras_estado"
    ];

    public function centro_distribucion_origen()
    {
        return $this->belongsTo(Centro_Distribucion::class, 'tras_cd_origen');
    }

    public function centro_distribucion_destino()
    {
        return $this->belongsTo(Centro_Distribucion::class, 'tras_cd_destino');
    }
}
