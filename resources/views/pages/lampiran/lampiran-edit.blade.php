<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit Dokumen Lampiran') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Lampiran</a></div>
            <div class="breadcrumb-item"><a href="{{ route('Lampiran') }}">Edit Dokumen Lampiran</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:add-lampiran action="updateLampiran" :pelatihanId="request()->lampiranId"/>
    </div>
</x-app-layout>
