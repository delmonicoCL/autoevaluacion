<?php

namespace App\Models;

use App\Models\Usuaris;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class tipus_usuaris extends Model
{
    use HasFactory;

    protected $table = 'tipus_usuaris';
    // protected $primaryKey = 'id';
    public $timestamps = false;

    /** 

    * @return \Illuminate\Database\Eloquent\Relations\HasMany

    */

    public function usuaris(): HasMany
    {
        return $this->hasMany(usuaris::class, 'tipus_usuaris_id');
    }
}
