<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Waiting Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6 md:p-10">

    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow">

        <h1 class="text-2xl font-bold mb-6 text-gray-800">
            ⏳ Waiting Orders
        </h1>

        <table class="w-full border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left uppercase text-gray-600">Product</th>
                    <th class="p-3 text-right uppercase text-gray-600">Price</th>
                    <th class="p-3 text-right uppercase text-gray-600">Quantity</th>
                    <th class="p-3 text-left uppercase text-gray-600">Buyer Role</th>
                    <th class="p-3 text-right uppercase text-gray-600">Buyer Tokens</th>
                    <th class="p-3 text-left uppercase text-gray-600">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($orderItems as $item)
                <tr class="border-t hover:bg-gray-50">

                    {{-- Product --}}
                    <td class="p-3 flex items-center gap-3">
                        @if($item->product)
                        <img src="{{ asset('storage/' . $item->product->image) }}"
                            class="h-12 w-12 rounded object-cover">
                        <span class="font-bold text-gray-800">
                            {{ $item->product->name }}
                        </span>
                        @else
                        <span class="text-red-500 font-semibold">Product deleted</span>
                        @endif
                    </td>

                    {{-- Price --}}
                    <td class="p-3 text-right font-semibold text-gray-700">
                        {{ $item->token_price }} Token
                    </td>

                    {{-- Quantity --}}
                    <td class="p-3 text-right text-gray-700">
                        {{ $item->quantity }}
                    </td>

                    {{-- User Role --}}
                    <td class="p-3 capitalize text-gray-700">
                        {{ $item->order?->user?->role ?? 'N/A' }}
                    </td>

                    {{-- User Tokens --}}
                    <td class="p-3 text-right font-bold text-blue-600">
                        {{ $item->order?->user?->token ?? 0 }}
                    </td>

                    {{-- Status + Actions --}}
                    <td class="p-3 flex flex-col md:flex-row gap-2 items-start md:items-center text-yellow-600 font-semibold">
                        <span>{{ ucfirst($item->status) }}</span>

                        @if($item->status === 'waiting')
                        <div class="flex gap-2 mt-2 md:mt-0">
                            <form action="{{ route('manager.orders.validate', $item) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                                    Validate
                                </button>
                            </form>

                            <form action="{{ route('manager.orders.refuse', $item) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                    Refuse
                                </button>
                            </form>
                        </div>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-500 font-medium">
                        No waiting orders
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</body>

</html>