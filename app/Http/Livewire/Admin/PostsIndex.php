<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostsIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search;

    //Metodo para resetear el valor del search
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        //metodo para realizar el filtro en campo de texto
        $posts = Post::where('user_id', auth()->user()->id)
                ->where('name', 'LIKE', '%'. $this->search .'%')
                ->latest('id')
                ->paginate();

        return view('livewire.admin.posts-index', compact('posts'));
    }
}
