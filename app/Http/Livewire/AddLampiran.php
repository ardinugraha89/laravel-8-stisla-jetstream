<?php

namespace App\Http\Livewire;

use App\Models\Lampiran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddLampiran extends Component
{
    use WithFileUploads;
    public $lampiran, $lampiranId, $action, $button;

    protected function rules()
    {
        if ($this->action == "updateLampiran") {
            return  [
                'lampiran.nama' => 'required|string',
                'lampiran.dokumen' => 'mimes:pdf|max:500',
            ];
        } else {
            return  [
                'lampiran.nama' => 'required|string',
                'lampiran.dokumen' => 'required|mimes:pdf|max:500',
            ];
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addLampiran()
    {
        $this->resetErrorBag();
        $this->validate();

        if (Auth::user()->is_admin) {
            $this->lampiran['user_id'] = $this->lampiran['user'];
        } else {
            $this->lampiran['user_id'] = auth()->user()->id;
        }
        $this->lampiran['dokumen'] = $this->lampiran['dokumen']->storeAs('dokumen', auth()->user()->nip . $this->lampiran['nama'] . '.pdf');

        Lampiran::create($this->lampiran);

        $this->emit('saved');
        $this->reset('lampiran');
    }

    public function updateLampiran()
    {
        $this->resetErrorBag();
        $this->validate();

        if (isset($this->lampiran['dokumen'])) {
            $this->lampiran['dokumen'] = $this->lampiran['dokumen']->storeAs('dokumen', auth()->user()->nip . $this->lampiran['dokumen'] . '.pdf');
        }
        Lampiran::query()
            ->where('id', $this->lampiranId)
            ->update($this->lampiran);

        $this->emit('saved');
    }

    public function export()
    {
        return response()->download(storage_path('app/' . $this->filepath));
    }

    public function mount()
    {
        if (!$this->lampiran && $this->lampiranId) {
            $lampiran = Lampiran::find($this->lampiranId);
            $this->lampiran['nama'] = $lampiran->nama;
            $this->filepath = $lampiran->ijazah_path;
        }

        $this->button = create_button($this->action, "Lampiran");
    }

    public function render()
    {
        if (Auth::user()->is_admin) {
            $user = User::all();
            return view('livewire.add-lampiran', compact('user'));
        } else {
            return view('livewire.add-lampiran', [
                'lampiran' => Lampiran::where('user_id', '=', auth()->user()->id)->get(),
            ]);
        }
    }
}
