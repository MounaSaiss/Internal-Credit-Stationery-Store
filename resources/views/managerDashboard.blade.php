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

        .dashboard-header {
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            color: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .06);
        }

        .table thead {
            background: #f3f4f6;
        }

        .table tbody tr:hover {
            background: #f9fafb;
            transition: 0.2s;
        }

        .product-item {
            background: #f8fafc;
            padding: 6px 10px;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .qty-badge {
            font-size: 14px;
            padding: 6px 10px;
            border-radius: 20px;
        }

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
        Manager Dashboard
    </div>

    <div class="text-white fs-4 p-3 mt-3 text-center rounded" style="background:#7c3aed;">
        Employees in {{ $manager->department }} Department
    </div>

    <div class="card mt-4">
        <div class="card-body">

            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Manager ID</th>
                        <th>Manager Name</th>
                        <th>Department</th>
                        <th>Employees</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>{{ $manager->id }}</td>

                        <td class="fw-semibold">
                            {{ $manager->name }}
                        </td>

                        <td>
                            <span class="badge bg-secondary">
                                {{ $manager->department }}
                            </span>
                        </td>

                        <td>
                            @forelse ($employees as $emp)
                                <div class="product-item">
                                    {{ $emp->name }}
                                </div>
                            @empty
                                <span class="text-muted">No employees</span>
                            @endforelse
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>
    </div>
</div>

</body>
</html>
