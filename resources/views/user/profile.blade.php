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
    <title>Profile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛍️</text></svg>">

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
                        <span class="font-bold text-xl text-gray-900 tracking-tight">TechCorp <span
                                class="text-blue-600">Store</span></span>
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
                        @auth
                            @if (auth()->user()->role === 'manager')
                                <a href="{{ route('orders.waiting', ['userId' => Auth::user()->id]) }}"
                                    class="border-b-2 border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 text-sm font-medium transition">
                                    Pending orders
                                </a>

                                <a href="{{ route('manager.managerDashboard', ['userId' => Auth::user()->id]) }}"
                                    class="border-b-2 border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 text-sm font-medium transition">
                                    Team Statistic
                                </a>
                            @endif
                        @endauth
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

                    <a href="{{ route('cart.index') }}"
                        class="relative p-2 text-gray-400 hover:text-blue-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
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
                        <div class="relative" id="profileDropdown">
                            <button onclick="toggleDropdown()"
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
                                    <a href="{{ route('user.profile', ['userId' => Auth::user()->id]) }}"
                                        class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                        <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        My Profile
                                    </a>

                                    <a href="{{ route('user.orders') }}"
                                        class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                        <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                        My Orders
                                    </a>

                                    <a href="{{ route('user.settings', ['userId' => Auth::user()->id]) }}"
                                        class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                        <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Settings
                                    </a>

                                    <a href="#"
                                        class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                        <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Help & Support
                                    </a>

                                    <div class="border-t border-gray-100 mt-1 pt-1">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"
                                                class="flex items-center w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                                <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
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

    @if (session('success'))
        <div id="success-message"
            class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-md rounded" role="alert">
            <div class="flex items-center">
                <div class="py-1">
                    <svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Success!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif
    <div class="max-w-5xl mx-auto">

        <div class=" mb-6">
        </div>

        <div class="profile-card bg-white rounded-xl shadow-md p-8 mb-10 flex items-center gap-8">
            <div
                class="avatar bg-blue-600 text-white w-24 h-24 rounded-full flex items-center justify-center text-4xl font-bold shadow-lg">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1">{{ $user->name }}</h1>
                <p class="text-gray-500 mb-3">{{ $user->email }}</p>
                <div class="flex gap-2">
                    <span
                        class="badge bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1 rounded-full border border-blue-200">
                        Department: {{ $user->department }}
                    </span>
                    <span
                        class="badge bg-purple-50 text-purple-700 text-xs font-bold px-3 py-1 rounded-full border border-purple-200">
                        Role: {{ $user->role }}
                    </span>
                </div>
            </div>
        </div>

        <div class="table-header flex justify-between items-end mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Purchased products</h2>

            <!-- Search Bar -->
            <div class="relative">
                <input type="text" id="searchInput" placeholder="Search products..."
                    class="search-input pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                <svg class="search-icon absolute left-3 top-2.5 h-5 w-5 text-gray-400"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <div class="table-section bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <table class="w-full text-left" id="productsTable">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-bold tracking-wider">
                    <tr>
                        <th class="p-5">
                            <button class="sort-header flex items-center gap-2 hover:text-gray-700 transition"
                                data-sort="name">
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
                <tbody id="ordersTableBody" class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                        @foreach ($order->items as $item)
                            @if ($item->product)
                                <tr class="hover:bg-gray-50 transition product-row"
                                    data-status="{{ $order->status }}" data-name="{{ $item->product->name }}"
                                    data-quantity="{{ $item->quantity }}"
                                    data-price="{{ $item->product->price * $item->quantity }}"
                                    data-date="{{ $order->updated_at }}">
                                    <td class="p-5 font-bold text-gray-800 product-name">
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
                            @endif
                        @endforeach
                    @empty
                        <tr id="emptyRow">
                            <td class="p-10 text-center text-gray-400 italic" colspan="5">
                                <div class="flex flex-col items-center">
                                    <span class="empty-icon text-4xl mb-2">🛒</span>
                                    <p>You haven't bought any products recently.</p>
                                    <a href="{{ route('shop.index') }}"
                                        class="text-blue-600 text-sm hover:underline mt-2">Browse Catalog</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

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

        const searchInput = document.getElementById("searchInput");

        searchInput.addEventListener("input", function(event) {
            let value = event.target.value;
            fetch(`/user/purchases/search/${value}`)
                .then(res => {
                    if (res.ok) {
                        return res.json();
                    }
                })
                .then(data => {
                    renderData(data);
                })
        });

        const tableBody = document.getElementById("ordersTableBody");

        function renderData(data) {
            tableBody.innerHTML = "";

            if (data.length === 0) {
                tableBody.innerHTML = `
            <tr id="empty-state-row">
                <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                    <div class="flex flex-col items-center">
                        <span class="empty-icon text-4xl mb-2">🔍</span>
                        <p class="text-gray-500">No products found matching your search.</p>
                    </div>
                </td>
            </tr>
        `;
                return;
            }

            data.forEach(order => {
                order.items.forEach(item => {
                    const totalPrice = item.product.price * item.quantity;

                    tableBody.innerHTML += `
                <tr class="hover:bg-gray-50 transition product-row"
                    data-status="${order.status}"
                    data-name="${item.product.name}"
                    data-quantity="${item.quantity}"
                    data-price="${totalPrice}"
                    data-date="${order.updated_at}"
                >
                    <td class="p-5 font-bold text-gray-800 product-name">
                        ${item.product.name}
                    </td>

                    <td class="p-5 text-gray-600">
                        ${item.quantity}
                    </td>

                    <td class="p-5 text-sm text-gray-600">
                        ${totalPrice}
                        <span class="text-blue-500 font-semibold ml-1">tks</span>
                    </td>

                    <td class="p-5">
                        <span class="text-sm font-medium px-2 py-1 rounded
                            ${order.status === 'pending' ? 'text-yellow-600 bg-yellow-50' : ''}
                            ${order.status === 'approved' ? 'text-green-600 bg-green-50' : ''}
                            ${order.status === 'rejected' ? 'text-red-600 bg-red-50' : ''}">
                            ${order.status}
                        </span>
                    </td>

                    <td class="p-5 text-center">
                        ${new Date(order.updated_at).toLocaleDateString()}
                    </td>
                </tr>
            `;
                });
            });
        }
    </script>
    <script src="{{ asset('js/member.js') }}"></script>

</body>

</html>
