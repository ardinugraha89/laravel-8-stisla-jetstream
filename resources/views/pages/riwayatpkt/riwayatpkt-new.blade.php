<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Pangkat') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Riwayat Pangkat</a></div>
            <div class="breadcrumb-item"><a href="{{ route('riwayatpkt.new') }}">Tambah Riwayat Pangkat</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:riwayat-pangkat action="addRiwayat" />
    </div>
</x-app-layout>
