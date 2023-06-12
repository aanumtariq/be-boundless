<div class="upper-head">
        <div class="icons-head">
            <i class="fa-icons">
                <a href="{{$config['FACEBOOK'] }}" class="fa fa-facebook"></a>
            </i>
            <i class="fa-icons">
                <a href="{{$config['GOOGLE'] }}" class="fa fa-google"></a>
            </i>
            <i class="fa-icons">
                <a href="{{$config['INSTAGRAM'] }}" class="fa fa-instagram"></a>
            </i>
            <i class="fa-icons">
                <a href="{{$config['YOUTUBE'] }}" class="fa fa-youtube"></a>
            </i>
            <i class="fa-icons">
                <a href="{{$config['PHONE'] }}" class="fa fa-phone phone_right">|{{$config['PHONE'] }}</a>
            </i>
        </div>
       
     </div>
    
        <header class="full-width top-header ">
            <div class="container">
                <a href="{{ url('index') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="logo" class="logo-img">
                </a>
                <nav class="main-menu-area">
                    <ul class="main-menu">
                        <li class="menu-item">
                            <a href="{{ url('index') }}">Home</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ url('about') }}">About us</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ url('articals') }}">Articals</a>
                        </li>
                        
                        <li class="menu-item">
                            <a href="{{ url('packages') }}">Packges</a>
                        </li>                     
                        <li class="menu-item">
                            <a href="{{ url('index') }}#sec5">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>