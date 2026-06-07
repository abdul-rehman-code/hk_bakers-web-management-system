<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HK Bakers | Freshly Baked Happiness</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700;800;900&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-[#FFF8F6] text-gray-900">
    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-20 right-4 sm:right-5 z-[9999] flex flex-col gap-3 pointer-events-none max-w-[90vw] sm:max-w-sm"></div>
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    {{-- Yahan hum footer ka code rakhenge --}}
    @include('partials.footer')


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
$(document).ready(function() {
    // Event Delegation: Taake Category switch aur Related products dono par kaam kare
    $(document).on('click', '.add-to-cart-btn', function(e) {
        e.preventDefault();

        let button = $(this);
        let productId = button.data('id');
        let originalContent = button.html();

        // 1. Data pick karein:
        let quantity = button.attr('data-qty') ? button.attr('data-qty') : 1;
        let variation = button.attr('data-variation') ? button.attr('data-variation') : '';
        let price = button.attr('data-price') ? button.attr('data-price') : '';

        // 2. Button loading state
        button.prop('disabled', true).html('<span class="animate-pulse">Adding...</span>');

        $.ajax({
            url: "{{ url('/cart/add') }}/" + productId,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                quantity: quantity,
                variation: variation,
                price: price
            },
            success: function(response) {
                if(response.success) {
                    // Header badge update (Unique items count)
                    $('.cart-count-badge').text(response.cart_count);

                    // Success Message
                    showToast(response.message, 'success');
                } else {
                    showToast(response.message, 'error');
                }
            },
            error: function(xhr) {
                console.error("Error Response:", xhr.responseText);
                showToast("Kuch masla hua! Dubara koshish karein.", 'error');
            },
            complete: function() {
                // 3. Button restore: Loading khatam hone par wapis original halat mein layein
                button.prop('disabled', false).html(originalContent);
            }
        });
    });

    // Toast Function
    window.showToast = function(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        
        toast.className = `${bgColor} text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 pointer-events-auto transform transition-all duration-500 translate-x-20 opacity-0`;
        toast.style.fontFamily = "'Inter', sans-serif";
        toast.innerHTML = `
            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center shrink-0">
                ${type === 'success' ? '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>' : '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>'}
            </div>
            <p class="font-bold text-sm leading-tight">${message}</p>
        `;
        
        container.appendChild(toast);
        setTimeout(() => toast.classList.remove('translate-x-20', 'opacity-0'), 10);
        
        setTimeout(() => {
            toast.classList.add('translate-x-20', 'opacity-0');
            setTimeout(() => toast.remove(), 500);
        }, 5000);
    }
});
</script>
    <!-- WhatsApp Floating Button -->
    <div class="fixed bottom-4 right-4 z-50">
        <a href="https://wa.me/923236425875" target="_blank" rel="noopener"
           class="flex items-center justify-center w-14 h-14 bg-[#25D366] rounded-full shadow-lg hover:shadow-xl transition transform hover:scale-110"
           aria-label="Chat on WhatsApp">
            <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M20.52 3.48A11.93 11.93 0 0012 0C5.373 0 0 5.373 0 12c0 2.12.55 4.13 1.5 5.88L0 24l6.31-1.65A11.9 11.9 0 0012 24c6.627 0 12-5.373 12-12 0-3.2-1.28-6.11-3.48-8.52zM12 22c-1.82 0-3.55-.5-5.03-1.38l-.36-.21-3.75 1L2.5 15.6l-.21-.36A9.96 9.96 0 012 12c0-5.51 4.49-10 10-10s10 4.49 10 10-4.49 10-10 10zm5.5-7.5c-.3-.15-1.78-.88-2.05-.98-.27-.1-.46-.15-.66.15-.2.3-.78.98-.96 1.18-.18.2-.36.23-.66.08-.3-.15-1.27-.46-2.42-1.48-.9-.8-1.5-1.78-1.68-2.08-.18-.3-.02-.46.13-.61.13-.13.3-.34.45-.51.15-.18.2-.3.3-.5.1-.2.05-.38-.02-.53-.08-.15-.66-1.6-.9-2.2-.23-.55-.46-.48-.66-.49h-.56c-.2 0-.53.08-.81.38-.27.3-1.05 1.03-1.05 2.5s1.07 2.9 1.22 3.1c.15.2 2.1 3.2 5.08 4.5.71.31 1.26.5 1.69.64.71.23 1.36.2 1.87.12.57-.09 1.78-.73 2.03-1.44.25-.71.25-1.32.18-1.44-.07-.12-.27-.2-.56-.35z"/>
            </svg>
        </a>
    </div>
</body>
</html>
