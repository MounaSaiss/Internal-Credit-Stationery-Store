@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
        <div class="max-w-4xl w-full mx-auto">

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-white">
                    <h1 class="text-4xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h1>
                    <p class="text-blue-100 text-lg">You are logged in as a <span
                            class="font-bold uppercase">{{ Auth::user()->role }}</span>.</p>
                </div>

                <div class="p-8">
                    <p class="text-gray-600 mb-6 text-lg">
                        This is your personal dashboard home. Select where you want to go next:
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('products.index') }}"
                                class="group block p-6 border rounded-xl hover:shadow-lg transition bg-purple-50 border-purple-100 hover:bg-purple-100">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-purple-600 font-bold group-hover:translate-x-1 transition">Go →</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Manage Products</h3>
                                <p class="text-gray-500 mt-2">Add, edit, or remove products from the inventory.</p>
                            </a>

                            <a href="{{ route('dashboard') }}"
                                class="group block p-6 border rounded-xl hover:shadow-lg transition bg-white hover:bg-gray-50 border-gray-100">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-gray-400 group-hover:translate-x-1 transition">Go →</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Sales Statistics</h3>
                                <p class="text-gray-500 mt-2">Analyze what users are shopping and view trends.</p>
                            </a>
                        @else
                            <a href="{{ route('shop.index') }}"
                                class="group block p-6 border rounded-xl hover:shadow-lg transition bg-blue-50 border-blue-100 hover:bg-blue-100">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-blue-600 font-bold group-hover:translate-x-1 transition">Go →</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Browse Shop</h3>
                                <p class="text-gray-500 mt-2">Explore our collection and start shopping.</p>
                            </a>

                            <a href="{{ route('user.profile', ['userId' => Auth::user()->id]) }}"
                                class="group block p-6 border rounded-xl hover:shadow-lg transition bg-green-50 border-green-100 hover:bg-green-100">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-green-600 font-bold group-hover:translate-x-1 transition">Go →</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">My Profile</h3>
                                <p class="text-gray-500 mt-2">Manage your personal information and settings.</p>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="bg-gray-50 p-4 border-t text-center">
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-red-500 hover:text-red-700 font-semibold hover:underline text-sm">
                            Log out from system
                        </button>
                    </form>
                </div>
            </div>

            <p class="text-center text-gray-400 text-sm">Project Management System &copy; 2026</p>
        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
@endsection
