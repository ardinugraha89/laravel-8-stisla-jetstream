<div>
    <x-data-table :data="$data" :model="$riwayatjbt">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                        ID
                        @include('components.sort-icon', ['field' => 'id'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('nama')" role="button" href="#">
                        Nama Jabatan
                        @include('components.sort-icon', ['field' => 'nama'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('tmt')" role="button" href="#">
                        TMT
                        @include('components.sort-icon', ['field' => 'tmt'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('status')" role="button" href="#">
                        Status
                        @include('components.sort-icon', ['field' => 'status'])
                    </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($riwayatjbt as $riwayat)
                <tr x-data="window.__controller.dataTableController({{ $riwayat->id }})">
                    <td>{{ $riwayat->id }}</td>
                    <td>{{ $riwayat->nama }}</td>
                    <td>{{ $riwayat->tmt }}</td>
                    <td>{{ $riwayat->status }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/riwayat/jabatan/edit/{{ $riwayat->id }}" class="mr-3"><i
                                class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i
                                class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
