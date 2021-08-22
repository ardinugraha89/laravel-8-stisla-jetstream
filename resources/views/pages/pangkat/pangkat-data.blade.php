<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Pangkat dan Golongan') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Pangkat</a></div>
            <div class="breadcrumb-item"><a href="{{ route('pangkat') }}">Data Pangkat dan Golongan</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="pangkat" :model="$pangkat" />
    </div>
</x-app-layout>
