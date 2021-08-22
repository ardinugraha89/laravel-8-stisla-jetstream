<?php

namespace App\Http\Livewire;

use App\Models\Pangkat;
use Livewire\Component;

class AddPangkat extends Component
{
    public $pangkat;
    public $pangkatId;
    public $action;
    public $button;
    protected function rules()
    {
        return  [
            'pangkat.nama' => 'required|string',
            'pangkat.golongan' => 'required|string',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addJabatan()
    {
        $this->resetErrorBag();
        $this->validate();

        Pangkat::create($this->pangkat);

        $this->emit('saved');
        $this->reset('pangkat');
    }

    public function updateDataJabatan()
    {
        $this->resetErrorBag();
        $this->validate();

        Pangkat::query()
            ->where('id', $this->pangkatId)
            ->update($this->pangkat);

        $this->emit('saved');
    }

    public function mount()
    {
        if (!$this->pangkat && $this->pangkatId) {
            $this->pangkat = Pangkat::find($this->pangkatId);
        }

        $this->button = create_button($this->action, "Pangkat");
    }

    public function render()
    {
        return view('livewire.add-pangkat');
    }
}
