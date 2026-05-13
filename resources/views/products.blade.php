@extends('layouts.app')

@section('content')

{{-- ===== HERO BANNER ===== --}}
<section class="relative py-12 md:py-16 overflow-hidden bg-[#2C1E16]">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1558301211-0d8c8ddee6ec?q=80&w=1600" class="w-full h-full object-cover opacity-20 mix-blend-overlay">
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-[#2C1E16]/80 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-[#FFFBF9]"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10 flex flex-col md:flex-row items-center gap-12">

        {{-- Left: Text Content --}}
        <div class="w-full md:w-1/2 text-center md:text-left">
            <span class="inline-block py-1.5 px-5 rounded-full bg-pink-500/20 text-pink-300 text-sm font-bold tracking-widest mb-4 border border-pink-500/30 uppercase shadow-sm">Complete Menu</span>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 drop-shadow-lg" style="font-family: 'Playfair Display', serif;">
                All Products
            </h1>
            <p class="text-pink-100 text-base md:text-lg max-w-xl mx-auto md:mx-0 font-medium drop-shadow-md">
                Browse our entire collection of freshly baked goods, crafted with love and premium ingredients just for you.
            </p>
        </div>

        {{-- Right: Animated Hot Sale --}}
        <div class="w-full md:w-1/2 flex justify-center md:justify-end perspective-1000">
            <div class="relative w-full max-w-sm" x-data="{
                active: 0,
                interval: null,
                items: [
                    @if(isset($onsaleproduct) && $onsaleproduct->count() > 0)
                        @foreach($onsaleproduct as $item)
                        {
                            id: '{{ $item->id }}',
                            name: '{{ addslashes($item->name) }}',
                            price: '{{ number_format($item->price) }}',
                            old_price: '{{ number_format($item->price + ($item->price * 0.2)) }}',
                            img: '{{ asset('storage/' . $item->image) }}'
                        },
                        @endforeach
                    @else
                        { name: 'Chocolate Delight', price: '1,200', old_price: '1,500', img: '{{ asset('images/cake.png') }}' },
                        { name: 'Butter Cookies Jar', price: '500', old_price: '650', img: '{{ asset('images/cookies.png') }}' }
                    @endif
                ],
                init() {
                    if(this.items.length > 1) {
                        this.interval = setInterval(() => {
                            this.active = (this.active + 1) % this.items.length;
                        }, 3500);
                    }
                }
            }">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 p-6 md:p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden">

                    <div class="absolute top-0 right-0 bg-[#F0718A] text-white font-bold px-5 py-2 rounded-bl-3xl text-xs shadow-lg z-20 flex items-center gap-1 uppercase tracking-widest">
                         <span class="w-1.5 h-1.5 bg-white rounded-full animate-ping"></span>
                         Hot Sale
                    </div>

                    <div class="relative h-44 mt-4 mb-4">
                        <template x-for="(item, index) in items" :key="index">
                            <div x-show="active === index"
                                 x-transition:enter="transition ease-out duration-700"
                                 x-transition:enter-start="opacity-0 translate-x-12 rotate-6 scale-90"
                                 x-transition:enter-end="opacity-100 translate-x-0 rotate-0 scale-100"
                                 x-transition:leave="transition ease-in duration-500 absolute inset-0"
                                 x-transition:leave-start="opacity-100 translate-x-0 rotate-0 scale-100"
                                 x-transition:leave-end="opacity-0 -translate-x-12 -rotate-6 scale-90"
                                 class="w-full h-full flex items-center justify-center">
                                <img :src="item.img" class="w-full h-full object-contain drop-shadow-[0_20px_20px_rgba(0,0,0,0.5)]">
                            </div>
                        </template>
                    </div>

                    <div class="relative h-16 text-center w-full">
                        <template x-for="(item, index) in items" :key="index">
                            <div x-show="active === index"
                                 x-transition.opacity.duration.700ms
                                 class="absolute inset-0 w-full flex flex-col justify-center items-center">
                                <h3 class="font-bold text-white text-lg mb-1 line-clamp-1 w-full px-2" style="font-family: 'Playfair Display', serif;" x-text="item.name"></h3>
                                <div class="flex items-center justify-center gap-3">
                                    <span class="text-[#F0718A] font-black text-xl drop-shadow-sm">Rs. <span x-text="item.price"></span></span>
                                    <span class="text-white/50 line-through text-xs font-medium">Rs. <span x-text="item.old_price"></span></span>
                                </div>
                            </div>
                        </template>
                    </div>

                    <button 
                        @click="addToCartAndRedirect(items[active].id)"
                        class="w-full mt-4 bg-white/20 hover:bg-[#F0718A] text-white border border-white/30 hover:border-transparent py-2.5 rounded-xl font-bold transition-all duration-300 text-sm">
                        Grab Offer Now
                    </button>

                </div>
            </div>
        </div>

    </div>
