<div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-lg">
    <form wire:submit.prevent="store" novalidate class="space-y-6">
        @csrf

        {{-- Messages d'erreur --}}
        @if (session()->has('error'))
            <div class="p-4 rounded bg-red-400 text-white animate-pulse">
                {{ session('error') }}
            </div>
        @endif

        {{-- Messages succès --}}
        @if (session()->has('success'))
            <div class="p-4 rounded bg-green-400 text-white">
                {{ session('success') }}
            </div>
        @endif

        {{-- Code --}}
        <div>
            <label for="code" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Code') }}</label>
            <input
                id="code" type="text" wire:model.defer="code" name="code" autocomplete="off"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                       @error('code') border-red-500 bg-red-100 animate-pulse @enderror"
            />
            @error('code')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Libellé --}}
        <div>
            <label for="libelle" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Libellé') }}</label>
            <input
                id="libelle" type="text" wire:model.defer="libelle" name="libelle" autocomplete="off"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                       @error('libelle') border-red-500 bg-red-100 animate-pulse @enderror"
            />
            @error('libelle')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Montant de la scolarité --}}
        <div>
            <label for="scolarite" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Montant de la scolarité') }}</label>
            <input
                id="scolarite" type="number" wire:model.defer="scolarite" name="scolarite" min="0" step="1"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                       @error('scolarite') border-red-500 bg-red-100 animate-pulse @enderror"
            />
            @error('scolarite')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Boutons --}}
        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
            <button
                type="button"
                class="px-5 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                wire:click="$reset(['code', 'libelle', 'scolarite'])"
            >
                Annuler
            </button>
            <button
                type="submit"
                class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
                Ajouter
            </button>
        </div>
    </form>
</div>
