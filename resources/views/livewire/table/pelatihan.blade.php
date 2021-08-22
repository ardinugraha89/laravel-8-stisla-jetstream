<div>
    <x-data-table :data="$data" :model="$pelatihan">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nama')" role="button" href="#">
                    Nama Pelatihan
                    @include('components.sort-icon', ['field' => 'nama'])
                </a></th>
                <th><a wire:click.prevent="sortBy('tanggal_pelatihan')" role="button" href="#">
                    Tanggal Pelatihan
                    @include('components.sort-icon', ['field' => 'tanggal_pelatihan'])
                </a></th>
                <th>
                    Sertifikat
                </th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($pelatihan as $plt)
                <tr x-data="window.__controller.dataTableController({{ $plt->id }})">
                    <td>{{ $plt->id }}</td>
                    <td>{{ $plt->nama }}</td>
                    <td>{{ $plt->tanggal_pelatihan }}</td>
                    <td><x-jet-secondary-button wire:click="export('{{ $plt->sertifikat }}')">
                        {{ __('Download Sertifikat') }}
                    </x-jet-secondary-button></td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/pelatihan/edit/{{ $plt->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
