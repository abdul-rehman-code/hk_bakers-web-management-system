@extends('layouts.app')

@section('content')

{{-- ===== HERO BANNER ===== --}}
<section class="relative py-24 overflow-hidden bg-[#2C1E16] text-center">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1556217477-d325251ece38?q=80&w=1600" class="w-full h-full object-cover opacity-25 mix-blend-overlay">
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-[#2C1E16]/80 to-[#FFFBF9]"></div>
    </div>
    <div class="container mx-auto px-6 relative z-10">
        <span class="inline-block py-1.5 px-5 rounded-full bg-pink-500/20 text-pink-300 text-sm font-bold tracking-widest mb-5 border border-pink-500/30 uppercase">Our Journey</span>
        <h1 class="text-5xl md:text-7xl font-bold text-white mb-5 drop-shadow-lg" style="font-family: 'Playfair Display', serif;">About HK Bakers</h1>
        <p class="text-pink-100 text-lg md:text-xl max-w-2xl mx-auto font-medium italic">
            "Baked with love and the finest ingredients, bringing happiness to your doorstep every single day."
        </p>
    </div>
</section>

{{-- ===== OUR STORY ===== --}}
<section class="py-24 bg-[#FFFBF9]">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">

            {{-- Image Collage --}}
            <div class="relative h-[450px] md:h-[550px] group">
                <!-- Main Image -->
                <div class="absolute top-5 left-0 w-4/5 h-[85%] rounded-[2.5rem] md:rounded-[4rem] overflow-hidden shadow-2xl z-10 -rotate-3 group-hover:-rotate-1 transition-all duration-700">
                    <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?q=80&w=800" alt="Beautiful Cake" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>
                
                <!-- Secondary Image -->
                <div class="absolute bottom-0 right-0 w-3/5 h-[55%] rounded-[2.5rem] md:rounded-[4rem] overflow-hidden shadow-2xl z-20 border-[6px] md:border-[12px] border-white rotate-6 group-hover:rotate-3 transition-all duration-700">
                    <img src="https://images.unsplash.com/photo-1556217477-d325251ece38?q=80&w=600" alt="Baking Process" class="w-full h-full object-cover">
                </div>

                <!-- Decorative floating elements -->
                <div class="absolute -top-4 right-12 w-20 h-20 bg-pink-200 rounded-full mix-blend-multiply filter blur-2xl opacity-60 animate-pulse"></div>
                <div class="absolute -bottom-6 left-12 w-24 h-24 bg-yellow-200 rounded-full mix-blend-multiply filter blur-2xl opacity-60 animate-pulse delay-1000"></div>
                
                <div class="absolute top-1/2 -right-4 w-12 h-12 bg-white rounded-2xl shadow-lg flex items-center justify-center text-2xl z-30 animate-bounce">🎂</div>
                <div class="absolute bottom-1/4 -left-6 w-10 h-10 bg-white rounded-xl shadow-lg flex items-center justify-center text-xl z-30 animate-float">🧁</div>
            </div>

            {{-- Text --}}
            <div class="space-y-6">
                <div>
                    <span class="text-[#F0718A] font-bold text-sm tracking-widest uppercase">Who We Are</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-[#3A2A26] mt-2" style="font-family: 'Playfair Display', serif;">
                        A Bakery Born <br>From Passion
                    </h2>
                </div>

                <p class="text-gray-600 leading-relaxed text-lg">
                    We are a home-based bakery creating fresh and delicious treats for every occasion. Our journey started with a simple passion for baking and has grown into a community of dessert lovers.
                </p>
                <p class="text-gray-600 leading-relaxed text-lg">
                    Every cake, pastry, and bread is made with the finest ingredients to ensure you get the best taste. Quality and love are our secret ingredients.
                </p>

                <div class="grid grid-cols-2 gap-5 pt-4">
                    <div class="flex items-center gap-4 bg-white p-4 rounded-2xl shadow-sm border border-pink-50 hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-[#F0718A] text-white rounded-xl flex items-center justify-center text-2xl shadow-md shadow-pink-200/50 rotate-3">✨</div>
                        <div>
                            <p class="font-bold text-[#3A2A26]">Freshly Baked</p>
                            <p class="text-gray-400 text-xs">Every single day</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 bg-white p-4 rounded-2xl shadow-sm border border-pink-50 hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-[#F0718A] text-white rounded-xl flex items-center justify-center text-2xl shadow-md shadow-pink-200/50 -rotate-3">🌿</div>
                        <div>
                            <p class="font-bold text-[#3A2A26]">Premium Quality</p>
                            <p class="text-gray-400 text-xs">Best ingredients</p>
                        </div>
                    </div>
                </div>

                <p class="text-[#CDA494] text-3xl italic pt-2" style="font-family: 'Great Vibes', cursive;">
                    Baked with love <span class="text-pink-500 text-4xl inline-block rotate-12">♡</span>
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ===== STATS COUNTER ===== --}}
<section class="py-16 bg-[#F0718A] relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 mix-blend-overlay" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 24px 24px;"></div>
    <div class="container mx-auto px-6 max-w-5xl relative z-10">
        
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('numberCounter', (target, duration = 2000, suffix = '+') => ({
                    count: 0,
                    display: '0' + suffix,
                    init() {
                        let start = null;
                        const step = (timestamp) => {
                            if (!start) start = timestamp;
                            const progress = Math.min((timestamp - start) / duration, 1);
                            // easeOutQuart curve for smooth slowdown
                            const ease = 1 - Math.pow(1 - progress, 4);
                            this.count = Math.floor(ease * target);
                            
                            // Format logic
                            if (target >= 1000) {
                                this.display = (this.count / 1000).toFixed(1).replace('.0', '') + 'K' + suffix;
                            } else {
                                this.display = this.count + suffix;
                            }
                            
                            if (progress < 1) {
                                window.requestAnimationFrame(step);
                            }
                        };
                        
                        // Start animation when scrolled into view
                        const observer = new IntersectionObserver((entries) => {
                            if(entries[0].isIntersecting) {
                                window.requestAnimationFrame(step);
                                observer.disconnect();
                            }
                        }, { threshold: 0.5 });
                        
                        observer.observe(this.$el);
                    }
                }))
            })
        </script>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white">
            <div class="space-y-2" x-data="numberCounter(5, 2000, '+')">
                <p class="text-5xl md:text-6xl font-black drop-shadow-md" x-text="display">0+</p>
                <p class="text-pink-100 font-medium text-sm uppercase tracking-wide">Years of Baking</p>
            </div>
            <div class="space-y-2" x-data="numberCounter(2000, 2500, '+')">
                <p class="text-5xl md:text-6xl font-black drop-shadow-md" x-text="display">0K+</p>
                <p class="text-pink-100 font-medium text-sm uppercase tracking-wide">Happy Customers</p>
            </div>
            <div class="space-y-2" x-data="numberCounter(50, 2000, '+')">
                <p class="text-5xl md:text-6xl font-black drop-shadow-md" x-text="display">0+</p>
                <p class="text-pink-100 font-medium text-sm uppercase tracking-wide">Unique Recipes</p>
            </div>
            <div class="space-y-2" x-data="numberCounter(100, 2500, '%')">
                <p class="text-5xl md:text-6xl font-black drop-shadow-md" x-text="display">0%</p>
                <p class="text-pink-100 font-medium text-sm uppercase tracking-wide">Love & Care</p>
            </div>
        </div>
    </div>
