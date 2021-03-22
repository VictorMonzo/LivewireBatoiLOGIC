<div class="page-providers">
    <div class="container my-5">

        <div class="row pt-5">
            <h1>Listado de proveedores</h1>
        </div>

        <div class="row py-4">
            @if(Auth::check() && (auth()->user()->type_user === 3))
                <a wire:click="create" class="btn btn-success text-white" >+ Añadir proveedor</a>
            @endif
        </div>

        <div class="row">
            @if($form) <div class="col-7"> @else <div class="col-12"> @endif
                <div class="row">
                    @forelse($providers as $provider)
                        <div class="p-3 mb-3 mr-3 bg-white rounded box-shadow w-100">
                            <div class="media text-muted">
                                <div class="media-body pt-3 mb-0 ml-3">
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                        <strong class="text-primary">Proveedor: {{ $provider->name." ".$provider->surname}}</strong>
                                    </div>
                                    <span class="d-block"><i class="fas fa-envelope"></i> {{ $provider->email }}</span>

                                    @if(Auth::check() && (auth()->user()->type_user === 3))

                                        <a wire:click="edit({{$provider}})" class="btn btn-primary text-white">Editar proveedor</a>
                                        <button wire:click="destroy({{$provider}})" class="btn btn-danger text-white">Eliminar proveedor</button>

                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-danger w-100" role="alert">No hay ningún proveedor</div>
                </div>
                @endforelse
            </div>

            {{ $providers->links('vendor.pagination.bootstrap-4') }}

        </div>


        @if($form)
            <div class="col-5 bg-white">
                <div class="page-create-comanda">
                    <div class="container mb-5">
                        <div class="row pt-3">
                            <h1>{{ $editing ? 'Editar proveedor' : 'Crear proveedor'}}</h1>
                        </div>

                        <div class="row py-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input wire:model="name" type="text" name="name" id="name" class="form-control" required>

                                    @error('name')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input wire:model="email" type="email" name="email" id="email" class="form-control" required>

                                    @error('email')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                    @enderror

                                </div>
                            </div>

                            @if($editing)
                                <button wire:click="update" type="submit" class="btn btn-primary text-white">Editar proveedor</button>
                            @else
                                <button wire:click="store" type="submit" class="btn btn-primary text-white">Crear proveedor</button>
                            @endif
                            <button wire:click="default" class="btn btn-danger ml-2 text-white">Cancelar</button>
                        </div>
                    </div>
                </div>

            </div>
        @endif

        </div>

    </div>
</div>

