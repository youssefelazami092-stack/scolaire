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

            {{-- Matricule --}}
            <div class="block mb-5">
                <label for="matricule" class="block font-medium text-sm text-gray-700">Matricule</label>
                <input id="matricule" type="text" wire:model.defer="matricule" name="matricule"
                    class="block mt-1 rounded-sm border border-gray-300 w-full @error('matricule') border-red-500 bg-red-100 animate-bounce @enderror">
                @error('matricule')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Nom --}}
            <div class="block mb-5">
                <label for="nom" class="block font-medium text-sm text-gray-700">Nom</label>
                <input id="nom" type="text" wire:model.defer="nom" name="nom"
                    class="block mt-1 rounded-sm border border-gray-300 w-full @error('nom') border-red-500 bg-red-100 animate-bounce @enderror">
                @error('nom')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Prénom --}}
            <div class="block mb-5">
                <label for="prenom" class="block font-medium text-sm text-gray-700">Prénom</label>
                <input id="prenom" type="text" wire:model.defer="prenom" name="prenom"
                    class="block mt-1 rounded-sm border border-gray-300 w-full @error('prenom') border-red-500 bg-red-100 animate-bounce @enderror">
                @error('prenom')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Date de naissance --}}
            <div class="block mb-5">
                <label for="naissance" class="block font-medium text-sm text-gray-700">Date de naissance</label>
                <input id="naissance" type="date" wire:model.defer="naissance" name="naissance"
                    class="block mt-1 rounded-sm border border-gray-300 w-full @error('naissance') border-red-500 bg-red-100 animate-bounce @enderror">
                @error('naissance')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Contact du parent --}}
            <div class="block mb-5">
                <label for="contact_parent" class="block font-medium text-sm text-gray-700">Contact du parent</label>
                <input id="contact_parent" type="text" wire:model.defer="contact_parent" name="contact_parent"
                    class="block mt-1 rounded-sm border border-gray-300 w-full @error('contact_parent') border-red-500 bg-red-100 animate-bounce @enderror">
                @error('contact_parent')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="p-5 flex justify-between items-center">
            <button type="button"
                class="bg-red-600 p-3 rounded-sm text-white text-sm hover:bg-red-700 transition"
                wire:click="$reset(['matricule', 'nom', 'prenom', 'naissance', 'contact_parent'])">
                Annuler
            </button>
            <button type="submit"
                class="bg-green-600 p-3 rounded-sm text-white text-sm hover:bg-green-700 transition">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
