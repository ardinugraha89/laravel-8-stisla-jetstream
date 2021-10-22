<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit Data Jabatan') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Jabatan</a></div>
            <div class="breadcrumb-item"><a href="{{ route('jabatan') }}">Edit Data Jabatan</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:add-jabatan action="updateDataJabatan" :jabatanId="request()->jabatanId"/>
    </div>
</x-app-layout>
