<aside class="h-screen bg-[--on-primary] text-white overflow-hidden flex flex-col">
    <div class="px-6 py-[18px] border-b" :class="{ 'justify-center': !sidebarOpen }">
        <h1 class="text-2xl text-center font-bold text-nowrap" x-show="sidebarOpen">Admin Panel</h1>
        <h1 class="text-sm font-bold text-center bg-[--primary] rounded-lg  p-2" x-show="!sidebarOpen">AP</h1>
        {{-- <h1>{{ Auth::user()->name }}</h1> --}}
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
            @can('member index')
                <a href="{{ route('admin.member.index') }}" title="Member"
                    class="flex items-center px-4 py-2 rounded-lg hover:bg-[--primary-container] {{ request()->routeIs('admin.member.*') ? 'bg-[--primary-container]' : '' }}"
                    :class="{ 'justify-center': !sidebarOpen }">
                    <i class="material-icons" :class="{ 'mr-3': sidebarOpen }">people</i>
                    <span x-show="sidebarOpen"
                        class="{{ request()->routeIs('admin.member.*') ? 'font-bold' : '' }}">Member</span>
                </a>
            @endcan
            <a href="{{ route('admin.hotel.index') }}" title="Hotel"
                class="flex items-center px-4 py-2 rounded-lg hover:bg-[--primary-container] {{ request()->routeIs('admin.hotel.*') ? 'bg-[--primary-container]' : '' }}"
                :class="{ 'justify-center': !sidebarOpen }">
                <i class="material-icons" :class="{ 'mr-3': sidebarOpen }">hotel</i>
                <span x-show="sidebarOpen"
                    class="{{ request()->routeIs('admin.hotel.*') ? 'font-bold' : '' }}">Hotel</span>
            </a>
            <a href="{{ route('admin.country.index') }}" title="Negara"
                class="flex items-center px-4 py-2 rounded-lg hover:bg-[--primary-container] {{ request()->routeIs('admin.country.*') ? 'bg-[--primary-container]' : '' }}"
                :class="{ 'justify-center': !sidebarOpen }">
                <i class="material-icons" :class="{ 'mr-3': sidebarOpen }">flag</i>
                <span x-show="sidebarOpen"
                    class="{{ request()->routeIs('admin.country.*') ? 'font-bold' : '' }}">Negara</span>
            </a>
            <a href="{{ route('admin.order.index') }}" title="Pesanan"
                class="flex items-center px-4 py-2 rounded-lg hover:bg-[--primary-container] {{ request()->routeIs('admin.order.*') ? 'bg-[--primary-container]' : '' }}"
                :class="{ 'justify-center': !sidebarOpen }">
                <i class="material-icons" :class="{ 'mr-3': sidebarOpen }">shopping_cart</i>
                <span x-show="sidebarOpen"
                    class="{{ request()->routeIs('admin.order.*') ? 'font-bold' : '' }}">Pesanan</span>
            </a>
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
