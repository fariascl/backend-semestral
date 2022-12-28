<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        "ingr_fecha",
        "ingr_centro_dist"
    ];

    public function centro_distribucion()
    {
        return $this->belongsTo(Centro_Distribucion::class, 'ingr_centro_dist');
    }

}
