<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationReceiptMail;


class DonationController extends Controller
{
    public function showForm()
    {
        return view('template.donation');
    }

    public function process(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Doação PetClub',
                    ],
                    'unit_amount' => $request->amount * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('donation.success') . '?amount=' . $request->amount,
            'cancel_url' => route('donation.cancel'),
        ]);
        return redirect($session->url);
    }

    public function success(Request $request)
    {
        Donation::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
        ]);
        Mail::to(Auth::user()->email)->send(new DonationReceiptMail($request->amount));
        return view('template.donation_success');
    }

    public function cancel()
    {
        return view('template.donation_cancel');
    }
}
