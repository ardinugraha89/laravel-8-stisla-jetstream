<?php

namespace App\Http\Livewire;

use App\Models\Jabatan;
use App\Models\RiwayatJabatan as ModelsRiwayatJabatan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class RiwayatJabatan extends Component
{
    use WithFileUploads;

    public $riwayatjbt;
    public $riwayatjbtId;
    public $action;
    public $button;
    public $filepath;
    public $rj;
    protected function rules()
    {
        return  [
            'rj.user' => 'required|string',
            'rj.jabatan_id' => 'required|string',
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

        if (Auth::user()->is_admin) {
            $this->rj['user_id'] = $this->rj['user'];
        } else {
            $this->rj['user_id'] = auth()->user()->id;
        }
        $this->rj['skjabatan'] = $this->rj['skjabatan']->storeAs('skjabatan', auth()->user()->nip . $this->rj['tmt'] . '.pdf');
        $this->rj['status'] = 'Aktif';

        ModelsRiwayatJabatan::create($this->rj);

        $this->emit('saved');
        $this->reset('rj');
    }

    public function updateRiwayatJabatan()
    {
        $this->resetErrorBag();
        $this->validate();

        if (isset($this->rj['skjabatan'])) {
            $this->rj['skjabatan'] = $this->rj['skjabatan']->storeAs('skjabatan', auth()->user()->nip . $this->rj['tmt'] . '.pdf');
        }

        ModelsRiwayatJabatan::query()
            ->where('id', $this->riwayatjbtId)
            ->update($this->rj);

        $this->emit('saved');
    }

    public function export()
    {
        return response()->download(storage_path('app/' . $this->filepath));
    }

    public function mount()
    {
        if (!$this->riwayatjbt && $this->riwayatjbtId) {
            $this->riwayatjbt = ModelsRiwayatJabatan::find($this->riwayatjbtId);
            $this->filepath = $this->riwayatjbt->sk;
        }

        $this->button = create_button($this->action, "Riwayat Jabatan");
    }

    public function render()
    {
        $jabatan = Jabatan::all();
        $user = User::all();
        return view('livewire.riwayat-jabatan', compact('jabatan', 'user'));
    }
}
