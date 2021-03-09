<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    //Propiedad search
    public $search;

    // para usar las clases de bootstrap, ya que el proyecto esta trabajando con tailwind
    protected $paginationTheme = "bootstrap";

    //Metodo para resetear el valor del search
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        //Secuencia sql para hacer busqueda por coincidencia,
        //Se visualiza resultado en el input del componente livewire
        $users = User::where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                ->paginate();

        return view('livewire.admin.users-index', compact('users'));
    }
}
