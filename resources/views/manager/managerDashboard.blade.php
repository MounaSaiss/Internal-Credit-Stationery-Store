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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50">

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
                            class="border-b-2 border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 text-sm font-medium">
                            Shop
                        </a>
                        <a href="{{ route('user.orders', ['userId' => Auth::user()->id]) }}"
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

    <div class="max-w-7xl mx-auto px-4 py-8">

        <div class="bg-white border border-slate-200 rounded-xl p-4 flex items-center justify-between shadow-sm mb-8">
            <div class="flex items-center gap-3">
                <div class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                    <i class="fas fa-id-badge text-xl"></i>
                </div>
                <div>
                    <span class="text-sm text-slate-500 block uppercase font-bold tracking-wider">Department</span>
                    <span class="text-xl font-bold text-slate-800">{{ $manager->department }}</span>
                </div>
            </div>
            <div class="hidden md:block">
                <span class="bg-blue-50 text-blue-700 px-4 py-2 rounded-full font-bold text-sm border border-blue-100">
                    <i class="fas fa-users mr-2"></i> {{ $employees->count() }} Employees
                </span>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <i class="fas fa-list-ul text-purple-500"></i>
                    Employee Information
                </h2>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 text-slate-500 text-xs uppercase tracking-widest border-b">
                                <th class="px-8 py-5 font-bold">Employee</th>
                                <th class="px-8 py-5 font-bold">Contact Info</th>
                                <th class="px-8 py-5 font-bold text-center">Role</th>
                                <th class="px-8 py-5 font-bold text-center">Tokens</th>
                                <th class="px-8 py-5 font-bold text-center">Total Orders</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse ($employees as $emp)
                                <tr class="hover:bg-slate-50/80 transition-all group">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center font-bold shadow-sm group-hover:scale-110 transition-transform">
                                                {{ strtoupper(substr($emp->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <span
                                                    class="block font-bold text-slate-800 text-base leading-tight">{{ $emp->name }}</span>
                                                <span class="text-xs text-slate-400 font-medium tracking-wide">ID:
                                                    #{{ $emp->id }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-2 text-slate-600">
                                            <i class="far fa-envelope text-slate-300"></i>
                                            <span class="font-medium">{{ $emp->email }}</span>
                                        </div>
                                    </td>

                                    <td class="px-8 py-5 text-center">
                                        <span
                                            class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black uppercase tracking-tighter border border-slate-200">
                                            {{ $emp->role }}
                                        </span>
                                    </td>

                                    <td class="px-8 py-5 text-center">
                                        <div
                                            class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 px-3 py-1 rounded-full border border-amber-100">
                                            <i class="fas fa-coins text-[10px]"></i>
                                            <span
                                                class="font-black text-sm">{{ number_format($emp->token ?? 0) }}</span>
                                        </div>
                                    </td>

                                    <td class="px-8 py-5 text-center">
                                        <div
                                            class="inline-flex items-center gap-2 bg-slate-100/50 border border-slate-200 px-3 py-1 rounded-xl transition-all duration-200 group-hover:border-indigo-200 group-hover:bg-indigo-50/50">
                                            <i
                                                class="fas fa-shopping-cart text-[10px] text-slate-400 group-hover:text-indigo-500 transition-colors"></i>

                                            <span
                                                class="text-sm font-bold text-slate-700 group-hover:text-indigo-600 transition-colors">
                                                {{ $emp->orders_count ?? 0 }}
                                            </span>

                                            <span
                                                class="text-[9px] font-semibold uppercase tracking-tighter text-slate-400 group-hover:text-indigo-400">
                                                Orders
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center">
                                        <div class="max-w-xs mx-auto">
                                            <div
                                                class="w-16 h-16 bg-slate-100 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <i class="fas fa-users-slash text-2xl"></i>
                                            </div>
                                            <h3 class="text-slate-800 font-bold text-lg leading-tight">No staff members
                                            </h3>
                                            <p class="text-slate-500 text-sm mt-1 text-balance">There are no employees
                                                assigned to the {{ $manager->department }} department yet.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</body>

</html>
