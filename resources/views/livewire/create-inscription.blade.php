<div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-lg">
    <form wire:submit.prevent="store" class="space-y-6">
        @csrf

        {{-- Messages d'erreur/succès --}}
        @if (session()->has('error'))
            <div class="p-4 mb-4 rounded bg-red-400 text-white animate-pulse">
                {{ session('error') }}
            </div>
        @endif

        @if (session()->has('success'))
            <div class="p-4 mb-4 rounded bg-green-400 text-white">
                {{ session('success') }}
            </div>
        @endif

        {{-- Matricule --}}
        <div>
            <label for="matricule" class="block text-sm font-medium text-gray-700 mb-1">Matricule</label>
            <input
                type="text" wire:model.defer="matricule" id="matricule"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                    focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                    @error('matricule') border-red-500 bg-red-100 animate-pulse @enderror"
                placeholder="Entrez le matricule"
            />
            @error('matricule')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nom Complet (readonly) --}}
        <div>
            <label for="fullname" class="block text-sm font-medium text-gray-700 mb-1">Nom Complet</label>
            <input
                type="text" wire:model="fullname" id="fullname" readonly
                class="w-full rounded-md border border-gray-300 bg-gray-100 px-4 py-2 cursor-not-allowed"
                placeholder="Nom complet généré automatiquement"
            />
        </div>

        {{-- Niveau --}}
        <div>
            <label for="level_id" class="block text-sm font-medium text-gray-700 mb-1">Choix du niveau</label>
            <select
                wire:model="level_id" id="level_id"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                    focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                    @error('level_id') border-red-500 bg-red-100 animate-pulse @enderror"
            >
                <option value="">-- Sélectionner --</option>
                @foreach ($currentLevels as $item)
                    <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                @endforeach
            </select>
            @error('level_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Classe --}}
        <div>
            <label for="classe_id" class="block text-sm font-medium text-gray-700 mb-1">Sélectionner la classe</label>
            <select
                wire:model="classe_id" id="classe_id"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                    focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                    @error('classe_id') border-red-500 bg-red-100 animate-pulse @enderror"
            >
                <option value="">-- Sélectionner --</option>
                @foreach ($classeList as $item)
                    <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                @endforeach
            </select>
            @error('classe_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Boutons --}}
        <div class="flex justify-between pt-4 border-t border-gray-200">
            <button
                type="button"
                class="px-5 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                wire:click="$reset(['matricule', 'fullname', 'student_id', 'level_id', 'classe_id', 'classeList'])"
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
