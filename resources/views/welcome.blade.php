<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛍️</text></svg>">
</head>
<body class="antialiased bg-gray-50 text-gray-800 font-figtree">
    <div
        class="relative min-h-screen flex flex-col justify-center items-center selection:bg-blue-500 selection:text-white">

        <div class="absolute top-0 right-0 p-6 text-right z-10">
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a href="{{ route('user.dashboard',['userId' => Auth::user()->id]) }}"
                            class="font-semibold text-gray-600 hover:text-blue-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg shadow-md hover:bg-blue-700 transition duration-300">Connexion</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-5 py-2.5 bg-white text-gray-700 border border-gray-300 font-medium rounded-lg shadow-sm hover:bg-gray-50 transition duration-300">Inscription</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8 w-full">

            <div class="text-center mb-16 mt-10">
                <div class="flex justify-center mb-6">
                    <div class="h-20 w-20 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-white text-3xl font-bold">TC</span>
                    </div>
                </div>
                <h1 class="text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
                    TechCorp <span class="text-blue-600">Store</span>
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    La plateforme interne de gestion des fournitures. Utilisez vos <span
                        class="font-bold text-blue-600">Tokens</span> pour commander votre matériel en toute simplicité.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4">

                <div
                    class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 border-t-4 border-blue-400">
                    <div class="h-12 w-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Espace Employé</h2>
                    <p class="text-gray-600 mb-4">
                        Consultez votre solde de tokens, parcourez le catalogue et commandez vos fournitures
                        instantanément.
                    </p>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li class="flex items-center">✓ Achat avec Tokens</li>
                        <li class="flex items-center">✓ Suivi des commandes</li>
                    </ul>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 border-t-4 border-purple-400">
                    <div
                        class="h-12 w-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Espace Manager</h2>
                    <p class="text-gray-600 mb-4">
                        Supervisez les dépenses de votre équipe et validez les demandes d'articles "Premium".
                    </p>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li class="flex items-center">✓ Validation des Premiums</li>
                        <li class="flex items-center">✓ Gestion d'équipe</li>
                    </ul>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 border-t-4 border-emerald-400">
                    <div
                        class="h-12 w-12 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Administration</h2>
                    <p class="text-gray-600 mb-4">
                        Gestion globale des stocks, attribution des crédits mensuels et reporting financier.
                    </p>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li class="flex items-center">✓ Gestion des stocks</li>
                        <li class="flex items-center">✓ Rapports par département</li>
                    </ul>
                </div>

            </div>

            <div class="mt-16 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} TechCorp Internal Store. Laravel
                v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </div>
</body>

</html>
