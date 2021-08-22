<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Pelatihan') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Pelatihan</a></div>
            <div class="breadcrumb-item"><a href="{{ route('pelatihan') }}">Data Pelatihan</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="pelatihan" :model="$pelatihan" />
    </div>
</x-app-layout>
