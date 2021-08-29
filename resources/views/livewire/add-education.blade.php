<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4" enctype="multipart/form-data">
        <x-slot name="title">
            {{ __('Pendidikan') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Lengkapi data berikut dan submit untuk membuat data riawayat pendidikan') }}
        </x-slot>

        <x-slot name="form">            
            @if ($action == "addEdu" && Auth::user()->is_admin)
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="jenjang" value="{{ __('Pilih Pengguna') }}" /> 
                <select id="user"  class="block mt-1 w-full" name="user" wire:model.defer="edu.user">
                    <option value="">
                        -- Pilih Pengguna --
                    </option>
                    @foreach ($user as $asn)
                        <option value="{{ $asn->id }}">{{ $asn->name }}</option>
                    @endforeach    
                </select>
                <x-jet-input-error for="edu.user" class="mt-2" />
            </div>
            @endif
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="jenjang" value="{{ __('Jenjang Pendidikan') }}" />           
                <select id="jenjang_pendidikan"  class="block mt-1 w-full" name="jenjang_pendidikan" wire:model.defer="edu.jenjang_pendidikan">
                    <option value="">
                        -- Pilih Jenjang Pendidikan --
                    </option>
                    <option value="SD">
                        SD
                    </option>
                    <option value="SMP">
                        SMP / Setara
                    </option>
                    <option value="SMA">
                        SMA / Setara
                    </option>
                    <option value="Diploma">
                        Diploma
                    </option>
                    <option value="Sarjana">
                        S1
                    </option>
                    <option value="Magister">
                        S2
                    </option>
                    <option value="Doktoral">
                        S3
                    </option>    
                </select>
                <x-jet-input-error for="edu.jenjang_pendidikan" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="nama" value="{{ __('Nama Almamater') }}" />
                <x-jet-input id="nama" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="edu.nama" />
                <x-jet-input-error for="edu.nama" class="mt-2" />
            </div>

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="tahun_lulus" value="{{ __('Tahun Lulus') }}" />
                <x-jet-input id="tahun_lulus" type="text" class="mt-1 block w-full form-control shadow-none" wire:model.defer="edu.tahun_lulus" placeholder="ex: 1999"/>
                <x-jet-input-error for="edu.tahun_lulus" class="mt-2" />
            </div>
            @if ($action == "updateEducation")
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-secondary-button wire:click="export">
                    {{ __('Download Ijazah') }}
                </x-jet-secondary-button>
            </div>
            @endif

            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="ijazah" value="{{ __('Upload Ijazah') }}" />
                <x-jet-input id="ijazah" type="file" accept="application/pdf" class="mt-1 block w-full form-control shadow-none" wire:model.defer="edu.ijazah_path" />
                <x-jet-input-error for="edu.ijazah_path" class="mt-2" />
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
