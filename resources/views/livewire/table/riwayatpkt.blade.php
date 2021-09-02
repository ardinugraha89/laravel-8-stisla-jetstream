<div>
    <x-data-table :data="$data" :model="$riwayatpkt">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                        ID
                        @include('components.sort-icon', ['field' => 'id'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('name')" role="button" href="#">
                        Nama Pengguna
                        @include('components.sort-icon', ['field' => 'name'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('nama')" role="button" href="#">
                        Nama Pangkat
                        @include('components.sort-icon', ['field' => 'nama'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('tmt')" role="button" href="#">
                        TMT
                        @include('components.sort-icon', ['field' => 'tmt'])
                    </a></th>
                <th>SK</th>
                <th><a wire:click.prevent="sortBy('status')" role="button" href="#">
                        Status
                        @include('components.sort-icon', ['field' => 'status'])
                    </a></th>
                <th>Kenaikan Pangkat Selanjutnya</th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($riwayatpkt as $riwayat)
                <tr x-data="window.__controller.dataTableController({{ $riwayat->id }})">
                    <td>{{ $riwayat->id }}</td>
                    <td>{{ $riwayat->user->name }}</td>
                    <td>{{ $riwayat->pangkat->nama }}</td>
                    <td>{{ $riwayat->tmt }}</td>
                    <td>
                        <x-jet-secondary-button wire:click="export('{{ $riwayat->skpangkat }}')">
                            {{ __('Download SK') }}
                        </x-jet-secondary-button>
                    </td>
                    <td>{{ $riwayat->status }}</td>
                    <td>{{ $riwayat->dateNaikPangkat }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/riwayat/pangkat/edit/{{ $riwayat->id }}" class="mr-3"><i
                                class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i
                                class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
