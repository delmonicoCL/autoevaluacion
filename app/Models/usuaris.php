<?php

namespace App\Models;

use App\Models\tipus_usuaris;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class usuaris extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'usuaris';
    // protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * Summary of tipusUsuaris
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo    
     */


    public function tipusUsuaris(): BelongsTo
    {
        return $this->belongsTo(tipus_usuaris::class, 'tipus_usuaris_id');
    }

    public function moduls()
    {
        return $this->belongsToMany(Moduls::class, 'usuaris_has_moduls', 'usuaris_id', 'moduls_id');
        
    }

    public function criteris_avaluacio()
    {
        return $this->belongsToMany(criteris_avaluacio::class, 'alumnes_has_criteris_avaluacio', 'usuaris_id', 'criteris_avaluacio_id')->withPivot('nota');
    }

}

