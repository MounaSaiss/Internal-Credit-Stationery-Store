<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier - TechCorp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white border-b border-gray-200 shadow-sm p-4 mb-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="font-bold text-xl">Mon Panier</h1>
            <a href="{{ route('shop.index') }}" class="text-blue-600 hover:underline">← Retour à la boutique</a>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4">

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        @if (session('cart') && count(session('cart')) > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="p-4">Produit</th>
                            <th class="p-4">Prix</th>
                            <th class="p-4">Quantité</th>
                            <th class="p-4">Total</th>
                            <th class="p-4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php $total = 0; @endphp
                        @foreach (session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity']; @endphp
                            <tr>
                                <td class="p-4 font-bold">{{ $details['name'] }}</td>
                                <td class="p-4">{{ $details['price'] }} Tks</td>
                                <td class="p-4">{{ $details['quantity'] }}</td>
                                <td class="p-4 font-bold text-blue-600">{{ $details['price'] * $details['quantity'] }}
                                    Tks</td>
                                <td class="p-4">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="text-red-500 hover:text-red-700 text-sm font-bold">Retirer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-6 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                    <div class="text-lg">Total Commande: <span class="font-bold text-gray-900">{{ $total }}
                            Tokens</span></div>
                    <form action="{{ route('order.store') }}" method="POST"> @csrf
                        <button
                            class="bg-gray-900 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition font-bold shadow-lg">
                            Confirmer la commande
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Votre panier est vide.</p>
                <a href="{{ route('shop.index') }}"
                    class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg">Commencer les achats</a>
            </div>
        @endif
    </div>

</body>

</html>
