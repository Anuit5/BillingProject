<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Form</title>
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
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .form-group {
            display: flex;
            align-items: center; /* Align items vertically centered */
            margin: 10px 0;
        }
        .form-group label {
            width: 100px; /* Fixed width for labels */
            margin-right: 10px; /* Space between label and input */
        }
        input[type="number"],
        input[type="email"],
        select {
            flex: 1; /* Allow input fields to take remaining space */
            max-width: 300px; /* Maximum width */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #218838;
        }
        .remove-product {
            background-color: #dc3545;
        }
        .remove-product:hover {
            background-color: #c82333;
        }
        hr {
            border: 0;
            height: 1px;
            background: #ccc;
            margin: 20px 0;
        }
        button.cancel {
            background-color: #dc3545; /* Red for cancel */
        }
        button.cancel:hover {
            background-color: #c82333; /* Darker red on hover */
        }
    </style>
</head>
<body>

<!-- Combined Form for Billing -->
<h2>Billing Form</h2>
<form action="<?php echo e(route('billing.generate')); ?>" method="POST">
<?php echo csrf_field(); ?> 
<input type="email" name="customer_email" placeholder="Customer Email" required>
    
    <div id="product-section">
        <div class="product-entry">
            <select name="products[0][product_id]" required>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($product->product_id); ?>"><?php echo e($product->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <input type="number" name="products[0][quantity]" placeholder="Quantity" required>
        </div>
    </div>
    
    <button type="button" id="add-product">Add New Product</button>
    
    <hr>

    <h2>Denominations</h2>
    <div>
        <label for="denomination-500">500</label>
        <input type="number" id="denomination-500" name="denominations[500]" placeholder="Count" min="0" value="0">
    </div>
    <div>
        <label for="denomination-100">100</label>
        <input type="number" id="denomination-100" name="denominations[100]" placeholder="Count" min="0" value="0">
    </div>
    <div>
        <label for="denomination-50">50</label>
        <input type="number" id="denomination-50" name="denominations[50]" placeholder="Count" min="0" value="0">
    </div>
    <div>
        <label for="denomination-20">20</label>
        <input type="number" id="denomination-20" name="denominations[20]" placeholder="Count" min="0" value="0">
    </div>
    <div>
        <label for="denomination-10">10</label>
        <input type="number" id="denomination-10" name="denominations[10]" placeholder="Count" min="0" value="0">
    </div>
    <div>
        <label for="denomination-5">5</label>
        <input type="number" id="denomination-5" name="denominations[5]" placeholder="Count" min="0" value="0">
    </div>
    <div>
        <label for="denomination-1">1</label>
        <input type="number" id="denomination-1" name="denominations[1]" placeholder="Count" min="0" value="0">
    </div>
    <div>
        <label for="cash-paid">Cash Paid By Customer</label>
        <input type="number" id="cash-paid" name="cash_paid" placeholder="Total Cash Paid" required>
    </div>
    
    <div>
        <button type="button" onclick="cancelForm()">Cancel</button>
        <button type="submit">Generate Bill</button>
    </div>
</form>

<script>
    let productCount = 1; // Start counting from 1 since we already have one product entry

    document.getElementById('add-product').addEventListener('click', function() {
        const productSection = document.getElementById('product-section');
        const newEntry = document.createElement('div');
        newEntry.classList.add('product-entry');
        newEntry.innerHTML = `
            <select name="products[${productCount}][product_id]" required>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($product->product_id); ?>"><?php echo e($product->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <input type="number" name="products[${productCount}][quantity]" placeholder="Quantity" required>
            <button type="button" class="remove-product">Remove</button>
        `;
        productSection.appendChild(newEntry);
        productCount++; // Increment the product count for the next entry

        // Add event listener to the remove button
        newEntry.querySelector('.remove-product').addEventListener('click', function() {
            productSection.removeChild(newEntry);
        });
    });

    function cancelForm() {
        // Logic to cancel the form submission or redirect
        window.location.href = '/'; // Redirect to home or another page
    }
</script>

</body>
</html><?php /**PATH C:\xampp\htdocs\LaravelProjects\BillingProject\resources\views/billing/form.blade.php ENDPATH**/ ?>