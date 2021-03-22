<div class="page-comanda">
    <div class="container my-5">
        <div class="row pt-5">
            <h1>Listado de comandas</h1>
        </div>

        @if(!$form)
            <div class="row py-4">
                @if(Auth::check() && (auth()->user()->type_user === 3))
                    <a wire:click="create" class="btn btn-success text-white" >+ Añadir comanda</a>
                @endif
            </div>
        @else
            <div class="page-create-comanda">
                <div class="container my-5">
                    <div class="row ">
                        <h2>{{ !$editing ? 'Crear comanda' : 'Editar comanda'}}</h2>
                    </div>

                    <div class="row py-4">
                        <form action="" method='POST' class="w-100">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="address">Seleccione un usuario</label>
                                        <select wire:model="user_id" class="form-control" id="user_id" name="user_id" required>
                                            @forelse($users as $user)
                                                <option value="">Seleccione un usuario</option>
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @empty
                                                <option value="">No hay usuarios</option>
                                            @endforelse
                                        </select>
                                        @error('user_id')
                                            <p class="text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="address">Seleccione un producto</label>
                                        <select wire:model="product_id" class="form-control" id="product_id" name="product_id" required>
                                            <option value="">Seleccione un producto</option>
                                            @forelse($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @empty
                                                <option value="">No hay productos</option>
                                            @endforelse
                                        </select>
                                        @error('product_id')
                                            <p class="text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="address">Cantidad</label>
                                        <input wire:model="quantity" type="number" id="quantity" name="quantity" class="form-control" min="1" required>
                                        @error('quantity')
                                            <p class="text-danger"><small>{{ $message }}</small></p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            @if($editing)
                                <div class="form-group">
                                    <label for="state">Estado de la comanda</label>
                                    <select wire:model="state" class="form-control" id="state" name="state" required>
                                        @forelse($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @empty
                                            <option value="">No hay estados</option>
                                        @endforelse
                                    </select>
                                    @error('state')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="address">Dirección</label>
                                <textarea wire:model="address" name="address" id="address" class="form-control" rows="3" required>{{ auth()->user()->address }}</textarea>
                                @error('address')
                                    <p class="text-danger"><small>{{ $message }}</small></p>
                                @enderror
                            </div>

                            @if(!$editing)
                                <a wire:click="store" type="submit" class="btn btn-primary text-white">Crear comanda</a>
                            @else
                                <a wire:click="update" type="submit" class="btn btn-primary text-white">Editar comanda</a>
                            @endif

                            <a wire:click="default" class="btn btn-danger ml-2 text-white">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        @endif


        <div class="row">
            @forelse($orders as $order)
                <div class="col-12 col-md-6 col-lg-4 mb-5">
                    <div class="card">
                        <!--img src="..." class="card-img-top" alt="..."-->
                        <div class="card-body">
                            <h5 class="card-title text-success"><a href="" class="text-success"><i class="fas fa-boxes"></i> #{{ $order->id }}</a></h5>
                            <p class="card-text m-0 py-3"><b>{{ $order->users->name }} {{ $order->users->surname }}</b></p>
                            <p class="card-text m-0"><i class="fas fa-envelope"></i> {{ $order->users->email }}</p>
                            <p class="card-text m-0 pb-3"><i class="fas fa-map-marker-alt"></i> {{ $order->address }}.</p>

                            <a wire:click="show" class="text-primary">{{ !$show ? 'Ver cotenido' : 'Ocultar contenido' }}</a>

                            @if($show)
                                <p class="card-text m-0">{{ $order->quantity }} unidades</p>
                                <p class="card-text m-0 pb-3">{{ $order->price }}€</p>
                            @endif

                            @if(Auth::check() && (auth()->user()->type_user === 3))
                                <form method="POST" action="" class="mt-3">
                                    @method('DELETE')
                                    @csrf
                                    <a wire:click="edit({{ $order }})" class="btn btn-primary text-white">Editar comanda</a>
                                    <a wire:click="destroy({{ $order }})" class="btn btn-danger text-white">Borrar</a>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-danger w-100" role="alert">No hay ninguna comanda</div>
            @endforelse
        </div>
        {{ $orders->links() }}
    </div>
</div>
