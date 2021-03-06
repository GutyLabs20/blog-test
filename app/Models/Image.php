<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    //Se agrego asignación masiva despues del crear un nuevo post con su imagen
    protected $fillable = ['url'];

    //Relación polimorfica
    public function imageable()
    {
        return $this->morphTo();
    }
}
