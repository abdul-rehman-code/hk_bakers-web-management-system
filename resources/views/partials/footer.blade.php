<footer class="bg-white border-t border-gray-100 pt-16 pb-8 mt-20">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">

            <div class="space-y-4">
                <a href="/" class="text-2xl font-bold text-amber-700">
                    HK <span class="text-gray-900">Bakers</span>
                </a>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Baked fresh. Delivered with love. We bring the sweetness of handmade treats right to your doorstep.
                </p>
                <div class="flex space-x-4 pt-2">
                    <a href="#" class="w-8 h-8 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center hover:bg-pink-600 hover:text-white transition">
                        <i class="fa-brands fa-facebook-f text-xs"></i>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center hover:bg-pink-600 hover:text-white transition">
                        <i class="fa-brands fa-instagram text-xs"></i>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center hover:bg-pink-600 hover:text-white transition">
                        <i class="fa-brands fa-tiktok text-xs"></i>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-gray-900 font-bold mb-6">Quick Links</h4>
                <ul class="space-y-3 text-sm text-gray-600 font-medium">
                    <li><a href="/" class="hover:text-amber-700 transition">Home</a></li>
                    <li><a href="{{ route('categories.all') }}" class="hover:text-amber-700 transition">Categories</a></li>
                    <li><a href="{{ route('products') }}" class="hover:text-amber-700 transition">All Products</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-amber-700 transition">About Us</a></li>
                    <li><a href="{{ route('custom-cake.index') }}" class="hover:text-amber-700 transition">Customize Cake</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-amber-700 transition">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-gray-900 font-bold mb-6">Contact Us</h4>
                <ul class="space-y-4 text-sm text-gray-600">
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        +92 300 1234567
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        info@hkbakers.com
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>123 Bakery Street, <br> Lahore, Pakistan</span>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-gray-900 font-bold mb-6">Newsletter</h4>
                <p class="text-sm text-gray-500 mb-4">Subscribe to get latest updates and offers.</p>
                <form class="flex flex-col gap-2">
                    <input type="email" placeholder="Enter your email" class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-amber-600">
                    <button type="submit" class="bg-pink-500 text-white rounded-lg px-4 py-2 text-sm font-bold hover:bg-pink-600 transition shadow-md">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-8 text-center text-xs text-gray-400">
            © 2026 HK Bakers. All Rights Reserved. | Developed by AR SOFT
        </div>
    </div>
</footer>
