<div>
    <x-data-table :data="$data" :model="$kgb">
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
                <th><a wire:click.prevent="sortBy('tmt')" role="button" href="#">
                        TMT
                        @include('components.sort-icon', ['field' => 'tmt'])
                    </a></th>
                    <th><a wire:click.prevent="sortBy('skkgb')" role="button" href="#">
                        SK
                        @include('components.sort-icon', ['field' => 'skkgb'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('dateKenaikan')" role="button" href="#">
                        Kenaikan Selanjutnya
                        @include('components.sort-icon', ['field' => 'dateKenaikan'])
                    </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($kgb as $kenaikan)
                <tr x-data="window.__controller.dataTableController({{ $kenaikan->id }})">
                    <td>{{ $kenaikan->id }}</td>
                    <td>{{ $kenaikan->user->name }}</td>
                    <td>{{ $kenaikan->tmt }}</td>
                    <td><x-jet-secondary-button wire:click="export('{{ $kenaikan->skkgb }}')">
                        {{ __('Download SK') }}
                    </x-jet-secondary-button></td>
                    <td>{{ $kenaikan->dateKenaikan }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="/kenaikan/edit/{{ $kenaikan->id }}" class="mr-3"><i
                                class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i
                                class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
