<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PericiaGh extends Model
{
    use HasFactory;

    public function party(){
        return $this->belongsToMany(PartyGh::class);
    }
}
