<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

use App\Models\User;

use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;

    public $name, $email, $type_user, $password, $address;

    public $user_id;

    public $form = false, $editing = false, $show = false;

    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'type_user' => 'required',
        'password' => 'required',
        'address' => 'required'
    ];

    protected $validationAttributes = [
        'name' => 'nombre',
        'type_user' => 'tipo de usuario',
        'password' => 'contraseña',
        'address' => 'dirección'
    ];

    public function render()
    {
        $users = User::paginate(6);
        $types_user = [
            1 => 'Customer',
            2 => 'Dealer',
            3 => 'Admin'
        ];
        return view('livewire.user-component', compact('users', 'types_user'));
    }

    public function create() {
        $this->form = true;
    }

    public function show() {
        $this->show = !$this->show;
    }

    public function store() {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'type_user' => $this->type_user,
            'password' => Hash::make($this->password),
            'address' => $this->address
        ]);

        $this->default();
    }

    public function edit(User $user) {
        $this->form = true;
        $this->editing = true;

        $this->name = $user->name;
        $this->email = $user->email;
        $this->type_user = $user->type_user;
        $this->address = $user->address;

        $this->user_id = $user->id;
    }

    public function update() {
        $this->validate();

        $user = User::find($this->user_id);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'type_user' => $this->type_user,
            'password' => Hash::make($this->password),
            'address' => $this->address
        ]);

        $this->default();
    }

    public function destroy(User $user) {
        $user->delete();
    }

    public function default() {
        $this->reset(['name', 'email', 'type_user', 'password', 'user_id', 'form', 'editing']);
    }
}
