<div>
    <x-data-table :data="$data" :model="$jabatan">
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
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($jabatan as $jbtn)
                <tr x-data="window.__controller.dataTableController({{ $jbtn->id }})">
                    <td>{{ $jbtn->id }}</td>
                    <td>{{ $jbtn->nama }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/jabatan/edit/{{ $jbtn->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
