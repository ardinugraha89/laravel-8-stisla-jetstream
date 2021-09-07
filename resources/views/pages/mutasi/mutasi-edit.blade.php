<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit Catatan Mutasi Pegawai') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Catatan Mutas</a></div>
            <div class="breadcrumb-item"><a href="{{ route('pangkat') }}">Edit Catatan Mutasi</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:add-mutasi action="updateMutasi" :mutasiId="request()->mutasiId"/>
    </div>
</x-app-layout>
