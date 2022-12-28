<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro_Distribucion extends Model
{
    use HasFactory;
    protected $table = 'centro_distribucion';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        "cd_codigo",
        "cd_direccion",
        "cd_telefono"
    ];

    public function stock() 
    {
        return $this->hasMany(Stock::class);
    }

    public function egreso() 
    {
        return $this->hasMany(Egreso::class);
    }

    public function ingreso() 
    {
        return $this->hasMany(Ingreso::class);
    }

    public function traspaso() 
    {
        return $this->hasMany(Traspaso::class);
    }
}
