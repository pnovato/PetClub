<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Donation Receipt</title>
    </head>
    <body>
        <h1>Thank for buying with PetClub!</h1>
        <p>Product: {{ $order->product->name }}</p>
        <p>Amount: {{ $order->quantity }}</p>
        <p>Total: €{{ number_format($order->price, 2, ',', '.') }}</p>
        <p>See you soon!</p>
    </body>
</html>
