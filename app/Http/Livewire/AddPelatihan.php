<?php

namespace App\Http\Livewire;

use App\Models\Pelatihan;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddPelatihan extends Component
{
    use WithFileUploads;

    public $action;
    public $pelatihan;
    public $pelatihanId;
    public $button;
    public $filepath;

    protected function rules()
    {
        if ($this->action == "updatePelatihan") {
            return  [
                'pelatihan.nama' => 'required|string',
                'pelatihan.tanggal_pelatihan' => 'required|string',
                'pelatihan.sertifikat' => 'mimes:pdf|max:500',
            ];
        } else {
            return  [
                'pelatihan.nama' => 'required|string',
                'pelatihan.tanggal_pelatihan' => 'required|string',
                'pelatihan.sertifikat' => 'required|mimes:pdf|max:500',
            ];
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addPelatihan()
    {
        $this->resetErrorBag();
        $this->validate();

        $this->pelatihan['user_id'] = auth()->user()->id;
        $string = str_replace(' ', '', $this->pelatihan['nama']);
        $this->pelatihan['sertifikat'] = $this->pelatihan['sertifikat']->storeAs('sertifikat', auth()->user()->nip . $string . '.pdf');

        Pelatihan::create($this->pelatihan);

        $this->emit('saved');
        $this->reset('pelatihan');
    }

    public function updatePelatihan()
    {
        $this->resetErrorBag();
        $this->validate();

        if (isset($this->pelatihan['sertifikat'])) {
            $this->pelatihan['sertifikat'] = $this->pelatihan['sertifikat']->storeAs('sertifikat', auth()->user()->nip . $this->pelatihan['sertifikat'] . '.pdf');
        }
        Pelatihan::query()
            ->where('id', $this->pelatihanId)
            ->update($this->pelatihan);

        $this->emit('saved');
    }

    public function export()
    {
        return response()->download(storage_path('app/' . $this->filepath));
    }

    public function mount()
    {
        if (!$this->pelatihan && $this->pelatihanId) {
            $pelatihan = Pelatihan::find($this->pelatihanId);
            $this->pelatihan['nama'] = $pelatihan->nama;
            $this->pelatihan['tanggal_pelatihan'] = $pelatihan->tanggal_pelatihan;
            $this->filepath = $pelatihan->sertifikat;
        }

        $this->button = create_button($this->action, "Pelatihan");
    }

    public function render()
    {
        return view('livewire.add-pelatihan');
    }
}
