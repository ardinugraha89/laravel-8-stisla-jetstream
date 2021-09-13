<?php

namespace App\Http\Livewire;

use App\Models\CatatanMutasi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddMutasi extends Component
{
    public $mutasi;
    public $mutasiId;
    public $action;
    public $button;
    protected function rules()
    {
        $rules = (Auth::user()->is_admin) ? [
            'mutasi.user' => 'required',
        ] : [];
        return  array_merge([
            'mutasi.tanggal' => 'required|string',
            'mutasi.catatan' => 'required|string',
        ], $rules);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addMutasi()
    {
        $this->resetErrorBag();
        $this->validate();

        if (Auth::user()->is_admin) {
            $this->mutasi['user_id'] = $this->mutasi['user'];
        } else {
            $this->mutasi['user_id'] = auth()->user()->id;
        }

        CatatanMutasi::create($this->mutasi);

        $this->emit('saved');
        $this->reset('mutasi');
    }

    public function updateMutasi()
    {
        $this->resetErrorBag();
        $this->validate();

        CatatanMutasi::query()
            ->where('id', $this->mutasiId)
            ->update($this->mutasi);

        $this->emit('saved');
    }

    public function mount()
    {
        if (!$this->mutasi && $this->mutasiId) {
            $this->mutasi = CatatanMutasi::find($this->mutasiId);
        }

        $this->button = create_button($this->action, "Catatan Mutasi");
    }

    public function render()
    {
        if (Auth::user()->is_admin) {
            $user = User::all();
            return view('livewire.add-mutasi', compact('user'));
        } else {
            return view('livewire.add-mutasi', [
                'mutasi' => CatatanMutasi::where('user_id', '=', auth()->user()->id)->get(),
            ]);
        }
    }
}
