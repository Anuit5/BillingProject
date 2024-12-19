<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Mail; 
use App\Mail\InvoiceMail; 

class BillingController extends Controller
{
    public function showBillingForm()
    {
        $products = Product::all();
        return view('billing.form', compact('products'));
    }
    
    public function generateBill(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'customer_email' => 'required|email',
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer',
            'products.*.quantity' => 'required|integer|min:1',
            'cash_paid' => 'required|numeric|min:0',
        ]);
    
        $products = $request->input('products');
        $cashPaid = $request->input('cash_paid');
        $customerEmail = $request->input('customer_email');
        
        $totalAmount = 0;
        $purchaseItems = []; 
    
        foreach ($products as $product) {
            $productDetails = Product::where('product_id', $product['product_id'])->first();
            if (!$productDetails) {
                return redirect()->back()->withErrors(['products' => 'Product not found.']);
            }
            $quantity = $product['quantity'];
            $unitPrice = $productDetails->price_per_unit;
            $taxRate = $productDetails->tax_percentage;
    
            // Calculate Purchase Price, Tax Payable, and Total Price
            $purchasePrice = $unitPrice * $quantity;
            $taxPayable = ($taxRate / 100) * $purchasePrice;
            $totalPrice = $purchasePrice + $taxPayable;
    
            // Prepare data for the invoice
            $purchaseItems[] = [
                'product_id' => $product['product_id'],
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'purchase_price' => $purchasePrice,
                'tax_rate' => $taxRate,
                'tax_payable' => $taxPayable,
                'total_price' => $totalPrice,
            ];
    
            // Accumulate total amount
            $totalAmount += $totalPrice;
        }
    
        $changeDue = $cashPaid - $totalAmount;
    
        // Check if cash paid is sufficient
        if ($changeDue < 0) {
            return redirect()->back()->withErrors(['cash_paid' => 'Insufficient cash paid.']);
        }
    
        // Save purchase to database
        $purchase = new Purchase();
        $purchase->customer_email = $customerEmail;
        $purchase->total_amount = $totalAmount;
        $purchase->cash_paid = $cashPaid;
        $purchase->change_due = $changeDue;
    
        // Use transaction to ensure both purchase and items are saved
        DB::transaction(function () use ($purchase, $purchaseItems) {
            $purchase->save();
            foreach ($purchaseItems as $item) {
                $purchase->purchaseItems()->create($item);
            }
        });

      //  $this->sendInvoiceEmail($purchase, $purchaseItems);

        return view('billing.generate')->with('purchase', $purchase)->with('purchaseItems', $purchaseItems);

    }
    protected function sendInvoiceEmail(Purchase $purchase, array $purchaseItems)
    {
        Mail::to($purchase->customer_email)->send(new InvoiceMail($purchase, $purchaseItems));
    }

    public function viewPreviousPurchase($id)
    {
           // Get the current purchase
           $currentPurchase = Purchase::findOrFail($id);

           // Fetch the previous purchase for the same customer
           $previousPurchase = Purchase::where('customer_email', $currentPurchase->customer_email)
               ->where('id', '<', $currentPurchase->id)
               ->orderBy('id', 'desc')
               ->first();
   
           // Check if a previous purchase exists
           if (!$previousPurchase) {
               return redirect()->back()->with('error', 'No previous purchase found for this customer.');
           }
           // Fetch the items for the previous purchase
           $purchaseItems = $previousPurchase->purchaseItems()->with('product')->get();
   
        return view('billing.previous-purchases', compact('previousPurchase', 'purchaseItems'));
    }
    public function showPurchaseDetails($purchaseId)
    {
        $currentPurchase = Purchase::findOrFail($purchaseId);

        // Fetch all purchases for the customer
        $purchases = Purchase::where('customer_email',  $currentPurchase->customer_email)
            ->with('purchaseItems.product') // Eager load items and their products
            ->orderBy('created_at', 'desc') // Order by date
            ->get();
        return view('billing.purchase-details', compact('purchases'));
    }
}