<?php

namespace App\Http\Livewire;

use App\Models\Education;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddEducation extends Component
{
    use WithFileUploads;

    public $action;
    public $edu;
    public $eduId;
    public $button;
    public $filepath;

    protected function rules()
    {
        if ($this->action == "updateEducation") {
            return  [
                'edu.jenjang_pendidikan' => 'required',
                'edu.nama' => 'required|string',
                'edu.tahun_lulus' => 'required|digits:4',
                'edu.ijazah_path' => 'mimes:pdf|max:500',
            ];
        } else {
            return  [
                'edu.jenjang_pendidikan' => 'required',
                'edu.nama' => 'required|string',
                'edu.tahun_lulus' => 'required|digits:4',
                'edu.ijazah_path' => 'required|mimes:pdf|max:500',
                'edu.user' => 'required',
            ];
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addEdu()
    {
        $this->resetErrorBag();
        $this->validate();

        if (Auth::user()->is_admin) {
            $this->edu['user_id'] = $this->edu['user'];
        } else {
            $this->edu['user_id'] = auth()->user()->id;
        }
        $this->edu['ijazah_path'] = $this->edu['ijazah_path']->storeAs('ijazah', auth()->user()->nip . $this->edu['jenjang_pendidikan'] . '.pdf');

        Education::create($this->edu);

        $this->emit('saved');
        $this->reset('edu');
    }

    public function updateEducation()
    {
        $this->resetErrorBag();
        $this->validate();

        if (isset($this->edu['ijazah_path'])) {
            $this->edu['ijazah_path'] = $this->edu['ijazah_path']->storeAs('ijazah', auth()->user()->nip . $this->edu['jenjang_pendidikan'] . '.pdf');
        }
        Education::query()
            ->where('id', $this->eduId)
            ->update($this->edu);

        $this->emit('saved');
    }

    public function export()
    {
        return response()->download(storage_path('app/' . $this->filepath));
    }

    public function mount()
    {
        if (!$this->edu && $this->eduId) {
            $education = Education::find($this->eduId);
            $this->edu['jenjang_pendidikan'] = $education->jenjang_pendidikan;
            $this->edu['nama'] = $education->nama;
            $this->edu['tahun_lulus'] = $education->tahun_lulus;
            $this->filepath = $education->ijazah_path;
        }

        $this->button = create_button($this->action, "Education");
    }

    public function render()
    {
        if (Auth::user()->is_admin) {
            $user = User::all();
            return view('livewire.add-education', compact('user'));
        } else {
            return view('livewire.add-education', [
                'edu' => Education::where('user_id', '=', auth()->user()->id)->get(),
            ]);
        }
    }
}
