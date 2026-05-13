@extends('layouts.app')

@section('content')
<div class="py-20 bg-[#FFF5F1] min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4">
        <div class="bg-white max-w-lg mx-auto p-12 rounded-[3.5rem] shadow-2xl border border-pink-50 text-center relative overflow-hidden">

            <!-- Confetti Effect (Optional CSS) -->
            <div class="absolute top-0 left-0 w-full h-2 bg-[#F0718A]"></div>

            <!-- Success Animation / Icon -->
            <div class="w-24 h-24 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h1 class="text-4xl font-bold text-[#3A2A26] mb-4" style="font-family: 'Playfair Display', serif;">
                Order Placed!
            </h1>

            <p class="text-gray-500 text-lg mb-2">
                Thank you, <span class="font-bold text-[#3A2A26]">{{ $order->customer_name }}</span>!
            </p>
            <p class="text-gray-400 mb-8">
                Your order <span class="font-bold text-[#F0718A]">#{{ $order->order_number }}</span> has been received and is being prepared with love.
            </p>

            <div class="space-y-4">
                <a href="{{ url('/') }}" class="block w-full bg-[#3A2A26] text-white font-bold py-4 rounded-2xl shadow-lg hover:bg-[#F0718A] transition-all transform hover:-translate-y-1">
                    Back to Home Now
                </a>
                <p class="text-xs text-gray-400 mt-4 italic">
                    Redirecting you to home page in <span id="countdown">5</span> seconds...
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Auto Redirect Script -->
<script>
    let seconds = 5;
    const countdownEl = document.getElementById('countdown');

    const timer = setInterval(() => {
        seconds--;
        countdownEl.textContent = seconds;
        if (seconds <= 0) {
            clearInterval(timer);
            window.location.href = "{{ url('/') }}";
        }
    }, 1000);
</script>
@endsection
