<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4" enctype="multipart/form-data">
        <x-slot name="title">
            {{ __('Lampiran DUK') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Lengkapi data berikut dan submit untuk melengkapi lampiran') }}
        </x-slot>

        <x-slot name="form">
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="nama" value="{{ __('Lampiran') }}" />
                <select id="nama"  class="block mt-1 w-full" name="nama" wire:model.defer="lampiran.nama">
                    <option value="">
                        -- Pilih Jenis Lampiran --
                    </option>
                    <option value="SK CPNS">
                        SK CPNS
                    </option>
                    <option value="SK PNS">
                        SK PNS
                    </option>
                    <option value="Kartu Pegawai">
                        Kartu Pegawai
                    </option>
                    <option value="e-Kartu Pegawai">
                        e-Kartu Pegawai
                    </option>
                    <option value="Taspen">
                        Taspen
                    </option>
                    <option value="BPJS">
                        BPJS
                    </option>
                    <option value="Karis">
                        Karis
                    </option> 
                    <option value="NPWP">
                        NPWP
                    </option>
                    <option value="KK">
                        Kartu Keluarga
                    </option>     
                    <option value="KTP">
                        KTP
                    </option>
                    <option value="KTP-S">
                        KTP Suami/Istri
                    </option>
                    <option value="Akte">
                        Akte Anak
                    </option>
                </select>
                <x-jet-input-error for="lampiran.nama" class="mt-2" />
            </div>

            @if ($action == "updateLampiran")
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-secondary-button wire:click="export">
                    {{ __('Download Dokumen') }}
                </x-jet-secondary-button>
            </div>
            @endif

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="dokumen" value="{{ __('Upload Dokumen Lampiran') }}" />
                <x-jet-input id="dokumen" type="file" accept="application/pdf" class="mt-1 block w-full form-control shadow-none" wire:model.defer="lampiran.dokumen" />
                <x-jet-input-error for="lampiran.dokumen" class="mt-2" />
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
