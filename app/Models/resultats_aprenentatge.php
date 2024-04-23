<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resultats_aprenentatge extends Model
{
    use HasFactory;


    protected $table = 'resultats_aprenentatge';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function moduls()
    {
        return $this->belongsTo(moduls::class, 'moduls_id');
    }

    public function criteris_avaluacio()
    {
        return $this->hasMany(criteris_avaluacio::class, 'resultats_aprenentatge_id');
    }


}
