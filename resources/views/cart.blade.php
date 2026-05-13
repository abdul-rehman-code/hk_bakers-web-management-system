@extends('layouts.app')

@section('content')
<section class="py-12 bg-[#FFF5F1] min-h-screen">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-[#3A2A26] mb-10 text-center" style="font-family: 'Playfair Display', serif;">
            Your Shopping Cart
        </h1>

        @if(count($cart) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cart as $id => $details)
                        @php $product = \App\Models\Product::find($details['product_id'] ?? $id); @endphp

                        <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-pink-50 flex flex-col sm:flex-row items-center gap-6 relative cart-item-row" data-id="{{ $id }}">

                            <!-- Remove Button -->
                            <button class="remove-from-cart absolute top-4 right-4 text-gray-300 hover:text-red-500 transition-all transform hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <!-- Product Image -->
                            <div class="w-24 h-24 bg-pink-50 rounded-2xl flex-shrink-0 overflow-hidden">
                                <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                            </div>

                            <!-- Product Info -->
                            <div class="flex-1 text-center sm:text-left">
                                <h3 class="text-xl font-bold text-[#3A2A26]">{{ $details['name'] }}</h3>
                                
                                <!-- Variation Selection in Cart -->
                                @if($product && !empty($product->formatted_variations))
                                    <div class="mt-2 relative inline-block w-full max-w-[220px]">
                                        <select class="update-variation-select w-full bg-white border-2 border-pink-100 text-gray-700 text-xs rounded-xl px-3 py-2 appearance-none focus:border-[#F0718A] focus:ring-0 outline-none cursor-pointer font-medium transition-all shadow-sm" data-id="{{ $id }}">
                                            @foreach($product->formatted_variations as $variation)
                                                <option value="{{ $variation['weight'] }}" {{ ($details['variation'] ?? '') == $variation['weight'] ? 'selected' : '' }}>
                                                    {{ $variation['weight'] }} - Rs. {{ number_format($variation['price']) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-pink-300">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                @endif

                                <p class="text-[#F0718A] font-bold text-lg mt-2">Rs. {{ number_format($details['price']) }}</p>
                            </div>

                            <!-- Qty Selector -->
                            <div class="flex items-center space-x-1 bg-pink-50 rounded-2xl p-1 shadow-inner">
                                <button class="update-qty w-10 h-10 flex items-center justify-center rounded-xl bg-white text-[#F0718A] font-bold shadow-sm hover:bg-pink-100 transition-all active:scale-90" data-action="minus">
                                    <span class="text-xl">−</span>
                                </button>
                                <input type="number" value="{{ $details['quantity'] }}" class="qty-input w-12 text-center bg-transparent border-none focus:ring-0 font-bold text-[#3A2A26]" readonly>
                                <button class="update-qty w-10 h-10 flex items-center justify-center rounded-xl bg-white text-[#F0718A] font-bold shadow-sm hover:bg-pink-100 transition-all active:scale-90" data-action="plus">
                                    <span class="text-xl">+</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border border-pink-50 sticky top-24">
                        <h2 class="text-2xl font-bold text-[#3A2A26] mb-6">Order Summary</h2>
                        @php $total = 0; foreach($cart as $id => $details) { $total += $details['price'] * $details['quantity']; } @endphp
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-gray-500 font-medium">
                                <span>Subtotal</span>
                                <span class="cart-subtotal">Rs. {{ number_format($total) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-500 font-medium">
                                <span>Shipping</span>
                                <span class="text-[#F0718A]">Rs. 200</span>
                            </div>
                            <div class="border-t border-pink-50 pt-4 flex justify-between items-center">
                                <span class="text-xl font-bold text-[#3A2A26]">Total Amount</span>
                                <span class="cart-total text-3xl font-black text-[#F0718A]">Rs. {{ number_format($total + 200) }}</span>
                            </div>
                        </div>
                        <a href="{{ route('checkout') }}" class="w-full inline-block text-center bg-[#3A2A26] hover:bg-[#F0718A] text-white font-bold py-5 rounded-[1.5rem] shadow-lg transition-all duration-300 transform hover:-translate-y-1 active:scale-95 uppercase tracking-wider">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center bg-white rounded-[3rem] p-20 shadow-sm border-2 border-dashed border-pink-200">
                <h3 class="text-2xl font-bold text-gray-400">Cart is empty</h3>
                <a href="{{ route('products') }}" class="mt-6 inline-block bg-[#F0718A] text-white font-bold px-10 py-4 rounded-full shadow-lg">Start Shopping</a>
            </div>
        @endif
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Remove Item
        $(document).on('click', '.remove-from-cart', function (e) {
            let btn = $(this);
            let row = btn.closest(".cart-item-row");
            let id = row.data("id");

            if(confirm("Do you want to remove?")) {
                $.ajax({
                    url: '{{ route("remove.from.cart") }}',
                    method: "DELETE",
                    data: { _token: '{{ csrf_token() }}', id: id },
                    success: function (response) {
                        if(response.success) {
                            row.fadeOut(300, function() {
                                $(this).remove();
                                updateCartTotals(response);

                                if(response.cart_count == 0) {
                                    location.reload(); // Reload to show empty state if no items left
                                }
                            });
                        }
                    },
                    error: function() { showToast("Something went wrong!", 'error'); }
                });
            }
        });

        // Update Qty
        $(document).on('click', '.update-qty', function (e) {
            let btn = $(this);
            let row = btn.closest(".cart-item-row");
            let id = row.data("id");
            let action = btn.data("action");
            let input = row.find(".qty-input");

            $.ajax({
                url: '{{ route("update.cart") }}',
                method: "PATCH",
                data: { _token: '{{ csrf_token() }}', id: id, action: action },
                success: function (response) {
                    if(response.success) {
                        input.val(response.quantity);
                        updateCartTotals(response);
                    }
                }
            });
        });

        // Update Variation
        $(document).on('change', '.update-variation-select', function (e) {
            let select = $(this);
            let id = select.data("id");
            let variation = select.val();

            $.ajax({
                url: '{{ route("update.variation") }}',
                method: "PATCH",
                data: { _token: '{{ csrf_token() }}', id: id, variation: variation },
                success: function (response) {
                    if(response.success) {
                        if(response.redirect) {
                            location.reload(); // Reload needed because keys and layout change
                        } else {
                            updateCartTotals(response);
                        }
                    } else {
                        showToast(response.message, 'error');
                    }
                }
            });
        });

        function updateCartTotals(response) {
            $('.cart-subtotal').text('Rs. ' + response.total);
            // Parse response.total as a number (it might be a formatted string or a raw number depending on the backend response)
            let subtotal = parseFloat(response.total.toString().replace(/,/g, ''));
            let totalWithShipping = subtotal + 200;
            $('.cart-total').text('Rs. ' + totalWithShipping.toLocaleString());
            $('.cart-count-badge').text(response.cart_count); 
        }
    });
</script>
@endsection
