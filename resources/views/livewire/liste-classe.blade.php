<div class="mt-10">
    <div class="bg-white rounded-2xl shadow-lg p-6">

        {{-- Top bar: recherche + bouton --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
            <div class="relative w-full md:w-1/3">
                <input
                    type="text"
                    wire:model.debounce.500ms="search"
                    placeholder="🔍 Rechercher une classe..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                >
            </div>

            <a href="{{ route('classes.create') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded-lg shadow-md transition duration-300">
                ➕ Ajouter une classe
            </a>
        </div>

        {{-- Message de succès --}}
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tableau --}}
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 text-sm rounded-lg shadow-sm">
                <thead class="bg-gray-100 text-gray-700 font-semibold uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 text-left">ID</th>
                        <th class="px-6 py-4 text-left">Libellé</th>
                        <th class="px-6 py-4 text-left">Niveau</th>
                        <th class="px-6 py-4 text-left">Scolarité</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($classes as $item)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="px-6 py-4">{{ $item->id }}</td>
                            <td class="px-6 py-4">{{ $item->libelle }}</td>
                            <td class="px-6 py-4">{{ optional($item->level)->libelle ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                {{ optional($item->level) ? number_format($item->level->scolarite, 2) : 'N/A' }} MAD
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('classes.edit', $item->id) }}"
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs font-medium transition">
                                        ✏️ Modifier
                                    </a>
                                    <button wire:click="delete({{ $item->id }})"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs font-medium transition">
                                        🗑️ Supprimer
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <img src="{{ asset('/logo/empty.png') }}" alt="Aucun élément trouvé" class="w-24 h-24 mb-2">
                                    <p class="text-sm">Aucune classe trouvée.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $classes->links() }}
            </div>
        </div>

    </div>
</div>
