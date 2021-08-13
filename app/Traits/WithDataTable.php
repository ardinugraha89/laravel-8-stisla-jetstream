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

            default:
                # code...
                break;
        }
    }
}
