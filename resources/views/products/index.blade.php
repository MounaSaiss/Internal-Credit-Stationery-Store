<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue Produits - TechCorp</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-2">
                    <div class="h-8 w-8 bg-blue-600 rounded-lg flex items-center justify-center shadow-sm">
                        <span class="text-white font-bold text-sm">TC</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900">Products Store</span>
                </div>

                <div class="flex items-center gap-3">

                    <a href="{{ route('admin.index') }}" class="btn btn-outline-dark rounded-pill px-4 fw-bold">
                        <i class="fas fa-box me-2"></i> Sales Statistics
                    </a>

                    <a href="{{ route('products.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 hover:border-blue-300 font-bold rounded-lg transition-all text-sm">
                        <span
                            class="mr-2 bg-blue-200 text-blue-700 rounded-full w-5 h-5 flex items-center justify-center text-xs">
                            +
                        </span>
                        Nouveau Produit
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="ml-2">
                        @csrf
                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition"
                            title="Déconnexion">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Catalogue des Fournitures</h1>
                <p class="mt-1 text-sm text-gray-500">Gérez l'inventaire et les prix des articles disponibles.</p>
            </div>
            <div class="mt-4 md:mt-0 flex gap-3">
                <div class="bg-white px-4 py-2 rounded-lg border border-gray-200 shadow-sm">
                    <span class="block text-xs text-gray-500 uppercase font-bold">Total Produits</span>
                    <span class="text-lg font-bold text-blue-600">{{ $products->total() }}</span>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div
                class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="h-6 w-6 text-green-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()"
                    class="text-green-600 hover:text-green-800">&times;</button>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @forelse ($products as $product)
                <div
                    class="group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col overflow-hidden">

                    <div class="relative h-48 bg-gray-100 overflow-hidden">
                        @if ($product->image)
                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif

                        <div class="absolute top-3 left-3 flex flex-col gap-2">
                            @if ($product->type === 'premium')
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-400 text-yellow-900 shadow-sm">
                                    ★ Premium
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="p-5 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-bold text-gray-900 line-clamp-1" title="{{ $product->name }}">
                                {{ $product->name }}
                            </h3>
                        </div>

                        <p class="text-sm text-gray-500 line-clamp-2 mb-4 flex-1">
                            {{ $product->description }}
                        </p>

                        <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-100">
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-400 uppercase font-semibold">Prix</span>
                                <span class="text-lg font-bold text-blue-600">{{ $product->price }} <span
                                        class="text-sm font-normal text-gray-500">Tokens</span></span>
                            </div>
                            <div class="flex flex-col text-right">
                                <span class="text-xs text-gray-400 uppercase font-semibold">Stock</span>
                                <span
                                    class="text-sm font-bold {{ $product->stock < 5 ? 'text-red-500' : 'text-gray-700' }}">
                                    {{ $product->stock }} unités
                                </span>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('products.edit', $product->id) }}"
                                class="flex-1 bg-white border border-gray-300 text-gray-700 text-sm font-medium py-2 px-3 rounded-lg hover:bg-gray-50 hover:text-blue-600 transition text-center flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                Éditer
                            </a>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-50 text-red-600 border border-red-100 p-2 rounded-lg hover:bg-red-100 hover:text-red-700 transition"
                                    title="Supprimer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="col-span-full flex flex-col items-center justify-center py-12 text-center bg-white rounded-2xl border border-gray-200 border-dashed">
                    <div class="bg-gray-50 p-4 rounded-full mb-3">
                        <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Aucun produit trouvé</h3>
                    <p class="text-gray-500 mb-4">Commencez par ajouter des fournitures au catalogue.</p>
                    <a href="{{ route('products.create') }}" class="text-blue-600 hover:underline font-medium">Créer
                        le premier produit</a>
                </div>
            @endforelse

        </div>

        <div class="mt-12 flex justify-center">
            {{ $products->links() }}
        </div>

    </main>

    <footer class="bg-white border-t border-gray-200 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} TechCorp. Tous droits réservés.
        </div>
    </footer>

</body>

</html>
