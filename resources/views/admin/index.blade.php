<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Statistics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-light" style="font-family: 'Inter', sans-serif;">

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
                                        <div
                                            class="bg-white border rounded px-2 py-1 mb-1 d-inline-block text-secondary small">
                                            {{ $item->product->name }}
                                        </div>
                                        <br>
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
