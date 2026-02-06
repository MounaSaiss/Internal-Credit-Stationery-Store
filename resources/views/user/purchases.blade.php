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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon"
          href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛍️</text></svg>">

    <style>
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

        /* Success message animation */
        @keyframes slideInTop {
            from {
                transform: translateY(-100px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        #success-message {
            animation: slideInTop 0.6s ease-out;
        }

        /* Profile card animation */
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .profile-card {
            animation: fadeInScale 0.6s ease-out 0.2s both;
        }

        /* Avatar pulse */
        @keyframes avatarPulse {
            0%, 100% {
                box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);
            }
            50% {
                box-shadow: 0 10px 25px -3px rgba(59, 130, 246, 0.5);
            }
        }

        .avatar {
            animation: avatarPulse 2s ease-in-out infinite;
        }

        /* Badge hover effect */
        .badge {
            transition: all 0.3s ease;
        }

        .badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Table section animation */
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

        .table-section {
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        /* Table row stagger animation */
        @keyframes rowFadeIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .product-row {
            animation: rowFadeIn 0.4s ease-out forwards;
            opacity: 0;
        }

        .product-row:nth-child(1) {
            animation-delay: 0.1s;
        }

        .product-row:nth-child(2) {
            animation-delay: 0.15s;
        }

        .product-row:nth-child(3) {
            animation-delay: 0.2s;
        }

        .product-row:nth-child(4) {
            animation-delay: 0.25s;
        }

        .product-row:nth-child(5) {
            animation-delay: 0.3s;
        }

        .product-row:nth-child(6) {
            animation-delay: 0.35s;
        }

        .product-row:nth-child(7) {
            animation-delay: 0.4s;
        }

        .product-row:nth-child(8) {
            animation-delay: 0.45s;
        }

        /* Search input focus animation */
        @keyframes inputGlow {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
            }
            50% {
                box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            }
        }

        .search-input:focus {
            animation: inputGlow 1.5s ease-in-out;
        }

        /* Sort header hover */
        .sort-header {
            position: relative;
            transition: all 0.3s ease;
        }

        .sort-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #3b82f6;
            transition: width 0.3s ease;
        }

        .sort-header:hover::after {
            width: 100%;
        }

        /* Sort arrow animation */
        .sort-arrow {
            transition: all 0.3s ease;
        }

        .sort-header:hover .sort-arrow {
            transform: scale(1.2);
        }

        /* Status badge pulse */
        @keyframes statusPulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.8;
            }
        }

        .status-badge {
            animation: statusPulse 2s ease-in-out infinite;
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

        /* Empty state animation */
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

        /* No results animation */
        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }
            25% {
                transform: translateX(-10px);
            }
            75% {
                transform: translateX(10px);
            }
        }

        #noResults.show-animation {
            animation: shake 0.5s ease-in-out;
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
            animation: headerFadeIn 0.5s ease-out 0.5s both;
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

        /* Smooth transitions for all interactive elements */
        * {
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Row highlight on hover */
        .product-row {
            transition: all 0.3s ease;
        }

        .product-row:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        /* Search icon pulse */
        @keyframes searchPulse {
            0%, 100% {
                opacity: 0.4;
            }
            50% {
                opacity: 1;
            }
        }

        .search-icon {
            animation: searchPulse 2s ease-in-out infinite;
        }
    </style>
</head>

<body class="antialiased bg-gray-50 text-gray-800 font-figtree h-[100vh]">
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
                    <a href="{{ route('user.dashboard', ['userId' => Auth::user()->id]) }}"
                       class="border-b-2 border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 text-sm font-medium transition">
                        Dashboard
                    </a>
                    <a href="{{ route('shop.index') }}"
                       class="border-b-2 border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 text-sm font-medium transition">
                        Shop
                    </a>
                    <a href="{{ route('user.orders') }}"
                       class="border-b-2 border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 text-sm font-medium transition">
                        My Orders
                    </a>
                </div>
            </div>

            <div class="flex items-center space-x-4">

                <div class="hidden lg:flex flex-col items-end border-r border-gray-200 pr-4">
                    <span class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Balance</span>
                    <span
                        class="font-bold {{ $remainingBalance <= 0 ? 'text-red-600' : 'text-blue-600' }} text-base leading-tight">
                        {{ number_format($remainingBalance) }} <span class="text-xs opacity-70">Tks</span>
                    </span>
                </div>


                <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-400 hover:text-blue-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    @if ($cartCount > 0)
                        <span
                            class="cart-badge absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-[10px] font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-red-600 rounded-full">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                <div class="flex items-center pl-4 border-l border-gray-100 space-x-3">
                    <div class="hidden md:flex flex-col items-end">
                        <a href="{{ route('user.profile', ['userId' => Auth::user()->id]) }}"
                           class="text-sm font-semibold text-gray-900 hover:text-blue-600 transition">
                            {{ Auth::user()->name }}
                        </a>
                        <p class="text-[11px] text-gray-500">{{ Auth::user()->role }}
                            • {{ Auth::user()->department }}</p>
                    </div>
                    <div
                        class="bg-blue-600 text-white w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold shadow-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="ml-2">
                        @csrf
                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition"
                                title="Déconnexion">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</nav>

@if (session('success'))
    <div id="success-message" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-md rounded"
         role="alert">
        <div class="flex items-center">
            <div class="py-1">
                <svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 20 20">
                    <path
                        d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                </svg>
            </div>
            <div>
                <p class="font-bold">Success!</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

<div class="bg-white border-b border-gray-200 mb-8 page-header">
    <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">My Purchased Products</h1>
            <p class="text-sm text-gray-500 mt-1">Track and manage your order history.</p>
        </div>
        <div class="relative w-full sm:w-64">
            <input
                type="text"
                id="searchInput"
                placeholder="Search products..."
                class="search-input w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
            <svg class="search-icon w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>
</div>

<main class="max-w-7xl mx-auto px-4 pb-12">
    <div class="table-section bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <table class="w-full text-left" id="productsTable">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-bold tracking-wider">
            <tr>
                <th class="p-5">
                    <button class="sort-header flex items-center gap-2 hover:text-gray-700 transition" data-sort="name">
                        Product Name
                        <span class="sort-arrow">↕</span>
                    </button>
                </th>
                <th class="p-5">
                    <button class="sort-header flex items-center gap-2 hover:text-gray-700 transition"
                            data-sort="quantity">
                        Quantity
                        <span class="sort-arrow">↕</span>
                    </button>
                </th>
                <th class="p-5">
                    <button class="sort-header flex items-center gap-2 hover:text-gray-700 transition"
                            data-sort="price">
                        Price
                        <span class="sort-arrow">↕</span>
                    </button>
                </th>
                <th class="p-5">
                    <button class="sort-header flex items-center gap-2 hover:text-gray-700 transition"
                            data-sort="status">
                        Status
                        <span class="sort-arrow">↕</span>
                    </button>
                </th>
                <th class="p-5 text-center">
                    <button class="sort-header flex items-center gap-2 hover:text-gray-700 transition mx-auto"
                            data-sort="date">
                        Date
                        <span class="sort-arrow">↕</span>
                    </button>
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @forelse ($orders as $order)

                @forelse ($order->items as $item)
                    <tr class="hover:bg-gray-50 transition product-row"
                        data-status="{{ $order->status }}"
                        data-name="{{ $item->product->name }}"
                        data-quantity="{{ $item->quantity }}"
                        data-price="{{ $item->product->price * $item->quantity }}"
                        data-date="{{ $order->updated_at }}"
                    >
                        <td class="p-5 font-bold text-gray-800">
                            {{ $item->product->name }}
                        </td>

                        <td class="p-5 text-gray-600">
                            {{ $item->quantity }}
                        </td>

                        <td class="p-5 text-sm text-gray-600">
                            {{ $item->product->price * $item->quantity }}
                            <span class="text-blue-500 font-semibold ml-1">tks</span>
                        </td>

                        <td class="p-5">
                <span @class([
                    'status-badge text-sm font-medium px-2 py-1 rounded',
                    'text-yellow-600 bg-yellow-50' => $order->status === 'pending',
                    'text-green-600 bg-green-50' => $order->status === 'approved',
                    'text-red-600 bg-red-50' => $order->status === 'rejected',
                ])>
                    {{ $order->status }}
                </span>
                        </td>

                        <td class="p-5 text-center">
                            {{ $order->updated_at }}
                        </td>
                    </tr>

                @empty
                    {{-- order exists but has NO items --}}
                @endforelse

            @empty
                {{-- user has NO orders --}}
                <tr id="emptyRow">
                    <td colspan="5" class="p-10 text-center text-gray-400 italic">
                        <div class="flex flex-col items-center">
                            <span class="empty-icon text-4xl mb-2">🛒</span>
                            <p>You haven't bought any products recently.</p>
                            <a href="{{ route('shop.index') }}" class="text-blue-600 text-sm hover:underline mt-2">Browse Catalog</a>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- No results message (hidden by default) -->
        <div id="noResults" class="p-10 text-center text-gray-400 italic hidden">
            <div class="flex flex-col items-center">
                <span class="text-4xl mb-2">🔍</span>
                <p>No products found matching your search.</p>
            </div>
        </div>
    </div>
</main>


<script src="{{ asset('js/member.js') }}"></script>

</body>

</html>
