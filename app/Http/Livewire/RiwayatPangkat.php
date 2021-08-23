<?php

namespace App\Http\Livewire;

use App\Models\Pangkat;
use App\Models\RiwayatPangkat as ModelsRiwayatPangkat;
use Livewire\Component;

class RiwayatPangkat extends Component
{
    public $riwayatpkt;
    public $riwayatpktId;
    public $action;
    public $button;
    protected function rules()
    {
        return  [
            'rj.pangkat' => 'required|string',
            'rj.tmt' => 'required|string',
            'rj.skjabatan' => 'required|mimes:pdf|max:500',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addRiwayat()
    {
        $this->resetErrorBag();
        $this->validate();

        ModelsRiwayatPangkat::create($this->rj);

        $this->emit('saved');
        $this->reset('rj');
    }

    public function updateRiwayatPangkat()
    {
        $this->resetErrorBag();
        $this->validate();

        ModelsRiwayatPangkat::query()
            ->where('id', $this->riwayatpktId)
            ->update($this->rj);

        $this->emit('saved');
    }
    public function mount()
    {
        if (!$this->riwayatpktId && $this->riwayatpktId) {
            $this->riwayatpktId = ModelsRiwayatPangkat::find($this->riwayatpktId);
        }

        $this->button = create_button($this->action, "Riwayat Jabatan");
    }
    public function render()
    {
        $pangkat = Pangkat::all();
        return view('livewire.riwayat-pangkat', compact('pangkat'));
    }
}
