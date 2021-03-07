<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


//Se agrega un FormRequest
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //metodo pluck, puede convertir una tabla en matriz con valor y clave, segun dos campos asignados
        $categorias = Category::pluck('name', 'id');
        $tags = Tag::all();

        return view('admin.posts.create', compact('categorias', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {


        //Se cambio request por PostRequest
        $post = Post::create($request->all());

        if ($request->file('file')) {
            $url = Storage::put('posts', $request->file('file'));

            $post->image()->create([
                'url' => $url,
            ]);
            //Despues de esta línea, habilitar la asignación masiva en el modelo Image
        }

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.edit', $post)
                ->with('info', 'El post se creó con éxito');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('author', $post);
        //
        //metodo pluck, puede convertir una tabla en matriz con valor y clave, segun dos campos asignados
        $categorias = Category::pluck('name', 'id');
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categorias', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('author', $post);
        //Le pasamos la información del formulario
        $post->update($request->all());

        //Si estamos mandando una imagen
        if ($request->file('file')) {
            //Aqui se llama a la carpeta llamada posts con ayuda del facade Storage
            $url = Storage::put('posts', $request->file('file'));

            //Si el post ya contaba con una imagen
            if ($post->image) {
                //Eliminamos la imagen
                Storage::delete($post->image->url);

                //Actualizamos la imagen
                $post->image->update([
                    'url' => $url
                ]);
            }else{
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }

        if ($request->tags) {
            //Aquí se soluciono la eliminación de etiquetas con el metodo sync
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.posts.edit', $post)
                ->with('info', 'El post se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('author', $post);
        //
        $post->delete();

        return redirect()->route('admin.posts.index')
                ->with('info', 'El post se eliminó con éxito');
    }
}
