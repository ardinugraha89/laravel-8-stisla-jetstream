<?php

namespace App\Http\Livewire;

use App\Models\Jabatan;
use App\Models\RiwayatJabatan as ModelsRiwayatJabatan;
use Livewire\Component;

class RiwayatJabatan extends Component
{
    public $riwayatjbt;
    public $riwayatjbtId;
    public $action;
    public $button;
    protected function rules()
    {
        return  [
            'rj.jabatan' => 'required|string',
            'rj.tmt' => 'required|string',
            'rj.skjabatan' => 'required|mimes:pdf|max:500',
            'rj.keterangan' => 'required|string',
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

        Jabatan::create($this->rj);

        $this->emit('saved');
        $this->reset('rj');
    }

    public function updateRiwayatJabatan()
    {
        $this->resetErrorBag();
        $this->validate();

        Jabatan::query()
            ->where('id', $this->riwayatjbtId)
            ->update($this->rj);

        $this->emit('saved');
    }

    public function mount()
    {
        if (!$this->riwayatjbt && $this->riwayatjbtId) {
            $this->riwayatjbt = ModelsRiwayatJabatan::find($this->riwayatjbtId);
        }

        $this->button = create_button($this->action, "Riwayat Jabatan");
    }

    public function render()
    {
        $jabatan = Jabatan::all();
        return view('livewire.riwayat-jabatan', compact('jabatan'));
    }
}
