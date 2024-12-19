<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previous Purchase</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Previous Purchase Details</h2>

<p><strong>Previous Purchase</strong> {{ $previousPurchase->customer_email }}</p>

@if($purchaseItems && $purchaseItems->isNotEmpty())
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product ID</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchaseItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->product_id }}</td>
                    <td>{{ $item->product->price_per_unit }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->product->price_per_unit * $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No items found for this purchase.</p>
@endif

</body