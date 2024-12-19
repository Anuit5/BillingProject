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

<p><strong>Previous Purchase</strong> <?php echo e($previousPurchase->customer_email); ?></p>

<?php if($purchaseItems && $purchaseItems->isNotEmpty()): ?>
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
            <?php $__currentLoopData = $purchaseItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->product->name); ?></td>
                    <td><?php echo e($item->product_id); ?></td>
                    <td><?php echo e($item->product->price_per_unit); ?></td>
                    <td><?php echo e($item->quantity); ?></td>
                    <td><?php echo e($item->product->price_per_unit * $item->quantity); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No items found for this purchase.</p>
<?php endif; ?>

</body<?php /**PATH C:\xampp\htdocs\LaravelProjects\FirstProject\resources\views/billing/previous-purchases.blade.php ENDPATH**/ ?>