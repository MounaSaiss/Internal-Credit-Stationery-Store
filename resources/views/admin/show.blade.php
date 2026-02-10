<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details #{{ $order->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
        }
    </style>
</head>

<body>
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm mb-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-2">
                    <div class="h-8 w-8 bg-blue-600 rounded-lg flex items-center justify-center shadow-sm">
                        <span class="text-white font-bold text-sm">TC</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900">Products Store</span>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.index') }}"
                        class="btn btn-outline-dark rounded-pill px-4 fw-bold shadow-sm text-sm">
                        <i class="fas fa-box me-2"></i> Sales Statistics
                    </a>

                    <a href="{{ route('products.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 hover:border-blue-300 font-bold rounded-lg transition-all text-sm no-underline">
                        <span
                            class="mr-2 bg-blue-200 text-blue-700 rounded-full w-5 h-5 flex items-center justify-center text-xs">+</span>
                        Nouveau Produit
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="mb-0 ml-2">
                        @csrf
                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition" title="Logout">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <a href="{{ route('admin.index') }}"
            class="inline-flex items-center text-slate-500 hover:text-blue-600 font-medium text-sm no-underline mb-4 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Back to Orders
        </a>

        <div class="row">
            <div class="col-lg-8">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-4">
                    <div class="p-4 border-b bg-slate-50 flex justify-between items-center">
                        <h5 class="m-0 font-bold text-slate-800">Order Items</h5>
                        <span class="badge bg-blue-600 rounded-pill">{{ $order->items->count() }} items</span>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @foreach ($order->items as $item)
                            @if ($item->product)
                                <div class="flex items-center p-4 hover:bg-slate-50 transition-colors">
                                    <div
                                        class="w-16 h-16 bg-slate-100 rounded-lg flex items-center justify-center overflow-hidden mr-4">
                                        @if ($item->product->image)
                                            <img src="{{ asset('images/' . $item->product->image) }}"
                                                alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <i class="fas fa-box text-slate-400"></i>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <span
                                            class="block font-semibold text-slate-900">{{ $item->product->name }}</span>
                                        <span class="text-sm text-slate-500">Unit Price:
                                            {{ $item->token_price ?? $item->price }} Tks</span>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-slate-900">x {{ $item->quantity }}</div>
                                        <div class="text-blue-600 font-bold">
                                            {{ ($item->token_price ?? $item->price) * $item->quantity }} Tks</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-4 mb-4">
                    <h6 class="uppercase text-slate-400 text-xs font-bold mb-4 tracking-wider">Customer Details</h6>
                    <div class="flex items-center mb-4">
                        <div
                            class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold mr-3">
                            {{ substr($order->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="font-bold text-slate-900">{{ $order->user->name }}</div>
                            <div class="text-xs text-slate-500">ID: #{{ $order->user->id }}</div>
                        </div>
                    </div>
                    <div class="text-sm text-slate-600 space-y-2">
                        <div class="flex items-center"><i class="fas fa-envelope w-5 text-slate-400"></i>
                            {{ $order->user->email }}</div>
                        <div class="flex items-center"><i class="fas fa-building w-5 text-slate-400"></i>
                            {{ $order->user->department ?? 'N/A' }}</div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-4">
                    <h6 class="uppercase text-slate-400 text-xs font-bold mb-4 tracking-wider">Order Summary</h6>

                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Order ID</span>
                            <span class="font-mono font-bold text-slate-900">#{{ $order->code ?? $order->id }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Date</span>
                            <span class="text-slate-900">{{ $order->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-slate-500">Status</span>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold {{ $order->status == 'approved' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex justify-between items-center">
                            <span class="font-bold text-slate-900 text-lg">Grand Total</span>
                            <span class="text-blue-600 font-extrabold text-xl">{{ number_format($order->total_price) }}
                                Tks</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
