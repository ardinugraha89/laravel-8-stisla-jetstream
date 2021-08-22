<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit Data Pelatihan') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Pelatihan</a></div>
            <div class="breadcrumb-item"><a href="{{ route('pelatihan') }}">Edit Data Pelatihan</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:add-pelatihan action="updatePelatihan" :pelatihanId="request()->pelatihanId"/>
    </div>
</x-app-layout>
