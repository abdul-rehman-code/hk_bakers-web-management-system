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
</body>
</html>
