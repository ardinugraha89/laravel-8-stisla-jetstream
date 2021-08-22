<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Lampiran') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Lampiran</a></div>
            <div class="breadcrumb-item"><a href="{{ route('lampiran') }}">Data Lampiran</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="lampiran" :model="$lampiran" />
    </div>
</x-app-layout>
