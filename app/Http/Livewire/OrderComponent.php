<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\State;

use Livewire\WithPagination;

class OrderComponent extends Component
{
    use WithPagination;

    public $state = 1, $address, $quantity, $price, $user_id, $product_id;

    public $order_id;

    public $form = false, $editing = false, $show = false;

    protected $rules = [
        'state' => 'required',
        'address' => 'required',
        'quantity' => 'required|min:1',
        'user_id' => 'required',
        'product_id' => 'required'
    ];

    protected $validationAttributes = [
        'state' => 'estado',
        'address' => 'dirección',
        'quantity' => 'cantidad',
        'user_id' => 'usuario',
        'product_id' => 'producto'
    ];

    public function render()
    {
        $orders = Order::paginate();
        $products = Product::all();
        $users = User::all();
        $states = State::all();
        return view('livewire.order-component', compact('orders', 'products', 'users', 'states'));
    }

    public function create() {
        $this->form = true;
    }

    public function show() {
        $this->show = !$this->show;
    }

    public function store() {
        $this->validate();

        $product = Product::find($this->product_id);

        Order::create([
            'state' => $this->state,
            'address' => $this->address,
            'quantity' => $this->quantity,
            'price' => $product['price'],
            'user_id' => $this->user_id,
            'product_id' => $this->product_id
        ]);

        $this->default();
    }

    public function edit(Order $order) {
        $this->form = true;
        $this->editing = true;

        $this->state = $order->state;
        $this->address = $order->address;
        $this->quantity = $order->quantity;
        $this->price = $order->price;
        $this->user_id = $order->user_id;
        $this->product_id = $order->product_id;

        $this->order_id = $order->id;
    }

    public function update() {
        $this->validate();

        $order = Order::find($this->order_id);

        $product = Product::find($this->product_id);

        $order->update([
            'state' => $this->state,
            'address' => $this->address,
            'quantity' => $this->quantity,
            'price' => $product->price,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id
        ]);

        $this->default();
    }

    public function destroy(Order $order) {
        $order->delete();
    }

    public function default() {
        $this->reset(['state', 'address', 'quantity', 'price', 'user_id', 'product_id', 'order_id', 'form', 'editing']);
    }
}
