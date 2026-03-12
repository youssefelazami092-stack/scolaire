<x-app-layout>
    <div class="max-w-7xl mx-auto p-8 bg-white rounded-xl shadow-lg mt-10">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">Tableau de bord</h1>
        <p class="text-gray-600 mb-10 max-w-xl">
            Surveillez et gérez facilement toutes les fonctionnalités clés de votre application.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

            {{-- Utilisateurs --}}
            <div
                class="bg-gradient-to-r from-indigo-600 to-indigo-500 text-white rounded-xl p-8 shadow-lg flex flex-col items-center hover:shadow-indigo-400/50 transition-shadow duration-300">
                <div class="flex items-center space-x-3 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.28.564 6.121 1.553M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-lg font-semibold tracking-wide">Utilisateurs</span>
                </div>
                <div class="text-5xl font-extrabold">{{ $usersCount }}</div>
                <p class="mt-2 text-indigo-200 text-sm uppercase tracking-wide font-medium">
                    Total des utilisateurs inscrits
                </p>
            </div>

            {{-- Inscriptions --}}
            <div
                class="bg-gradient-to-r from-green-600 to-green-500 text-white rounded-xl p-8 shadow-lg flex flex-col items-center hover:shadow-green-400/50 transition-shadow duration-300">
                <div class="flex items-center space-x-3 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 17v-6a3 3 0 116 0v6m-3-3v3" />
                    </svg>
                    <span class="text-lg font-semibold tracking-wide">Inscriptions</span>
                </div>
                <div class="text-5xl font-extrabold">{{ $inscriptionsCount }}</div>
                <p class="mt-2 text-green-200 text-sm uppercase tracking-wide font-medium">
                    Total des inscriptions
                </p>
            </div>

            {{-- Paiements --}}
            <div
                class="bg-gradient-to-r from-yellow-600 to-yellow-500 text-white rounded-xl p-8 shadow-lg flex flex-col items-center hover:shadow-yellow-400/50 transition-shadow duration-300">
                <div class="flex items-center space-x-3 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8c-1.657 0-3 1.343-3 3 0 1.305 1.053 2.437 2.334 2.86l.666.18.666-.18c1.28-.423 2.334-1.555 2.334-2.86 0-1.657-1.343-3-3-3z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364 6.364l-1.414-1.414M7.05 7.05L5.636 5.636m12.728 0l-1.414 1.414M7.05 16.95l-1.414 1.414" />
                    </svg>
                    <span class="text-lg font-semibold tracking-wide">Paiements</span>
                </div>
                <div class="text-5xl font-extrabold">{{ number_format($paymentsSum, 2, ',', ' ') }} MAD</div>
                <p class="mt-2 text-yellow-200 text-sm uppercase tracking-wide font-medium">
                    Total des paiements reçus
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
