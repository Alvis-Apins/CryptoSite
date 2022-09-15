<nav class="py-4">
    <div class="px-8 mx-auto bg-black bg-opacity-80 h-16">
        <div class="flex justify-between">
            <!-- navbar left side -->
            <div class="flex px-8">
                <div class="pr-8 py-1.5">
                    <a href="/">@include('components.logo')</a>
                </div>
                <div class="flex items-center space-x-8 text-slate-100">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/my-wallet') }}">My Wallet</a>
                            <a href="{{ url('/crypto-assets') }}"> Buy Crypto </a>
                            <a href="{{ url('/evaluation') }}"> Evaluation </a>
                        @endauth
                    @endif
                </div>
            </div>
            <!-- nav bar right side -->
            <div class="flex px-8">
                <div class="flex items-center space-x-8 text-slate-100">
                    @if (Route::has('login'))
                        @auth
                            @if(!empty($available_money))
                                <div class="border border-solid border-1">
                                    <a class="p-2"> Available: {{ $available_money }}$ </a>
                                </div>
                            @endif
                            <a href="{{ url('/add-money') }}">Add Money</a>

                            <div class="hidden sm:flex sm:items-center sm:ml-6">
                                <x-jet-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="flex items-center text-sm font-medium text-white hover:text-gray-400 focus:outline-none focus:text-gray-200 focus:border-white transition duration-150 ease-in-out">
                                            <div>{{ Auth::user()->name }}</div>

                                            <div class="ml-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-jet-dropdown-link :href="route('logout')"
                                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-jet-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-jet-dropdown>
                            </div>
                        @else
                            <a href="{{ route('login') }}">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
