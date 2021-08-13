<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Pendidikan') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Pendidikan</a></div>
            <div class="breadcrumb-item"><a href="{{ route('edu') }}">Data Pendidikan</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.main name="education" :model="$edu" />
    </div>
</x-app-layout>
