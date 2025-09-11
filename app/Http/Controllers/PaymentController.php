<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Checkout\Session;
use App\Models\Product;
use App\Models\Order;
use App\Mail\PurchaseConfirmation;
use Illuminate\Support\Facades\Mail;


class PaymentController extends Controller
{
    public function checkout($id)
    {
        $product = Product::findOrFail($id);
        Stripe::setApiKey(config('services.stripe.secret'));
        session(['purchased_product_id' => $product->id]);
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $product->name,
                        'description' => $product->description,
                    ],
                    'unit_amount' => $product->price * 100, // em cêntimos
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);
        return redirect($session->url);
    }

    public function success(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = StripeSession::retrieve($request->get('session_id'));
        $metadata = $session->metadata; 
        $product = Product::find($metadata->product_id);
        if ($product && $product->quantity >= $metadata->quantity) 
        {
            $product->decrement('quantity', $metadata->quantity);
            $order = Order::create([
                'user_id' => $metadata->user_id ?? null,
                'product_id' => $product->id,
                'quantity' => $metadata->quantity,
                'price' => $product->price * $metadata->quantity,
                'stripe_id' => $session->id,
            ]);
            $email = $metadata->user_id ? auth()->user()->email : $metadata->email;
            if ($email)
                Mail::to($email)->send(new PurchaseConfirmation($order));
        }
        return view('store.success');
    }

    public function cancel()
    {
        return view('store.cancel');
    }

    public function process(Request $request)
    {
        $request->validate
        ([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'email' => 'nullable|email',
        ]);
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        if ($product->quantity < $quantity)
            return back()->with('error', 'No Stock For This Amount.');
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = Session::create
        ([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price * 100, // em cêntimos
                ],
                'quantity' => $quantity,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('public.store'),
            'metadata' => [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'user_id' => auth()->id(),
                'email' => $request->input('email'),
            ],
        ]);
        return redirect($session->url);
    }
}
