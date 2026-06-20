<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'apellido',
        'email',
        'password',
        'rol_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function talleres()
    {
        return $this->belongsToMany(
            \App\Models\Taller::class,
            'inscripciones'
        )->withTimestamps();
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
