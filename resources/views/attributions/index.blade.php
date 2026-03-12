<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inscription effectuées') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @livewire('liste-inscription')
    </div>
</x-app-layout>
