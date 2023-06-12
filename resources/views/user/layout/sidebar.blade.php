<!-- Sidebar -->  
<aside class="sidebar">
    <a href="\" class="sidebar__logo">
        <img src="{{ asset('user/images/logo.png') }}" alt="logo">
    </a>
    <ul class="sidebar__nav">
        <li><a href="{{ route('userDash') }}" class="{{(request()->is('user_profile')) || (request()->is('userDash')) ?'active':''}}"><span><i class='bx bx-user-circle bx-sm'></i></span> My Account</a></li>
        @php $last = explode("/", request()->url(), 5); @endphp
        <li><a href="{{ route('user.orders') }}" class="{{(request()->is('user_orders')) || ($last[3] == 'order_details') ?'active':''}}"><span class="active"><i class='bx bx-shopping-bag bx-sm'></i></span> My Orders</a></li>
        <li><a href="{{ route('user.wishlist') }}" class="{{(request()->is('user_wishlist'))?'active':''}}"><span class="active"><i class='bx bx-heart bx-sm'></i></span> My Wishlist</a></li>
        <li><a href="{{ route('user.addressBook') }}" class="{{ (request()->is('user_addressBook'))?'active':''}}"><span><i class='bx bx-map bx-sm'></i></span> My Addresses</a></li>
        <li><a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout">            
        <span><i class='bx bx-log-out bx-sm'></i></span> {{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form></li>
    </ul>
    <div class="sidebar__deal"></div>
</aside>