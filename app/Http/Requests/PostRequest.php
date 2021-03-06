<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Se comenta las lineas abajos para que desde aquí pase de frente a las reglas de validación.
        return true;

        //Validación de autorización de usuario, de acuerdo a usuario autenticado.
        // if ($this->user_id == auth()->user()->id) {
        //     return true;
        // }else{
        //     return false;
        // }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //Cuando se va a crear un nuevo post
        $post = $this->route()->parameter('post'); //null -> para el tema de edit

        $reglas = [
            'name' => 'required',
            'slug' => 'required|unique:posts',
            'status' => 'required|in:1,2',
            'file' => 'image'
        ];

        //Si el post ya existe, pero se va a actualizar y no tener problemas con el slug se agrega el siguiente código
        if ($post) {
            $reglas['slug'] = 'required|unique:posts,slug,' . $post->id;
        }

        if ($this->status == 2) {
            $reglas = array_merge($reglas, [
                'category_id' => 'required',
                'tags' => 'required',
                'extract' => 'required',
                'body' => 'required'
            ]);
        }

        return $reglas;
    }
}
