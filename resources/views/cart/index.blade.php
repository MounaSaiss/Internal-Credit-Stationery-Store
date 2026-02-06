@php
    $cart = session('cart', []);
    $cartTotal = 0;
    foreach ($cart as $item) {
        $cartTotal += $item['price'] * $item['quantity'];
    }

    $remainingBalance = auth()->user()->token - $cartTotal;
    $cartCount = count($cart);
@endphp

    <!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier - TechCorp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="icon"
          href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛍️</text></svg>">

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        /* Nav animation */
        @keyframes navSlideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        nav {
            animation: navSlideDown 0.5s ease-out;
        }

        /* Toast Animation */
        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: translateX(400px);
            }
        }

        .toast-enter {
            animation: slideInRight 0.5s ease-out forwards;
        }

        .toast-exit {
            animation: fadeOut 0.3s ease-in forwards;
        }

        /* Cart items stagger animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .cart-item {
            animation: fadeInUp 0.4s ease-out forwards;
            opacity: 0;
        }

        .cart-item:nth-child(1) { animation-delay: 0.1s; }
        .cart-item:nth-child(2) { animation-delay: 0.15s; }
        .cart-item:nth-child(3) { animation-delay: 0.2s; }
        .cart-item:nth-child(4) { animation-delay: 0.25s; }
        .cart-item:nth-child(5) { animation-delay: 0.3s; }
        .cart-item:nth-child(6) { animation-delay: 0.35s; }

        /* Cart summary animation */
        @keyframes slideInBottom {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .cart-summary {
            animation: slideInBottom 0.6s ease-out 0.4s both;
        }

        /* Empty cart animation */
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .empty-icon {
            animation: bounce 2s ease-in-out infinite;
        }

        /* Button ripple effect */
        .btn-ripple {
            position: relative;
            overflow: hidden;
        }

        .btn-ripple::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-ripple:active::before {
            width: 300px;
            height: 300px;
        }

        /* Cart badge pulse */
        @keyframes badgePulse {
            0%, 100% {
                transform: translate(25%, -25%) scale(1);
            }
            50% {
                transform: translate(25%, -25%) scale(1.1);
            }
        }

        .cart-badge {
            animation: badgePulse 0.5s ease-out;
        }

        /* Table header fade in */
        @keyframes headerFadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-header {
            animation: headerFadeIn 0.5s ease-out 0.2s both;
        }

        /* Row hover effect */
        .cart-item {
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            transform: translateX(5px);
            background-color: rgba(249, 250, 251, 0.5);
        }

        /* Remove button hover */
        .remove-btn {
            transition: all 0.3s ease;
        }

        .remove-btn:hover {
            transform: scale(1.1);
        }

        /* Page header animation */
        @keyframes pageHeaderFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-header {
            animation: pageHeaderFadeIn 0.7s ease-out 0.3s both;
        }

        /* Confirm button pulse */
        @keyframes confirmPulse {
            0%, 100% {
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            }
            50% {
                box-shadow: 0 20px 25px -5px rgba(34, 197, 94, 0.3);
            }
        }

        .confirm-btn:hover {
            animation: confirmPulse 1.5s ease-in-out infinite;
        }

        /* Smooth transitions */
        * {
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

<div class="fixed top-20 right-5 z-[100] flex flex-col gap-3 w-80">
    @if (session('success'))
        <div id="toast-success"
             class="toast-enter flex items-center w-full p-4 text-gray-500 bg-white rounded-lg shadow-xl border-l-4 border-green-500 transition-opacity duration-500 transform translate-x-0 opacity-100"
             role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
            </div>
            <div class="ml-3 text-sm font-normal text-gray-900">{{ session('success') }}</div>
            <button type="button" onclick="closeToast('toast-success')"
                    class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div id="toast-error"
             class="toast-enter flex items-center w-full p-4 text-gray-500 bg-white rounded-lg shadow-xl border-l-4 border-red-500 transition-opacity duration-500 transform translate-x-0 opacity-100"
             role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                </svg>
            </div>
            <div class="ml-3 text-sm font-normal text-gray-900">{{ session('error') }}</div>
            <button type="button" onclick="closeToast('toast-error')"
                    class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
</div>

<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center gap-3 mr-8">
                    <div class="h-9 w-9 bg-blue-600 rounded-lg flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-lg">T</span>
                    </div>
                    <span class="font-bold text-xl text-gray-900 tracking-tight">TechCorp <span class="text-blue-600">Store</span></span>
                </div>

                <div class="hidden md:flex md:space-x-8">
                    <a href="{{ route('user.dashboard', ['username' => Auth::user()->name]) }}" class="border-b-2 border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 text-sm font-medium transition">
                        Dashboard
                    </a>
                    <a href="{{ route('shop.index') }}" class="border-b-2 border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 text-sm font-medium transition">
                        Shop
                    </a>
                    <a href="#" class="border-b-2 border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 text-sm font-medium transition">
                        My Orders
                    </a>
                </div>
            </div>

            <div class="flex items-center space-x-4">

                <div class="hidden lg:flex flex-col items-end border-r border-gray-200 pr-4">
                    <span class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Solde Restant</span>
                    <span class="font-bold {{ $remainingBalance <= 0 ? 'text-red-600' : 'text-blue-600' }} text-base leading-tight">
                        {{ number_format($remainingBalance) }} <span class="text-xs opacity-70">Tks</span>
                    </span>
                </div>


                <a href="{{ route('cart.index') }}" class="relative p-2 text-blue-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    @if ($cartCount > 0)
                        <span class="cart-badge absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-[10px] font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-red-600 rounded-full">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                <div class="flex items-center pl-4 border-l border-gray-100 space-x-3">
                    <div class="hidden md:flex flex-col items-end">
                        <a href="{{ route('user.profile', ['username' => Auth::user()->name]) }}" class="text-sm font-semibold text-gray-900 hover:text-blue-600 transition">
                            {{ Auth::user()->name }}
                        </a>
                        <p class="text-[11px] text-gray-500">{{ Auth::user()->role }} • {{ Auth::user()->department }}</p>
                    </div>
                    <div class="bg-blue-600 text-white w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold shadow-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="ml-2">
                        @csrf
                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition" title="Déconnexion">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</nav>

<div class="bg-white border-b border-gray-200 mb-8 page-header">
    <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Mon Panier</h1>
            <p class="text-sm text-gray-500 mt-1">Vérifiez vos articles avant de confirmer votre commande.</p>
        </div>
        <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Continuer les achats
        </a>
    </div>
</div>

<main class="max-w-7xl mx-auto px-4 pb-12">

    @if (session('cart') && count(session('cart')) > 0)
        <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
            <table class="w-full text-left table-header">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="p-5">Produit</th>
                    <th class="p-5">Prix Unitaire</th>
                    <th class="p-5">Quantité</th>
                    <th class="p-5">Total</th>
                    <th class="p-5 text-center">Action</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @php $total = 0; @endphp
                @foreach (session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity']; @endphp
                    <tr class="cart-item hover:bg-gray-50 transition">
                        <td class="p-5">
                            <div class="font-bold text-gray-900">{{ $details['name'] }}</div>
                        </td>
                        <td class="p-5 text-gray-600">
                            {{ $details['price'] }} <span class="text-blue-500 font-semibold">Tks</span>
                        </td>
                        <td class="p-5">
                                    <span class="inline-flex items-center justify-center px-3 py-1 bg-gray-100 text-gray-700 font-bold rounded-lg text-sm">
                                        {{ $details['quantity'] }}
                                    </span>
                        </td>
                        <td class="p-5">
                                    <span class="font-bold text-blue-600 text-lg">
                                        {{ $details['price'] * $details['quantity'] }} <span class="text-sm">Tks</span>
                                    </span>
                        </td>
                        <td class="p-5 text-center">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="remove-btn inline-flex items-center gap-2 text-red-500 hover:text-red-700 text-sm font-bold px-3 py-2 rounded-lg hover:bg-red-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Retirer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="cart-summary p-6 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <div class="text-center sm:text-left">
                        <div class="text-sm text-gray-500 uppercase font-bold tracking-wider mb-1">Total Commande</div>
                        <div class="text-3xl font-bold text-gray-900">
                            {{ $total }} <span class="text-lg text-blue-600">Tokens</span>
                        </div>
                    </div>
                    <div class="h-12 w-px bg-gray-300 hidden sm:block"></div>
                    <div class="text-center sm:text-left">
                        <div class="text-sm text-gray-500 uppercase font-bold tracking-wider mb-1">Solde Restant</div>
                        <div class="text-2xl font-bold {{ $remainingBalance <= 0 ? 'text-red-600' : 'text-green-600' }}">
                            {{ number_format($remainingBalance) }} <span class="text-sm opacity-70">Tks</span>
                        </div>
                    </div>
                </div>
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <button class="confirm-btn btn-ripple bg-green-600 text-white px-8 py-4 rounded-lg hover:bg-green-700 transition font-bold shadow-lg text-base inline-flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Confirmer la commande
                    </button>
                </form>
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-12">
            <div class="text-center">
                <div class="empty-icon text-6xl mb-4">🛒</div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Votre panier est vide</h2>
                <p class="text-gray-500 mb-6">Parcourez notre catalogue et ajoutez des produits à votre panier.</p>
                <a href="{{ route('shop.index') }}"
                   class="btn-ripple inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-bold shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Commencer les achats
                </a>
            </div>
        </div>
    @endif
</main>

<script>
    // Toast close animation
    function closeToast(toastId) {
        const toast = document.getElementById(toastId);
        if (toast) {
            toast.classList.remove('toast-enter');
            toast.classList.add('toast-exit');
            setTimeout(() => toast.remove(), 300);
        }
    }

    // Auto-dismiss toasts after 5 seconds
    document.addEventListener('DOMContentLoaded', () => {
        const toasts = document.querySelectorAll('[id^="toast-"]');
        toasts.forEach(toast => {
            setTimeout(() => closeToast(toast.id), 5000);
        });
    });
</script>

</body>

</html>
