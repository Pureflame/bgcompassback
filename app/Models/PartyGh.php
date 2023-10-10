<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PartyGh extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    // Aquellos atributos que modificaremos de forma manual (insert, por ejemplo)
    // NO incluimos, por ejemplo, ID porque es autoincremental
    protected $fillable = [
        'nombre_party_gh',
        'experiencia_party_gh',
        'reputacion_party_gh',
        'oro_party_gh',
        'marcas_party_gh',
        'grupo_party_gh'
    ];

    // Para que no utilice las columnas de “updated_at” y “created_at”
    public $timestamps = false;

    // Para evitar que la peticion use un nombre erroneo de tabla por el plural de las migraciones
    public $table = "party_ghs";

    public function equipamientos(){
        return $this->belongsToMany(EquipamientoGh::class);
    }

    public function habilidad(){
        return $this->belongsToMany(HabilidadGh::class);
    }

    public function pericia(){
        return $this->belongsToMany(PericiaGh::class);
    }

    public function logrosGrupo(){
        return $this->belongsToMany(LogroGrupoGh::class);
    }
}
