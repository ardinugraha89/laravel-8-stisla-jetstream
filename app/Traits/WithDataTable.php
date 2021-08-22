<?php

namespace App\Traits;


trait WithDataTable
{

    public function get_pagination_data()
    {
        switch ($this->name) {
            case 'user':
                $users = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.user',
                    "users" => $users,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('user.new'),
                            'create_new_text' => 'Buat User Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'education':
                $educations = $this->model::search($this->search)
                    ->orderBy('tahun_lulus', $this->sortAsc ? 'desc' : 'asc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.education',
                    "educations" => $educations,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('edu.new'),
                            'create_new_text' => 'Tambah Data Pendidikan',
                        ]
                    ])
                ];
                break;

            case 'pelatihan':
                $pelatihan = $this->model::search($this->search)
                    ->orderBy('tanggal_pelatihan', $this->sortAsc ? 'desc' : 'asc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.pelatihan',
                    "pelatihan" => $pelatihan,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('pelatihan.new'),
                            'create_new_text' => 'Tambah Data Pelatihan',
                        ]
                    ])
                ];
                break;

            case 'jabatan':
                $jabatan = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.jabatan',
                    "jabatan" => $jabatan,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('jabatan.new'),
                            'create_new_text' => 'Tambah Data Jabatan',
                        ]
                    ])
                ];
                break;

            case 'pangkat':
                $pangkat = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.pangkat',
                    "pangkat" => $pangkat,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('pangkat.new'),
                            'create_new_text' => 'Tambah Data Pangkat',
                        ]
                    ])
                ];
                break;

            case 'lampiran':
                $lampiran = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.lampiran',
                    "lampiran" => $lampiran,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('lampiran.new'),
                            'create_new_text' => 'Tambah Data Lampiran',
                        ]
                    ])
                ];
                break;

            case 'riwayatjbt':
                $riwayatjbt = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.riwayatjbt',
                    "riwayatjbt" => $riwayatjbt,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('riwayatjbt.new'),
                            'create_new_text' => 'Tambah Data Riwayat Jabatan',
                        ]
                    ])
                ];
                break;

            default:
                # code...
                break;
        }
    }
}