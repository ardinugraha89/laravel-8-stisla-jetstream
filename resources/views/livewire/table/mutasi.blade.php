<div>
    <x-data-table :data="$data" :model="$mutasi">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                        ID
                        @include('components.sort-icon', ['field' => 'id'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('name')" role="button" href="#">
                        Nama User
                        @include('components.sort-icon', ['field' => 'name'])
                    </a></th>
                    <th><a wire:click.prevent="sortBy('catatan')" role="button" href="#">
                        Catatan Mutasi
                        @include('components.sort-icon', ['field' => 'catatan'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('tanggal')" role="button" href="#">
                        Tanggal Mutasi
                        @include('components.sort-icon', ['field' => 'tanggal'])
                    </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($mutasi as $mts)
                <tr x-data="window.__controller.dataTableController({{ $mts->id }})">
                    <td>{{ $mts->id }}</td>
                    <td>{{ $mts->user->name }}</td>
                    <td>{{ $mts->catatan }}</td>
                    <td>{{ $mts->tanggal }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/kenaikan/edit/{{ $mts->id }}" class="mr-3"><i
                                class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i
                                class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
