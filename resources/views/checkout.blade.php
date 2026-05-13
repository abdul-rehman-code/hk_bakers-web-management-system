@extends('layouts.app')

@section('content')
<section class="py-12 bg-[#FFF5F1] min-h-screen">
    <div class="container mx-auto px-4 max-w-6xl">
        <h1 class="text-3xl font-bold text-[#3A2A26] mb-8" style="font-family: 'Playfair Display', serif;">Checkout</h1>

                        <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data" x-data="{ paymentMethod: '{{ $paymentSettings->first()->id ?? 'online' }}' }">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left: Billing Details -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-pink-50">
                        <h2 class="text-xl font-bold text-[#3A2A26] mb-6">Billing Information</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-600 mb-2">Full Name *</label>
                                <input type="text" name="name" required class="w-full bg-pink-50 border-none rounded-xl p-3 focus:ring-2 focus:ring-[#F0718A]" placeholder="Enter your name">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-600 mb-2">Phone Number *</label>
                                <input type="text" name="phone" required class="w-full bg-pink-50 border-none rounded-xl p-3 focus:ring-2 focus:ring-[#F0718A]" placeholder="03xx-xxxxxxx">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-bold text-gray-600 mb-2">Email (Optional)</label>
                            <input type="email" name="email" class="w-full bg-pink-50 border-none rounded-xl p-3 focus:ring-2 focus:ring-[#F0718A]" placeholder="email@example.com">
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-bold text-gray-600 mb-2">Full Delivery Address * <span class="text-[#F0718A] text-xs">(Delivery only in Lahore)</span></label>
                            <textarea name="address" required rows="3" class="w-full bg-pink-50 border-none rounded-xl p-3 focus:ring-2 focus:ring-[#F0718A]" placeholder="House #, Street, Area..."></textarea>
                            <p class="text-[10px] text-gray-400 mt-1 italic">Note: Currently, we are only delivering within Lahore city.</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-pink-50">
                        <h2 class="text-xl font-bold text-[#3A2A26] mb-6">Payment Method</h2>
                        
                        <div class="space-y-4">
                            {{-- COD (Disabled) --}}
                            <div class="flex items-center p-4 rounded-xl border-2 transition-all cursor-not-allowed opacity-50 border-gray-100 bg-gray-50">
                                <input type="radio" name="payment_method_disabled" value="cod" disabled class="text-gray-400 focus:ring-gray-400">
                                <div class="ml-3">
                                    <p class="font-bold text-gray-400">Cash on Delivery (COD) <span class="text-[10px] bg-gray-200 px-2 py-0.5 rounded ml-1">Currently Unavailable</span></p>
                                    <p class="text-xs text-gray-400">Pay when your order is delivered</p>
                                </div>
                            </div>

                            @foreach($paymentSettings as $setting)
                            {{-- Dynamic Payment Method --}}
                            <div class="flex flex-col p-4 rounded-xl border-2 transition-all cursor-pointer"
                                 :class="paymentMethod === '{{ $setting->id }}' ? 'border-[#F0718A] bg-pink-50' : 'border-gray-100 bg-gray-50'"
                                 @click="paymentMethod = '{{ $setting->id }}'">
                                <div class="flex items-center">
                                    <input type="radio" name="payment_method" x-model="paymentMethod" value="{{ $setting->id }}" class="text-[#F0718A] focus:ring-[#F0718A]">
                                    <div class="ml-3">
                                        <p class="font-bold text-[#3A2A26]">Online Payment ({{ $setting->method_name }})</p>
                                        <p class="text-xs text-gray-500">Pay via {{ $setting->method_name }} to confirm order</p>
                                    </div>
                                </div>

                                {{-- Account Details --}}
                                <div x-show="paymentMethod === '{{ $setting->id }}'" x-collapse class="mt-4 pt-4 border-t border-pink-100 space-y-4">
                                    <div class="bg-white p-4 rounded-xl border border-pink-100">
                                        <p class="text-sm font-bold text-gray-700 mb-1">{{ $setting->method_name }} Account Details:</p>
                                        <p class="text-lg font-black text-[#F0718A]">{{ $setting->account_number }}</p>
                                        <p class="text-sm text-gray-600">Account Holder: <span class="font-bold">{{ $setting->account_holder }}</span></p>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="block text-sm font-bold text-gray-700">Upload Payment Screenshot *</label>
                                        <div class="relative">
                                            <input type="file" name="payment_screenshot" :required="paymentMethod === '{{ $setting->id }}'" 
                                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-[#F0718A] hover:file:bg-pink-100">
                                        </div>
                                        <p class="text-[10px] text-gray-400 italic">Please upload the confirmation screenshot of your {{ $setting->method_name }} transaction.</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right: Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-[2.5rem] p-8 shadow-lg border border-pink-50 sticky top-24">
                        <h2 class="text-xl font-bold text-[#3A2A26] mb-6">Your Order</h2>

                        <div class="max-h-[300px] overflow-y-auto mb-6 space-y-4 pr-2">
                            @foreach($cart as $id => $details)
                            <div class="flex justify-between items-center text-sm border-b border-pink-50 pb-3">
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-700">{{ $details['name'] }}</h4>
                                    <p class="text-xs text-gray-400">Qty: {{ $details['quantity'] }} | {{ $details['variation'] ?? 'Standard' }}</p>
                                </div>
                                <span class="font-bold text-[#F0718A]">Rs. {{ number_format($details['price'] * $details['quantity']) }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-500 font-medium">
                                <span>Subtotal</span>
                                <span>Rs. {{ number_format($total) }}</span>
                            </div>
                             <div class="flex justify-between text-gray-500 font-medium border-b border-pink-50 pb-3">
                                <span>Shipping</span>
                                <span class="text-[#F0718A]">Rs. 200</span>
                            </div>
                             <div class="flex justify-between items-center pt-2">
                                <span class="text-lg font-bold text-[#3A2A26]">Total</span>
                                <span class="text-2xl font-black text-[#F0718A]">Rs. {{ number_format($total + 200) }}</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-[#F0718A] hover:bg-[#d85d75] text-white font-bold py-4 rounded-2xl shadow-lg transition-all active:scale-95 uppercase tracking-widest">
                            Place Order
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</section>
@endsection
