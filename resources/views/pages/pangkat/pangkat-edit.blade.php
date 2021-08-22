<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit Data Pangkat dan Golongan') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Pangkat</a></div>
            <div class="breadcrumb-item"><a href="{{ route('pangkat') }}">Edit Data Pangkat</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:add-pangkat action="updatePangkatGolongan" :pangkatId="request()->pangkatId"/>
    </div>
</x-app-layout>
