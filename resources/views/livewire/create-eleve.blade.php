<div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-lg">
    <form wire:submit.prevent="store" class="space-y-6">
        @csrf

        {{-- Messages d'erreur/succès --}}
        @if (session()->has('error'))
            <div class="p-4 rounded-md bg-red-100 border border-red-400 text-red-700 animate-pulse">
                {{ session('error') }}
            </div>
        @endif

        @if (session()->has('success'))
            <div class="p-4 rounded-md bg-green-100 border border-green-400 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Matricule --}}
        <div>
            <label for="matricule" class="block text-gray-700 font-semibold mb-2">Matricule</label>
            <input
                type="text" wire:model.defer="matricule" name="matricule" id="matricule"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                       @error('matricule') border-red-500 bg-red-50 animate-pulse @enderror"
                placeholder="Entrez le matricule"
            />
            @error('matricule')
                <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nom --}}
        <div>
            <label for="nom" class="block text-gray-700 font-semibold mb-2">Nom</label>
            <input
                type="text" wire:model.defer="nom" name="nom" id="nom"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                       @error('nom') border-red-500 bg-red-50 animate-pulse @enderror"
                placeholder="Entrez le nom"
            />
            @error('nom')
                <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Prénom --}}
        <div>
            <label for="prenom" class="block text-gray-700 font-semibold mb-2">Prénom</label>
            <input
                type="text" wire:model.defer="prenom" name="prenom" id="prenom"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                       @error('prenom') border-red-500 bg-red-50 animate-pulse @enderror"
                placeholder="Entrez le prénom"
            />
            @error('prenom')
                <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>
        {{-- Date de naissance --}}
        <div>
            <label for="naissance" class="block text-gray-700 font-semibold mb-2">Date de naissance</label>
            <input
                type="date" wire:model.defer="naissance" name="naissance" id="naissance"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                       @error('naissance') border-red-500 bg-red-50 animate-pulse @enderror"
            />
            @error('naissance')
                <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>
        {{-- Contact du parent --}}
        <div>
            <label for="contact_parent" class="block text-gray-700 font-semibold mb-2">Contact du parent</label>
            <input
                type="text" wire:model.defer="contact_parent" name="contact_parent" id="contact_parent"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                       @error('contact_parent') border-red-500 bg-red-50 animate-pulse @enderror"
                placeholder="Entrez le contact du parent"
            />
            @error('contact_parent')
                <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>
        {{-- Boutons --}}
        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
            <button
                type="button"
                class="px-5 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                wire:click="$reset(['matricule', 'nom', 'prenom', 'naissance', 'contact_parent'])"
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
