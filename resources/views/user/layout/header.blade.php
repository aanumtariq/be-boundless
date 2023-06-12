<div class="dashboard__top">
    <div class="avatar">       
        <h5>Welcome <a href="\userDash"><span>{{ Auth::check() ? Auth::user()->name : ''}}</span></a></h5>
    </div>
    {{-- <ul>
        <li class="dropdown notify">
            <a href="#"><i class='bx bx-bell bx-sm'></i></a>
            <ul class="dropdownMenu">
                <li>
                    <a href="#">
                        <img src="{{ asset('user/images/user.png') }}" alt="image">
                        <div>
                            <h5>Your order number #1321 is delivered</h5>
                            <span>03:00am</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('user/images/user.png') }}" alt="image">
                        <div>
                            <h5>Your order number #1321 is delivered</h5>
                            <span>03:00am</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('user/images/user.png') }}" alt="image">
                        <div>
                            <h5>Your order number #1321 is delivered</h5>
                            <span>03:00am</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('user/images/user.png') }}" alt="image">
                        <div>
                            <h5>Your order number #1321 is delivered</h5>
                            <span>03:00am</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('user/images/user.png') }}" alt="image">
                        <div>
                            <h5>Your order number #1321 is delivered</h5>
                            <span>03:00am</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('user/images/user.png') }}" alt="image">
                        <div>
                            <h5>Your order number #1321 is delivered</h5>
                            <span>03:00am</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('user/images/user.png') }}" alt="image">
                        <div>
                            <h5>Your order number #1321 is delivered</h5>
                            <span>03:00am</span>
                        </div>
                    </a>
                </li>
            </ul>
        </li>
    </ul> --}}
</div>