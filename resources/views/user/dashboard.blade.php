@php
    $cart = session('cart', []);
    $cartTotal = 0;
    foreach ($cart as $item) {
        $cartTotal += $item['price'] * $item['quantity'];
    }

    $cartCount = count($cart);
@endphp
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TechCorp Store</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon"
          href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛍️</text></svg>">

</head>

<body class="bg-gray-50">

<!-- Navigation -->
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
                       class="border-b-2 border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 text-sm font-medium">
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
                        class="font-bold {{ $user->token  <= 0 ? 'text-red-600' : 'text-blue-600' }} text-base leading-tight">
                        {{ number_format($user->token ) }} <span class="text-xs opacity-70">Tks</span>
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
                            class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-[10px] font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-red-600 rounded-full">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                <div class="flex items-center pl-4 border-l border-gray-100 space-x-3 relative">
                    <div class="hidden md:flex flex-col items-end">
                        <a href="{{ route('user.profile', ['userId' => Auth::user()->id]) }}"
                           class="text-sm font-semibold text-gray-900 hover:text-blue-600 transition">
                            {{ Auth::user()->name }}
                        </a>
                        <p class="text-[11px] text-gray-500">{{ Auth::user()->role }}
                            • {{ Auth::user()->department }}</p>
                    </div>

                    <!-- Profile Dropdown -->
                    <div class="relative" id="profileDropdown">
                        <button
                            onclick="toggleDropdown()"
                            class="bg-blue-600 text-white w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold shadow-sm hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="dropdownMenu"
                             class="hidden absolute right-0 mt-2 w-56 rounded-xl bg-white shadow-lg ring-1 ring-black ring-opacity-5 z-50">
                            <div class="py-1">
                                <!-- User Info Header -->
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ Auth::user()->email }}</p>
                                </div>

                                <!-- Menu Items -->
                                <div class="py-1">
                                    <a href="{{ route('user.profile', ['userId' => Auth::user()->id]) }}"
                                       class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                        <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        My Profile
                                    </a>

                                    <a href="{{ route('user.orders') }}"
                                       class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                        <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                        </svg>
                                        My Orders
                                    </a>

                                    <a href="{{ route('user.settings', ['userId' => Auth::user()->id]) }}"
                                       class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                        <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        Settings
                                    </a>

                                    <a href="#"
                                       class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                        <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Help & Support
                                    </a>
                                </div>

                                <!-- Logout Section -->
                                <div class="border-t border-gray-100 py-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                                class="flex items-center w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors">
                                            <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
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

<!-- Welcome Section -->
<div class="bg-white border-b border-gray-200 mb-8 page-header">
    <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Hello, {{ Auth::user()->name }} 👋</h1>
        <p class="text-gray-600">Here's an overview of your TechCorp Store account</p>
    </div>