</section>

{{-- ===== MAIN SHOP SECTION ===== --}}
<section class="py-16 bg-[#FFFBF9]"
    x-data="{
        activeCategory: '{{ request('category', '') }}',
        loading: false,
        totalResults: {{ $products->total() }},
        currentPage: {{ $products->currentPage() }},
        lastPage: {{ $products->lastPage() }},

        fetchProducts(category, page = 1) {
            if (this.loading) return;
            this.loading = true;
            this.activeCategory = category;

            let url = new URL('{{ route('products.partial') }}');
            url.searchParams.set('page', page);
            if (category) url.searchParams.set('category', category);

            fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('products-container').innerHTML = data.html;
                this.totalResults = data.total;
                this.currentPage  = data.currentPage;
                this.lastPage     = data.lastPage;

                // Update browser URL
                let historyUrl = new URL('{{ route('products') }}');
                if (category) historyUrl.searchParams.set('category', category);
                if (page > 1) historyUrl.searchParams.set('page', page);
                window.history.pushState({ category, page }, '', historyUrl);

                this.loading = false;

                // Scroll to products section
                document.getElementById('products-section').scrollIntoView({ behavior: 'smooth' });
            })
            .catch(error => {
                console.error('Error fetching products:', error);
                this.loading = false;
            });
        },

        addToCartAndRedirect(id) {
            $.ajax({
                url: '{{ url('/cart/add') }}/' + id,
                type: 'POST',
                data: { _token: '{{ csrf_token() }}', quantity: 1 },
                success: function(response) {
                    window.location.href = '{{ route('cart.index') }}';
                }
            });
        }
    }"
    @popstate.window="
        const params = new URLSearchParams(window.location.search);
        fetchProducts(params.get('category') || '', params.get('page') || 1);
    "
