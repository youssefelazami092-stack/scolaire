<div class="mt-10">
    <div class="bg-white shadow-lg rounded-2xl p-6">

        <div class="flex flex-col md:flex-row gap-6">

            <div class="md:w-2/3 flex flex-col space-y-6">

                {{-- Informations Élève --}}
                <div>
                    <h2 class="text-lg font-semibold text-red-600 border-b-2 border-red-500 pb-2 mb-4">
                        Informations de l'élève
                    </h2>

                    <div class="flex items-center space-x-6">
                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode($eleve->nom . ' ' . $eleve->prenom) }}"
                            alt="Avatar {{ $eleve->nom }} {{ $eleve->prenom }}"
                            class="w-24 h-24 rounded-full object-cover"
                        >

                        <div class="space-y-2 text-gray-800">
                            <div><span class="font-semibold uppercase">Matricule: </span> {{ $eleve->matricule }}</div>
                            <div><span class="font-bold text-xl">{{ $eleve->nom }}</span> <span class="font-bold text-xl">{{ $eleve->prenom }}</span></div>
                            <div><span class="font-semibold">Classe actuelle: </span> {{ $this->getCurrentClasse() }}</div>
                        </div>
                    </div>
                </div>

                {{-- Derniers paiements --}}
                <div>
                    <h2 class="text-lg font-semibold text-red-600 border-b-2 border-red-500 pb-2 mb-4">
                        Derniers paiements effectués
                    </h2>

                    @forelse ($studentsLastPayment as $payment)
                        <div class="p-3 border-b border-red-200 shadow-sm flex justify-between text-gray-700">
                            <span class="font-medium">{{ number_format($payment->montant, 2) }} MAD</span>
                            <span class="text-sm text-gray-500">Payé le: {{ $payment->created_at->format('d/m/Y') }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500 italic">Aucun paiement effectué !</p>
                    @endforelse

                    <div class="mt-4">
                        {{ $studentsLastPayment->links() }}
                    </div>
                </div>

            </div>

            <div class="md:w-1/3">
                {{-- Espace pour autres infos ou widgets --}}
            </div>
        </div>
    </div>
</div>
