<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Pendidikan') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Lengkapi data berikut dan submit untuk membuat data riawayat pendidikan') }}
        </x-slot>

        <x-slot name="form">
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="jenjang" value="{{ __('Jenjang Pendidikan') }}" />
                <select id="jenjang_pendidikan"  class="block mt-1 w-full" name="jenjang_pendidikan" wire:model.defer="jenjang">
                    <option value="">
                        -- Pilih Jenjang Pendidikan --
                    </option>
                    <option value="SD">
                        SD
                    </option>
                    <option value="SMP/Setara">
                        SMP / Setara
                    </option>
                    <option value="SMA/Setara">
                        SMA / Setara
                    </option>
                    <option value="Diploma">
                        Diploma
                    </option>
                    <option value="Strata 1">
                        S1
                    </option>
                    <option value="Magister">
                        S2
                    </option>
                    <option value="Doktoral">
                        S3
                    </option>    
                </select>
                <x-jet-input-error for="jenjang" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="nama" value="{{ __('Nama Almamater') }}" />
                <x-jet-input id="nama" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="nama" />
                <x-jet-input-error for="nama" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="tahun_lulus" value="{{ __('Tahun Lulus') }}" />
                <x-jet-input id="tahun_lulus" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="tahun_lulus" placeholder="ex: 1999"/>
                <x-jet-input-error for="tahun_lulus" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="ijazah" value="{{ __('Upload Ijazah') }}" />
                <x-jet-input id="ijazah" type="file" accept="application/pdf" class="mt-1 block w-full form-control shadow-none" wire:model.defer="ijazah" />
                <x-jet-input-error for="ijazah" class="mt-2" />
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
