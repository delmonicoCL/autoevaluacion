<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class moduls extends Model
{
    use HasFactory;


    protected $table = 'moduls';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function cicle()
    {
        return $this->belongsTo(cicle::class, 'cicles_id');
    }

    public function resultats_aprenentatge()
    {
        return $this->hasMany(resultats_aprenentatge::class, 'moduls_id');
    }

    public function usuaris()
    {
        return $this->belongsToMany(Usuaris::class, 'usuaris_has_moduls', 'moduls_id', 'usuaris_id');
    }

}
