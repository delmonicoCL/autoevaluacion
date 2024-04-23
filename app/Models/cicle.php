<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cicle extends Model
{
    use HasFactory;


    protected $table = 'cicles';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function moduls()
    {
        return $this->hasMany(moduls::class, 'cicles_id');
    }


}
