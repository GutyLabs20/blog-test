<div class="card">

    {{-- {{$search}} --}}
    {{-- Aqui esto es un buscador con filtro muy bueno realizado con livewire --}}
    <div class="card-header bg-secondary">
        <input wire:model="search" class="form-control" placeholder="Ingrese el nombre o correo de un usuario">
    </div>


    @if ($users->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td width="10px">
                                <a class="btn btn-primary btn-sm" href="{{route('admin.users.edit', $user)}}">Editar</a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{$users->links()}}
        </div>
    @else

        <div class="card-body">
            <strong>No existe registro...</strong>
        </div>

    @endif



</div>
