<aside class="h-screen bg-[--on-primary] text-white overflow-hidden flex flex-col">
    <div class="px-6 py-2 border-b" :class="{ 'justify-center': !sidebarOpen, 'py-4': !sidebarOpen }">
        <h1 class="text-2xl text-center font-bold text-nowrap" x-show="sidebarOpen">Admin Panel</h1>
        <h1 class="text-center font-semibold" x-show='sidebarOpen'>{{ Auth::user()->name }}</h1>
        @if (Auth::user()->hasRole('admin'))
            <div x-data="{ copied: false }" class="flex items-center justify-center gap-2" x-show='sidebarOpen'>
                <h1 class="text-center font-semibold text-xs">Refferal Code : {{ Auth::user()->ownReff->reff_code }}</h1>
                <button
                    @click="
                    $refs.code.select();
                    document.execCommand('copy');
                    copied = true;
                    setTimeout(() => copied = false, 2000)
                "
                    class="p-1 rounded-lg hover:bg-[--primary-container] focus:outline-none text-xs relative">
                    <input type="text" class="sr-only" x-ref="code" value="{{ Auth::user()->ownReff->reff_code }}">
                    <i class="material-icons text-sm">content_copy</i>
                    <div x-show="copied" x-transition
                        class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-green-500 text-white text-xs rounded whitespace-nowrap">
                        Tersalin!
                    </div>
                </button>
            </div>
        @endif
        <h1 class="text-sm font-bold text-center bg-[--primary] rounded-lg p-2" x-show="!sidebarOpen">AP</h1>
    </div>
    <nav class="flex-1 flex flex-col">
        <div class="px-4 pt-3 space-y-2">
            @can('dashboard')
                <a href="{{ route('admin.dashboard') }}" title="Dashboard"
                    class="flex items-center px-4 py-2 rounded-lg hover:bg-[--primary-container] {{ request()->routeIs('admin.dashboard') ? 'bg-[--primary-container]' : '' }}"
                    :class="{ 'justify-center': !sidebarOpen }">
                    <i class="material-icons" :class="{ 'mr-3': sidebarOpen }">dashboard</i>
                    <span x-show="sidebarOpen"
                        class="{{ request()->routeIs('admin.dashboard') ? 'font-bold' : '' }}">Dashboard</span>
                </a>
            @endcan
            @can('admin index')
                <a href="{{ route('admin.admin.index') }}" title="Admin"
                    class="flex items-center px-4 py-2 rounded-lg hover:bg-[--primary-container] {{ request()->routeIs('admin.admin.*') ? 'bg-[--primary-container]' : '' }}"
                    :class="{ 'justify-center': !sidebarOpen }">
                    <i class="material-icons" :class="{ 'mr-3': sidebarOpen }">manage_accounts</i>
                    <span x-show="sidebarOpen"
                        class="{{ request()->routeIs('admin.member.*') ? 'font-bold' : '' }}">Administrator</span>
                </a>
            @endcan
            @can('member index')
                <a href="{{ route('admin.member.index') }}" title="Member"
                    class="flex items-center px-4 py-2 rounded-lg hover:bg-[--primary-container] {{ request()->routeIs('admin.member.*') ? 'bg-[--primary-container]' : '' }}"
                    :class="{ 'justify-center': !sidebarOpen }">
                    <i class="material-icons" :class="{ 'mr-3': sidebarOpen }">people</i>
                    <span x-show="sidebarOpen"
                        class="{{ request()->routeIs('admin.member.*') ? 'font-bold' : '' }}">Member</span>
                </a>
            @endcan
            @can('hotel index')
                <a href="{{ route('admin.hotel.index') }}" title="Hotel"
                    class="flex items-center px-4 py-2 rounded-lg hover:bg-[--primary-container] {{ request()->routeIs('admin.hotel.*') ? 'bg-[--primary-container]' : '' }}"
                    :class="{ 'justify-center': !sidebarOpen }">
                    <i class="material-icons" :class="{ 'mr-3': sidebarOpen }">hotel</i>
                    <span x-show="sidebarOpen"
                        class="{{ request()->routeIs('admin.hotel.*') ? 'font-bold' : '' }}">Hotel</span>
                </a>
            @endcan
            @can('country index')
                <a href="{{ route('admin.country.index') }}" title="Negara"
                    class="flex items-center px-4 py-2 rounded-lg hover:bg-[--primary-container] {{ request()->routeIs('admin.country.*') ? 'bg-[--primary-container]' : '' }}"
                    :class="{ 'justify-center': !sidebarOpen }">
                    <i class="material-icons" :class="{ 'mr-3': sidebarOpen }">flag</i>
                    <span x-show="sidebarOpen"
                        class="{{ request()->routeIs('admin.country.*') ? 'font-bold' : '' }}">Negara</span>
                </a>
            @endcan
            @can('order index')
                <a href="{{ route('admin.order.index') }}" title="Pesanan"
                    class="flex items-center px-4 py-2 rounded-lg hover:bg-[--primary-container] {{ request()->routeIs('admin.order.*') ? 'bg-[--primary-container]' : '' }}"
                    :class="{ 'justify-center': !sidebarOpen }">
                    <i class="material-icons" :class="{ 'mr-3': sidebarOpen }">shopping_cart</i>
                    <span x-show="sidebarOpen"
                        class="{{ request()->routeIs('admin.order.*') ? 'font-bold' : '' }}">Pesanan</span>
                </a>
            @endcan

            @canany(['deposit index', 'withdraw index', 'point index', 'cancellation index'])
                <div x-data="{
                    open: {{ request()->routeIs('admin.deposit.*') || request()->routeIs('admin.withdraw.*') || request()->routeIs('admin.point.*') || request()->routeIs('admin.cancellation.*') ? 'true' : 'false' }}
                }" class="relative">
                    <button @click="open = !open" type="button"
                        class="flex items-center px-4 py-2 w-full rounded-lg hover:bg-[--primary-container]"
                        :class="{ 'justify-center': !sidebarOpen, 'bg-[--primary-container]': open }">
                        <i class="material-icons" :class="{ 'mr-3': sidebarOpen }">payments</i>
                        <span x-show="sidebarOpen" class="flex-1 text-left">Transaksi</span>
                        <i x-show="sidebarOpen" class="material-icons transition-transform"
                            :class="{ 'rotate-180': open }">expand_more</i>
                    </button>

                    <div x-show="open" x-transition.origin.top class="mt-2 space-y-2">
                        @can('deposit index')
                            <a href="{{ route('admin.deposit.index') }}" title="Deposit"
                                class="flex items-center px-4 py-2 rounded-lg hover:bg-[--primary-container] {{ request()->routeIs('admin.deposit.*') ? 'bg-[--primary-container]' : '' }}">
                                <i class="material-icons" :class="{ 'mr-3': sidebarOpen }">account_balance_wallet</i>
                                <span x-show="sidebarOpen"
                                    class="{{ request()->routeIs('admin.deposit.*') ? 'font-bold' : '' }}">Deposit</span>
                            </a>
                        @endcan

                        @can('withdraw index')
                            <a href="{{ route('admin.withdraw.index') }}" title="Withdraw"
                                class="flex items-center px-4 py-2 rounded-lg hover:bg-[--primary-container] {{ request()->routeIs('admin.withdraw.*') ? 'bg-[--primary-container]' : '' }}">
                                <i class="material-icons" :class="{ 'mr-3': sidebarOpen }">money</i>
                                <span x-show="sidebarOpen"
                                    class="{{ request()->routeIs('admin.withdraw.*') ? 'font-bold' : '' }}">Withdraw</span>
                            </a>
                        @endcan

                        @can('point index')
                            <a href="{{ route('admin.point.index') }}" title="Point"
                                class="flex items-center px-4 py-2 rounded-lg hover:bg-[--primary-container] {{ request()->routeIs('admin.point.*') ? 'bg-[--primary-container]' : '' }}">
                                <i class="material-icons" :class="{ 'mr-3': sidebarOpen }">stars</i>
                                <span x-show="sidebarOpen"
                                    class="{{ request()->routeIs('admin.point.*') ? 'font-bold' : '' }}">Point</span>
                            </a>
                        @endcan

                        @can('cancellation index')
                            <a href="{{ route('admin.cancellation.index') }}" title="Pembatalan"
                                class="flex items-center px-4 py-2 rounded-lg hover:bg-[--primary-container] {{ request()->routeIs('admin.cancellation.*') ? 'bg-[--primary-container]' : '' }}">
                                <i class="material-icons" :class="{ 'mr-3': sidebarOpen }">event_busy</i>
                                <span x-show="sidebarOpen"
                                    class="{{ request()->routeIs('admin.cancellation.*') ? 'font-bold' : '' }}">Pembatalan</span>
                            </a>
                        @endcan
                    </div>
                </div>
            @endcanany
        </div>

        <form method="POST" action="{{ route('logout') }}" class="mt-auto px-4 border-t">
            @csrf
            <button type="submit"
                class="flex items-center px-4 py-4 my-2 w-full rounded-lg hover:bg-[--primary-container] "
                :class="{ 'justify-center': !sidebarOpen }">
                <i class="material-icons" :class="{ 'mr-3': sidebarOpen }">logout</i>
                <span x-show="sidebarOpen" class="font-bold">Logout</span>
            </button>
        </form>
    </nav>
</aside>
