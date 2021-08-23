<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit Data Pangkat') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Riwayat Pangkat</a></div>
            <div class="breadcrumb-item"><a href="{{ route('pangkat.user') }}">Edit Data Riwayat Pangkat</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:riwayat-jabatan action="updateRiwayatPangkat" :riwayatpktId="request()->riwayatpktId" />
    </div>
</x-app-layout>
