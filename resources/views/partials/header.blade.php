<nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-pink-50 shadow-sm transition-all duration-300" x-data="{ mobileMenuOpen: false }">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        {{-- Logo --}}
        <a href="/" class="flex items-center gap-2 group">
            <div class="w-10 h-10 bg-[#F0718A] rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-md shadow-pink-200 group-hover:rotate-12 transition-transform duration-300">
                HK
            </div>
            <span class="text-2xl font-bold text-[#3A2A26] tracking-tight" style="font-family: 'Playfair Display', serif;">
                Bakers<span class="text-[#F0718A]">.</span>
            </span>
        </a>

        {{-- Navigation Links (Desktop) --}}
        <div class="hidden md:flex space-x-8 font-semibold text-gray-600 text-sm tracking-wide">
            <a href="/" class="{{ request()->is('/') ? 'text-[#F0718A]' : 'hover:text-[#F0718A]' }} transition-colors">Home</a>
            <a href="{{ route('categories.all') }}" class="{{ request()->routeIs('categories.all') ? 'text-[#F0718A]' : 'hover:text-[#F0718A]' }} transition-colors">Categories</a>
            <a href="{{ route('products') }}" class="{{ request()->routeIs('products') ? 'text-[#F0718A]' : 'hover:text-[#F0718A]' }} transition-colors">All Products</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-[#F0718A]' : 'hover:text-[#F0718A]' }} transition-colors">About Us</a>
            <a href="{{ route('custom-cake.index') }}" class="{{ request()->routeIs('custom-cake.index') ? 'text-[#F0718A]' : 'hover:text-[#F0718A]' }} transition-colors">Customize Cake</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-[#F0718A]' : 'hover:text-[#F0718A]' }} transition-colors">Contact</a>
        </div>

        {{-- Action Icons --}}
        <div class="flex items-center space-x-2 md:space-x-5 text-gray-500">
            {{-- Cart --}}
            <a href="{{ route('cart.index') }}" class="relative flex items-center justify-center bg-[#FFF5F1] text-[#F0718A] hover:bg-[#F0718A] hover:text-white p-2.5 rounded-full transition-all group shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <span class="cart-count-badge absolute -top-1 -right-1 bg-black text-white text-[10px] rounded-full h-4 w-4 flex items-center justify-center">
                    {{ count(session('cart', [])) }}
                </span>
            </a>

            {{-- Mobile Menu Toggle --}}
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-xl bg-pink-50 text-[#F0718A] transition-all active:scale-90">
                <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu Content --}}
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden bg-white border-t border-pink-50 p-6 space-y-4 shadow-xl">
        <a href="/" class="block font-bold text-gray-700 hover:text-[#F0718A]">Home</a>
        <a href="{{ route('categories.all') }}" class="block font-bold text-gray-700 hover:text-[#F0718A]">Categories</a>
        <a href="{{ route('products') }}" class="block font-bold text-gray-700 hover:text-[#F0718A]">All Products</a>
        <a href="{{ route('about') }}" class="block font-bold text-gray-700 hover:text-[#F0718A]">About Us</a>
        <a href="{{ route('custom-cake.index') }}" class="block font-bold text-gray-700 hover:text-[#F0718A]">Customize Cake</a>
        <a href="{{ route('contact') }}" class="block font-bold text-gray-700 hover:text-[#F0718A]">Contact</a>
        <div class="pt-4 border-t border-pink-50 flex gap-4">
             <a href="/admin" class="flex-1 text-center py-3 bg-pink-50 text-[#F0718A] rounded-xl font-bold">Admin</a>
        </div>
    </div>
</nav>
