<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4" enctype="multipart/form-data">
        <x-slot name="title">
            {{ __('Pelatihan/Diklat') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Lengkapi data berikut dan submit untuk membuat data riawayat pelatihan/diklat') }}
        </x-slot>

        <x-slot name="form">
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="nama" value="{{ __('Nama Pelatihan') }}" />
                <x-jet-input id="nama" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="pelatihan.nama" />
                <x-jet-input-error for="pelatihan.nama" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="tanggal_pelatihan" value="{{ __('Tanggal Pelatihan') }}" />
                <input type="date" class="mt-1 block w-full" id="tanggal_pelatihan" wire:model.defer="pelatihan.tanggal_pelatihan">
                <x-jet-input-error for="pelatihan.tanggal_pelatihan" class="mt-2" />
            </div>
            @if ($action == "updatePelatihan")
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-secondary-button wire:click="export">
                    {{ __('Download Sertifikat') }}
                </x-jet-secondary-button>
            </div>
            @endif

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="sertifikat" value="{{ __('Upload Sertifikat') }}" />
                <x-jet-input id="sertifikat" type="file" accept="application/pdf" class="mt-1 block w-full form-control shadow-none" wire:model.defer="pelatihan.sertifikat" />
                <x-jet-input-error for="pelatihan.sertifikat" class="mt-2" />
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
