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
                <p class="text-gray-500 leading-relaxed">+92 300 1234567 <a href="https://wa.me/923236425875" target="_blank" rel="noopener" class="inline-flex items-center ml-2" aria-label="Chat on WhatsApp"><svg class="w-5 h-5 text-[#25D366]" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M20.52 3.48A11.93 11.93 0 0012 0C5.373 0 0 5.373 0 12c0 2.12.55 4.13 1.5 5.88L0 24l6.31-1.65A11.9 11.9 0 0012 24c6.627 0 12-5.373 12-12 0-3.2-1.28-6.11-3.48-8.52zM12 22c-1.82 0-3.55-.5-5.03-1.38l-.36-.21-3.75 1L2.5 15.6l-.21-.36A9.96 9.96 0 012 12c0-5.51 4.49-10 10-10s10 4.49 10 10-4.49 10-10 10zm5.5-7.5c-.3-.15-1.78-.88-2.05-.98-.27-.1-.46-.15-.66.15-.2.3-.78.98-.96 1.18-.18.2-.36.23-.66.08-.3-.15-1.27-.46-2.42-1.48-.9-.8-1.5-1.78-1.68-2.08-.18-.3-.02-.46.13-.61.13-.13.3-.34.45-.51.15-.18.2-.3.3-.5.1-.2.05-.38-.02-.53-.08-.15-.66-1.6-.9-2.2-.23-.55-.46-.48-.66-.49h-.56c-.2 0-.53.08-.81.38-.27.3-1.05 1.03-1.05 2.5s1.07 2.9 1.22 3.1c.15.2 2.1 3.2 5.08 4.5.71.31 1.26.5 1.69.64.71.23 1.36.2 1.87.12.57-.09 1.78-.73 2.03-1.44.25-.71.25-1.32.18-1.44-.07-.12-.27-.2-.56-.35z"/></svg></a><br>Mon-Sat: 9am - 8pm</p>
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

                    {{-- Success Message Alert (Controlled via JavaScript) --}}
                    <div id="success-alert" class="hidden mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl font-semibold relative z-10">
                    </div>

                    {{-- Main Form with unique ID --}}
                    <form id="contactForm" action="{{ route('contact.submit') }}" method="POST" class="space-y-6 relative z-10">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[#3A2A26] font-bold text-sm ml-2">Full Name</label>
                                <input type="text" name="name" placeholder="AR SOFT" class="w-full px-6 py-4 rounded-2xl bg-[#FFF5F1] border border-transparent focus:border-pink-200 focus:bg-white focus:ring-4 focus:ring-pink-50 transition-all text-gray-700 outline-none" required>
                                <span id="error-name" class="text-red-500 text-xs ml-2 hidden"></span>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[#3A2A26] font-bold text-sm ml-2">Email Address</label>
                                <input type="email" name="email" placeholder="ardigitalsoftware@gmail.com" class="w-full px-6 py-4 rounded-2xl bg-[#FFF5F1] border border-transparent focus:border-pink-200 focus:bg-white focus:ring-4 focus:ring-pink-50 transition-all text-gray-700 outline-none" required>
                                <span id="error-email" class="text-red-500 text-xs ml-2 hidden"></span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[#3A2A26] font-bold text-sm ml-2">Phone Number</label>
                                <input type="text" name="phone" placeholder="+923027988096" class="w-full px-6 py-4 rounded-2xl bg-[#FFF5F1] border border-transparent focus:border-pink-200 focus:bg-white focus:ring-4 focus:ring-pink-50 transition-all text-gray-700 outline-none">
                                <span id="error-phone" class="text-red-500 text-xs ml-2 hidden"></span>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[#3A2A26] font-bold text-sm ml-2">Subject</label>
                                <input type="text" name="subject" placeholder="Custom Cake Inquiry" class="w-full px-6 py-4 rounded-2xl bg-[#FFF5F1] border border-transparent focus:border-pink-200 focus:bg-white focus:ring-4 focus:ring-pink-50 transition-all text-gray-700 outline-none" required>
                                <span id="error-subject" class="text-red-500 text-xs ml-2 hidden"></span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[#3A2A26] font-bold text-sm ml-2">Your Message</label>
                            <textarea name="message" rows="5" placeholder="Tell us about your event or request..." class="w-full px-6 py-4 rounded-2xl bg-[#FFF5F1] border border-transparent focus:border-pink-200 focus:bg-white focus:ring-4 focus:ring-pink-50 transition-all text-gray-700 outline-none resize-none" required></textarea>
                            <span id="error-message" class="text-red-500 text-xs ml-2 hidden"></span>
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

{{-- AJAX Script Section --}}
<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Page reload rokne ke liye

    let form = this;
    let formData = new FormData(form);
    let submitButton = form.querySelector('button[type="submit"]');
    let alertBox = document.getElementById('success-alert');

    // Purane errors ko saaf (hide) karne ke liye
    document.querySelectorAll('[id^="error-"]').forEach(el => {
        el.classList.add('hidden');
        el.innerText = '';
    });
    alertBox.classList.add('hidden');

    // Button par loading state lagana
    submitButton.disabled = true;
    submitButton.innerHTML = '<span>Sending Message...</span>';

    // Fetch API call
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(async response => {
        const data = await response.json();

        if (!response.ok) {
            // Agar validation fail ho jaye (Status 422)
            if (response.status === 422 && data.errors) {
                Object.keys(data.errors).forEach(key => {
                    let errorSpan = document.getElementById(`error-${key}`);
                    if (errorSpan) {
                        errorSpan.innerText = data.errors[key][0];
                        errorSpan.classList.remove('hidden');
                    }
                });
            } else {
                throw new Error(data.message || 'Server Error');
            }
        } else if (data.success) {
            // Agar email kamyabi se send ho jaye
            alertBox.innerText = data.message;
            alertBox.classList.remove('hidden');
            form.reset(); // Form clear karna

            // 5 second baad alert box ko automatic hide karna
            setTimeout(() => alertBox.classList.add('hidden'), 5000);
        }
    })
    .catch(error => {
        console.error('AJAX Error:', error);
        alert('Internal server error. Try again!');
    })
    .finally(() => {
        // Button ko normal state mein wapas lana
        submitButton.disabled = false;
        submitButton.innerHTML = `
            <span>Send Message</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
            </svg>
        `;
    });
});
</script>

<div class="fixed bottom-4 right-4 z-50">
    <a href="https://wa.me/923236425875" target="_blank" rel="noopener" class="flex items-center justify-center w-14 h-14 bg-[#25D366] rounded-full shadow-lg hover:shadow-xl transition transform hover:scale-110" aria-label="Chat on WhatsApp">
        <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.52 3.48A11.93 11.93 0 0012 0C5.373 0 0 5.373 0 12c0 2.12.55 4.13 1.5 5.88L0 24l6.31-1.65A11.9 11.9 0 0012 24c6.627 0 12-5.373 12-12 0-3.2-1.28-6.11-3.48-8.52zM12 22c-1.82 0-3.55-.5-5.03-1.38l-.36-.21-3.75 1L2.5 15.6l-.21-.36A9.96 9.96 0 012 12c0-5.51 4.49-10 10-10s10 4.49 10 10-4.49 10-10 10zm5.5-7.5c-.3-.15-1.78-.88-2.05-.98-.27-.1-.46-.15-.66.15-.2.3-.78.98-.96 1.18-.18.2-.36.23-.66.08-.3-.15-1.27-.46-2.42-1.48-.9-.8-1.5-1.78-1.68-2.08-.18-.3-.02-.46.13-.61.13-.13.3-.34.45-.51.15-.18.2-.3.3-.5.1-.2.05-.38-.02-.53-.08-.15-.66-1.6-.9-2.2-.23-.55-.46-.48-.66-.49h-.56c-.2 0-.53.08-.81.38-.27.3-1.05 1.03-1.05 2.5s1.07 2.9 1.22 3.1c.15.2 2.1 3.2 5.08 4.5.71.31 1.26.5 1.69.64.71.23 1.36.2 1.87.12.57-.09 1.78-.73 2.03-1.44.25-.71.25-1.32.18-1.44-.07-.12-.27-.2-.56-.35z"/>
        </svg>
    </a>
</div>

@endsection
