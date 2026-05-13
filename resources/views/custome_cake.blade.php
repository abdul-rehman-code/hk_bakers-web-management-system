@extends('layouts.app')

@section('content')
<section class="py-16 bg-[#FFF5F1] min-h-screen">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-[#3A2A26] mb-4" style="font-family: 'Playfair Display', serif;">
                Customize Your <span class="text-[#F0718A] italic" style="font-family: 'Dancing Script', cursive;">Cake</span>
            </h1>
            <p class="text-gray-600 font-medium">
                Choose your design and event, and leave the rest to HK Bakers!
            </p>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-pink-100/50 overflow-hidden border border-pink-50">
            <div class="p-8 md:p-12">

                @if(session('success'))
                    <div class="mb-8 p-6 bg-green-50 border-2 border-green-100 rounded-2xl flex items-center gap-4 text-green-700 animate-bounce">
                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <p class="font-bold">{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('custom-order.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label for="event_type" class="block text-sm font-bold text-gray-600 mb-3 ml-1">Select Event</label>
                            <div class="relative">
                                <select name="event_type" id="event_type"
                                    class="w-full bg-pink-50 border-2 border-transparent rounded-2xl px-5 py-4 focus:ring-0 focus:border-[#F0718A] transition-all outline-none appearance-none font-medium text-gray-700" required>
                                    <option value="" disabled selected>Who is it for?</option>
                                    <option value="Birthday">Birthday Party</option>
                                    <option value="Wedding">Wedding / Walima</option>
                                    <option value="Anniversary">Wedding Anniversary</option>
                                    <option value="Engagement">Engagement</option>
                                    <option value="Other">Other Occasion</option>
                                </select>
                                <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none text-[#F0718A]">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            
                            @error('event_type') <p class="mt-2 text-xs text-red-500 font-bold ml-2">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="weight" class="block text-sm font-bold text-gray-600 mb-3 ml-1">Cake Weight (Pounds)</label>
                            <div class="relative">
                                <select name="weight" id="weight"
                                    class="w-full bg-pink-50 border-2 border-transparent rounded-2xl px-5 py-4 focus:ring-0 focus:border-[#F0718A] transition-all outline-none appearance-none font-medium text-gray-700" required>
                                    <option value="1">1.0 Pound</option>
                                    <option value="1.5">1.5 Pound</option>
                                    <option value="2">2.0 Pound</option>
                                    <option value="2.5">2.5 Pound</option>
                                    <option value="3">3.0 Pound</option>
                                    <option value="5">5.0 Pound +</option>
                                </select>
                                <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none text-[#F0718A]">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            @error('weight') <p class="mt-2 text-xs text-red-500 font-bold ml-2">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="sample_image" class="block text-sm font-bold text-gray-600 mb-3 ml-1">Upload Sample Design (Optional)</label>
                        <div class="relative group">
                            <label for="sample_image" class="flex flex-col items-center justify-center w-full h-48 bg-pink-50/50 border-2 border-dashed border-pink-200 rounded-[2rem] cursor-pointer hover:bg-pink-50 hover:border-[#F0718A] transition-all duration-300">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-[#F0718A] mb-4 group-hover:scale-110 transition-transform">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <p class="mb-2 text-sm text-gray-700 font-bold">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500">PNG, JPG or GIF (MAX. 2MB)</p>
                                </div>
                                <input id="sample_image" name="sample_image" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>
                        @error('sample_image') <p class="mt-2 text-xs text-red-500 font-bold ml-2">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="details" class="block text-sm font-bold text-gray-600 mb-3 ml-1">Special Instructions</label>
                        <textarea name="details" id="details" rows="5"
                            class="w-full bg-pink-50 border-2 border-transparent rounded-[2rem] px-6 py-5 focus:ring-0 focus:border-[#F0718A] transition-all outline-none font-medium text-gray-700 resize-none"
                            placeholder="E.g. What should be written on the cake? Colors, Flavour, or any specific message?"></textarea>
                        @error('details') <p class="mt-2 text-xs text-red-500 font-bold ml-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-[#F0718A] hover:bg-[#d85d75] text-white font-bold py-5 rounded-2xl shadow-lg shadow-pink-200 transition-all active:scale-[0.98] uppercase tracking-widest text-lg">
                            Submit Custom Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
