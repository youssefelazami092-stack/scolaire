<div class="mt-10 max-w-6xl mx-auto">
    <div class="bg-white shadow-lg rounded-2xl p-6">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
            <input
                type="text"
                wire:model.debounce.500ms="search"
                placeholder="🔍 Rechercher un niveau..."
                class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition text-sm"
                aria-label="Recherche niveau"
            >
            <a href="{{ route('settings.create_levels') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded-lg shadow-md transition">
                ➕ Ajouter un niveau
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
        <div class="overflow-x-auto w-full">
            <table class="min-w-[600px] text-[15px] text-left border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                <thead class="bg-gray-100 text-gray-700 uppercase tracking-wider text-xs">
                    <tr>
                        <th class="px-6 py-3 font-semibold">ID</th>
                        <th class="px-6 py-3 font-semibold">Code</th>
                        <th class="px-6 py-3 font-semibold">Libellé</th>
                        <th class="px-6 py-3 font-semibold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($levels as $item)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="px-6 py-2">{{ $item->id }}</td>
                            <td class="px-6 py-2">{{ $item->code }}</td>
                            <td class="px-6 py-2">{{ $item->libelle }}</td>
                            <td class="px-6 py-2 text-center">
                                <div class="flex justify-center gap-2 flex-wrap">
                                    <a href="{{ route('settings.edit_level', $item->id) }}"
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1.5 rounded-md text-sm font-medium shadow">
                                        ✏️ Modifier
                                    </a>

                                    @if ($confirmingDeleteId === $item->id)
                                        <div class="flex gap-2">
                                            <button wire:click="delete"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-1.5 rounded-md text-sm font-medium">
                                                ✔️ Confirmer ?
                                            </button>
                                            <button wire:click="$set('confirmingDeleteId', null)"
                                                    class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-1.5 rounded-md text-sm font-medium">
                                                ✖️ Annuler
                                            </button>
                                        </div>
                                    @else
                                        <button wire:click="confirmDelete({{ $item->id }})"
                                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-1.5 rounded-md text-sm font-medium shadow">
                                            🗑️ Supprimer
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-8">
                                <div class="flex flex-col items-center text-gray-500">
                                    <img src="{{ asset('/logo/empty.png') }}" alt="Aucun niveau trouvé" class="w-20 h-20 mb-2 opacity-60">
                                    <span class="text-sm">Aucun niveau trouvé.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $levels->links() }}
            </div>
        </div>
    </div>
</div>
