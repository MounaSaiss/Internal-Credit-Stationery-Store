<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes en attente</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- NAVBAR -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-2">
                    <div class="h-8 w-8 bg-blue-600 rounded-lg flex items-center justify-center shadow-sm">
                        <span class="text-white font-bold text-sm">MG</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-500 font-medium">
                            Manager
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-blue-50 text-blue-700 border border-blue-200">
                            {{ auth()->user()->department }} Department
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}"
                        class="px-3 py-2 text-gray-600 hover:text-gray-900 font-medium text-sm rounded-lg hover:bg-gray-100 transition">
                        Dashboard
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Commandes en attente</h1>
                <p class="mt-1 text-sm text-gray-500">
                    Validez ou refusez les commandes clients.
                </p>
            </div>

            <div class="mt-4 md:mt-0 bg-white px-4 py-2 rounded-lg border border-gray-200 shadow-sm">
                <span class="block text-xs text-gray-500 uppercase font-bold">
                    Total en attente
                </span>
                <span class="text-lg font-bold text-blue-600">
                    {{ $orders->count() }}
                </span>
            </div>
        </div>

        <!-- SUCCESS MESSAGE -->
        @if (session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm flex items-center justify-between">
            <div class="flex items-center">
                <svg class="h-6 w-6 text-green-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm font-medium text-green-800">
                    {{ session('success') }}
                </p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">
                &times;
            </button>
        </div>
        @endif

        <!-- TABLE -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Client</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Total</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($orders as $order)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            #{{ $order->id }}
                        </td>

                        <td class="px-6 py-4 text-gray-700">
                            {{ $order->user->name ?? 'N/A' }}
                        </td>

                        <td class="px-6 py-4 font-bold text-blue-600">
                            {{ $order->total_price }} Token
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">
                                ⏳ Pending
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-2">

                                <form method="POST" action="{{ route('orders.approve', $order->id) }}">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-2 bg-green-50 text-green-700 border border-green-200 rounded-lg hover:bg-green-100 hover:border-green-300 transition text-sm font-medium">
                                        ✅ Approve
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('orders.reject', $order->id) }}">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-2 bg-red-50 text-red-600 border border-red-200 rounded-lg hover:bg-red-100 hover:border-red-300 transition text-sm font-medium">
                                        ❌ Reject
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            Aucune commande en attente
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200 mt-12 py-6">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} Manager Panel — Tous droits réservés.
        </div>
    </footer>

</body>

</html>