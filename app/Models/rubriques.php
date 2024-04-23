<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rubriques extends Model
{
    use HasFactory;

     protected $table = 'rubriques';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function criteris_avaluacio()
    {
        return $this->belongsTo(criteris_avaluacio::class, 'criteris_avaluacio_id');
    }

    public function criteri_avaluacio()
    {
        return $this->belongsTo(criteris_avaluacio::class, 'criteris_avaluacio_id');
    }

}

