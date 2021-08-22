<div>
    <x-data-table :data="$data" :model="$lampiran">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nama')" role="button" href="#">
                    Nama
                    @include('components.sort-icon', ['field' => 'nama'])
                </a></th>
                <th><a wire:click.prevent="sortBy('dokumen')" role="button" href="#">
                    Dokumen Lampiran
                    @include('components.sort-icon', ['field' => 'dokumen'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($lampiran as $lprn)
                <tr x-data="window.__controller.dataTableController({{ $lprn->id }})">
                    <td>{{ $lprn->id }}</td>
                    <td>{{ $lprn->nama }}</td>
                    <td><x-jet-secondary-button wire:click="export('{{ $lprn->dokumen }}')">
                        {{ __('Download Dokumen Lampiran') }}
                    </x-jet-secondary-button></td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/lampiran/edit/{{ $lprn->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
