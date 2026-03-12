<div class="p-2 bg-white shadow-sm">
    <form wire:submit.prevent="update" novalidate>
        @csrf

        @if (session()->has('error'))
            <div class="p-5">
                <div class="border-red-500 bg-red-400 animate-bounce text-white rounded px-3 py-2">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if (session()->has('success'))
            <div class="p-5">
                <div class="border-green-500 bg-green-400 text-white rounded px-3 py-2">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="p-5 flex flex-col gap-4">
            <div class="block mb-5">
                <label for="level_id" class="block font-medium text-sm text-gray-700">{{ __('Choix du niveau') }}</label>
                <select id="level_id" wire:model="level_id"
                        class="block mt-1 rounded-sm border border-gray-300 w-full @error('level_id') border-red-500 bg-red-100 animate-bounce @enderror"
                        name="level_id">
                    <option value="">-- Sélectionner un niveau --</option>
                    @foreach ($currentLevels as $item)
                        <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                    @endforeach
                </select>
                @error('level_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="block mb-5">
                <label for="libelle" class="block font-medium text-sm text-gray-700">{{ __('Libellé') }}</label>
                <input id="libelle" type="text" wire:model.defer="libelle" name="libelle"
                    class="block mt-1 rounded-sm border border-gray-300 w-full @error('libelle') border-red-500 bg-red-100 animate-bounce @enderror">
                @error('libelle')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="p-5 flex justify-between items-center">
            <button type="button" class="bg-red-600 p-3 rounded-sm text-white text-sm"
                    wire:click="$reset(['level_id', 'libelle'])">
                Annuler
            </button>
            <button type="submit" class="bg-green-600 p-3 rounded-sm text-white text-sm hover:bg-green-700 transition">
                Mettre à jour la classe
            </button>
        </div>
    </form>
</div>
