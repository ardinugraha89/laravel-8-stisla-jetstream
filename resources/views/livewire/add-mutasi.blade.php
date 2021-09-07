<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Catatan Mutasi Pegawai') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Lengkapi data berikut dan submit untuk menambah data catatan mutasi') }}
        </x-slot>

        <x-slot name="form">
            @if ($action == 'addMutasi' && Auth::user()->is_admin)
                <div class="form-group col-span-6 sm:col-span-5">
                    <x-jet-label for="mutasi" value="{{ __('Pilih Pengguna') }}" />
                    <select id="mutasi" class="block mt-1 w-full" name="mutasi" wire:model.defer="mutasi.user">
                        <option value="">
                            -- Pilih Pengguna --
                        </option>
                        @foreach ($user as $asn)
                            <option value="{{ $asn->id }}">{{ $asn->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="mutasi.user" class="mt-2" />
                </div>
            @endif

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="nama" value="{{ __('Catatan Mutasi') }}" />
                <x-jet-input id="nama" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="mutasi.nama" />
                <x-jet-input-error for="mutasi.nama" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="tmt" value="{{ __('Tanggal mutasi') }}" />
                <x-jet-input id="tmt" type="date" class="mt-1 block w-full form-control shadow-none"
                    wire:model.defer="mutasi.tanggal" />
                <x-jet-input-error for="mutasi.tanggal" class="mt-2" />
            </div>

        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __($button['submit_response']) }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __($button['submit_text']) }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
</div>
