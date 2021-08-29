<?php

namespace App\Http\Livewire;

use App\Models\KenaikanGajiBerkala;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddKgb extends Component
{
    use WithFileUploads;

    public $kgb;
    public $kgbId;
    public $action;
    public $button;
    public $filepath;
    protected function rules()
    {
        return  [
            'kgb.user' => 'required',
            'kgb.tmt' => 'required|string',
            'kgb.skkgb' => 'required|mimes:pdf|max:500',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addKenaikanGaji()
    {
        $this->resetErrorBag();
        $this->validate();

        if (Auth::user()->is_admin) {
            $this->kgb['user_id'] = $this->kgb['user'];
        } else {
            $this->kgb['user_id'] = auth()->user()->id;
        }
        $this->kgb['skkgb'] = $this->kgb['skkgb']->storeAs('kgb', auth()->user()->nip . $this->kgb['tmt'] . '.pdf');


        KenaikanGajiBerkala::create($this->kgb);

        $this->emit('saved');
        $this->reset('kgb');
    }

    public function updateKenaikanGaji()
    {
        $this->resetErrorBag();
        $this->validate();

        if (isset($this->kgb['skkgb'])) {
            $this->kgb['skkgb'] = $this->kgb['skkgb']->storeAs('kgb', auth()->user()->nip . $this->kgb['tmt'] . '.pdf');
        }

        KenaikanGajiBerkala::query()
            ->where('id', $this->kgbId)
            ->update($this->kgb);

        $this->emit('saved');
    }

    public function export()
    {
        return response()->download(storage_path('app/' . $this->filepath));
    }

    public function mount()
    {
        if (!$this->kgb && $this->kgbId) {
            $this->kgb = KenaikanGajiBerkala::find($this->kgbId);
            $this->filepath = $this->kgb->sk;
        }

        $this->button = create_button($this->action, "Kenaikan Gaji Berkala");
    }

    public function render()
    {

        if (Auth::user()->is_admin) {
            $user = User::all();
            return view('livewire.add-kgb', compact('user'));
        } else {
            return view('livewire.add-kgb', [
                'kgb' => KenaikanGajiBerkala::where('user_id', '=', auth()->user()->id)->get(),
            ]);
        }
    }
}