</section>

{{-- ===== OUR VALUES ===== --}}
<section class="py-24 bg-[#FFFBF9]">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="text-center mb-16">
            <span class="text-[#F0718A] font-bold text-sm tracking-widest uppercase">What Drives Us</span>
            <h2 class="text-4xl font-bold text-[#3A2A26] mt-2" style="font-family: 'Playfair Display', serif;">Our Core Values</h2>
            <div class="relative flex items-center justify-center mt-4">
                <div class="w-32 h-[2px] bg-gradient-to-r from-transparent via-pink-300 to-transparent"></div>
                <span class="absolute bg-[#FFFBF9] px-3 text-pink-400 text-xl">✨</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
            <div class="space-y-5 p-10 bg-white rounded-[2.5rem] shadow-sm border border-pink-50 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 group">
                <div class="w-20 h-20 mx-auto bg-[#F0718A] text-white rounded-2xl rotate-3 group-hover:-rotate-3 flex items-center justify-center text-4xl shadow-lg shadow-pink-500/30 transition-transform duration-500">❤️</div>
                <h3 class="font-bold text-[#3A2A26] text-2xl" style="font-family: 'Playfair Display', serif;">Passion</h3>
                <p class="text-gray-500 leading-relaxed">Everything we bake comes from a place of deep love, creativity, and a genuine desire to make people happy.</p>
            </div>

            <div class="space-y-5 p-10 bg-white rounded-[2.5rem] shadow-sm border border-pink-50 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 group">
                <div class="w-20 h-20 mx-auto bg-[#F0718A] text-white rounded-2xl -rotate-3 group-hover:rotate-3 flex items-center justify-center text-4xl shadow-lg shadow-pink-500/30 transition-transform duration-500">⭐</div>
                <h3 class="font-bold text-[#3A2A26] text-2xl" style="font-family: 'Playfair Display', serif;">Quality</h3>
                <p class="text-gray-500 leading-relaxed">We never compromise on the ingredients we use. Only the finest, freshest, and most premium quality makes the cut.</p>
            </div>

            <div class="space-y-5 p-10 bg-white rounded-[2.5rem] shadow-sm border border-pink-50 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 group">
                <div class="w-20 h-20 mx-auto bg-[#F0718A] text-white rounded-2xl rotate-3 group-hover:-rotate-3 flex items-center justify-center text-4xl shadow-lg shadow-pink-500/30 transition-transform duration-500">🤝</div>
                <h3 class="font-bold text-[#3A2A26] text-2xl" style="font-family: 'Playfair Display', serif;">Community</h3>
                <p class="text-gray-500 leading-relaxed">Our customers are family. Every smile, every celebration, and every sweet moment is what keeps us going.</p>
            </div>
        </div>
    </div>
