<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Donation Receipt</title>
    </head>
    <body>
        <h2>Hello {{ Auth::user()->name }},</h2>
        <p>We received your donation<strong>€{{ number_format($amount, 2, ',', '.') }}</strong>.</p>
        <p>Your support matters for our pets! Thank you.</p>
    </body>
</html>
