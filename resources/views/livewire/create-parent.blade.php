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

        {{-- Nom --}}
        <div>
            <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
            <input
                id="nom" type="text" wire:model.defer="nom" name="nom" autocomplete="off"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                       @error('nom') border-red-500 bg-red-100 animate-pulse @enderror"
                placeholder="Entrez le nom"
            />
            @error('nom')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Prénom --}}
        <div>
            <label for="prenom" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
            <input
                id="prenom" type="text" wire:model.defer="prenom" name="prenom" autocomplete="off"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                       @error('prenom') border-red-500 bg-red-100 animate-pulse @enderror"
                placeholder="Entrez le prénom"
            />
            @error('prenom')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input
                id="email" type="email" wire:model.defer="email" name="email" autocomplete="off"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                       @error('email') border-red-500 bg-red-100 animate-pulse @enderror"
                placeholder="Entrez l'email"
            />
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Contact --}}
        <div>
            <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Contact</label>
            <input
                id="contact" type="text" wire:model.defer="contact" name="contact" autocomplete="off"
                class="w-full rounded-md border border-gray-300 px-4 py-2
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                       @error('contact') border-red-500 bg-red-100 animate-pulse @enderror"
                placeholder="Entrez le contact"
            />
            @error('contact')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Boutons --}}
        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
            <button
                type="button"
                class="px-5 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                wire:click="$reset(['nom', 'prenom', 'email', 'contact'])"
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
