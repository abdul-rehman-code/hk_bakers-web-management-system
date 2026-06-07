<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;
use App\Mail\AdminOrderNotification;
use App\Mail\CustomerOrderConfirmation;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index() {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $details) { $total += $details['price'] * $details['quantity']; }

        $paymentSettings = PaymentSetting::where('is_active', true)->get();

        return view('checkout', compact('cart', 'total', 'paymentSettings'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart');

        // 1. Order create karein
        $screenshotPath = null;
        if ($request->hasFile('payment_screenshot')) {
            $screenshotPath = $request->file('payment_screenshot')->store('payments', 'public');
        }

        $order = Order::create([
            'order_number'       => 'ORD-' . strtoupper(uniqid()),
            'customer_name'      => $request->name,
            'customer_phone'     => $request->phone,
            'delivery_address'   => $request->address,
            'city'               => $request->city ?? 'Lahore',
            'delivery_date'      => now()->addDays(2),
            'total_price'        => $this->calculateTotal($cart),
            'status'             => 'pending',
            'payment_method'     => $this->getPaymentMethodName($request->payment_method),
            'payment_screenshot' => $screenshotPath,
            'user_id'            => auth()->id() ?? 1,
        ]);

        // 2. Order ki items save karein
        foreach ($cart as $key => $details) {
            \App\Models\OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $details['product_id'],
                'variation'  => $details['variation'] ?? null,
                'quantity'   => $details['quantity'],
                'unit_price' => $details['price'],
            ]);
        }

        // ======================== EMAIL SYSTEM INTEGRATION ========================
        try {
            // 1. Admin ko mail bhejna (info@hkbakers.com)
            Mail::to('info@hkbakers.com')->send(new AdminOrderNotification($order));

            // 2. Customer ko mail bhejna (agar request me email field aa rhi ho)
            if ($request->has('email') && !empty($request->email)) {
                Mail::to($request->email)->send(new CustomerOrderConfirmation($order));
            }
            // Alternative: Agar user logged in hai aur model me email save hai
            elseif (auth()->check() && auth()->user()->email) {
                Mail::to(auth()->user()->email)->send(new CustomerOrderConfirmation($order));
            }
        } catch (\Exception $e) {
            // Mail fail hone par order rukhna nahi chahiye, islye isko try-catch me rakha hai
            // Aap chahein toh logger me check kr skte hain: \Log::error("Mail error: " . $e->getMessage());
        }
        // ==========================================================================

        // 3. Cart khali kar dein
        session()->forget('cart');

        return redirect()->route('order.success', $order->id)->with('success', 'Order placed successfully!');
    }

    private function calculateTotal($cart) {
        $total = 0;
        foreach($cart as $item) { $total += $item['price'] * $item['quantity']; }
        return $total + 200; // Standard shipping fee
    }

    private function getPaymentMethodName($methodId) {
        if (!$methodId || $methodId == 'cod') return 'cod';

        $setting = PaymentSetting::find($methodId);
        return $setting ? $setting->method_name : 'online';
    }

    public function success($id)
    {
        $order = \App\Models\Order::findOrFail($id);
        return view('order-success', compact('order'));
    }
}