</section>

{{-- ===== GALLERY ===== --}}
<section class="py-20 bg-[#FFF5F1]">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="text-center mb-12">
            <span class="text-[#F0718A] font-bold text-sm tracking-widest uppercase">Behind the Scenes</span>
            <h2 class="text-4xl font-bold text-[#3A2A26] mt-2" style="font-family: 'Playfair Display', serif;">From Our Kitchen</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="rounded-[2rem] overflow-hidden shadow-md hover:shadow-xl transition-shadow group col-span-2 row-span-2">
                <img src="https://images.unsplash.com/photo-1517433367423-c7e5b0f35086?q=80&w=1000" alt="Baking" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            </div>
            <div class="rounded-[2rem] overflow-hidden shadow-md hover:shadow-xl transition-shadow group">
                <img src="https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?q=80&w=400" alt="Cupcakes" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            </div>
            <div class="rounded-[2rem] overflow-hidden shadow-md hover:shadow-xl transition-shadow group">
                <img src="https://images.unsplash.com/photo-1558301211-0d8c8ddee6ec?q=80&w=400" alt="Cookies" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            </div>
            <div class="rounded-[2rem] overflow-hidden shadow-md hover:shadow-xl transition-shadow group">
                <img src="https://images.unsplash.com/photo-1464349095431-e9a21285b5f3?q=80&w=400" alt="Birthday Cake" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            </div>
            <div class="rounded-[2rem] overflow-hidden shadow-md hover:shadow-xl transition-shadow group">
                <img src="https://images.unsplash.com/photo-1587668178277-295251f900ce?q=80&w=400" alt="Pastries" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            </div>
        </div>
    </div>
</section>

{{-- ===== CTA ===== --}}
<section class="py-20 bg-[#2C1E16] relative overflow-hidden text-center">
    <div class="absolute inset-0 opacity-10">
        <img src="https://images.unsplash.com/photo-1556217477-d325251ece38?q=80&w=1600" class="w-full h-full object-cover mix-blend-overlay">
    </div>
    <div class="container mx-auto px-6 relative z-10">
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-4" style="font-family: 'Playfair Display', serif;">Ready to Taste the Magic?</h2>
        <p class="text-pink-200 text-lg max-w-xl mx-auto mb-8 font-medium">
            Order your favorite treats now and experience the sweetness of HK Bakers.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('products') }}" class="bg-[#F0718A] text-white px-10 py-4 rounded-full font-bold text-lg shadow-lg shadow-pink-500/30 hover:bg-[#E06079] transition-all hover:-translate-y-1">
                Order Now
            </a>
            <a href="{{ route('categories.all') }}" class="bg-transparent border-2 border-white/30 text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-white/10 transition-all hover:-translate-y-1">
                View Menu
            </a>
        </div>
    </div>
</section>

@endsection

