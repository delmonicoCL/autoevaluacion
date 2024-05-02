<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasModuls extends Model
{
    use HasFactory;


    protected $table = 'usuaris_has_moduls';
    // Especifica los nombres de las dos claves primarias
    protected $primaryKey = ['usuaris_id', 'moduls_id'];
    public $timestamps = false;

    public function usuaris()
    {
        return $this->belongsTo(Usuaris::class, 'usuaris_id');
    }

    public function moduls()
    {
        return $this->belongsTo(Moduls::class, 'moduls_id');
    }
}
