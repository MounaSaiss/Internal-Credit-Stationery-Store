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
    <title>My Profile - Settings</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon"
          href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>⚙️</text></svg>">

</head>

<body class="antialiased bg-gray-50 text-gray-800 font-figtree min-h-screen">
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
                    <a href="{{ route('user.dashboard', ['username' => Auth::user()->name]) }}"
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
                        <a href="{{ route('user.profile', ['username' => Auth::user()->name]) }}"
                           class="text-sm font-semibold text-gray-900 hover:text-blue-600 transition">
                            {{ Auth::user()->name }}
                        </a>
                        <p class="text-[11px] text-gray-500">{{ Auth::user()->role }}
                            • {{ Auth::user()->department }}</p>
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

<!-- Alert Messages -->
@if (session('success'))
    <div class="max-w-4xl mx-auto mt-6 px-4">
        <div class="alert-message bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-md rounded"
             role="alert">
            <div class="flex items-center">
                <svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 20 20">
                    <path
                        d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                </svg>
                <div>
                    <p class="font-bold">Success!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="max-w-4xl mx-auto mt-6 px-4">
        <div class="alert-message bg-red-100 border-l-4 border-red-500 text-red-700 p-4 shadow-md rounded"
             role="alert">
            <div class="flex items-center">
                <svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 20 20">
                    <path
                        d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 5h2v6H9V5zm0 8h2v2H9v-2z"/>
                </svg>
                <div>
                    <p class="font-bold">Error!</p>
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="max-w-4xl mx-auto px-4 py-8">

    <!-- Page Header -->
    <div class="page-header mb-8">
        <div class="flex items-center gap-4 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <h1 class="text-3xl font-bold text-gray-800">Profile Settings</h1>
        </div>
        <p class="text-gray-500 ml-12">Manage your account information and preferences</p>
    </div>

    <!-- Profile Overview Card -->
    <div class="settings-card bg-white rounded-xl shadow-md p-6 mb-6">
        <div class="flex items-center gap-6">
            <div
                class="avatar bg-blue-600 text-white w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold shadow-lg">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
                <p class="text-gray-500 mt-1">{{ Auth::user()->email }}</p>
                <div class="flex gap-2 mt-3">
                    <span
                        class="badge bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1 rounded-full border border-blue-200">
                        {{ Auth::user()->role }}
                    </span>
                    <span
                        class="badge bg-purple-50 text-purple-700 text-xs font-bold px-3 py-1 rounded-full border border-purple-200">
                        {{ Auth::user()->department }}
                    </span>
                </div>
            </div>
            <div class="text-right">
                <span class="text-xs text-gray-400 uppercase font-bold tracking-wider block">Account Balance</span>
                <span class="text-2xl font-bold text-blue-600">
                    {{ number_format(Auth::user()->token) }} <span class="text-sm opacity-70">Tks</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Personal Information Form -->
    <div class="settings-card bg-white rounded-xl shadow-md p-6 mb-6">
        <div class="flex items-center gap-3 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <h3 class="text-xl font-bold text-gray-800">Personal Information</h3>
        </div>

        <form method="POST" action="">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ Auth::user()->name }}"
                           class="form-input w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ Auth::user()->email }}"
                           class="form-input w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                </div>

                <!-- Department -->
                <div>
                    <label for="department" class="block text-sm font-semibold text-gray-700 mb-2">Department</label>
                    <select id="department"
                            name="department"
                            class="form-input w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required>
                        <option value="IT" {{ Auth::user()->department === 'IT' ? 'selected' : '' }}>IT</option>
                        <option value="HR" {{ Auth::user()->department === 'HR' ? 'selected' : '' }}>HR</option>
                        <option value="Finance" {{ Auth::user()->department === 'Finance' ? 'selected' : '' }}>Finance</option>
                        <option value="Marketing" {{ Auth::user()->department === 'Marketing' ? 'selected' : '' }}>Marketing</option>
                        <option value="Sales" {{ Auth::user()->department === 'Sales' ? 'selected' : '' }}>Sales</option>
                        <option value="Operations" {{ Auth::user()->department === 'Operations' ? 'selected' : '' }}>Operations</option>
                    </select>
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                    <input type="text"
                           id="role"
                           name="role"
                           value="{{ Auth::user()->role }}"
                           class="form-input w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit"
                        class="btn bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Change Password Form -->
    <div class="settings-card bg-white rounded-xl shadow-md p-6 mb-6">
        <div class="flex items-center gap-3 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <h3 class="text-xl font-bold text-gray-800">Change Password</h3>
        </div>

        <form method="POST" action="">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">
                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">Current
                        Password</label>
                    <input type="password"
                           id="current_password"
                           name="current_password"
                           class="form-input w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                </div>

                <!-- New Password -->
                <div>
                    <label for="new_password" class="block text-sm font-semibold text-gray-700 mb-2">New
                        Password</label>
                    <input type="password"
                           id="new_password"
                           name="new_password"
                           class="form-input w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                </div>

                <!-- Confirm New Password -->
                <div>
                    <label for="new_password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm
                        New Password</label>
                    <input type="password"
                           id="new_password_confirmation"
                           name="new_password_confirmation"
                           class="form-input w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           required>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit"
                        class="btn bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md">
                    Update Password
                </button>
            </div>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="settings-card bg-white rounded-xl shadow-md border-2 border-red-200 p-6">
        <div class="flex items-center gap-3 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <h3 class="text-xl font-bold text-red-600">Danger Zone</h3>
        </div>

        <p class="text-gray-600 mb-4">Once you delete your account, there is no going back. Please be certain.</p>

        <button type="button"
                onclick="openDeleteModal()"
                class="delete-btn btn bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md">
            Delete Account
        </button>
    </div>

</div>

<!-- Delete Account Confirmation Modal -->
<div id="deleteModal" class="modal fixed inset-0 z-50">
    <div class="modal-backdrop fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="modal-content bg-white rounded-xl shadow-2xl max-w-md w-full p-6 fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <div class="flex items-center gap-3 mb-4">
                <div class="bg-red-100 rounded-full p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Delete Account?</h3>
            </div>

            <p class="text-gray-600 mb-6">
                Are you absolutely sure you want to delete your account? This action cannot be undone. All your data,
                orders, and balance will be permanently deleted.
            </p>

            <form method="POST" action="">
                @csrf
                @method('DELETE')

                <div class="mb-4">
                    <label for="confirm_password" class="block text-sm font-semibold text-gray-700 mb-2">
                        Enter your password to confirm
                    </label>
                    <input type="password"
                           id="confirm_password"
                           name="password"
                           class="form-input w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                           required>
                </div>

                <div class="flex gap-3 justify-end">
                    <button type="button"
                            onclick="closeDeleteModal()"
                            class="btn bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2.5 rounded-lg">
                        Cancel
                    </button>
                    <button type="submit"
                            class="btn bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md">
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
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

    function openDeleteModal() {
        document.getElementById('deleteModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('deleteModal')?.addEventListener('click', function(e) {
        if (e.target === this || e.target.classList.contains('modal-backdrop')) {
            closeDeleteModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('deleteModal').classList.contains('active')) {
            closeDeleteModal();
        }
    });
</script>

</body>

</html>
