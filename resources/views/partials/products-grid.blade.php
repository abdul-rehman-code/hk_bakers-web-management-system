@forelse($products as $product)
    <div class="bg-white rounded-[1.5rem] overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 group p-3 border border-gray-50 flex flex-col h-full">
        <!-- Image Section -->
        <div class="relative h-56 w-full rounded-xl overflow-hidden mb-4 shrink-0">
            {{-- Check if slug exists before creating route --}}
            <a href="{{ $product->slug ? route('product.details', $product->slug) : '#' }}" class="block w-full h-full">
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
            </a>

            @if($product->on_sale)
                <div class="absolute top-0 left-0 bg-[#F0718A] text-white text-[10px] font-bold px-4 py-1.5 rounded-br-2xl uppercase tracking-widest shadow-md z-10">
                    Sale
                </div>
            @endif
        </div>

        <div class="px-2 pb-2 text-left flex flex-col flex-grow">
            <!-- Title -->
            <a href="{{ $product->slug ? route('product.details', $product->slug) : '#' }}" class="hover:text-[#F0718A] transition-colors">
                <h3 class="font-bold text-base text-gray-900 mb-1 line-clamp-1 h-6" title="{{ $product->name }}">
                    {{ $product->name }}
                </h3>
            </a>

            <p class="text-[#F0718A] font-bold text-sm mb-4">
                @if(!empty($product->formatted_variations))
                    <span class="text-xs text-gray-400 font-normal">Starting from</span><br>
                @endif
                Rs. {{ number_format($product->display_price) }}
            </p>
               <button type="button"
                    data-id="{{ $product->id }}"
                    data-price="{{ $product->display_price }}"
                    class="add-to-cart-btn mt-auto w-full bg-[#F0718A] text-white py-2.5 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-[#E06079] transition-all active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Add to Cart</span>
                </button>
        </div>
    </div>
@empty
    <div class="col-span-full py-20 text-center">
        <div class="text-6xl mb-4">🍪</div>
        <h3 class="text-xl font-bold text-gray-700 mb-2">No products found</h3>
        <p class="text-gray-500">Try selecting a different category or checking back later.</p>
    </div>
@endforelse
