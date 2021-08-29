<?php

namespace App\Http\Livewire;

use App\Models\Pangkat;
use App\Models\RiwayatJabatan;
use App\Models\RiwayatPangkat as ModelsRiwayatPangkat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class RiwayatPangkat extends Component
{
    use WithFileUploads;

    public $rj;
    public $riwayatpkt;
    public $riwayatpktId;
    public $action;
    public $button;
    public $dateNaikPangkat;
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

        if (Auth::user()->is_admin) {
            $this->rj['user_id'] = $this->rj['user'];
        } else {
            $this->rj['user_id'] = auth()->user()->id;
        }
        $this->rj['skpangkat'] = $this->rj['skpangkat']->storeAs('skpangkat', auth()->user()->nip . $this->rj['tmt'] . '.pdf');

        ModelsRiwayatPangkat::create($this->rj);

        $this->emit('saved');
        $this->reset('rj');
    }

    public function updateRiwayatPangkat()
    {
        $this->resetErrorBag();
        $this->validate();

        if (isset($this->rj['skpangkat'])) {
            $this->rj['skpangkat'] = $this->rj['skpangkat']->storeAs('skpangkat', auth()->user()->nip . $this->rj['tmt'] . '.pdf');
        }

        ModelsRiwayatPangkat::query()
            ->where('id', $this->riwayatpktId)
            ->update($this->rj);

        $this->emit('saved');
    }

    public function export()
    {
        return response()->download(storage_path('app/' . $this->filepath));
    }

    public function getKenaikanPangkat()
    {

        $riwayatJbt = RiwayatJabatan::where('user_id', '=', Auth::user()->id)->first();

        if ($riwayatJbt->keterangan == "Promosi") {
            $dateNaikPangkat = $riwayatJbt->tmt->addYears(2);
        } else {
            $dateNaikPangkat = $riwayatJbt->tmt->addYears(4);
        }

        return $dateNaikPangkat;
    }

    public function mount()
    {
        if (!$this->riwayatpktId && $this->riwayatpktId) {
            $this->riwayatpktId = ModelsRiwayatPangkat::find($this->riwayatpktId);
            $this->filepath = $this->riwayatpkt->sk;
        }

        $this->button = create_button($this->action, "Riwayat Jabatan");
    }
    public function render()
    {
        $pangkat = Pangkat::all();
        $user = User::all();
        $this->getKenaikanPangkat();
        return view('livewire.riwayat-pangkat', compact('pangkat', 'user'));
    }
}
