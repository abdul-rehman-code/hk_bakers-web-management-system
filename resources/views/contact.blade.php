@extends('layouts.app')

@section('content')

{{-- ===== HERO BANNER ===== --}}
<section class="relative py-24 overflow-hidden bg-[#2C1E16] text-center">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1486427944544-d2c246c4df4d?q=80&w=1600" class="w-full h-full object-cover opacity-25 mix-blend-overlay">
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-[#2C1E16]/80 to-[#FFFBF9]"></div>
    </div>
    <div class="container mx-auto px-6 relative z-10">
        <span class="inline-block py-1.5 px-5 rounded-full bg-pink-500/20 text-pink-300 text-sm font-bold tracking-widest mb-5 border border-pink-500/30 uppercase">Let's Talk</span>
        <h1 class="text-5xl md:text-7xl font-bold text-white mb-5 drop-shadow-lg" style="font-family: 'Playfair Display', serif;">Get In Touch</h1>
        <p class="text-pink-100 text-lg md:text-xl max-w-2xl mx-auto font-medium">
            Have a question, feedback, or want to order a custom cake? We'd love to hear from you!
        </p>
    </div>
</section>

{{-- ===== CONTACT INFO CARDS ===== --}}
<section class="py-12 bg-[#FFFBF9] relative -mt-16 z-20">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Location --}}
            <div class="bg-white p-8 rounded-[2.5rem] shadow-lg border border-pink-50 text-center hover:-translate-y-2 transition-transform duration-300">
                <div class="w-16 h-16 mx-auto bg-[#FFF5F1] text-[#F0718A] rounded-2xl flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                </div>
                <h3 class="font-bold text-xl text-[#3A2A26] mb-3" style="font-family: 'Playfair Display', serif;">Our Location</h3>
                <p class="text-gray-500 leading-relaxed">123 Bakery Street<br>Model Town, Lahore, Pakistan</p>
            </div>

            {{-- Phone --}}
            <div class="bg-white p-8 rounded-[2.5rem] shadow-lg border border-pink-50 text-center hover:-translate-y-2 transition-transform duration-300">
                <div class="w-16 h-16 mx-auto bg-[#FFF5F1] text-[#F0718A] rounded-2xl flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.48-4.18-7.076-7.076l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                    </svg>
                </div>
                <h3 class="font-bold text-xl text-[#3A2A26] mb-3" style="font-family: 'Playfair Display', serif;">Call Us</h3>
                <p class="text-gray-500 leading-relaxed">+92 300 1234567<br>Mon-Sat: 9am - 8pm</p>
            </div>

            {{-- Email --}}
            <div class="bg-white p-8 rounded-[2.5rem] shadow-lg border border-pink-50 text-center hover:-translate-y-2 transition-transform duration-300">
                <div class="w-16 h-16 mx-auto bg-[#FFF5F1] text-[#F0718A] rounded-2xl flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </div>
                <h3 class="font-bold text-xl text-[#3A2A26] mb-3" style="font-family: 'Playfair Display', serif;">Email Us</h3>
                <p class="text-gray-500 leading-relaxed">hello@hkbakers.com<br>We reply within 24 hours</p>
            </div>
        </div>
    </div>
</section>

{{-- ===== CONTACT FORM SECTION ===== --}}
<section class="py-20 bg-[#FFFBF9]">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="flex flex-col lg:flex-row gap-16 items-center">

            {{-- Left Side: Image / Text --}}
            <div class="w-full lg:w-5/12 space-y-8">
                <div>
                    <span class="text-[#F0718A] font-bold text-sm tracking-widest uppercase">Message Us</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-[#3A2A26] mt-2 leading-tight" style="font-family: 'Playfair Display', serif;">Drop Us A Line</h2>
                </div>
                <p class="text-gray-600 leading-relaxed text-lg">
                    Planning a special event? Need a custom cake design? Or just want to say hi? Fill out the form and our team will get back to you as soon as possible.
                </p>
                <div class="relative rounded-[3rem] overflow-hidden shadow-2xl mt-8">
                    <img src="https://images.unsplash.com/photo-1558301211-0d8c8ddee6ec?q=80&w=600" alt="Baking Process" class="w-full h-[300px] object-cover">
                    <div class="absolute inset-0 bg-[#F0718A]/20 mix-blend-overlay"></div>
                </div>
            </div>

            {{-- Right Side: Form --}}
            <div class="w-full lg:w-7/12">
                <div class="bg-white p-10 md:p-14 rounded-[3rem] shadow-xl border border-pink-50 relative overflow-hidden">
                    {{-- Decorative Blur --}}
                    <div class="absolute -top-20 -right-20 w-40 h-40 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
                    <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-yellow-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>

                    <form action="#" class="space-y-6 relative z-10">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[#3A2A26] font-bold text-sm ml-2">Full Name</label>
                                <input type="text" placeholder="John Doe" class="w-full px-6 py-4 rounded-2xl bg-[#FFF5F1] border border-transparent focus:border-pink-200 focus:bg-white focus:ring-4 focus:ring-pink-50 transition-all text-gray-700 outline-none">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[#3A2A26] font-bold text-sm ml-2">Email Address</label>
                                <input type="email" placeholder="john@example.com" class="w-full px-6 py-4 rounded-2xl bg-[#FFF5F1] border border-transparent focus:border-pink-200 focus:bg-white focus:ring-4 focus:ring-pink-50 transition-all text-gray-700 outline-none">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[#3A2A26] font-bold text-sm ml-2">Phone Number</label>
                                <input type="text" placeholder="+92 300 0000000" class="w-full px-6 py-4 rounded-2xl bg-[#FFF5F1] border border-transparent focus:border-pink-200 focus:bg-white focus:ring-4 focus:ring-pink-50 transition-all text-gray-700 outline-none">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[#3A2A26] font-bold text-sm ml-2">Subject</label>
                                <input type="text" placeholder="Custom Cake Inquiry" class="w-full px-6 py-4 rounded-2xl bg-[#FFF5F1] border border-transparent focus:border-pink-200 focus:bg-white focus:ring-4 focus:ring-pink-50 transition-all text-gray-700 outline-none">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[#3A2A26] font-bold text-sm ml-2">Your Message</label>
                            <textarea rows="5" placeholder="Tell us about your event or request..." class="w-full px-6 py-4 rounded-2xl bg-[#FFF5F1] border border-transparent focus:border-pink-200 focus:bg-white focus:ring-4 focus:ring-pink-50 transition-all text-gray-700 outline-none resize-none"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-[#F0718A] text-white px-8 py-5 rounded-2xl font-bold text-lg hover:bg-[#E06079] transition-all shadow-lg shadow-pink-200 active:scale-[0.98] flex items-center justify-center gap-2 mt-4">
                            <span>Send Message</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
