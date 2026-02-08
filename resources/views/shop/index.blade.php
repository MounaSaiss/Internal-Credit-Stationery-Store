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
    <title>Catalogue - TechCorp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="icon"
          href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛍️</text></svg>">

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
                    <a href="{{ route('user.dashboard', ['userId' => Auth::user()->id]) }}" class="border-b-2 border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 text-sm font-medium transition">
                        Dashboard
                    </a>
                    <a href="{{ route('shop.index') }}" class="border-b-2 border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 text-sm font-medium">
                        Shop
                    </a>
                    <a href="{{  route('user.orders',['userId' => Auth::user()->id]) }}" class="border-b-2 border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 text-sm font-medium transition">
                        My Orders
                    </a>
                </div>
            </div>

            <div class="flex items-center space-x-4">

                <div class="hidden lg:flex flex-col items-end border-r border-gray-200 pr-4">
                    <span class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Balance</span>
                    <span class="font-bold {{ $remainingBalance <= 0 ? 'text-red-600' : 'text-blue-600' }} text-base leading-tight">
                        {{ number_format($remainingBalance) }} <span class="text-xs opacity-70">Tks</span>
                    </span>
                </div>

                <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-400 hover:text-blue-600 transition">
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
                        <a href="{{ route('user.profile', ['userId' => Auth::user()->id]) }}" class="text-sm font-semibold text-gray-900 hover:text-blue-600 transition">
                            {{ Auth::user()->name }}
                        </a>
                        <p class="text-[11px] text-gray-500">{{ Auth::user()->role }} • {{ Auth::user()->department }}</p>
                    </div>
                    <div class="relative" id="profileDropdown">
                        <button
                            onclick="toggleDropdown()"
                            class="bg-blue-600 text-white w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold shadow-sm hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-56 rounded-xl bg-white shadow-lg ring-1 ring-black ring-opacity-5 z-50">
                            <div class="py-1">
                                <!-- User Info Header -->
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ Auth::user()->email }}</p>
                                </div>

                                <!-- Menu Items -->
                                <a href="{{ route('user.profile', ['userId' => Auth::user()->id]) }}"
                                   class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    My Profile
                                </a>

                                <a href="{{ route('user.orders') }}"
                                   class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                    My Orders
                                </a>

                                <a href="{{ route('user.settings', ['userId' => Auth::user()->id]) }}"
                                   class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Settings
                                </a>

                                <a href="#"
                                   class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Help & Support
                                </a>

                                <div class="border-t border-gray-100 mt-1 pt-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                                class="flex items-center w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                            <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                            </svg>
                                            Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</nav>

<div class="bg-white border-b border-gray-200 mb-8 page-header">
    <div
        class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Catalogue Produits</h1>
            <p class="text-sm text-gray-500 mt-1">Sélectionnez les équipements nécessaires pour votre département.
            </p>
        </div>
        <div class="relative w-full sm:w-64">
            <input type="text" placeholder="Rechercher..."
                   class="search-input w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>
</div>

<main class="max-w-7xl mx-auto px-4 pb-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        @foreach ($products as $product)
            <div
                class="product-card group bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md hover:border-blue-400 transition-all duration-300 flex flex-col overflow-hidden relative">

                <a href="{{ route('shop.show', $product->id) }}"
                   class="block relative h-48 bg-gray-50 overflow-hidden border-b border-gray-100">
                    <div class="relative h-48 bg-gray-50 overflow-hidden border-b border-gray-100">
                        @if ($product->image)
                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-300">
                                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif

                        @if ($product->type === 'premium')
                            <div
                                class="premium-badge absolute top-3 left-3 backdrop-blur-sm text-yellow-400 text-[10px] font-bold px-2 py-1 rounded shadow-sm flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-current"
                                     viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                PREMIUM
                            </div>
                        @endif
                    </div>
                </a>

                <div class="p-4 flex-1 flex flex-col">
                    <div class="mb-3">
                        <a href="{{ route('shop.show', $product->id) }}">
                            <h3
                                class="text-base font-bold text-gray-900 mb-1 leading-tight hover:text-blue-600 transition-colors">
                                {{ $product->name }}</h3>
                        </a>
                        <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $product->description }}</p>
                    </div>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST"
                          class="mt-auto pt-3 border-t border-gray-50 flex items-center justify-between gap-3">
                        @csrf

                        <div class="flex flex-col">
                            <span class="text-lg font-bold text-gray-900">{{ $product->price }}</span>
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wide">Tokens</span>
                        </div>

                        <button type="submit"
                                class="add-to-cart-btn bg-gray-900 hover:bg-blue-600 text-white text-xs font-bold px-4 py-2 rounded-lg transition-colors shadow-sm flex items-center gap-2">
                            <span>Ajouter</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach

    </div>

    <div class="mt-12 flex justify-center">
        {{ $products->links() }}
    </div>
</main>

<script>

    function toggleDropdown() {
        const dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('hidden');

        if (!dropdown.classList.contains('hidden')) {
            dropdown.classList.add('dropdown-enter');
        }
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('profileDropdown');
        const dropdownMenu = document.getElementById('dropdownMenu');

        if (!dropdown.contains(event.target) && !dropdownMenu.classList.contains('hidden')) {
            dropdownMenu.classList.add('hidden');
        }
    });

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

<script src="{{ asset('js/shop.js') }}"></script>
</body>

</html>
