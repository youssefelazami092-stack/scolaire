<div class="mt-10">
    <div class="bg-white shadow-lg rounded-2xl p-6">

        {{-- Titre et barre de recherche + bouton --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
            <input
                type="text"
                wire:model="search"
                placeholder="🔍 Rechercher une année scolaire..."
                class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                aria-label="Rechercher une année scolaire"
            >
            <a href="{{ route('settings.create_school_year') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded-lg shadow-md transition duration-300"
               aria-label="Nouvelle année scolaire">
                ➕ Nouvelle Année Scolaire
            </a>
        </div>

        {{-- Messages --}}
        @if (session()->has('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded-md shadow" role="alert">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tableau --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                <thead class="bg-gray-100 text-gray-700 uppercase tracking-wider text-xs">
                    <tr>
                        <th class="px-6 py-4 font-semibold">ID</th>
                        <th class="px-6 py-4 font-semibold">Année Scolaire</th>
                        <th class="px-6 py-4 font-semibold">Statut</th>
                        <th class="px-6 py-4 font-semibold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($schoolYearList as $item)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="px-6 py-3">{{ $item->id }}</td>
                            <td class="px-6 py-3">{{ $item->school_year }}</td>
                            <td class="px-6 py-3">
                                @if ($item->active)
                                    <span class="px-2 py-1 bg-green-400 text-white rounded-md text-xs font-semibold">Actif</span>
                                @else
                                    <span class="px-2 py-1 bg-red-400 text-white rounded-md text-xs font-semibold">Inactif</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-center">
                                <button
                                    class="px-3 py-1 text-white text-xs rounded-md transition {{ $item->active ? 'bg-red-400 hover:bg-red-500' : 'bg-green-400 hover:bg-green-500' }}"
                                    wire:click="toggleStatus({{ $item->id }})"
                                    aria-label="{{ $item->active ? 'Rendre inactif' : 'Rendre actif' }} l’année scolaire {{ $item->school_year }}">
                                    {{ $item->active ? 'Rendre Inactif' : 'Rendre Actif' }}
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-10">
                                <div class="flex flex-col items-center text-gray-500">
                                    <img src="{{ asset('/logo/empty.png') }}" alt="Aucun élément trouvé" class="w-24 h-24 mb-2 opacity-70">
                                    <span class="text-sm">Aucun élément trouvé.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $schoolYearList->links() }}
            </div>
        </div>

    </div>
</div>
