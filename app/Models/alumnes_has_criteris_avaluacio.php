<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alumnes_has_criteris_avaluacio extends Model
{
    use HasFactory;

    protected $table = 'alumnes_has_criteris_avaluacio';
    protected $primaryKey = ['usuaris_id', 'criteris_avaluacio_id'];
    public $timestamps = false;

    public function usuaris()
    {
        return $this->belongsTo(Usuaris::class, 'usuaris_id');
    }

    public function criteris_avaluacio()
    {
        return $this->belongsTo(criteris_avaluacio::class, 'criteris_avaluacio_id');
    }

}
