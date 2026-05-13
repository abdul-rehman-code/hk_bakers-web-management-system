@extends('layouts.app')

@section('content')
<!-- Page Header/Hero -->
<section class="relative py-8 md:py-24 overflow-hidden bg-[#2C1E16]">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/card_pic.png') }}" class="w-full h-full object-cover opacity-30 mix-blend-overlay">
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-[#2C1E16]/80 to-[#FFFBF9]"></div>
    </div>
    <div class="container mx-auto px-6 relative z-10 flex flex-col md:flex-row items-center gap-12">

        <!-- Text Content -->
        <div class="md:w-1/2 text-center md:text-left">
            <span class="inline-block py-1.5 px-4 rounded-full bg-pink-500/20 text-pink-300 text-sm font-bold tracking-widest mb-6 border border-pink-500/30 uppercase shadow-sm">Delicious Variety</span>
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 drop-shadow-lg" style="font-family: 'Playfair Display', serif;">Our Complete Menu</h1>
            <p class="text-pink-50 max-w-xl mx-auto md:mx-0 text-lg md:text-xl leading-relaxed font-medium drop-shadow-md">
                Browse through our freshly baked collections. From decadent chocolate cakes to buttery pastries, everything is crafted with love.
            </p>
        </div>

        <!-- 3D Animation Area -->
        <div class="md:w-1/2 relative h-[220px] md:h-[400px] w-full flex items-center justify-center perspective-1000">
            <img src="{{ asset('images/cake.png') }}" class="absolute w-44 h-44 md:w-72 md:h-72 object-contain animate-fly3d drop-shadow-2xl" style="animation-delay: 0s;">
            <img src="{{ asset('images/cup_cake.png') }}" class="absolute w-44 h-44 md:w-72 md:h-72 object-contain animate-fly3d drop-shadow-2xl" style="animation-delay: -3s;">
            <img src="{{ asset('images/cookies.png') }}" class="absolute w-44 h-44 md:w-72 md:h-72 object-contain animate-fly3d drop-shadow-2xl" style="animation-delay: -6s;">
        </div>

    </div>
</section>

<style>
    @keyframes fly3D {
        0%, 22% {
            transform: translate(0, 0) scale(1) rotate(0deg);
            opacity: 1;
            z-index: 30;
        }
        33.33% {
            transform: translate(-120%, 80%) scale(1.4) rotate(-15deg);
            opacity: 0;
            z-index: 30;
        }
        33.34%, 66.65% {
            transform: translate(120%, -80%) scale(0.2) rotate(15deg);
            opacity: 0;
            z-index: 10;
        }
        66.66%, 89% {
            transform: translate(80%, -60%) scale(0.4) rotate(10deg);
            opacity: 0.9;
            z-index: 20;
        }
        100% {
            transform: translate(0, 0) scale(1) rotate(0deg);
            opacity: 1;
            z-index: 30;
        }
    }
    .animate-fly3d {
        animation: fly3D 9s infinite ease-in-out;
        will-change: transform, opacity;
    }
</style>

<!-- Categories Grid -->
<section class="py-20 bg-[#FFFBF9] relative overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute top-10 left-10 text-6xl opacity-5 rotate-12 select-none pointer-events-none">🧁</div>
    <div class="absolute bottom-10 right-10 text-6xl opacity-5 -rotate-12 select-none pointer-events-none">🥐</div>
    <div class="absolute top-1/2 right-20 text-6xl opacity-5 rotate-45 select-none pointer-events-none">🍩</div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-[#3A2A26]" style="font-family: 'Playfair Display', serif;">Explore Categories</h2>
            <div class="relative flex items-center justify-center mt-4">
                <div class="w-32 h-[2px] bg-gradient-to-r from-transparent via-pink-300 to-transparent"></div>
                <span class="absolute bg-[#FFFBF9] px-3 text-pink-400 text-xl">✨</span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
           @foreach($categories as $category)
    <a href="{{ route('products', ['category' => $category->slug]) }}" class="group block h-full">
        <div class="bg-white rounded-[2rem] p-8 flex flex-col items-center justify-center transition-all duration-500 shadow-md border-b-4 border-transparent group-hover:border-[#F0718A] group-hover:bg-[#FFF5F1] group-hover:shadow-2xl group-hover:-translate-y-3 h-full relative overflow-hidden">

            <div class="absolute inset-0 bg-gradient-to-br from-pink-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

            <div class="h-32 w-32 mb-6 flex items-center justify-center bg-pink-50 rounded-full group-hover:bg-white group-hover:shadow-inner transition-all duration-500 relative z-10">
                <img src="{{ asset('storage/' . $category->image) }}"
                     alt="{{ $category->name }}"
                     class="w-20 h-20 object-contain drop-shadow-xl group-hover:scale-125 group-hover:rotate-6 transition-transform duration-500">
            </div>

            <h3 class="font-bold text-gray-900 text-2xl relative z-10" style="font-family: 'Playfair Display', serif;">
                {{ $category->name }}
            </h3>

            <p class="text-gray-400 text-sm mt-1 relative z-10 group-hover:text-[#F0718A]/70">
                {{ $category->products_count }} Items
            </p>

            <div class="mt-4 flex items-center gap-2 text-[#F0718A] font-bold opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0 relative z-10">
                <span>View Items</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                </svg>
            </div>
        </div>
    </a>
@endforeach
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-24 bg-[#FFA2A9] relative overflow-hidden">
    <!-- Overlay Pattern -->
    <div class="absolute inset-0 opacity-10 mix-blend-overlay" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 24px 24px;"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/10"></div>

    <div class="container mx-auto px-6 max-w-6xl relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-white drop-shadow-md" style="font-family: 'Playfair Display', serif;">The HK Bakers Promise</h2>
            <div class="relative flex items-center justify-center mt-6">
                <div class="w-32 h-[2px] bg-white/30"></div>
                <span class="absolute px-4 text-white text-xl">♡</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
            <div class="space-y-6 p-10 bg-white/95 backdrop-blur-sm rounded-[2.5rem] shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                <div class="w-20 h-20 mx-auto bg-[#F0718A] text-white rounded-2xl rotate-3 flex items-center justify-center text-4xl shadow-lg shadow-pink-500/30">🌾</div>
                <h3 class="font-bold text-[#3A2A26] text-2xl" style="font-family: 'Playfair Display', serif;">Finest Ingredients</h3>
                <p class="text-gray-600 text-base leading-relaxed font-medium">We use only premium, locally-sourced ingredients to ensure the best taste and quality in every bite.</p>
            </div>

            <div class="space-y-6 p-10 bg-white/95 backdrop-blur-sm rounded-[2.5rem] shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 delay-100">
                <div class="w-20 h-20 mx-auto bg-[#F0718A] text-white rounded-2xl -rotate-3 flex items-center justify-center text-4xl shadow-lg shadow-pink-500/30">🧑‍🍳</div>
                <h3 class="font-bold text-[#3A2A26] text-2xl" style="font-family: 'Playfair Display', serif;">Freshly Baked</h3>
                <p class="text-gray-600 text-base leading-relaxed font-medium">Every order is baked fresh daily by our expert pastry chefs just for you, guaranteeing maximum freshness.</p>
            </div>

            <div class="space-y-6 p-10 bg-white/95 backdrop-blur-sm rounded-[2.5rem] shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 delay-200">
                <div class="w-20 h-20 mx-auto bg-[#F0718A] text-white rounded-2xl rotate-3 flex items-center justify-center text-4xl shadow-lg shadow-pink-500/30">💝</div>
                <h3 class="font-bold text-[#3A2A26] text-2xl" style="font-family: 'Playfair Display', serif;">Made with Love</h3>
                <p class="text-gray-600 text-base leading-relaxed font-medium">A dash of love and passion goes into every single treat that leaves our bakery, making it extra special.</p>
            </div>
        </div>
    </div>
</section>
@endsection
