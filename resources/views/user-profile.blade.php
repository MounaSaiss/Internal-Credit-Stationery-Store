<x-layout title="My Profile">

    @if (session('success'))
        <div id="success-message"
             class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-md rounded" role="alert">
            <div class="flex items-center">
                <div class="py-1">
                    <svg class="fill-current h-6 w-6 text-green-500 mr-4"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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
    <div class="max-w-5xl mx-auto">

        <a href="{{ route('home') }}"
           class="inline-flex items-center mb-6 text-gray-600 hover:text-blue-600 transition">
            <span class="mr-2">←</span> Back to Home
        </a>

        <div class="bg-white rounded-xl shadow-md p-8 mb-10 flex items-center gap-8">
            <div
                class="bg-blue-600 text-white w-24 h-24 rounded-full flex items-center justify-center text-4xl font-bold shadow-lg">
                {{ substr($user->name,0,1) }}
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-1">{{ $user->name }}</h1>
                <p class="text-gray-500 mb-3">{{ $user->email }}</p>
                <div class="flex gap-2">
                    <span
                        class="bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1 rounded-full border border-blue-200">
                        Department: {{ $user->department }}
                    </span>
                    <span
                        class="bg-purple-50 text-purple-700 text-xs font-bold px-3 py-1 rounded-full border border-purple-200">
                        Role: {{ $user->role }}
                    </span>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-end mb-6">
            <h2 class="text-2xl font-bold text-gray-800"> My Purchased products</h2>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="p-5">Product Name</th>
                    <th class="p-5">Quantity</th>
                    <th class="p-5">Price</th>
                    <th class="p-5">Status</th>
                    <th class="p-5 text-center">Date</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                    @foreach ($order->items as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-5 font-bold text-gray-800">
                                {{ $item->product->name }}
                            </td>

                            <td class="p-5 text-gray-600">
                                {{ $item->quantity }}
                            </td>

                            <td class="p-5 text-sm text-gray-600">
                                {{ ($item->product->price)*($item->quantity) }} $
                            </td>

                            <td class="p-5">
                <span @class([
                    'text-sm font-medium px-2 py-1 rounded',
                    'text-yellow-600 bg-yellow-50' => $item->status === 'waiting',
                    'text-green-600 bg-green-50'  => $item->status === 'valid',
                    'text-red-600 bg-red-50'      => $item->status === 'rejected',
                ])>
                    {{ $item->status }}
                </span>
                            </td>

                            <td class="p-5 text-center">
                                {{ $order->updated_at }}
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td class="p-10 text-center text-gray-400 italic" colspan="5">
                            <div class="flex flex-col items-center"><span class="text-4xl mb-2">🛒</span>
                                <p>You haven't bought any products recently.</p> <a href=""
                                                                                    class="text-blue-600 text-sm hover:underline mt-2">Browse
                                    Catalog</a></div>
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

    </div>
    <script src="{{ asset('js/member.js') }}"></script>

</x-layout>
