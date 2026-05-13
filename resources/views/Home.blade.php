@extends('layouts.app')

@section('content')

    <section class="relative h-[600px] flex items-center overflow-hidden bg-[#FFF4ED]">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/card_pic.png') }}"
             class="w-full h-full object-cover"
             alt="Bakery Background">
        <div class="absolute inset-0 bg-gradient-to-r from-[#FFF4ED]/90 via-[#FFF4ED]/60 to-transparent"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="md:w-2/3 lg:w-1/2 space-y-6">
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold text-[#3A2A26] leading-[1.05]" style="font-family: 'Playfair Display', serif;">
                Freshly <span class="text-[#F0718A] italic" style="font-family: 'Dancing Script', cursive;">Baked</span> <br>
                Happiness, Every Day 
                <span class="text-[#F0718A] font-sans font-normal text-6xl md:text-8xl inline-block rotate-12 align-middle ml-2 drop-shadow-sm">♡</span>
            </h1>

            <p class="text-gray-700 text-lg max-w-md font-medium leading-relaxed">
                Delicious cakes, pastries, and breads <br class="hidden md:block"> made with love.
            </p>

            <div class="flex flex-row gap-4 pt-4 justify-center md:justify-start">
                <a href="{{ route('products') }}" class="flex-1 md:flex-none text-center bg-[#F0718A] text-white px-6 md:px-8 py-3 rounded-full font-bold shadow-lg shadow-pink-200 hover:bg-[#E06079] transition transform hover:-translate-y-1 text-sm md:text-base">
                    Shop Now
                </a>
                <a href="{{ route('categories.all') }}" class="flex-1 md:flex-none text-center bg-transparent border-2 border-[#EADACF] text-gray-800 px-6 md:px-8 py-3 rounded-full font-bold hover:border-gray-400 transition shadow-sm text-sm md:text-base">
                    View Menu
                </a>
            </div>
        </div>
    </div>
</section>


    <section class="py-16 bg-[#FFFBF9]" style="font-family: 'Poppins', sans-serif;">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-[#3A2A26]" style="font-family: 'Playfair Display', serif;">Our Categories</h2>
            <div class="relative flex items-center justify-center mt-2">
                <div class="w-24 h-[1px] bg-pink-200"></div>
                <span class="absolute bg-[#FFFBF9] px-2 text-pink-400 text-sm">🧁</span>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-6 gap-6">
            {{-- dynamic categories --}}
             @foreach($categories as $category)
            <a href="{{ route('products') }}?category={{ $category->slug }}" class="group">
                <div class="bg-[#FFF8F6] rounded-[2rem] p-6 flex flex-col items-center justify-center transition-all duration-300 hover:bg-[#FEECEB] hover:shadow-md hover:-translate-y-1 border border-pink-100/50">
                    <div class="h-24 w-24 mb-4 flex items-center justify-center">
                        <img src="{{ asset('storage/' . $category->image) }}"
                            alt="{{ $category->name }}"
                            class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="font-bold text-gray-800 text-lg" style="font-family: 'Playfair Display', serif;">
                        {{ $category->name }}
                    </p>
                </div>
            </a>
            @endforeach
            {{-- dynamic categories --}}
        </div>
    </div>
</section>

    <section class="py-16 bg-[#FFFBF9]" style="font-family: 'Poppins', sans-serif;">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-[#3A2A26]" style="font-family: 'Playfair Display', serif;">Popular Products</h2>
            <div class="relative flex items-center justify-center mt-2">
                <div class="w-24 h-[1px] bg-pink-200"></div>
                <span class="absolute bg-[#FFFBF9] px-2 text-pink-400 text-sm">🧁</span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($featuredProducts as $product)
    <div class="bg-white rounded-[1.5rem] overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 group p-3 border border-gray-50 flex flex-col h-full">
        <div class="relative h-56 w-full rounded-xl overflow-hidden mb-4 shrink-0">
            <a href="{{ route('product.details', $product->slug) }}">
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
            <a href="{{ route('product.details', $product->slug) }}">
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
            class="add-to-cart-btn mt-auto w-full bg-[#F0718A] text-white py-2.5 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-[#E06079] transition-all active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span>Add to Cart</span>
        </button>
        </div>
    </div>
    @endforeach
</div>
    </div>
</section>

<section class="py-3">
    <div class="container mx-auto px-3 max-w-8xl">
        <div class="w-full rounded-[2.5rem] overflow-hidden relative flex items-center min-h-[250px] md:min-h-[350px] bg-[#FFA2A9] shadow-md">
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/birthday_discount.png') }}"
                     class="w-full h-full object-cover object-right-bottom md:object-center opacity-90 mix-blend-multiply">
                <div class="absolute inset-0 bg-gradient-to-r from-[#FFA2A9]/90 via-[#FFA2A9]/40 to-transparent"></div>
            </div>

            <div class="relative z-10 px-8 md:px-16 space-y-4 md:w-1/2 text-[#3A2A26]">
                <p class="font-medium text-sm md:text-base tracking-wide">
                    Limited Time Offer
                </p>

                <h2 class="leading-tight">
                    <span class="inline-block text-5xl md:text-7xl font-black tracking-tight">
                        20% OFF
                    </span>
                    <br>
                    <span class="text-2xl md:text-4xl font-medium">
                        on Birthday Cakes!
                    </span>
                </h2>

                <div class="pt-4">
                    <a href="{{ route('custom-cake.index') }}" class="inline-block bg-[#6B4F4F] text-white px-10 py-3.5 rounded-full font-bold hover:bg-[#523B3B] transition-all shadow-md text-sm md:text-base">
                        Customize Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Custom Floating Animation */
    @keyframes float {
        0% { transform: translate(0, 0); }
        25% { transform: translate(-3px, -5px); }
        50% { transform: translate(3px, -2px); }
        75% { transform: translate(-2px, 3px); }
        100% { transform: translate(0, 0); }
    }
    .animate-float {
        animation: float 4s ease-in-out infinite;
    }
</style>

<section class="py-20 bg-[#FFFBF9]">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-24 items-start">

            <!-- About Us -->
            <div class="flex flex-col md:flex-row gap-10 items-center text-center md:text-left bg-white/50 p-8 rounded-[3rem] md:bg-transparent md:p-0">
                <div class="w-48 md:w-64 shrink-0 mx-auto md:mx-0">
                    <img src="{{ asset('images/about_us_section.png') }}" alt="Bakery Items"
                         class="w-full h-auto drop-shadow-2xl opacity-90 -rotate-6 md:-rotate-12 transform transition hover:scale-105">
                </div>
                <div class="space-y-5">
                    <div class="inline-block">
                        <h2 class="text-3xl font-bold text-[#3A2A26]" style="font-family: 'Playfair Display', serif;">About Us</h2>
                        <div class="relative flex items-center justify-center md:justify-start mt-1">
                            <div class="w-12 h-[1px] bg-pink-200"></div>
                            <span class="px-1 text-pink-400 text-sm">🧁</span>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                        We are a home-based bakery creating fresh and delicious treats for every occasion. Quality ingredients and love are our secret.
                    </p>
                    <p class="text-[#CDA494] font-serif text-2xl italic" style="font-family: 'Great Vibes', cursive;">Baked with love
                         <span class="text-pink-500 text-4xl inline-block rotate-12">♡</span></p>
                </div>
            </div>

            <!-- Testimonials -->
            <div class="space-y-6" x-data="{
                reviews: [
                    { text: 'Best cakes in town! Very fresh, tasty and beautifully designed. Highly recommended.', name: 'Ali Khan' },
                    { text: 'Absolutely loved the chocolate cake, it was a hit at our party!', name: 'Sarah Ahmed' },
                    { text: 'The cupcakes were so soft and the frosting was just perfect.', name: 'Zainab B.' }
                ],
                currentIndex: 0,
                init() {
                    setInterval(() => { this.next() }, 4000);
                },
                next() {
                    this.currentIndex = (this.currentIndex + 1) % this.reviews.length;
                },
                prev() {
                    this.currentIndex = (this.currentIndex - 1 + this.reviews.length) % this.reviews.length;
                }
            }">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-[#3A2A26]" style="font-family: 'Playfair Display', serif;">What Our Customers Say</h2>
                    <div class="relative flex items-center justify-center mt-1">
                        <div class="w-12 h-[1px] bg-pink-200"></div>
                        <span class="px-1 text-pink-400 text-sm">🧁</span>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm relative flex items-center gap-4 min-h-[160px]">
                    <button @click="prev()" class="w-8 h-8 rounded-full bg-[#F0718A] text-white flex items-center justify-center shrink-0 hover:bg-[#E06079] transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" /></svg>
                    </button>

                    <div class="text-center space-y-4 flex-1">
                        <p class="text-gray-600 text-sm md:text-base italic leading-relaxed px-2 transition-all duration-300" x-text="'&quot;' + reviews[currentIndex].text + '&quot;'">
                            "Best cakes in town! Very fresh, tasty and beautifully designed. Highly recommended."
                        </p>
                        <div class="flex justify-center gap-1 text-yellow-400">
                            @for($i=0; $i<5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                            @endfor
                        </div>
                        <p class="font-bold text-gray-800 text-sm" x-text="'— ' + reviews[currentIndex].name">— Ali Khan</p>
                    </div>

                    <button @click="next()" class="w-8 h-8 rounded-full bg-[#F0718A] text-white flex items-center justify-center shrink-0 hover:bg-[#E06079] transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                    </button>
                </div>

                <div class="flex justify-center gap-2 mt-4">
                    <template x-for="(review, index) in reviews" :key="index">
                        <div class="w-2 h-2 rounded-full cursor-pointer transition-colors"
                             :class="currentIndex === index ? 'bg-[#F0718A]' : 'bg-gray-200'"
                             @click="currentIndex = index"></div>
                    </template>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
