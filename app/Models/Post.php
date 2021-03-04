<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //asignacion masiva con metodo guarded
    protected $guarded = ['id', 'created_at', 'updated_at'];
    //ayuda colocar campos que no requieran ingreso masiva.

    //Relación de uno a muchos inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Relacion mucho a muchos
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //Relación uno a uno polimorfica
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}

