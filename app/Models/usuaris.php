<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuaris extends Model
{
    use HasFactory;
    protected $table = 'usuaris';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function tipusUsuaris() {
        return $this->belongsTo(tipus_usuaris::class, 'tipus_usuaris_id');
    }

    public function moduls() {
        return $this->belongsToMany(moduls::class, 'usuaris_has_moduls', 'usuaris_id', 'moduls_id');
    }

    public function criteris_avaluacio() {
        return $this->belongsToMany(criteris_avaluacio::class, 'alumnes_has_criteris_avaluacio', 'usuaris_id', 'criteris_avaluacio_id')->withPivot('nota');
    }

}