>
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row gap-10">

            {{-- ===== SIDEBAR (Desktop Only) ===== --}}
            <aside class="hidden md:block w-full md:w-1/4">
                <div class="md:sticky md:top-24 space-y-8">

                {{-- Search --}}
               <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-pink-50">
                    <h3 class="text-lg font-bold text-[#3A2A26] mb-4" style="font-family: 'Playfair Display', serif;">Search</h3>
                    <div class="relative">
                        <input type="text"
                            id="search_products"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search products..."
                            class="w-full bg-[#FFF5F1] border border-pink-100 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-pink-300 placeholder-gray-400">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute right-3 top-3 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>

                {{-- Categories --}}
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-pink-50">
                    <h3 class="text-lg font-bold text-[#3A2A26] mb-4" style="font-family: 'Playfair Display', serif;">Categories</h3>
                    <ul class="space-y-2.5">

                        {{-- All Products --}}
                        <li>
                            <button
                                @click="fetchProducts('')"
                                :class="activeCategory === ''
                                    ? 'bg-[#F0718A] text-white shadow-sm'
                                    : 'text-gray-600 hover:bg-pink-50 hover:text-[#F0718A]'"
                                class="w-full flex justify-between items-center px-3 py-2 rounded-xl text-sm font-medium transition-all text-left">
                                <span>All Products</span>
                            </button>
                        </li>

                        @foreach($categories as $cat)
                        <li>
                            <button
                                @click="fetchProducts('{{ $cat->slug }}')"
                                :class="activeCategory === '{{ $cat->slug }}'
                                    ? 'bg-[#F0718A] text-white shadow-sm'
                                    : 'text-gray-600 hover:bg-pink-50 hover:text-[#F0718A]'"
                                class="w-full flex justify-between items-center px-3 py-2 rounded-xl text-sm font-medium transition-all text-left">
                                <span>{{ $cat->name }}</span>
                                <span class="text-xs font-bold px-2 py-0.5 rounded-full transition-all"
                                    :class="activeCategory === '{{ $cat->slug }}'
                                        ? 'bg-white/30 text-white'
                                        : 'bg-yellow-400 text-gray-800'">
                                    {{ $cat->products_count }}
                                </span>
                            </button>
                        </li>
                        @endforeach

                    </ul>
                </div>

                {{-- Tags --}}
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-pink-50">
                    <h3 class="text-lg font-bold text-[#3A2A26] mb-4" style="font-family: 'Playfair Display', serif;">Popular Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Birthday', 'Wedding', 'Chocolate', 'Vanilla', 'Custom', 'Eggless', 'Party'] as $tag)
                            <span onclick="filterByTag('{{ $tag }}')"
                                class="text-xs px-3 py-1.5 rounded-full border border-pink-200 text-pink-600 hover:bg-[#F0718A] hover:text-white hover:border-[#F0718A] transition-all cursor-pointer font-medium">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                </div>

                </div>
            </aside>

            {{-- ===== PRODUCTS AREA ===== --}}
            <div class="w-full md:w-3/4" id="products-section">

                {{-- Mobile Filters Section --}}
                <div class="md:hidden space-y-6 mb-10">
                    {{-- Mobile Search --}}
                    <div class="relative">
                        <input type="text"
                            onkeyup="fetchProductsMobile(this.value)"
                            placeholder="Search products..."
                            class="w-full bg-white border border-pink-100 rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-pink-300 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-4 top-3.5 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>

                    {{-- Mobile Categories Slider --}}
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Categories</p>
                        <div class="-mx-6 px-6 overflow-x-auto no-scrollbar">
                            <div class="flex gap-2 pb-1 min-w-max">
                                <button @click="fetchProducts('')" 
                                    :class="activeCategory === '' ? 'bg-[#F0718A] text-white shadow-md' : 'bg-white text-gray-600 border border-pink-50'"
                                    class="px-5 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2">
                                    All
                                </button>
                                @foreach($categories as $cat)
                                    <button @click="fetchProducts('{{ $cat->slug }}')"
                                        :class="activeCategory === '{{ $cat->slug }}' ? 'bg-[#F0718A] text-white shadow-md' : 'bg-white text-gray-600 border border-pink-50'"
                                        class="px-5 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2">
                                        <span>{{ $cat->name }}</span>
                                        <span class="text-[10px] opacity-70 bg-black/10 px-1.5 py-0.5 rounded-md">{{ $cat->products_count }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Mobile Tags Slider --}}
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Popular Tags</p>
                        <div class="-mx-6 px-6 overflow-x-auto no-scrollbar">
                            <div class="flex gap-2 pb-1 min-w-max">
                                @foreach(['Birthday', 'Wedding', 'Chocolate', 'Vanilla', 'Custom', 'Eggless', 'Party'] as $tag)
                                    <button onclick="filterByTag('{{ $tag }}')"
                                        class="px-4 py-2 rounded-xl bg-white border border-pink-50 text-gray-500 text-[11px] font-medium hover:border-[#F0718A] hover:text-[#F0718A] transition-all">
                                        #{{ $tag }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Toolbar --}}
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8 bg-white p-4 rounded-[1.5rem] shadow-sm border border-pink-50 gap-4">
                    <p class="text-gray-500 text-sm font-medium">
                        Showing
                        <span class="text-[#3A2A26] font-bold" x-text="totalResults"></span>
                        results
                        <span x-show="activeCategory !== ''" class="text-pink-400 italic" x-text="'in \'' + activeCategory + '\''"></span>
                    </p>
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-400">Sort by:</span>
                    <select id="sort_by_ajax" data-url="{{ route('products.partial') }}" class="border rounded-xl px-4 py-2">
                        <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="price_low_high" {{ request('sort_by') == 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high_low" {{ request('sort_by') == 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                    </div>
                </div>

                {{-- Loading Spinner (category switch hone par dikhe) --}}
                <div x-show="loading"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="flex flex-col items-center justify-center py-28">
                    <svg class="animate-spin h-10 w-10 text-[#F0718A] mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    <p class="text-pink-300 text-sm font-medium">Loading products...</p>
                </div>

                {{-- Product Grid — AJAX isi div ko update karega --}}
                <div id="products-container"
                     x-show="!loading"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100slate-y-0"
                     class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
                    @include('partials.products-grid', ['products' => $products])
                </div>

                {{-- ===== PAGINATION ===== --}}
                {{-- Alpine reactive pagination — page number click pe bhi AJAX call hogi --}}
                <div class="mt-14 flex justify-center items-center gap-2"
                     x-show="!loading && lastPage > 1" tran
                     x-transition.opacity>

                    {{-- Prev Button --}}
                    <button
                        @click="if(currentPage > 1) fetchProducts(activeCategory, currentPage - 1)"
                        :disabled="currentPage <= 1"
                        :class="currentPage <= 1 ? 'opacity-40 cursor-not-allowed' : 'hover:bg-pink-50 hover:text-pink-500'"
                        class="w-10 h-10 rounded-full border border-pink-100 text-gray-400 transition flex items-center justify-center text-sm">
                        ←
                    </button>

                    {{-- Page Numbers --}}
                    <template x-for="p in lastPage" :key="p">
                        <button
                            @click="fetchProducts(activeCategory, p)"
                            :class="p === currentPage
                                ? 'bg-[#F0718A] text-white shadow-md shadow-pink-200'
                                : 'border border-pink-100 text-gray-500 hover:bg-pink-50 hover:text-pink-500'"
                            class="w-10 h-10 rounded-full font-bold text-sm transition flex items-center justify-center"
                            x-text="p">
                        </button>
                    </template>

                    {{-- Next Button --}}
                    <button
                        @click="if(currentPage < lastPage) fetchProducts(activeCategory, currentPage + 1)"
                        :disabled="currentPage >= lastPage"
                        :class="currentPage >= lastPage ? 'opacity-40 cursor-not-allowed' : 'hover:bg-pink-50 hover:text-pink-500'"
                        class="w-10 h-10 rounded-full border border-pink-100 text-gray-400 transition flex items-center justify-center text-sm">
                        →
                    </button>

                </div>

            </div>
        </div>
    </div>
</section>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#sort_by_ajax').on('change', function() {
        let sortBy = $(this).val();
        let url = $(this).data('url');
        let category = new URLSearchParams(window.location.search).get('category');

        // Loading effect (Optional)
        $('#products-container').css('opacity', '0.5');

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                sort_by: sortBy,
                category: category
            },
            success: function(response) {
                // Sirf products wala grid update karein
                $('#products-container').html(response.html);
                $('#products-container').css('opacity', '1');

                // URL ko update karein bina page load kiye (Optional)
                let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?sort_by=' + sortBy;
                if(category) newUrl += '&category=' + category;
                window.history.pushState({path:newUrl}, '', newUrl);
            }
        });
    });
});

