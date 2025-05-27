<h2>Thank you for your order, {{ $order->user->name }}!</h2>
<p>Order ID: {{ $order->id }}</p>
<p>Total Amount: ${{ number_format($order->amount, 2) }}</p>

<h4>Order Details:</h4>
<ul>
    @foreach ($order->orderDetails as $item)
        <li>{{ $item->product->name }} - Quantity: {{ $item->quantity }} - Price: ${{ $item->price }}</li>
    @endforeach
</ul>
