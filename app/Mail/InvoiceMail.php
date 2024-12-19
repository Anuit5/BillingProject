<?php

namespace App\Mail;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Invoice $invoice)
    {
    }

    public function build()
    {
        return $this->subject('Your Invoice is Ready')
                    ->view('invoice') 
                    ->with([
                        'purchase' => $this->purchase,
                        'purchaseItems' => $this->purchaseItems,
                    ]);
    }
}