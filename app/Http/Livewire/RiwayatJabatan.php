<?php

namespace App\Http\Livewire;

use App\Models\Education;
use App\Models\Jabatan;
use App\Models\Pangkat;
use App\Models\RiwayatJabatan as ModelsRiwayatJabatan;
use App\Models\RiwayatPangkat;
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
    public $pangkat, $dateNaikPangkat, $edu;
    protected function rules()
    {
        return  [
            'rj.user' => 'required|string',
            'rj.position_id' => 'required|string',
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

        //check jika sudah ada jabatan dengan status aktif
        $status = ModelsRiwayatJabatan::where('status', '=', 'aktif')->where('user_id', '=', $this->rj['user_id'])->first();
        //dd($this->rj['skjabatan']);
        if (isset($status->id)) {
            ModelsRiwayatJabatan::query()
                ->where('id', $status->id)
                ->update(['status' => "-"]);
        }

        ModelsRiwayatJabatan::create($this->rj);

        //kalau naik jabatan promosi & golongan masih 3b, date naik pangkat jadi TMT pangkat + 1
        if ($this->rj['keterangan'] == 'Promosi') {
            //check id pangkat pengguna
            $pangkat = RiwayatPangkat::where('user_id', '=', $this->rj['user_id'])->where('Status', '=', 'Aktif')->first();
            //ambil data golongan pengguna
            $golongan = Pangkat::find($pangkat->rank_id);
            $pendidikan = Education::where('user_id', '=', $this->rj['user_id'])->max('tahun_lulus');

            //cek apakah masa jabatan sudah mencukupi satu tahun
            $jabatanDate = date('Y-m-d', strtotime('+1 year', strtotime($this->rj['tmt'])));
            //cek apakah masa pangkat sudah 1 tahun
            $pangkatDate = date('Y-m-d', strtotime('+1 year', strtotime($pangkat->tmt)));
            if ($jabatanDate > $pangkatDate) {
                if ($golongan['golongan'] == 'IIIB' || ($golongan['golongan'] == 'IIID' && $pendidikan->jenjang_pendidikan = 'S2')) {
                    // RiwayatPangkat::query()
                    //     ->where('id', '=', $pangkat->id)
                    //     ->update(['dateNaikPangkat' => date('Y-m-d', strtotime('+1 year', strtotime($pangkatDate)))]);
                    $pangkatDate = date('Y-m-d', strtotime('+2 year', strtotime($pangkatDate)));
                } elseif ($golongan['golongan'] == 'IIID' && $pendidikan->jenjang_pendidikan = 'S1') {
                    $pangkatDate = "-";
                } else {
                    $pangkatDate = date('Y-m-d', strtotime('+3 year', strtotime($pangkatDate)));
                }
            } else {
                if ($golongan['golongan'] == 'IIIB' || ($golongan['golongan'] == 'IIID' && $pendidikan->jenjang_pendidikan = 'S2')) {
                    $pangkatDate =  $pangkatDate;
                } elseif ($golongan['golongan'] == 'IIID' && $pendidikan->jenjang_pendidikan = 'S1') {
                    $pangkatDate = "-";
                } else {
                    $pangkatDate = date('Y-m-d', strtotime('+3 year', strtotime($pangkatDate)));
                }
            }
            RiwayatPangkat::query()
                ->where('id', '=', $pangkat->id)
                ->update(['dateNaikPangkat' => $pangkatDate]);
        }

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
        if (Auth::user()->is_admin) {
            $jabatan = Jabatan::all();
            $user = User::all();
            return view('livewire.riwayat-jabatan', compact('jabatan', 'user'));
        } else {
            return view('livewire.riwayat-jabatan', [
                'riwayatjbt' => RiwayatJabatan::where('user_id', '=', auth()->user()->id)->get(),
            ]);
        }
    }
}
