
<nav x-data="{ open: false, userDropdown: false }"
     class="bg-black border-b border-gray-800">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <!-- Logo only: no Products link beside it -->
            <a href="{{ route('products.index') }}"
               class="font-bold text-xl text-white tracking-wide">
                Laravel CRUD
            </a>

            <!-- Username dropdown -->
            <div class="relative hidden sm:block">
                <button
                    type="button"
                    @click="userDropdown = !userDropdown"
                    @click.outside="userDropdown = false"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm text-gray-300 hover:bg-gray-800 hover:text-white transition">
                    <span>{{ Auth::user()->name }}</span>
                    <svg class="w-4 h-4" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="m19 9-7 7-7-7" />
                    </svg>
                </button>

                <!-- Only Log Out appears in the dropdown -->
                <div
                    x-show="userDropdown"
                    x-transition
                    style="display: none;"
                    class="absolute right-0 mt-2 w-40 rounded-lg bg-gray-900 border border-gray-700 shadow-xl z-50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="w-full text-left px-4 py-3 rounded-lg text-sm text-red-400 hover:bg-gray-800 transition">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="sm:hidden">
                <button
                    type="button"
                    @click="open = !open"
                    class="px-3 py-2 rounded-lg border border-gray-700 text-gray-300 hover:bg-gray-800">
                    Menu
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="open"
         x-transition
         style="display: none;"
         class="sm:hidden border-t border-gray-800 px-6 py-4 space-y-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="text-sm text-red-400 hover:text-red-300">
                Log Out
            </button>
        </form>
    </div>
</nav>
