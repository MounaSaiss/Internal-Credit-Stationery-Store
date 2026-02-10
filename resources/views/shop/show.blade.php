<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - TechCorp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="icon"
          href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛒</text></svg>">

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-3">
                    <a href="{{ route('shop.index') }}" class="flex items-center gap-3">
                        <div class="h-9 w-9 bg-gray-900 rounded-lg flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-lg">T</span>
                        </div>
                        <span class="font-bold text-xl text-gray-900 tracking-tight">TechCorp Shop</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('shop.index') }}"
                        class="text-sm font-medium text-gray-500 hover:text-blue-600 transition flex items-center gap-1">
                        <span>← Retour au catalogue</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-10">

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 shadow-sm border border-green-200">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6 shadow-sm border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">

                <div
                    class="bg-gray-50 h-96 md:h-auto flex items-center justify-center border-b md:border-b-0 md:border-r border-gray-100 p-8 relative">
                    @if ($product->image)
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}"
                            class="max-h-80 object-contain drop-shadow-xl hover:scale-105 transition-transform duration-500">
                    @else
                        <svg class="h-32 w-32 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    @endif

                    <div class="absolute top-6 left-6 flex flex-col gap-2">
                        @if ($product->type === 'premium')
                            <span
                                class="bg-gray-900 text-yellow-400 text-xs font-bold px-3 py-1.5 rounded shadow-sm inline-flex items-center gap-1">
                                <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                PREMIUM
                            </span>
                        @endif
                    </div>
                </div>

                <div class="p-8 md:p-12 flex flex-col justify-center">

                    <div class="flex items-center gap-4 text-sm font-medium text-gray-500 mb-4">
                        <span class="uppercase tracking-wider">ID: #{{ $product->id }}</span>
                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                        <span class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->stock > 0 ? 'En Stock (' . $product->stock . ')' : 'Rupture de stock' }}
                        </span>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 leading-tight">
                        {{ $product->name }}
                    </h1>

                    <div class="flex items-end gap-2 mb-6">
                        <span class="text-4xl font-bold text-blue-600">{{ $product->price }}</span>
                        <span class="text-lg text-gray-400 font-bold uppercase mb-1">Tokens</span>
                    </div>

                    <div class="prose prose-sm text-gray-600 mb-8 border-t border-b border-gray-100 py-6">
                        <p>{{ $product->description }}</p>
                    </div>

                    <div class="mt-auto">
                        @if ($product->stock > 0)
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-gray-900 hover:bg-blue-600 text-white text-lg font-bold py-4 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all flex items-center justify-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    Ajouter au panier
                                </button>
                            </form>
                        @else
                            <button disabled
                                class="w-full bg-gray-200 text-gray-400 text-lg font-bold py-4 rounded-xl cursor-not-allowed">
                                Indisponible
                            </button>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </main>

</body>

</html>
