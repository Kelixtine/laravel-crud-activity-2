
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="min-h-screen bg-black text-gray-200 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gray-950 border border-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-200">
                    <h3 class="text-xl font-bold mb-3">
                        Welcome Back!
                    </h3>

                    <p class="text-gray-400">
                        You're logged in!
                    </p>

                    <div class="mt-6">
                        <a href="{{ route('products.index') }}"
                           class="inline-block bg-white text-black font-semibold px-5 py-3 rounded-lg hover:bg-gray-300 transition">
                            View Products
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
