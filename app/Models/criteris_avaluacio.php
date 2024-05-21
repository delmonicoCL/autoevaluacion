<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class criteris_avaluacio extends Model
{
    use HasFactory;


    protected $table = 'criteris_avaluacio';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function resultats_aprenentatge()
    {
        return $this->belongsTo(resultats_aprenentatge::class, 'resultats_aprenentatge_id');
    }

    public function rubriques()
    {
        return $this->hasMany(rubriques::class, 'criteris_avaluacio_id');
    }

    public function usuaris()
    {
        return $this->belongsToMany(usuaris::class, 'alumnes_has_criteris_avaluacio', 'criteris_avaluacio_id', 'usuaris_id')->withPivot('nota');
    }

    // Nueva relación
    public function alumnesHasCriterisAvaluacio()
    {
        return $this->hasMany(alumnes_has_criteris_avaluacio::class, 'criteris_avaluacio_id');
    }

}
