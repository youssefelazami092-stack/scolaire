<div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-lg">
    <form wire:submit.prevent="store" class="space-y-6">
        @csrf

        {{-- Messages d'erreur/succès --}}
        @if (session()->has('error'))
            <div class="p-4 rounded-md bg-red-100 border border-red-400 text-red-700 animate-pulse">
                {{ session('error') }}
            </div>
        @endif

        @if (!empty($error))
            <div class="p-4 mb-4 rounded bg-red-200 text-red-800">
                {{ $error }}
            </div>
        @endif

        @if (session()->has('success'))
            <div class="p-4 rounded-md bg-green-100 border border-green-400 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Choix du niveau --}}
        <div>
            <label for="level_id" class="block text-gray-700 font-semibold mb-2">{{ __('Choix du niveau') }}</label>
            <select
                wire:model="level_id" name="level_id" id="level_id"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                       @error('level_id') border-red-500 bg-red-50 animate-pulse @enderror"
            >
                <option value="">{{ __('-- Sélectionner un niveau --') }}</option>
                @foreach ($currentLevels as $item)
                    <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                @endforeach
            </select>
            @error('level_id')
                <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Montant --}}
        <div>
            <label for="amount" class="block text-gray-700 font-semibold mb-2">{{ __('Montant de la scolarité') }}</label>
            <input
                type="text" wire:model.defer="amount" name="amount" id="amount"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                       @error('amount') border-red-500 bg-red-50 animate-pulse @enderror"
                placeholder="Entrez le montant"
            />
            @error('amount')
                <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Boutons --}}
        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
            <button
                type="button"
                class="px-5 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                wire:click="$reset(['level_id', 'amount', 'error'])"
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
