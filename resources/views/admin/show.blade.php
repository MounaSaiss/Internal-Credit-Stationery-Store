<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details #{{ $order->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Reuse main CSS */
        :root {
            --primary-color: #4f46e5;
            --bg-color: #f1f5f9;
            --card-bg: #ffffff;
            --text-dark: #1e293b;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Inter', sans-serif;
        }

        .dashboard-card {
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .back-link {
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .back-link:hover {
            color: var(--primary-color);
        }

        /* Product Item Row */
        .item-row {
            display: flex;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 60px;
            height: 60px;
            background: #f1f5f9;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            margin-right: 16px;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            color: var(--text-dark);
            display: block;
        }

        .item-meta {
            font-size: 0.85rem;
            color: #64748b;
        }

        /* Summary Section */
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 0.95rem;
            color: #64748b;
        }

        .summary-total {
            border-top: 1px solid #e2e8f0;
            margin-top: 10px;
            padding-top: 15px;
            font-weight: 700;
            color: var(--text-dark);
            font-size: 1.2rem;
        }
    </style>
</head>

<body>

    <div class="container py-5">

        <a href="{{ route('admin.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Orders
        </a>

        <div class="row">
            <div class="col-lg-8">
                <div class="dashboard-card">
                    <div class="p-4 border-bottom bg-gray-50">
                        <h5 class="m-0 fw-bold text-dark">Order Items <span
                                class="badge bg-primary rounded-pill ms-2">{{ $order->items->count() }}</span></h5>
                    </div>

                    <div class="p-0">
                        @foreach ($order->items as $item)
                            <div class="item-row">
                                <div class="item-image">
                                    @if ($item->product->image)
                                        <img src="{{ asset('images/' . $item->product->image) }}"
                                            alt="{{ $item->product->name }}"
                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                                    @else
                                        <i class="fas fa-box fa-lg text-secondary"></i>
                                    @endif
                                </div>
                                <div class="item-details">
                                    <span class="item-name">{{ $item->product->name }}</span>
                                    <span class="item-meta">Unit Price:
                                        {{ $item->token_price ?? $item->price }}Tks</span>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold text-dark">x {{ $item->quantity }}</div>
                                    <div class="text-primary fw-bold">
                                        {{ ($item->token_price ?? $item->price) * $item->quantity }} Tks</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-4">

                <div class="dashboard-card p-4">
                    <h6 class="text-uppercase text-muted small fw-bold mb-3">Customer Details</h6>
                    <div class="d-flex align-items-center mb-3">
                        <div
                            style="width: 40px; height: 40px; background: #e0e7ff; color: #4f46e5; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; margin-right: 12px;">
                            {{ substr($order->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="fw-bold text-dark">{{ $order->user->name }}</div>
                            <div class="small text-muted">ID: #{{ $order->user->id }}</div>
                        </div>
                    </div>
                    <div class="small text-muted">
                        <i class="fas fa-envelope me-2"></i> {{ $order->user->email }}<br>
                        <i class="fas fa-building me-2"></i> {{ $order->user->department ?? 'N/A' }}
                    </div>
                </div>

                <div class="dashboard-card p-4">
                    <h6 class="text-uppercase text-muted small fw-bold mb-3">Order Summary</h6>

                    <div class="summary-row">
                        <span>Order ID</span>
                        <span class="font-monospace text-dark">#{{ $order->code ?? $order->id }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Date</span>
                        <span>{{ $order->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Status</span>
                        <span class="badge {{ $order->status == 'approved' ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="summary-row summary-total">
                        <span>Grand Total</span>
                        <span class="text-primary">{{ number_format($order->total_price) }} Tks</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
