@extends('layouts.app')

@section('content')
<section class="py-12 bg-[#FFF5F1]">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-[3rem] p-8 md:p-12 shadow-xl border border-pink-50 flex flex-col md:flex-row gap-12">

            <!-- Left: Product Image -->
            <div class="w-full md:w-1/2 flex items-center justify-center bg-pink-50 rounded-[2rem] p-10">
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}"
                     class="max-h-[400px] object-contain drop-shadow-2xl transition-transform duration-500 hover:scale-110">
            </div>

            <!-- Right: Product Info -->
            <div class="w-full md:w-1/2 flex flex-col justify-center" x-data="{ 
                qty: 1, 
                variations: {{ json_encode($product->formatted_variations) }},
                selectedVariation: null,
                price: {{ $product->display_price }},
                init() {
                    if (this.variations.length > 0) {
                        this.selectedVariation = this.variations[0];
                        this.price = this.selectedVariation.price;
                    }
                },
                updatePrice(variation) {
                    this.selectedVariation = variation;
                    this.price = variation.price;
                }
            }">
                <nav class="flex text-sm text-gray-400 mb-4">
                    <a href="/" class="hover:text-[#F0718A]">Home</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('products') }}?category={{ $product->category->slug }}" class="hover:text-[#F0718A]">
                        {{ $product->category->name }}
                    </a>
                </nav>

                <h1 class="text-4xl md:text-5xl font-bold text-[#3A2A26] mb-4" style="font-family: 'Playfair Display', serif;">
                    {{ $product->name }}
                </h1>

                <div class="flex items-center gap-4 mb-6">
                    <span class="text-3xl font-extrabold text-[#F0718A]">Rs. <span x-text="new Intl.NumberFormat().format(price)">{{ number_format($product->display_price) }}</span></span>
                    @if($product->old_price)
                        <span class="text-xl text-gray-400 line-through">Rs. {{ number_format($product->old_price) }}</span>
                    @endif
                </div>

                <p class="text-gray-600 leading-relaxed mb-8 text-lg">
                    {{ $product->description }}
                </p>

                @if(!empty($product->formatted_variations))
                <div class="mb-8">
                    <h3 class="text-sm font-bold text-[#3A2A26] uppercase tracking-wider mb-4">Select Weight/Size</h3>
                    <div class="flex flex-wrap gap-3">
                        <template x-for="variation in variations" :key="variation.weight">
                            <button 
                                @click="updatePrice(variation)"
                                :class="selectedVariation && selectedVariation.weight === variation.weight ? 'bg-[#F0718A] text-white border-[#F0718A]' : 'bg-white text-gray-600 border-pink-100 hover:border-[#F0718A]'"
                                class="px-6 py-3 rounded-2xl border-2 font-bold transition-all duration-300 shadow-sm active:scale-95 text-sm"
                            >
                                <span x-text="variation.weight"></span>
                                <span class="block text-xs opacity-75 mt-0.5" x-text="'Rs. ' + new Intl.NumberFormat().format(variation.price)"></span>
                            </button>
                        </template>
                    </div>
                </div>
                @endif

                <!-- Action Buttons wrapper -->
            <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex items-center border-2 border-pink-100 rounded-2xl p-1 bg-white">
                <!-- Minus Button: Minimum 1 tak jayega -->
                <button @click="if(qty > 1) qty--" class="px-4 py-2 text-xl font-bold text-gray-500">-</button>

                <!-- Input: x-model se qty variable se connect kar diya -->
                <input type="number" x-model="qty" class="w-12 text-center border-none focus:ring-0 font-bold" readonly>

                <!-- Plus Button: Quantity barhaye ga -->
                <button @click="qty++" class="px-4 py-2 text-xl font-bold text-[#F0718A]">+</button>
            </div>

            <!-- Add to Cart Button -->
            <button type="button"
                    data-id="{{ $product->id }}"
                    :data-qty="qty"
                    :data-variation="selectedVariation ? selectedVariation.weight : ''"
                    :data-price="price"
                    class="add-to-cart-btn flex-1 bg-[#F0718A] hover:bg-[#d85d75] text-white font-bold py-4 rounded-2xl shadow-lg transition-all active:scale-95 flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Add to Cart
            </button>
        </div>
            </div>
        </div>

        <!-- Related Products Section -->
        <div class="mt-20">
            <h2 class="text-3xl font-bold text-[#3A2A26] mb-8 text-center" style="font-family: 'Playfair Display', serif;">You Might Also Like</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @include('partials.products-grid', ['products' => $relatedProducts])
            </div>
        </div>
    </div>
</section>
@endsection
