<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Kenaikan Gaji Berkala') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Kenaikan Gaji Berkala</a></div>
            <div class="breadcrumb-item"><a href="{{ route('kgb') }}">Data Kenaikan Gaji Berkala</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="kgb" :model="$kgb" />
    </div>
</x-app-layout>
