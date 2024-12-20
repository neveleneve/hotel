<nav class="fixed bottom-0 left-0 w-full bg-[--on-primary] text-white flex justify-around py-2 rounded-t">
    <a href="{{ route('landing') }}"
        class="column-3 items-center p-3 {{ Request::is('/') ? 'bg-[--primary] rounded' : 'hover:bg-[--primary] hover:text-[--on-primary] rounded' }}">
        <i class="material-icons {{ Request::is('/') ? 'text-[--on-primary]' : null }}">home</i>
    </a>
    <a href="{{ route('cart.index') }}"
        class="column-3 items-center p-3 {{ Request::is('cart*') ? 'bg-[--primary] rounded' : 'hover:bg-[--primary] hover:text-[--on-primary] rounded' }}">
        <i class="material-icons {{ Request::is('cart*') ? 'text-[--on-primary]' : null }}">shopping_bag</i>
    </a>
    <a href="{{ route('order.index') }}"
        class="column-3 items-center p-3 {{ Request::is('order*') ? 'bg-[--primary] rounded' : 'hover:bg-[--primary] hover:text-[--on-primary] rounded' }}">
        <i class="material-icons {{ Request::is('order*') ? 'text-[--on-primary]' : '' }}">shopping_cart</i>
    </a>
    <a href="{{ route('profile.index') }}"
        class="column-3 items-center p-3 {{ Request::is('profile*') ? 'bg-[--primary] rounded' : 'hover:bg-[--primary] hover:text-[--on-primary] rounded' }}">
        <i class="material-icons {{ Request::is('profile*') ? 'text-[--on-primary]' : '' }}">person</i>
    </a>
</nav>
