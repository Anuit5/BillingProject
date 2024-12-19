<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
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
        .customer-email {
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

@if($purchases->isNotEmpty())
    <div class="customer-email">Entire Purchase History of {{ $purchases->first()->customer_email }}</div>
    
    <table>
        <thead>
            <tr>
                <th>Purchase Date</th>
                <th>Total Amount</th>
                <th>Cash Paid</th>
                <th>Change Due</th>
                <th>Items</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
                <tr>
                    <td>{{ $purchase->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>{{ number_format($purchase->total_amount, 2) }}</td>
                    <td>{{ number_format($purchase->cash_paid, 2) }}</td>
                    <td>{{ number_format($purchase->change_due, 2) }}</td>
                    <td>
                        <ul>
                            @foreach($purchase->purchaseItems as $item)
                                <li>{{ $item->product->name }} (Quantity: {{ $item->quantity }})</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No purchase history found for this customer.</p>
@endif

</body>
</html>