$(document).ready(function() {

    // 1. Jab user search box mein type kare (Live Search)
    $('#search_products').on('keyup', function() {
        fetchProducts();
    });

    // 2. Jab user sorting dropdown badle (Price Low/High etc)
    $('#sort_by_ajax').on('change', function() {
        fetchProducts();
    });

    // 3. Global function Popular Tags ke liye (isko globally define kiya hai taake onclick kaam kare)
    window.filterByTag = function(tagName) {
        // Search box mein tag ka naam dalna
        $('#search_products').val(tagName);
        // Products fetch karna
        fetchProducts();

        // Smooth scroll to results (optional but good for UX)
        $('html, body').animate({
            scrollTop: $("#products-container").offset().top - 100
        }, 500);
    }

    // Main AJAX Function
    function fetchProducts() {
        let search = $('#search_products').val();
        // Fallback for mobile search
        if(!search && $('.md\\:hidden input').val()) {
            search = $('.md\\:hidden input').val();
        }
        let sortBy = $('#sort_by_ajax').val();
        let category = new URLSearchParams(window.location.search).get('category');
        let url = "{{ route('products.partial') }}";

        // Loading effect start
        $('#products-container').css('opacity', '0.5');

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                search: search,
                sort_by: sortBy,
                category: category
            },
            success: function(response) {
                // Products grid update karna
                $('#products-container').html(response.html);
                $('#products-container').css('opacity', '1');

                // Browser URL update karna (PushState)
                let newUrl = new URL(window.location.href);

                if(search) newUrl.searchParams.set('search', search);
                else newUrl.searchParams.delete('search');

                if(sortBy) newUrl.searchParams.set('sort_by', sortBy);

                // URL bar mein tabdeeli bina reload ke
                window.history.pushState({path: newUrl.href}, '', newUrl.href);
            },
            error: function() { showToast("Something went wrong!", 'error'); 
                $('#products-container').css('opacity', '1');
            }
        });
    }

    // Mobile Search Bridge
    window.fetchProductsMobile = function(val) {
        $('#search_products').val(val);
        fetchProducts();
    }
});
</script>
