<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

         <!-- NIP -->
         <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="nip" value="{{ __('Nomor Induk Pegawai') }}" />
            <x-jet-input id="nip" type="text" class="mt-1 block w-full" wire:model.defer="state.nip" />
            <x-jet-input-error for="nip" class="mt-2" />
        </div>

        <!-- NIK -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="nik" value="{{ __('Nomor Induk Kependudukan') }}" />
            <x-jet-input id="nik" type="text" class="mt-1 block w-full" wire:model.defer="state.user_detail.nik" />
            <x-jet-input-error for="nik" class="mt-2" />
        </div>

        <!-- NPWP -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="npwp" value="{{ __('NPWP') }}" />
            <x-jet-input id="npwp" type="text" class="mt-1 block w-full" wire:model.defer="state.user_detail.npwp" />
            <x-jet-input-error for="npwp" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="jenis_kelamin" value="{{ __('Jenis Kelamin') }}" />
            <select id="jenis_kelamin"  class="block mt-1 w-full" name="gender" wire:model.defer="state.user_detail.jenis_kelamin">
                <option value="">
                    -- Pilih Jenis Kelamin --
                </option>
                <option value="Laki-Laki">
                    Laki-Laki
                </option>
                <option value="Perempuan">
                    Perempuan
                </option>

            </select>
            <x-jet-input-error for="jenis_kelamin" class="mt-2" />
        </div> 

        <!-- d.o.b. -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="dob" value="{{ __('Tempat/Tanggal Lahir') }}" />
            <x-jet-input id="tempat_lahir" type="text" class="mt-1 block w-full" wire:model.defer="state.user_detail.tempat_lahir" /><x-jet-input-error for="tempat_lahir" class="mt-2" /> <input type="date" class="mt-1 block w-full" id="tanggal_lahir" wire:model.defer="state.user_detail.tanggal_lahir">
            <x-jet-input-error for="tanggal_lahir" class="mt-2" />
        </div> 

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.user_detail.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div> 

        <!-- Telepon -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="telepon" value="{{ __('Telepon') }}" />
            <x-jet-input id="telepon" type="text" class="mt-1 block w-full" wire:model.defer="state.user_detail.telepon" />
            <x-jet-input-error for="telepon" class="mt-2" />
        </div> 

        <!-- Alamat -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="alamat" value="{{ __('Alamat') }}" />
            <x-jet-input id="alamat" type="text" class="mt-1 block w-full" wire:model.defer="state.user_detail.alamat" />
            <x-jet-input-error for="alamat" class="mt-2" />
        </div> 
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
