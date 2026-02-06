<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #eef1f6;
        }

        /* Header */
        .dashboard-header {
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            color: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            font-weight: bold;
            letter-spacing: 1px;
        }

        /* Card */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .06);
        }

        /* Table */
        .table thead {
            background: #f3f4f6;
        }

        .table tbody tr:hover {
            background: #f9fafb;
            transition: 0.2s;
        }

        /* Product list */
        .product-item {
            background: #f8fafc;
            padding: 6px 10px;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        /* Quantity badge */
        .qty-badge {
            font-size: 14px;
            padding: 6px 10px;
            border-radius: 20px;
        }

        /* Total price */
        .total-price {
            font-weight: bold;
            color: #16a34a;
            font-size: 17px;
        }
    </style>
</head>

<body>

    <div class="container mt-4">
        <div class="dashboard-header fs-3">
            Product Sales Statistics Dashboard
        </div>

        <div class="text-white fs-4 p-3 mt-3 text-center rounded" style="background:#7c3aed;">
            Buyers Activity
        </div>

        <div class="card mt-4">
            <div class="card-body">

                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Buyer ID</th>
                            <th>Buyer Name</th>
                            <th>Role</th>
                            <th>Products</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Purchase Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($ordersRow as $row)
                            <tr>
                                <td>{{ $row['id'] }}</td>

                                <td class="fw-semibold">
                                    {{ $row['Buyer Name'] }}
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $row['Buyer Role'] }}
                                    </span>
                                </td>

                                <td>
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($row['Products'] as $product)
                                            <li class="product-item">
                                                {{ $product['Product Name'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>

                                <td>
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($row['Products'] as $product)
                                            <li class="mb-1">
                                                <span class="badge bg-success qty-badge">
                                                    {{ $product['Quantity'] }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>

                                <td class="total-price">
                                    {{ $row['Total Price'] }}$
                                </td>

                                <td>{{ $row['Purchase Date'] }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</body>

</html>