</div>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Token Balance Card -->
    <div class="mb-8 animate-fade-in-up" style="animation-delay: 0.1s;">
        <div class="token-card rounded-2xl p-8 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 h-32 w-32 rounded-full bg-white opacity-10"></div>
            <div class="absolute bottom-0 left-0 -mb-8 -ml-8 h-40 w-40 rounded-full bg-white opacity-10"></div>
            <div class="shimmer-effect absolute inset-0 pointer-events-none"></div>
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <p class="text-blue-100 text-sm font-medium mb-2">Available Balance</p>
                        <h2 class="text-5xl font-bold mb-1 animate-scale-in">
                            <span id="balance-counter" class="balance-number">0</span>
                        </h2>
                        <p class="text-blue-100 text-sm">Tokens</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-xl p-3">
                        <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9" stroke-width="2"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 8h6m-3 0v8"/>
                        </svg>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <button onclick="location.href='{{ route('shop.index') }}'"
                            class="flex-1 bg-white text-purple-600 font-semibold py-3 px-4 rounded-xl hover:bg-gray-50 transition-colors shadow-lg">
                        Shop Now
                    </button>
                    <button
                        onclick="location.href='{{ route('user.profile', ['userId' => Auth::user()->id]) }}'"
                        class="flex-1 bg-white bg-opacity-20 backdrop-blur text-blue-600 font-semibold py-3 px-4 rounded-xl hover:bg-opacity-30 transition-colors">
                        View History
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Stats Cards -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Statistics Overview -->
            <div class="grid sm:grid-cols-3 gap-4 animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="stat-card card-hover rounded-xl border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="bg-blue-100 rounded-lg p-2">
                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">{{ $ordertotal }}</p>
                    <p class="text-sm text-gray-600">Order{{ $ordertotal > 1 ? 's' : '' }} This Month</p>
                </div>

                <div class="stat-card card-hover rounded-xl border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="bg-green-100 rounded-lg p-2">
                            <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">{{ 1000 - ($user->token) }}</p>
                    <p class="text-sm text-gray-600">Token{{ 1000 - ($user->token) > 1 ? 's' : '' }} Spent</p>
                </div>

                <div class="stat-card card-hover rounded-xl border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="bg-purple-100 rounded-lg p-2">
                            <svg class="h-5 w-5 text-yellow-500" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">{{ $pendingOrders }}</p>
                    <p class="text-sm text-gray-600">Pending Order{{ $pendingOrders > 1 ? 's' : '' }}</p>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden animate-fade-in-up"
                 style="animation-delay: 0.4s;">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Orders</h3>
                </div>

                @forelse($recentOrders as $order)
                    <div onclick="location.href='{{ route('user.purchases',['order_id' => $order->code ])  }}'"
                         class="px-6 py-4 hover:bg-gray-50 transition-colors cursor-pointer">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-3">
                                <div class="bg-blue-100 rounded-lg p-2">
                                    <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900 hover:text-blue-600 transition">{{ $order->code }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                        <span
                                        @class([
                                            'text-sm font-medium px-2 py-1 rounded-full',
                                            'text-yellow-600 bg-yellow-50' => $order->status === 'pending',
                                            'text-green-600 bg-green-50' => $order->status === 'approved',
                                            'text-red-600 bg-red-50' => $order->status === 'rejected',
                                        ])>
                                            {{ $order->status }}
                                        </span>
                                <p class="text-sm font-semibold text-gray-900 mt-1">
                                    {{ $order->items->count() }} Product{{ $order->items->count() > 1 ? 's' : '' }}</p>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="px-6 py-8 text-center">
                        <p class="text-gray-500">No recent orders found.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="space-y-6 animate-fade-in-up" style="animation-delay: 0.6s;">
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('shop.index') }}"
                       class="flex items-center justify-between p-3 rounded-lg hover:bg-blue-50 transition-colors group">
                        <div class="flex items-center space-x-3">
                            <div class="bg-blue-100 rounded-lg p-2 group-hover:bg-blue-200 transition-colors">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900">Browse Shop</span>
                        </div>
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>

                    <a href="{{ route('user.profile', ['userId' => Auth::user()->id]) }}"
                       class="flex items-center justify-between p-3 rounded-lg hover:bg-purple-50 transition-colors group">
                        <div class="flex items-center space-x-3">
                            <div class="bg-purple-100 rounded-lg p-2 group-hover:bg-purple-200 transition-colors">
                                <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900">Full History</span>
                        </div>
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-purple-600 transition-colors" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>

                    <a href="{{ route('user.purchases', ['userId' => Auth::user()->id]) }}"
                       class="flex items-center justify-between p-3 rounded-lg hover:bg-green-50 transition-colors group">
                        <div class="flex items-center space-x-3">
                            <div class="bg-green-100 rounded-lg p-2 group-hover:bg-green-200 transition-colors">
                                <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900">My Transactions</span>
                        </div>
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-green-600 transition-colors" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl border border-amber-200 p-6">
                <div class="flex items-start space-x-3">
                    <div class="bg-amber-100 rounded-lg p-2">
                        <svg class="h-5 w-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1">Notice</h4>
                        <p class="text-sm text-gray-700">Premium items require manager approval. Please allow 24-48
                            hours processing time.</p>
                    </div>
                </div>
            </div>
        </div>
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

    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('profileDropdown');
        const dropdownMenu = document.getElementById('dropdownMenu');

        if (!dropdown.contains(event.target) && !dropdownMenu.classList.contains('hidden')) {
            dropdownMenu.classList.add('hidden');
        }
    });

    function animateCounter(element, target, duration = 2000) {
        const start = 0;
        const increment = target / (duration / 16); // 60 FPS
        let current = start;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target.toLocaleString();
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current).toLocaleString();
            }
        }, 16);
    }

    window.addEventListener('load', () => {
        const balanceElement = document.getElementById('balance-counter');
        animateCounter(balanceElement, {{ $user->token }}, 800);
    });
</script>

</body>

</html>
