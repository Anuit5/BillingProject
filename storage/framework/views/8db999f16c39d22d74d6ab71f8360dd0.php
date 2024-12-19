<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Receipt</title>
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
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>Billing Receipt</h2>

<p><strong>Customer Email:</strong> <?php echo e($purchase->customer_email); ?></p>

<table>
    <thead>
        <tr>
            <th>Product ID</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Purchase Price</th>
            <th>Tax %</th>
            <th>Tax Payable</th>
            <th>Total Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $totalPriceWithoutTax = 0;
            $totalTaxPayable = 0;
            $netPrice = 0;
        ?>
        <?php $__currentLoopData = $purchaseItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                // Assuming you have a method to get the product details
                $product = \App\Models\Product::find($item['product_id']);
                $unitPrice = $item['unit_price'];
                $taxPayable = $item['tax_payable'];
                $totalPrice = $item['total_price'];

                // Accumulate totals
                $totalPriceWithoutTax += $item['purchase_price'];
                $totalTaxPayable += $taxPayable;
                $netPrice += $totalPrice;
            ?>
            <tr>
                <td><?php echo e($item['product_id']); ?></td>
                <td><?php echo e(number_format($unitPrice, 2)); ?></td>
                <td><?php echo e($item['quantity']); ?></td>
                <td><?php echo e(number_format($item['purchase_price'], 2)); ?></td>
                <td><?php echo e(number_format($item['tax_rate'], 2)); ?></td>
                <td><?php echo e(number_format($taxPayable, 2)); ?></td>
                <td><?php echo e(number_format($totalPrice, 2)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<p class="total">Total Price Without Tax: <?php echo e(number_format($totalPriceWithoutTax, 2)); ?></p>
<p class="total">Total Tax Payable: <?php echo e(number_format($totalTaxPayable, 2)); ?></p>
<p class="total">Net Price of Purchased Items: <?php echo e(number_format($netPrice, 2)); ?></p>
<p class="total">Rounded Down Value of Net Price: <?php echo e(number_format(floor($netPrice), 2)); ?></p>
<p class="total">Balance Payable to Customer: <?php echo e(number_format($purchase->cash_paid - $netPrice, 2)); ?></p>
<h3>Balance Breakdown</h3>
<?php
    $balance = $purchase->cash_paid - $netPrice; // Calculate the balance to be given to the customer
    $denominations = [500, 100, 50, 20, 10, 5, 1]; // Define the available denominations
    $denominationCounts = []; // Array to hold the count of each denomination

    // Calculate the breakdown of the balance
    foreach ($denominations as $denomination) {
        if ($balance >= $denomination) {
            $denominationCounts[$denomination] = floor($balance / $denomination); // Count how many of this denomination
            $balance -= $denominationCounts[$denomination] * $denomination; // Reduce the balance accordingly
        } else {
            $denominationCounts[$denomination] = 0; // If the balance is less than the denomination, set count to 0
        }
    }
?>

<table>
    <thead>
        <tr>
            <th>Denomination</th>
            <th>Count</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $denominationCounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $denomination => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>$<?php echo e(number_format($denomination, 2)); ?></td>
                <td><?php echo e($count); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<div>
        <a href="<?php echo e(route('billing.previous-purchases', ['id' => $purchase->id])); ?>" style="padding: 10px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">Previous Purchase</a>
        <a href="<?php echo e(route('billing.purchase-details', ['purchaseId' => $purchase->id])); ?>" style="padding: 10px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px;">Entire Purchase History</a>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\LaravelProjects\FirstProject\resources\views/billing/generate.blade.php ENDPATH**/ ?>