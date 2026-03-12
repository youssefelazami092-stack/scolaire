<div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-lg">
    <form wire:submit.prevent="store" novalidate class="space-y-6">
        @csrf

        {{-- Messages Livewire succès --}}
        @if ($haveSuccess)
            <div class="p-4 rounded bg-green-200 text-green-800 animate-pulse">
                {{ $success }}
            </div>
        @endif

        {{-- Messages Livewire erreur --}}
        @if ($haveError)
            <div class="p-4 rounded bg-red-200 text-red-800 animate-pulse">
                {{ $error }}
            </div>
        @endif

        {{-- Erreurs de validation --}}
        @if ($errors->any())
            <div class="p-4 rounded bg-red-100 text-red-700">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Matricule --}}
        <div>
            <label for="matricule" class="block text-sm font-medium text-gray-700 mb-1">Matricule</label>
            <input
                id="matricule" type="text" wire:model.defer="matricule"
                class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                       @error('matricule') border-red-500 bg-red-100 animate-pulse @enderror"
                autocomplete="off"
            />
            @error('matricule')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Élève trouvé (readonly) --}}
        <div>
            <label for="fullname" class="block text-sm font-medium text-gray-700 mb-1">Élève trouvé</label>
            <input
                id="fullname" type="text" wire:model.defer="fullname" readonly
                class="w-full rounded-md border border-gray-200 bg-gray-100 px-4 py-2 text-gray-800 cursor-not-allowed"
                autocomplete="off"
            />
        </div>

        {{-- Montant --}}
        <div>
            <label for="montant" class="block text-sm font-medium text-gray-700 mb-1">Montant</label>
            <input
                id="montant" type="number" wire:model.defer="montant" min="0" step="0.01"
                class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                       @error('montant') border-red-500 bg-red-100 animate-pulse @enderror"
                autocomplete="off"
            />
            @error('montant')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Boutons --}}
        <div class="flex justify-between pt-4 border-t border-gray-200">
            <button
                type="button"
                wire:click="$reset(['matricule', 'fullname', 'montant', 'student_id', 'success', 'error', 'haveSuccess', 'haveError'])"
                class="px-5 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition shadow-md focus:outline-none focus:ring-2 focus:ring-red-500"
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
