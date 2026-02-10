<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Statistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* لتجنب تداخل تنسيقات Tailwind مع أزرار Bootstrap */
        .btn {
            display: inline-flex;
            align-items: center;
        }
    </style>
</head>

<body class="bg-light">

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-2">
                    <div class="h-8 w-8 bg-blue-600 rounded-lg flex items-center justify-center shadow-sm">
                        <span class="text-white font-bold text-sm">TC</span>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900">Products Store</span>
                </div>

                <div class="flex items-center gap-3">

                    <a href="{{ route('products.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 hover:border-blue-300 font-bold rounded-lg transition-all text-sm no-underline">
                        <span
                            class="mr-2 bg-blue-200 text-blue-700 rounded-full w-5 h-5 flex items-center justify-center text-xs">
                            +
                        </span>
                        Nouveau Produit
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="ml-2 mb-0">
                        @csrf
                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition"
                            title="Déconnexion">
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

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark mb-1">Sales Statistics</h2>
                <p class="text-secondary mb-0">Detailed breakdown of product sales.</p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('products.index') }}" class="btn btn-outline-dark rounded-pill px-4 fw-bold">
                    <i class="fas fa-box me-2"></i> Manage Products
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold m-0 text-dark">
                    <i class="fas fa-chart-pie me-2 text-primary"></i> Transactions Report
                </h5>
                <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill">
                    Total: {{ $orders->total() }} Orders
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 text-secondary text-uppercase py-3 small fw-bold">Order ID</th>
                            <th class="text-secondary text-uppercase py-3 small fw-bold">Buyer</th>
                            <th class="text-secondary text-uppercase py-3 small fw-bold">Role / Status</th>
                            <th class="text-secondary text-uppercase py-3 small fw-bold">Products</th>
                            <th class="text-center text-secondary text-uppercase py-3 small fw-bold">Qty</th>
                            <th class="text-end text-secondary text-uppercase py-3 small fw-bold">Total</th>
                            <th class="text-end pe-4 text-secondary text-uppercase py-3 small fw-bold">Date</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @foreach ($orders as $order)
                            <tr onclick="window.location='{{ route('admin.show', $order->id) }}'"
                                style="cursor: pointer;" title="Click to view details">

                                <td class="ps-4 fw-semibold text-secondary">
                                    #{{ $order->code ?? $order->id }}
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary-subtle text-primary fw-bold d-flex align-items-center justify-content-center me-3"
                                            style="width: 40px; height: 40px;">
                                            {{ substr($order->user->name ?? 'U', 0, 1) }}
                                        </div>
                                        <span class="fw-semibold text-dark">{{ $order->user->name ?? 'Unknown' }}</span>
                                    </div>
                                </td>

                                <td>
                                    @php
                                        $role = $order->user->role ?? 'Customer';
                                        $badgeClass = match ($role) {
                                            'admin' => 'bg-danger-subtle text-danger border border-danger-subtle',
                                            'manager' => 'bg-info-subtle text-info-emphasis border border-info-subtle',
                                            default => 'bg-success-subtle text-success border border-success-subtle',
                                        };
                                    @endphp
                                    <span class="badge rounded-pill {{ $badgeClass }} px-3 py-2 fw-bold">
                                        {{ ucfirst($role) }}
                                    </span>
                                </td>

                                <td>
                                    @foreach ($order->items as $item)
                                        @if ($item->product)
                                            <div
                                                class="bg-white border rounded px-2 py-1 mb-1 d-inline-block text-secondary small">
                                                {{ $item->product->name }}
                                            </div>
                                            <br>
                                        @endif
                                    @endforeach
                                </td>

                                <td class="text-center">
                                    @foreach ($order->items as $item)
                                        <span
                                            class="badge bg-secondary-subtle text-secondary rounded-circle d-inline-flex align-items-center justify-content-center mb-1"
                                            style="width: 25px; height: 25px;">
                                            {{ $item->quantity }}
                                        </span>
                                        <br>
                                    @endforeach
                                </td>

                                <td class="text-end fw-bold text-dark">
                                    {{ number_format($order->total_price) }} Tks
                                </td>

                                <td class="text-end pe-4 text-secondary small">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ $order->created_at->format('d M Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white border-top p-4 d-flex justify-content-center">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

</body>

</html>
