<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class HeroeDc extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    // Aquellos atributos que modificaremos de forma manual (insert, por ejemplo)
    // NO incluimos, por ejemplo, ID porque es autoincremental
    protected $fillable = [
        'nombre_heroe_dc',
        'arquetipo_heroe_dc',
        'capacidad_heroe_dc',
        'proeza_heroe_dc',
        'velocidad_heroe_dc',
        'vida_heroe_dc',
        'aguante_heroe_dc',
        'defensa_heroe_dc',
        'fuerza_heroe_dc',
        'conocimiento_heroe_dc',
        'voluntad_heroe_dc',
        'percepcion_heroe_dc',
    ];

    // Para que no utilice las columnas de “updated_at” y “created_at”
    public $timestamps = true;

    // Para evitar que la peticion use un nombre erroneo de tabla por el plural de las migraciones
    public $table = "heroe_dcs";
}
