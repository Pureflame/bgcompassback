<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class EquipamientoDc extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    // Aquellos atributos que modificaremos de forma manual (insert, por ejemplo)
    // NO incluimos, por ejemplo, ID porque es autoincremental
    protected $fillable = [
        'acto_equipamiento_dc',
        'nombre_equipamiento_dc',
        'tipo_equipamiento_dc',
        'precio_equipamiento_dc',
        'dado_equipamiento_dc',
        'espacio_equipamiento_dc',
        'descripcion_equipamiento_dc',
    ];

    // Para que no utilice las columnas de “updated_at” y “created_at”
    public $timestamps = false;

    // Para evitar que la peticion use un nombre erroneo de tabla por el plural de las migraciones
    public $table = "equipamiento_dcs";

    public function parties(){
        return $this->belongsToMany(PartyDc::class);
    }
}
