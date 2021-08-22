<?php

namespace App\Http\Livewire;

use App\Models\Jabatan;
use Livewire\Component;

class AddJabatan extends Component
{
    public $jabatan;
    public $jabatanId;
    public $action;
    public $button;
    protected function rules()
    {
        return  [
            'jabatan.nama' => 'required|string',
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

        Jabatan::create($this->jabatan);

        $this->emit('saved');
        $this->reset('jabatan');
    }

    public function updateDataJabatan()
    {
        $this->resetErrorBag();
        $this->validate();

        Jabatan::query()
            ->where('id', $this->jabatanId)
            ->update($this->jabatan);

        $this->emit('saved');
    }

    public function mount()
    {
        if (!$this->jabatan && $this->jabatanId) {
            $this->jabatan = Jabatan::find($this->jabatanId);
        }

        $this->button = create_button($this->action, "Jabatan");
    }


    public function render()
    {
        return view('livewire.add-jabatan');
    }
}
