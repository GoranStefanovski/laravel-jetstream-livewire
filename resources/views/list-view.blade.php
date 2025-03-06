<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black text-gray-800 leading-tight">
            {{ __('List View') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-xl sm:rounded-lg p-4">
            @livewire('list-view-admin')
        </div>
    </div>
</x-app-layout>
