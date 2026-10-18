<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="text-3xl">🥐</span>
            <div>
                <h2 class="text-2xl font-bold" style="color: #694B2D;">
                    Little Bakery Café
                </h2>
                <p class="text-sm" style="color: #927B5C;">
                    Your cozy corner of sweetness
                </p>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen py-12"
         style="background-color: #FFF9E9; color: #694B2D;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="rounded-3xl p-8 sm:p-12 mb-8"
                 style="background-color: #F8D978; border: 2px dashed #A9B987;">
                <p class="font-bold uppercase tracking-widest text-sm mb-3">
                    ✿ Freshly baked, warmly welcomed ✿
                </p>

                <h1 class="text-3xl sm:text-5xl font-bold mb-4">
                    Welcome back, Café Owner!
                </h1>

                <p class="text-lg max-w-2xl">
                    Your little bakery dashboard is ready. Keep your products
                    organized and make every day a little sweeter.
                </p>

                <a href="{{ route('products.index') }}"
                   class="inline-block mt-6 px-6 py-3 rounded-full font-bold shadow-sm transition"
                   style="background-color: #70864E; color: white;">
                    🍞 View Bakery Products →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="rounded-2xl p-6 shadow-sm"
                     style="background-color: #FFFEF8; border: 1px solid #E8DDBD;">
                    <div class="text-3xl mb-3">🥖</div>
                    <h3 class="text-xl font-bold mb-2">Bakery Products</h3>
                    <p style="color: #927B5C;">
                        View and manage your product collection.
                    </p>
                    <a href="{{ route('products.index') }}"
                       class="inline-block mt-4 font-bold underline"
                       style="color: #70864E;">
                        Explore products
                    </a>
                </div>

                <div class="rounded-2xl p-6 shadow-sm"
                     style="background-color: #EAF0DF; border: 1px solid #C8D5B2;">
                    <div class="text-3xl mb-3">☕</div>
                    <h3 class="text-xl font-bold mb-2">Cozy Café</h3>
                    <p style="color: #694B2D;">
                        A warm, calm workspace for your bakery tasks.
                    </p>
                </div>

                <div class="rounded-2xl p-6 shadow-sm"
                     style="background-color: #FFF0B8; border: 1px solid #E8DDBD;">
                    <div class="text-3xl mb-3">🌿</div>
                    <h3 class="text-xl font-bold mb-2">Made with Care</h3>
                    <p style="color: #694B2D;">
                        Keep your little business organized, one step at a time.
                    </p>
                </div>
            </div>

            <div class="rounded-2xl p-6 text-center"
                 style="background-color: #FFFEF8; border: 1px solid #E8DDBD;">
                <p class="text-lg font-bold">“Life is what you bake it.”</p>
                <p class="mt-2" style="color: #927B5C;">
                    Made with ☕, butter, and a little bit of love.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
