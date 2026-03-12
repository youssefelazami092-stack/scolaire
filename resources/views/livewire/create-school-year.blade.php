<div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-lg">
    <form method="POST" wire:submit.prevent="store" novalidate class="space-y-6">
        @csrf
        {{-- Message d'erreur session --}}
        @if (session('error'))
            <div class="p-4 rounded bg-red-400 text-white animate-pulse">
                {{ session('error') }}
            </div>
        @endif
        {{-- Libellé --}}
        <div>
            <label for="libelle" class="block text-sm font-medium text-gray-700 mb-1">
                {{ __("Libellé de l'année scolaire") }}
            </label>
            <input
                id="libelle"
                name="libelle"
                type="text"
                wire:model.defer="libelle"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                       @error('libelle') border-red-500 bg-red-100 animate-pulse @enderror"
                autocomplete="off"
                placeholder="Entrez le libellé"
            />
            @error('libelle')
                <p class="text-red-500 text-sm mt-1">* Le champ est requis</p>
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        {{-- Boutons --}}
        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
            <button
                type="button"
                class="px-5 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition shadow-md focus:outline-none focus:ring-2 focus:ring-red-500"
                wire:click="$reset('libelle')"
            >
                Annuler
            </button>
            <button
                type="submit"
                class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
                Ajouter
            </button>
        </div>
    </form>
</div>
