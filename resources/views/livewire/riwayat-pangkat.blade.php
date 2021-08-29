<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Riwayat Pangkat') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Lengkapi data berikut dan submit untuk menambah pangkat pada User') }}
        </x-slot>

        <x-slot name="form">
            @if ($action == 'addRiwayat' && Auth::user()->is_admin)
                <div class="form-group col-span-6 sm:col-span-5">
                    <x-jet-label for="jenjang" value="{{ __('Pilih Pengguna') }}" />
                    <select id="user" class="block mt-1 w-full" name="user" wire:model.defer="rj.user">
                        <option value="">
                            -- Pilih Pengguna --
                        </option>
                        @foreach ($user as $asn)
                            <option value="{{ $asn->id }}">{{ $asn->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="rj.user" class="mt-2" />
                </div>
            @endif
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="pangkat" value="{{ __('Riwayat Pangkat') }}" />
                <select class="form-control" id="pangkat" name="pangkat" wire:model.defer="rj.pangkat_id">
                    <option value="">
                        -- Pilih Pangkat --
                    </option>
                    @foreach ($pangkat as $pkt)
                        <option value="{{ $pkt->id }}">{{ $pkt->nama }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="rj.pangkat_id" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="tmt" value="{{ __('TMT') }}" />
                <x-jet-input id="tmt" type="date" class="mt-1 block w-full form-control shadow-none"
                    wire:model.defer="rj.tmt" />
                <x-jet-input-error for="rj.tmt" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="skpangkat" value="{{ __('Upload SK Pangkat') }}" />
                <x-jet-input id="skpangkat" type="file" accept="application/pdf"
                    class="mt-1 block w-full form-control shadow-none" wire:model.defer="rj.skpangkat" />
                <x-jet-input-error for="rj.skpangkat" class="mt-2" />
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
