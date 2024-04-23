<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipus_usuaris extends Model
{
    use HasFactory;

    protected $table = 'tipus_usuaris';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function usuaris()
    {
        return $this->hasMany(usuaris::class, 'tipus_usuaris_id');
    }
}
