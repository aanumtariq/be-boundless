@extends('user.layout.master')
@section('css')
@endsection
@section('login')

<div class="auth">
    <div class="container">
        <div class="row justify-content-center">


            <div class="col-12 col-md-6" style="padding: 0;">
                <div class="auth__background">
                    <div class="auth__backgroundContent textCenter">
                        <h4>Welcome Back!</h4>
                        <p>Already signed up, enter your details and Sign In</p>
                        <a href="{{ route('login') }}" class="themeBtn">Sign In</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="auth__contentWrapper">
                    <div class="auth__content">
                        
                        <div class="auth__logo">
                            <a href="\">   <img src="{{ asset('user/images/logo.png') }}" alt="logo"></a>
                        </div> 
                        
                        <form method="POST" class="themeForm" action="{{ route('register') }}">
                            @csrf
                            <div class="row justify-content-center">

                               <div class="col-12 col-lg-6">
                                    <div class="formField">
                                        <i class='bx bx-user bx-sm'></i>
                                        <label for="name">{{ __('Name') }}</label>                                
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Full Name" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="formField">
                                        <i class='bx bx-envelope bx-sm'></i>
                                        <label for="email">{{ __('E-Mail Address') }}</label>
                                    
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="formField">
                                        <i class='bx bx-lock-open-alt bx-sm'></i>
                                        <label for="password">{{ __('Password') }}</label>

                                   
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="formField">
                                        <i class='bx bx-lock-open-alt bx-sm'></i>
                                        <label for="password-confirm">{{ __('Confirm Password') }}</label>                                
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="formField">
                                        <label for="terms">
                                            <input type="checkbox" style="width: auto;    display: inherit;    margin-right: 10px;" name="terms" id="terms" />
                                            I accept the <a style="color: var(--color-primary);" href="{{ url('terms_condition') }}" target="_blank">Terms of Use &amp; Privacy Policy</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                   
                                        <button type="submit" class="themeBtn">
                                            {{ __('Register') }}
                                        </button>
                                 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
