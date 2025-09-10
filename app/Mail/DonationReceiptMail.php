<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function build()
    {
        return $this->subject('Donation Receipt')->view('emails.donation_receipt', ['amount' => $this->amount]);
    }
}
