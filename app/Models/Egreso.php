<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        "egre_fecha",
        "egre_centro_dist",
        "egre_farmacia_id"
    ];

    public function centro_distribucion()
    {
        return $this->belongsTo(Centro_Distribucion::class, 'egre_centro_dist');
    }

    public function farmacia()
    {
        return $this->belongsTo(Farmacia::class, 'egre_farmacia_id');
    }
}
