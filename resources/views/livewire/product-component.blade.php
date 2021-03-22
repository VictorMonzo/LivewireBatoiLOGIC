<div class="page-products">
    <div class="container my-5">
        <div class="row pt-5">
            <h1>Listado de productos</h1>
        </div>

        @if(!$form)
            <div class="row py-4">
                @if(Auth::check() && (auth()->user()->type_user === 3))
                    <a wire:click="create" class="btn btn-success text-white">+ Añadir producto</a>
                @endif
            </div>
        @else
            <div class="page-create-product bg-white">
                <div class="container my-5">
                    <div class="row">
                        <h2>{{ !$editing ? 'Crear producto' : 'Editar producto'}}</h2>
                    </div>

                    <div>
                        <!--form action="" method='POST' class="w-100" enctype="multipart/form-data"-->

                        <div class="row">
                            <div class="col-12 col-md-7">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input wire:model="name" type="text" id="name" name="name" class="form-control" required>
                                    @error('name')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input wire:model="price" type="number" id="price" name="price" class="form-control" min="1" step="0.01" required>
                                    @error('price')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input wire:model="stock" type="number" id="stock" name="stock" class="form-control" min="0" required>
                                    @error('stock')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="form-group">
                                    <label for="address">Descripción</label>
                                    <textarea wire:model="description" name="description" id="description" class="form-control" rows="3" required></textarea>
                                    @error('description')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="provider">Seleccione un proveedor</label>
                                    <select wire:model="provider_id" class="form-control" id="provider_id" name="provider_id" required>
                                        <option value="">Seleccione un proveedor</option>
                                        @forelse($providers as $provider)
                                            <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                        @empty
                                            <option value="">No hay proveedores</option>
                                        @endforelse
                                    </select>
                                    @error('provider_id')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input id="file-input" name="photo" type="file" class="form-control" accept="image/gif,image/jpeg,image/jpg,image/png" required/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col d-flex">
                                @if(!$editing)
                                    <button wire:click="store" type="submit" class="btn btn-primary text-white">Crear producto</button>
                                @else
                                    <button wire:click="update" type="submit" class="btn btn-primary text-white">Editar producto</button>
                                @endif

                                <button wire:click="default" class="btn btn-danger ml-2 text-white">Cancelar</button>

                                <div class="form-check ml-3">
                                    <input wire:model="active" {{ $active ? 'checked' : '' }} type="checkbox" class="form-check-input" id="active" name="active">
                                    <label class="form-check-label" for="exampleCheck1">Activo</label>
                                    @error('active')
                                        <p class="text-danger"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!--/form-->
                    </div>
                </div>
            </div>
        @endif


        <div class="container my-5">
            <div class="row">
                @forelse($products as $product)
                    <div class="col-12 col-md-6 col-lg-4 mb-5">
                        <div class="card product">
                            <a href=""><img src="{{ $product->photo ? asset($product->photo) : 'https://via.placeholder.com/300' }}" class="card-img-top" alt="Imágen de producto" height="250" style="object-fit: cover"></a>
                            <div class="card-body">
                                <a href=""><h4 class="text-dark">{{ $product->name }}</h4></a>
                                <p class="text-primary m-0 pb-3">{{ $product->price }}€</p>
                                <div class="row">
                                    <div class="col">
                                        <a class="text-primary">{{ $product->providers->name }}</a>
                                    </div>
                                    <div class="col text-right">
                                        <span class="card-text m-0 text-danger">{{ $product->stock }} en stock</span>
                                    </div>
                                </div>

                                <a wire:click="show" class="btn btn-block btn-danger mt-3 mb-2 text-white">{{ !$show ? 'Ver descripción' : 'Ocultar descripción' }}</a>

                                @if($show)
                                    <p>{{ $product->description }}</p>
                                @endif


                                @if(Auth::check() && (auth()->user()->type_user === 3))
                                    <a wire:click="edit({{ $product }})" class="btn btn-primary text-white">Editar producto</a>
                                    <button wire:click="destroy({{ $product }})" class="btn btn-danger">Borrar</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-danger w-100" role="alert">No hay ningún producto</div>
                @endforelse
            </div>
        </div>
        {{ $products->links('vendor.pagination.bootstrap-4') }}

    </div>
</div>
