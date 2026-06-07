<!DOCTYPE html>
<html>
<head>
    <title>Thank You for Your Order</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; }
        .header { background: #fff5e6; padding: 20px; text-align: center; border-radius: 5px; }
        .order-details { margin-top: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .table th, .table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .table th { background-color: #f8f8f8; }
        .footer { text-align: center; margin-top: 30px; font-size: 14px; color: #555; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="color: #db2777;">Thank You for Your Order! 🍰</h2>
            <p>Hi <strong>{{ $order->customer_name }}</strong>, we have successfully received your order.</p>
        </div>

        <div class="order-details">
            <h3>Your Shipping & Order Details:</h3>
            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
            <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}, {{ $order->city }}</p>
            <p><strong>Contact Number:</strong> {{ $order->customer_phone }}</p>
        </div>

        <h3>Order Summary:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Variation</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Product' }}</td>
                    <td>{{ $item->variation ?? 'Standard' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rs. {{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" align="right"><strong>Total Price (Inc. Shipping):</strong></td>
                    <td style="font-weight: bold; color: #db2777;">Rs. {{ number_format($order->total_price, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>We are processing your order and will deliver it fresh soon!</p>
            <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
            <p><strong>HK Bakers</strong><br>Freshly Baked Happiness</p>
        </div>
    </div>
</body>
</html>
