<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Donation Receipt</title>
        <style>
            body { font-family: sans-serif; }
            .container { margin: 40px; }
            h2 { text-align: center; margin-bottom: 30px; }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Donation Receipt</h2>
            <p><strong>Name:</strong> {{ $donation->user->name }}</p>
            <p><strong>Email:</strong> {{ $donation->user->email }}</p>
            <p><strong>Donation Amount:</strong> €{{ number_format($donation->amount, 2, ',', '.') }}</p>
            <p><strong>Date:</strong> {{ $donation->created_at->format('d/m/Y H:i') }}</p>
            <hr>
            <p>Thank you for supporting PetClub!</p>
        </div>
    </body>
</html>
