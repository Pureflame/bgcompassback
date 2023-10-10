<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class LogroGrupoGh extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    // Aquellos atributos que modificaremos de forma manual (insert, por ejemplo)
    // NO incluimos, por ejemplo, ID porque es autoincremental
    protected $fillable = [
        'titulo_logro_grupo_gh',
    ];

    // Para que no utilice las columnas de “updated_at” y “created_at”
    public $timestamps = false;

    // Para evitar que la peticion use un nombre erroneo de tabla por el plural de las migraciones
    public $table = "logro_grupo_ghs";

    public function party(){
        return $this->belongsToMany(PartyGh::class);
    }
}
