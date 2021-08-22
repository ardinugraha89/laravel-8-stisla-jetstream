<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Riwayat Jabatan') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Lengkapi data berikut dan submit untuk menambah jabatan pada User') }}
        </x-slot>

        <x-slot name="form">
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="jabatan" value="{{ __('Jabatan') }}" />
                <x-jet-input id="jabatan" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="rj.jabatan" />
                <x-jet-input-error for="rj.jabatan" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="tmt" value="{{ __('TMT') }}" />
                <x-jet-input id="tmt" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="rj.tmt" />
                <x-jet-input-error for="rj.tmt" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="skjabatan" value="{{ __('Upload SK Jabatan') }}" />
                <x-jet-input id="skjabatan" type="file" accept="application/pdf" class="mt-1 block w-full form-control shadow-none" wire:model.defer="rj.skjabatan" />
                <x-jet-input-error for="rj.skjabatan" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="keterangan" value="{{ __('Keterangan') }}" />
                <select id="keterangan"  class="block mt-1 w-full" name="keterangan" wire:model.defer="rj.keterangan">
                    <option value="">
                        -- Pilih Keterangan --
                    </option>
                    <option value="SD">
                        Kenaikan Jabatan Normal
                    </option>
                    <option value="SMP">
                        Promosi
                    </option>   
                </select>
                <x-jet-input-error for="rj.keterangan" class="mt-2" />
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
