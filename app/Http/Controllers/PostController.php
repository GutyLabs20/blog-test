<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //Este Controller es para mostrar blog
    //En estos metodos, los resultados se muestran en el Front End

    public function index()
    {
        $posts = Post::where('status', 2)->latest('id')->paginate(8);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $this->authorize('published',$post);

        $similares = Post::where('category_id', $post->category_id)
                            ->where('status', 2)
                            ->where('id', '!=', $post->id)
                            ->latest('id')
                            ->take(4)
                            ->get();

        return view('posts.show', compact('post', 'similares'));
    }

    public function category(Category $categoria)
    {
        $posts = Post::where('category_id', $categoria->id)
                            ->where('status', 2)
                            ->latest('id')
                            ->paginate(4);

        return view('posts.category', compact('posts', 'categoria'));
    }

    public function tag(Tag $tag)
    {
        $posts_etiquetas = $tag->posts()->where('status', 2)->latest('id')->paginate(4);

        return view('posts.tag', compact('posts_etiquetas', 'tag'));
    }

}
