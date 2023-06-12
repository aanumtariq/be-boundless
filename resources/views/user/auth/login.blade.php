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
                        <h4>Join Us!</h4>
                        <p>Do not have an account?</p>
                        <a href="{{ route('register') }}" class="themeBtn">Sign Up</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="auth__contentWrapper">
                    <div class="auth__content">
                        <div class="auth__logo">
                            <a href="\"><img src="{{ asset('user/images/logo.png') }}" alt="logo"></a>
                        </div>                       
                        <form method="POST" class="themeForm" action="{{ route('login') }}">
                            @csrf
                            <div class="row justify-content-center">

                                <div class="col-12">
                                    <div class="formField">

                                        <i class='bx bx-envelope bx-sm'></i>

                                        <label for="email">{{ __('E-Mail Address') }}</label>
                                    
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="formField">

                                        <i class='bx bx-lock-open-alt bx-sm'></i>
                                        <label for="password" >{{ __('Password') }}</label>
                                    
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="formField">
                                            <input style="width: 2%;" class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                               

                                    <div class="col-12">

                                        <button type="submit" class="themeBtn">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif

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
