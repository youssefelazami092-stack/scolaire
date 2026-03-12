<div class="p-2 bg-white shadow-sm">
    <form wire:submit.prevent="update" novalidate>
        @csrf

        {{-- Affichage des messages --}}
        @if (session()->has('error'))
            <div class="p-5 bg-red-400 text-white rounded px-3 py-2">
                {{ session('error') }}
            </div>
        @endif

        @if (session()->has('success'))
            <div class="p-5 bg-green-400 text-white rounded px-3 py-2">
                {{ session('success') }}
            </div>
        @endif

        {{-- Formulaire --}}
        <div class="p-5 flex flex-col gap-4">

            {{-- Matricule --}}
            <div>
                <label for="matricule" class="block text-sm font-medium text-gray-700">Matricule</label>
                <input id="matricule" type="text" wire:model.defer="matricule" name="matricule"
                    class="mt-1 block w-full rounded-sm border border-gray-300 @error('matricule') border-red-500 bg-red-100 @enderror">
                @error('matricule')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Nom Complet (readonly) --}}
            <div>
                <label for="fullname" class="block text-sm font-medium text-gray-700">Nom Complet</label>
                <input id="fullname" type="text" wire:model="fullname" readonly
                    class="mt-1 block w-full rounded-sm border border-gray-300 bg-gray-100 text-gray-700 cursor-not-allowed">
            </div>

            {{-- Niveau --}}
            <div>
                <label for="level_id" class="block text-sm font-medium text-gray-700">Choix du niveau</label>
                <select id="level_id" wire:model="level_id" name="level_id"
                    class="mt-1 block w-full rounded-sm border border-gray-300 @error('level_id') border-red-500 bg-red-100 @enderror">
                    <option value="">-- Sélectionner --</option>
                    @foreach ($currentLevels as $item)
                        <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                    @endforeach
                </select>
                @error('level_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Classe --}}
            <div>
                <label for="classe_id" class="block text-sm font-medium text-gray-700">Sélectionner la classe</label>
                <select id="classe_id" wire:model="classe_id" name="classe_id"
                    class="mt-1 block w-full rounded-sm border border-gray-300 @error('classe_id') border-red-500 bg-red-100 @enderror">
                    <option value="">-- Sélectionner --</option>
                    @foreach ($classeList as $item)
                        <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                    @endforeach
                </select>
                @error('classe_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

        </div>

        {{-- Boutons --}}
        <div class="p-5 flex justify-between">
            <button type="button"
                class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded transition"
                wire:click="$reset(['matricule', 'fullname', 'student_id', 'level_id', 'classe_id', 'classeList'])">
                Annuler
            </button>
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded transition">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
