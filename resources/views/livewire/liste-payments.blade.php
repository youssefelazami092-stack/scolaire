<div class="mt-10">
    <div class="bg-white shadow-lg rounded-2xl p-6">

        {{-- Recherche + bouton création --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
            <input
                type="text"
                wire:model.debounce.500ms="search"
                placeholder="🔍 Rechercher un paiement..."
                class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                aria-label="Recherche paiement"
            >

            <a href="{{ route('payments.create') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded-lg shadow-md transition duration-300"
               aria-label="Faire un paiement">
                ➕ Faire un paiement
            </a>
        </div>

        {{-- Messages --}}
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

        {{-- Tableau --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                <thead class="bg-gray-100 text-gray-700 uppercase tracking-wider text-xs">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Date</th>
                        <th class="px-6 py-4 font-semibold">Matricule</th>
                        <th class="px-6 py-4 font-semibold">Nom</th>
                        <th class="px-6 py-4 font-semibold">Prénom</th>
                        <th class="px-6 py-4 font-semibold">Classe</th>
                        <th class="px-6 py-4 font-semibold">Montant</th>
                        <th class="px-6 py-4 font-semibold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($payments as $item)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="px-6 py-3">{{ $item->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-3">{{ $item->student->matricule }}</td>
                            <td class="px-6 py-3">{{ $item->student->nom }}</td>
                            <td class="px-6 py-3">{{ $item->student->prenom }}</td>
                            <td class="px-6 py-3">{{ $item->classe->libelle }}</td>
                            <td class="px-6 py-3">{{ number_format($item->montant, 2) }} MAD</td>
                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center gap-2 flex-wrap">
                                    @if ($confirmingDeleteId === $item->id)
                                        <button wire:click="delete"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-xs font-medium"
                                            aria-label="Confirmer suppression paiement {{ $item->id }}">
                                            ✔️ Confirmer ?
                                        </button>
                                        <button wire:click="cancelDelete"
                                            class="bg-gray-400 hover:bg-gray-500 text-white px-3 py-1 rounded-md text-xs font-medium"
                                            aria-label="Annuler suppression paiement {{ $item->id }}">
                                            ✖️ Annuler
                                        </button>
                                    @else
                                        <button wire:click="confirmDelete({{ $item->id }})"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs font-medium shadow-sm"
                                            aria-label="Supprimer le paiement {{ $item->id }}">
                                            🗑️ Supprimer
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-8">
                                <div class="flex flex-col items-center text-gray-500">
                                    <img src="{{ asset('/logo/empty.png') }}" alt="Aucun paiement trouvé" class="w-24 h-24 mb-2 opacity-70">
                                    <span class="text-sm">Aucun paiement trouvé.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $payments->links() }}
            </div>
        </div>
    </div>
</div>
