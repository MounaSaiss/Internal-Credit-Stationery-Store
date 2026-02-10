
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vérification Email - TechCorp</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛍️</text></svg>">

</head>

<body class="font-figtree text-gray-900 antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

        <div class="mb-6">
            <a href="/" class="flex items-center gap-2">
                <div class="h-12 w-12 bg-blue-600 rounded-lg flex items-center justify-center shadow-md">
                    <span class="text-white text-xl font-bold">TC</span>
                </div>
                <span class="text-2xl font-bold text-gray-800">TechCorp</span>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-lg overflow-hidden sm:rounded-xl text-center">

            <div class="mb-6 flex justify-center">
                <div class="h-16 w-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </div>
            </div>

            <h2 class="text-xl font-bold text-gray-800 mb-2">Vérifiez votre boîte mail</h2>
            <div class="text-sm text-gray-600 mb-6">
                Merci pour votre inscription ! Avant de commencer, pourriez-vous vérifier votre adresse email en
                cliquant sur le lien que nous venons de vous envoyer ?
            </div>

            @if (session('resent'))
                <div class="mb-6 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-200">
                    Un nouveau lien de vérification a été envoyé à l'adresse email que vous avez fournie lors de
                    l'inscription.
                </div>
            @endif

            <div class="mt-4 flex flex-col gap-3">
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit"
                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Renvoyer l'email de vérification
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="text-sm text-gray-600 hover:text-gray-900 underline decoration-gray-400 hover:decoration-gray-800">
                        Se déconnecter
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
