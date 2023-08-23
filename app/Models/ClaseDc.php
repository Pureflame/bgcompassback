<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ClaseDc extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    // Aquellos atributos que modificaremos de forma manual (insert, por ejemplo)
    // NO incluimos, por ejemplo, ID porque es autoincremental
    protected $fillable = [
        'titulo_clase_dc',
        'nombre_clase_dc',
        'experiencia_clase_dc',
        'coste_clase_dc',
        'descripcion_clase_dc',
    ];

    // Para que no utilice las columnas de “updated_at” y “created_at”
    public $timestamps = true;

    // Para evitar que la peticion use un nombre erroneo de tabla por el plural de las migraciones
    public $table = "clase_dcs";
}
