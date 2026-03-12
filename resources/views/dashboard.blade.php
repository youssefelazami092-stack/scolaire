<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md mt-6">
      <h1 class="text-3xl font-semibold text-gray-800 mb-6">Tableau de bord</h1>
      <p class="text-gray-600 mb-8">
        Surveillez et gérez facilement toutes les fonctionnalités clés de votre application.
      </p>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-indigo-600 text-white rounded-lg p-6 shadow-md flex flex-col items-center">
          <div class="text-4xl font-bold">{{ $usersCount }}</div>
          <div class="mt-2 uppercase tracking-wide font-semibold text-sm">Utilisateurs</div>
          <div class="mt-1 text-indigo-200 text-xs">Total des utilisateurs inscrits</div>
        </div>

        <div class="bg-green-600 text-white rounded-lg p-6 shadow-md flex flex-col items-center">
          <div class="text-4xl font-bold">{{ $inscriptionsCount }}</div>
          <div class="mt-2 uppercase tracking-wide font-semibold text-sm">Inscriptions</div>
          <div class="mt-1 text-green-200 text-xs">Inscriptions ce mois</div>
        </div>

        <div class="bg-yellow-600 text-white rounded-lg p-6 shadow-md flex flex-col items-center">
          <div class="text-4xl font-bold">{{ number_format($paymentsSum, 2, ',', ' ') }} MAD</div>
          <div class="mt-2 uppercase tracking-wide font-semibold text-sm">Paiements</div>
          <div class="mt-1 text-yellow-200 text-xs">Total des paiements reçus</div>
        </div>

      </div>
    </div>

    <div class="max-w-7xl mx-auto p-6 mt-10 bg-gray-50 rounded-lg shadow-sm">
        <h2 class="text-2xl font-semibold mb-4">Statistiques détaillées</h2>
        <p class="mb-2">Utilisateurs : <strong>{{ $usersCount }}</strong></p>
        <p class="mb-2">Inscriptions ce mois : <strong>{{ $inscriptionsCount }}</strong></p>
        <p>Somme des paiements : <strong>{{ number_format($paymentsSum, 2, ',', ' ') }} MAD</strong></p>
    </div>
</x-app-layout>
