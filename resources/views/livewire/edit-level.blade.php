<div class="p-2 bg-white shadow-sm">
    <form method="POST" wire:submit.prevent="update" novalidate>
        @csrf

        @if (session('error'))
            <div class="p-5">
                <div class="border-red-500 bg-red-400 animate-bounce text-white rounded px-3 py-2">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <div class="p-5 flex flex-col gap-4">
            {{-- Code --}}
            <div class="block mb-5">
                <label for="code" class="block font-medium text-sm text-gray-700">Code</label>
                <input id="code" type="text" wire:model.defer="code" name="code"
                    class="block mt-1 rounded-sm border border-gray-300 w-full @error('code') border-red-500 bg-red-100 animate-bounce @enderror">
                @error('code')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Libelle --}}
            <div class="block mb-5">
                <label for="libelle" class="block font-medium text-sm text-gray-700">Libellé</label>
                <input id="libelle" type="text" wire:model.defer="libelle" name="libelle"
                    class="block mt-1 rounded-sm border border-gray-300 w-full @error('libelle') border-red-500 bg-red-100 animate-bounce @enderror">
                @error('libelle')
                    <span class="text-red-500 text-sm">*Le champ est requis</span>
                    <br>
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Montant de la scolarité --}}
            <div class="block mb-5">
                <label for="scolarite" class="block font-medium text-sm text-gray-700">Montant de la scolarité</label>
                <input id="scolarite" type="number" min="0" step="1" wire:model.defer="scolarite" name="scolarite"
                    class="block mt-1 rounded-sm border border-gray-300 w-full @error('scolarite') border-red-500 bg-red-100 animate-bounce @enderror">
                @error('scolarite')
                    <span class="text-red-500 text-sm">*Le champ est requis</span>
                    <br>
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="p-5 flex justify-between items-center">
            <button type="button"
                class="bg-red-600 p-3 rounded-sm text-white text-sm hover:bg-red-700 transition"
                wire:click="$reset(['code', 'libelle', 'scolarite'])">
                Annuler
            </button>
            <button type="submit"
                class="bg-green-600 p-3 rounded-sm text-white text-sm hover:bg-green-700 transition">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
