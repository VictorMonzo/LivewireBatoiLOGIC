<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Product;
use App\Models\Provider;

use Livewire\WithPagination;

class ProductComponent extends Component
{
    use WithPagination;

    public $name, $description, $price, $stock, $active = 0, $photo = 'https://via.placeholder.com/250', $provider_id;

    public $product_id;

    public $form = false, $editing = false, $show = false;

    protected $rules = [
        'name' => 'required|min:5|max:100',
        'description' => 'required|min:20',
        'price' => 'required|min:0',
        'stock' => 'required|min:0',
        'active' => 'required',
        'provider_id' => 'required'
    ];

    protected $validationAttributes = [
        'name' => 'nombre',
        'description' => 'descripción',
        'price' => 'precio',
        'active' => 'activo',
        'provider_id' => 'proveedor'
    ];

    public function render()
    {
        $products = Product::paginate(6);
        $providers = Provider::all();
        return view('livewire.product-component', compact('products', 'providers'));
    }

    public function create() {
        $this->form = true;
    }

    public function show() {
        $this->show = !$this->show;
    }

    public function store() {
        $this->validate();

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' =>$this->price,
            'stock' => $this->stock,
            'active' => $this->active ? 1 : 0,
            'photo' => $this->photo,
            'provider_id' => $this->provider_id
        ]);

        $this->default();
    }

    public function edit(Product $product) {
        $this->form = true;
        $this->editing = true;

        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->active = $product->active;
        $this->provider_id = $product->provider_id;

        $this->product_id = $product->id;
    }

    public function update() {
        $this->validate();

        $product = Product::find($this->product_id);

        $product->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' =>$this->price,
            'stock' => $this->stock,
            'active' => $this->active ? 1 : 0,
            'photo' => $this->photo,
            'provider_id' => $this->provider_id
        ]);

        $this->default();
    }

    public function destroy(Product $product) {
        $product->delete();
    }

    public function default() {
        $this->reset(['name', 'description', 'price', 'stock', 'active', 'photo', 'provider_id', 'form', 'editing']);
    }
}
