<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        //Esta condicional sirve al momento de ejecutar los seeders y no ubicar el id de autenticación
        if (! \App::runningInConsole()) {
            //Aqui se pondra el usuario autenticado desde el backend
            $post->user_id = auth()->user()->id;
        }

    }



    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
        if ($post->image) {
            Storage::delete($post->image->url);
        }
        //Luego de eso, se tiene que que registrar lo Observers en app/Providers/EventServiceProvider.php
    }

    //Se generó un Observer -> leer más sobre ellos en la documentación de laravel.

}
