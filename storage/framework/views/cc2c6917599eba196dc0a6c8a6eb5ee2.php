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

<?php if($purchases->isNotEmpty()): ?>
    <div class="customer-email">Entire Purchase History of <?php echo e($purchases->first()->customer_email); ?></div>
    
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
            <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($purchase->created_at->format('Y-m-d H:i:s')); ?></td>
                    <td><?php echo e(number_format($purchase->total_amount, 2)); ?></td>
                    <td><?php echo e(number_format($purchase->cash_paid, 2)); ?></td>
                    <td><?php echo e(number_format($purchase->change_due, 2)); ?></td>
                    <td>
                        <ul>
                            <?php $__currentLoopData = $purchase->purchaseItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($item->product->name); ?> (Quantity: <?php echo e($item->quantity); ?>)</li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No purchase history found for this customer.</p>
<?php endif; ?>

</body>
</html><?php /**PATH C:\xampp\htdocs\LaravelProjects\BillingProject\resources\views/billing/purchase-details.blade.php ENDPATH**/ ?>