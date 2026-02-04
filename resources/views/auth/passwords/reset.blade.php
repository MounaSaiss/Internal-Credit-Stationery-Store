<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nouveau mot de passe - TechCorp</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
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

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-lg overflow-hidden sm:rounded-xl">

            <h2 class="text-center text-lg font-semibold text-gray-700 mb-6">Définir le nouveau mot de passe</h2>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-4">
                    <label for="email" class="block font-medium text-sm text-gray-700">Adresse Email</label>
                    <input id="email"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 py-2 px-3 border bg-gray-50 text-gray-500"
                        type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                        readonly />

                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block font-medium text-sm text-gray-700">Nouveau mot de passe</label>
                    <input id="password"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 py-2 px-3 border"
                        type="password" name="password" required autocomplete="new-password" autofocus />

                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password-confirm" class="block font-medium text-sm text-gray-700">Confirmer le mot de
                        passe</label>
                    <input id="password-confirm"
                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 py-2 px-3 border"
                        type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit"
                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Réinitialiser le mot de passe
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
