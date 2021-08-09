<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class Education extends Component
{
    use WithFileUploads;

    public $action;
    public $button;
    public $jenjang, $nama, $tahun_lulus, $ijazah;



    public function rules()
    {
        return  [
            'jenjang' => 'required',
            'nama' => 'required|string',
            'tahun_lulus' => 'required|digits:4',
            'ijazah' => 'required|mimes:pdf|max:500',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addEdu()
    {
        $this->resetErrorBag();
        $this->validate();

        // $password = $this->user['password'];

        // if (!empty($password)) {
        //     $this->user['password'] = Hash::make($password);
        // }

        Education::create($this->education);

        $this->emit('saved');
        $this->reset('education');
    }

    public function mount()
    {

        $this->button = create_button($this->action, "Education");
    }

    public function render()
    {
        return view('livewire.education');
    }
}
