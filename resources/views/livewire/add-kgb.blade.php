<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Kenaikan Gaji Berkala') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Lengkapi data berikut dan submit untuk menambah data kenaikan gaji berkala pada User') }}
        </x-slot>

        <x-slot name="form">
            @if ($action == "addKenaikanGaji" && Auth::user()->is_admin)
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="kgb" value="{{ __('Pilih Pengguna') }}" /> 
                <select id="kgb"  class="block mt-1 w-full" name="kgb" wire:model.defer="kgb.user">
                    <option value="">
                        -- Pilih Pengguna --
                    </option>
                    @foreach ($user as $asn)
                        <option value="{{ $asn->id }}">{{ $asn->name }}</option>
                    @endforeach    
                </select>
                <x-jet-input-error for="kgb.user" class="mt-2" />
            </div>
            @endif
            
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="tmt" value="{{ __('TMT SK Kenaikan Gaji Berkala') }}" />
                <x-jet-input id="tmt" type="date" class="mt-1 block w-full form-control shadow-none"
                    wire:model.defer="kgb.tmt" />
                <x-jet-input-error for="kgb.tmt" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="sskkgb" value="{{ __('Upload SK Kenaikan Gaji Berkala') }}" />
                <x-jet-input id="sskkgb" type="file" accept="application/pdf"
                    class="mt-1 block w-full form-control shadow-none" wire:model.defer="kgb.sskkgb" />
                <x-jet-input-error for="kgb.sskkgb" class="mt-2" />
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
