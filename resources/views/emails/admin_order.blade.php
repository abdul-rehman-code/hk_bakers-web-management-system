<!DOCTYPE html>
<html>
<head>
    <title>New Order Received</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; }
        .header { background: #ffefef; padding: 15px; text-align: center; border-radius: 5px; }
        .order-details { margin-top: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .table th, .table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .table th { background-color: #f8f8f8; }
        .total { font-weight: bold; font-size: 16px; color: #db2777; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="color: #db2777;">🎉 New Order Placed!</h2>
            <p>You have received a new order on HK Bakers.</p>
        </div>

        <div class="order-details">
            <h3>Order Details:</h3>
            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
            <p><strong>Customer Name:</strong> {{ $order->customer_name }}</p>
            <p><strong>Phone Number:</strong> {{ $order->customer_phone }}</p>
            <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}, {{ $order->city }}</p>
            <p><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
        </div>

        <h3>Items Ordered:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Variation</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Product' }}</td>
                    <td>{{ $item->variation ?? 'Standard' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rs. {{ number_format($item->unit_price, 2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" align="right"><strong>Total Amount (Inc. Shipping):</strong></td>
                    <td class="total">Rs. {{ number_format($order->total_price, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <p style="margin-top: 30px; font-size: 12px; color: #777; text-align: center;">This is an automated notification from HK Bakers.</p>
    </div>
</body>
</html>
