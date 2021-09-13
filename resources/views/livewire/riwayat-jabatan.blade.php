<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Riwayat Jabatan') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Lengkapi data berikut dan submit untuk menambah jabatan pada User') }}
        </x-slot>

        <x-slot name="form">
            @if ($action == "addRiwayat" && Auth::user()->is_admin)
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="jenjang" value="{{ __('Pilih Pengguna') }}" /> 
                <select id="user"  class="block mt-1 w-full" name="user" wire:model.defer="rj.user">
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
                <x-jet-label for="jabatan" value="{{ __('Riwayat Jabatan') }}" />
                <select class="form-control" id="jabatan" name="jabatan" wire:model.defer="rj.position_id">
                    <option value="">
                        -- Pilih Jabatan --
                    </option>
                    @foreach ($jabatan as $jbtn)
                        <option value="{{ $jbtn->id }}">{{ $jbtn->nama }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="rj.position_id" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="tmt" value="{{ __('TMT') }}" />
                <x-jet-input id="tmt" type="date" class="mt-1 block w-full form-control shadow-none"
                    wire:model.defer="rj.tmt" />
                <x-jet-input-error for="rj.tmt" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="skjabatan" value="{{ __('Upload SK Jabatan') }}" />
                <x-jet-input id="skjabatan" type="file" accept="application/pdf"
                    class="mt-1 block w-full form-control shadow-none" wire:model.defer="rj.skjabatan" />
                <x-jet-input-error for="rj.skjabatan" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="keterangan" value="{{ __('Keterangan') }}" />
                <select id="keterangan" class="block mt-1 w-full" name="keterangan" wire:model.defer="rj.keterangan">
                    <option value="">
                        -- Pilih Keterangan --
                    </option>
                    <option value="Promosi">
                        Kenaikan Jabatan
                    </option>
                    <option value="Non">
                        Non Job
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
