<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Provider;

use Livewire\WithPagination;

class ProviderComponent extends Component
{

    use WithPagination;

    public $name, $email, $provider_id;

    public $form = false, $editing = false;

    protected $rules = [
        'name' => 'required',
        'email' => 'required'
    ];

    protected $validationAttributes = [
        'name' => 'nombre'
    ];

    public function render()
    {
        $providers = Provider::paginate(6);
        return view('livewire.provider-component', compact('providers'));
    }

    public function create() {
        $this->form = true;
    }

    public function store() {

        $this->validate();

        Provider::create([
            'name' =>  $this->name,
            'email' => $this->email
        ]);

        $this->default();
    }

    public function edit(Provider $provider) {
        $this->name = $provider->name;
        $this->email = $provider->email;
        $this->provider_id = $provider->id;

        $this->form = true;
        $this->editing = true;
    }

    public function update() {

        $this->validate();

        $provider = Provider::find($this->provider_id);

        $provider->update([
           'name' => $this->name,
           'email' => $this->email
        ]);

        $this->default();
    }

    public function destroy(Provider $provider) {
        $provider->delete();
    }

    public function default() {
        $this->reset(['name', 'email', 'form', 'editing']);
    }
}
