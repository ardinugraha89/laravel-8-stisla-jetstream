<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Jabatan') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Riwayat Jabatan</a></div>
            <div class="breadcrumb-item"><a href="{{ route('jabatan.user') }}">Riwayat Data Jabatan</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="riwayatjbt" :model="$riwayatjbt" />
    </div>
</x-app-layout>
