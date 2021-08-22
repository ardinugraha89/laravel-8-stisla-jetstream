<div>
    <x-data-table :data="$data" :model="$pangkat">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                    ID
                    @include('components.sort-icon', ['field' => 'id'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nama')" role="button" href="#">
                    Nama Pangkat
                    @include('components.sort-icon', ['field' => 'nama'])
                </a></th>
                <th><a wire:click.prevent="sortBy('golongan')" role="button" href="#">
                    Golongan
                    @include('components.sort-icon', ['field' => 'golongan'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($pangkat as $pkt)
                <tr x-data="window.__controller.dataTableController({{ $pkt->id }})">
                    <td>{{ $pkt->id }}</td>
                    <td>{{ $pkt->nama }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/pangkat/edit/{{ $pkt->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
