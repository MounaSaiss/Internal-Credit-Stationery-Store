<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6f8;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .05);
        }

        .book-img {
            width: 50px;
            height: 70px;
            object-fit: cover;
        }
    </style>

</head>

<body>
    <div class="bg-primary fs-2 text-white p-4 text-center rounded">
        Product Sales Statistics Dashboard
    </div>
    <div class="text-white fs-3 p-4 mt-3 text-center rounded" style="background: #7c3aed;">
        Buyers Activity
    </div>



    <div class="container my-4">

        <div class="card mb-4">
            <div class="card-body">

                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Buyer ID</th>
                            <th>Buyer Name</th>
                            <th>Product Name</th>
                            <th>Buyer Role</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Purchase Date</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($ordersRow as $row)
                            <tr>
                                <td>{{ $row['id']}}</td>
                                <td>{{ $row['Buyer Name']}}</td>
                                <td>{{ $row['Product Name']}}</td>
                                <td>{{ $row['Buyer Role']}}</td>
                                <td><span class="badge bg-success">{{ $row['Quantity']}}</span></td>
                                <td>{{ $row['Total Price']}}</td>
                                <td> {{ $row['Purchase Date']}}</td>
                            </tr>






                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>



</body>

</html>