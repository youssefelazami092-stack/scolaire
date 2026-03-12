<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Connexion - EduManager</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .logo-container {
            background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-[#F8FAFC] to-[#EFF6FF] min-h-screen flex flex-col items-center justify-center p-4">
    <div class="flex-1 flex items-center justify-center w-full">
        <div class="w-full max-w-md bg-white rounded-xl shadow-xl overflow-hidden border border-[#E2E8F0]">
            <!-- En-tête avec logo -->
            <div class="logo-container p-6 text-center relative">
                <div class="absolute top-4 left-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-white">EduManager</h1>
                <p class="text-[#EFF6FF] mt-1">Gestion Scolaire Professionnelle</p>
            </div>

            <!-- Formulaire -->
            <div class="p-8">
                <h2 class="text-xl font-semibold text-[#1E293B] mb-6 text-center">Connectez-vous à votre compte</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-medium text-[#1E293B] mb-2">Adresse Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-[#64748B]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" required autofocus
                                   class="input-focus w-full pl-10 pr-4 py-3 border border-[#E2E8F0] rounded-lg focus:ring-[#3B82F6] focus:border-[#3B82F6]"
                                   placeholder="votre@email.com">
                        </div>
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-5">
                        <label for="password" class="block text-sm font-medium text-[#1E293B] mb-2">Mot de passe</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-[#64748B]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required
                                   class="input-focus w-full pl-10 pr-4 py-3 border border-[#E2E8F0] rounded-lg focus:ring-[#3B82F6] focus:border-[#3B82F6]"
                                   placeholder="••••••••">
                        </div>
                    </div>

                    <!-- Options -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox"
                                   class="h-4 w-4 text-[#3B82F6] focus:ring-[#3B82F6] border-[#E2E8F0] rounded">
                            <label for="remember" class="ml-2 block text-sm text-[#64748B]">
                                Se souvenir de moi
                            </label>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-[#3B82F6] hover:underline">Mot de passe oublié?</a>
                        </div>
                    </div>

                    <!-- Bouton de connexion -->
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-[#3B82F6] to-[#1D4ED8] hover:from-[#2563EB] hover:to-[#1E40AF] text-white py-3 px-4 rounded-lg font-medium transition-all duration-300 shadow-md hover:shadow-lg">
                        Se connecter
                    </button>
                </form>

                <!-- Séparateur -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-[#E2E8F0]"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-[#64748B]">Ou</span>
                    </div>
                </div>

                <!-- Lien vers l'inscription -->
                <div class="text-center">
                    <p class="text-sm text-[#64748B]">
                        Pas encore de compte ?
                        <a href="{{ route('register') }}" class="font-medium text-[#3B82F6] hover:underline">Créer un compte</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="w-full py-4 mt-8 text-center text-sm text-[#64748B] border-t border-[#E2E8F0]">
        <div class="container mx-auto px-4">
            <p>© {{ date('Y') }} EduManager - Tous droits réservés</p>
            <div class="mt-2 flex justify-center space-x-6">
                <a href="#" class="text-[#64748B] hover:text-[#3B82F6]">Conditions d'utilisation</a>
                <a href="#" class="text-[#64748B] hover:text-[#3B82F6]">Politique de confidentialité</a>
                <a href="#" class="text-[#64748B] hover:text-[#3B82F6]">Contact</a>
            </div>
        </div>
    </footer>
</body>
</html>
