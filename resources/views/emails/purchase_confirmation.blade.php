<h1>Obrigado pela sua compra no PetClub!</h1>
<p>Produto: {{ $order->product->name }}</p>
<p>Quantidade: {{ $order->quantity }}</p>
<p>Total: €{{ number_format($order->price, 2, ',', '.') }}</p>
<p>Esperamos vê-lo(a) novamente em breve!</p>
