<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class usuaris_has_moduls extends Model
{
    protected $table = 'usuaris_has_moduls';
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        // Desactivar la generación automática de ID para claves primarias compuestas
        static::creating(function ($model) {
            $model->incrementing = false;
        });
    }

    protected $fillable = ['usuaris_id', 'moduls_id'];

    public function usuaris()
    {
        return $this->belongsTo(Usuaris::class, 'usuaris_id');
    }

    public function moduls()
    {
        return $this->belongsTo(Moduls::class, 'moduls_id');
    }

    // Definir claves primarias compuestas
    protected $primaryKey = ['usuaris_id', 'moduls_id'];
}
