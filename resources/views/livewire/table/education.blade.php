<div>
    <x-data-table :data="$data" :model="$educations">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('jenjang_pendidikan')" role="button" href="#">
                    Jenjang Pendidikan
                    @include('components.sort-icon', ['field' => 'jenjang_pendidikan'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nama')" role="button" href="#">
                    Nama Almamater
                    @include('components.sort-icon', ['field' => 'nama'])
                </a></th>
                <th><a wire:click.prevent="sortBy('tahun_lulus')" role="button" href="#">
                    Tahun Lulus
                    @include('components.sort-icon', ['field' => 'tahun_lulus'])
                </a></th>
                <th><a wire:click.prevent="sortBy('ijazah_path')" role="button" href="#">
                    Ijazah
                    @include('components.sort-icon', ['field' => 'ijazah_path'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($educations as $edu)
                <tr x-data="window.__controller.dataTableController({{ $edu->id }})">
                    <td>{{ $edu->id }}</td>
                    <td>{{ $edu->jenjang_pendidikan }}</td>
                    <td>{{ $edu->nama }}</td>
                    <td>{{ $edu->tahun_lulus }}</td>
                    <td><x-jet-secondary-button wire:click="export('{{ $edu->ijazah_path }}')">
                        {{ __('Download Ijazah') }}
                    </x-jet-secondary-button></td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/edu/edit/{{ $edu->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
