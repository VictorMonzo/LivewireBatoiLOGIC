<div class="page-users">
    <div class="container my-5">
        <div class="row pt-5">
            <h1>Listado de usuarios</h1>
        </div>

        @if(!$form)
            <div class="row py-4">
                @if(Auth::check() && (auth()->user()->type_user === 3))
                    <a wire:click="create" class="btn btn-success text-white">+ Añadir usuario</a>
                @endif
            </div>
        @else
            <div class="page-create-user">
                <div class="container my-5">
                    <div class="row">
                        <h2>{{ !$editing ? 'Crear usuario' : 'Editar usuario'}}</h2>
                    </div>

                    <div class="row py-4">
                        <form action="" method='POST' class="w-100" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="name">Nombre: </label>
                                        <input wire:model="name" type="text" class="form-control" id="name" name="name" required>
                                        @error('name')
                                            <p class="text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="form-group">
                                        <label for="email">Email: </label>
                                        <input wire:model="email" type="email" class="form-control" id="email" name="email" required>
                                        @error('email')
                                            <p class="text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    <div class="form-group">
                                        <label for="password">Contraseña: </label>
                                        <input wire:model="password" type="password" class="form-control" id="password" name="password" required>
                                        @error('password')
                                            <p class="text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="type_user">Tipo usuario: </label>
                                            <select wire:model="type_user" class="form-control" id="type_user" name="type_user" required>
                                                <option value="">Seleccione el tipo de usuario</option>
                                                @foreach($types_user as $id=>$name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                            @error('type_user')
                                                <p class="text-danger"><small>{{ $message }}</small></p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address">Dirección: </label>
                                <textarea wire:model="address" class="form-control" id="address" name="address" rows="3" required></textarea>
                                @error('address')
                                    <p class="text-danger"><small>{{ $message }}</small></p>
                                @enderror
                            </div>

                            @if(!$editing)
                                <a wire:click="store" type="submit" class="btn btn-primary text-white">Crear usuario</a>
                            @else
                                <a wire:click="update" type="submit" class="btn btn-primary text-white">Editar usuario</a>
                            @endif

                            <a wire:click="default" class="btn btn-danger ml-2 text-white">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            @forelse($users as $user)
                <div class="p-3 mb-3 bg-white rounded box-shadow w-100">
                    <div class="media text-muted">
                        <a href="" class="pt-3">
                            <img src="{{ $user->photo ? asset($user->photo): 'https://via.placeholder.com/300' }}" class="rounded-circle" height="100" width="100" style="object-fit: cover">
                        </a>
                        <div class="media-body pt-3 mb-0 ml-3">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                @if(auth()->user()->id === $user->id || auth()->user()->type_user === 3)
                                    <a><strong class="text-gray-dark">{{ $user->name }}</strong></a>
                                    <!--a href="" class="d-none d-md-block">Ver usuario</a-->
                                @else
                                    <a href="#"><strong class="text-gray-dark">{{ $user->name." ".$user->surname}}</strong></a>
                                @endif
                            </div>
                            <span class="d-block"><i class="fas fa-envelope"></i> {{ $user->email }}</span>
                            <span class="d-block"><i class="fas fa-map-marker-alt"></i> {{ $user->address }}</span>
                            <span class="d-block"> {{ $user->type_user == 1 ? 'Customer' : ($user->type_user == 2 ? 'Dealer' : 'Admin') }}</span>
                        </div>
                    </div>
                    <div class="row pl-4">
                        @if(Auth::check() && (auth()->user()->type_user === 3 || auth()->user()->id === $user->id))
                            <form method="POST" action="" class="pt-4">
                                @method('DELETE')
                                @csrf
                                <a wire:click="edit({{ $user }})" class="btn btn-primary text-white">Editar usuario</a>
                                <a wire:click="destroy({{ $user }})" class="btn btn-danger text-white">Eliminar usuario</a>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="alert alert-danger w-100" role="alert">No hay ningún usuario</div>
        </div>
        @endforelse
        {{ $users->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
