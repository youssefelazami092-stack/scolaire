<div class="mt-10">
    <div class="bg-white shadow-lg rounded-2xl p-6">

        {{-- Barre de recherche, filtre classe et bouton création --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">

            <input
                type="text"
                wire:model.debounce.500ms="search"
                placeholder="🔍 Rechercher une inscription..."
                class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                aria-label="Recherche inscription"
            >

            <select
                wire:model="selected_classe_id"
                class="w-full md:w-1/3 mt-1 block rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('selected_classe_id') border-red-500 bg-red-100 @enderror"
                aria-label="Filtrer par classe"
            >
                <option value="">-- Classe --</option>
                @foreach ($classeList as $item)
                    <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                @endforeach
            </select>
            @error('selected_classe_id')
                <span class="text-red-500 text-sm md:absolute md:mt-1">{{ $message }}</span>
            @enderror

            <a href="{{ route('inscriptions.create') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded-lg shadow-md transition duration-300"
               aria-label="Faire une inscription">
                ➕ Faire une inscription
            </a>
        </div>

        {{-- Messages succès / erreur --}}
        @if (session()->has('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded-md shadow" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-4 px-4 py-2 bg-red-100 text-red-800 rounded-md shadow" role="alert">
                {{ session('error') }}
            </div>
        @endif

        {{-- Tableau inscriptions --}}
        <div class="overflow-x-auto rounded-lg shadow-sm border border-gray-200">
            <table class="min-w-full text-sm text-left whitespace-nowrap">
                <thead class="bg-gray-100 text-gray-700 uppercase tracking-wider text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Matricule</th>
                        <th class="px-6 py-4">Nom</th>
                        <th class="px-6 py-4">Prénom</th>
                        <th class="px-6 py-4">Classe</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($inscriptionList as $item)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="px-6 py-3">{{ $item->id }}</td>
                            <td class="px-6 py-3">{{ $item->student->matricule ?? 'N/A' }}</td>
                            <td class="px-6 py-3">{{ $item->student->nom ?? 'N/A' }}</td>
                            <td class="px-6 py-3">{{ $item->student->prenom ?? 'N/A' }}</td>
                            <td class="px-6 py-3">{{ $item->classe->libelle ?? 'N/A' }}</td>
                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center gap-2 flex-wrap">
                                    <a href="{{ route('inscriptions.edit', $item->id) }}"
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs font-medium shadow-sm"
                                       aria-label="Modifier inscription {{ $item->id }}">
                                        ✏️ Modifier
                                    </a>

                                    @if ($confirmingDeleteId === $item->id)
                                        <div class="flex gap-2">
                                            <button wire:click="delete"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-xs font-medium"
                                                aria-label="Confirmer suppression inscription {{ $item->id }}">
                                                ✔️ Confirmer
                                            </button>
                                            <button wire:click="$set('confirmingDeleteId', null)"
                                                class="bg-gray-400 hover:bg-gray-500 text-white px-3 py-1 rounded-md text-xs font-medium"
                                                aria-label="Annuler suppression inscription {{ $item->id }}">
                                                ✖️ Annuler
                                            </button>
                                        </div>
                                    @else
                                        <button wire:click="confirmDelete({{ $item->id }})"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs font-medium shadow-sm"
                                            aria-label="Supprimer inscription {{ $item->id }}">
                                            🗑️ Supprimer
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8">
                                <div class="flex flex-col items-center text-gray-500">
                                    <img src="{{ asset('/logo/empty.png') }}" alt="Aucun élément trouvé" class="w-24 h-24 mb-2 opacity-70">
                                    <span class="text-sm">Aucun élément trouvé.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $inscriptionList->links() }}
        </div>

    </div>
</div>
