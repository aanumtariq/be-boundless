

<!--Login Modal -->
<div class="modal fade" id="loginModal" role="dialog">    
    <div class="modal-dialog modal-lg">
      <!--Modal content-->
        <div class="modal-content">
          <div class="modal-header">               
            <button type="button" class="close" data-dismiss="modal">&times;</button> 
          </div>
          <!--Modal body-->  
          <div class="modal-body">                  
            <div class="">
              <div class="row">
                 <?php                        
                        Session::put('backUrl', url()->current());
                        ?>
                      <div class="col-md-6 col-xs-12 col-sm-6 nopadding">
                          <div class="login-second">
                              <h1>Log in</h1>
                              <form method="POST" action="{{ route('login') }}">
                                @csrf        
                                <div class="form-group row">
                                    <label for="email" class="col-md-5 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>        
                                    <div class="col-md-7">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>        
                                <div class="form-group row">
                                    <label for="password" class="col-md-5 col-form-label text-md-right">{{ __('Password') }}</label>        
                                    <div class="col-md-7">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>        
                                <div class="form-group row">
                                    <div class="col-md-7 offset-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>        
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>        
                                <div class="form-group row mb-0">
                                    <div class="col-md-5">
                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif
                                    </div>
                                    <div class="col-md-7">                                       
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>                                               
                                    </div>

                                </div>
                            </form>
                          </div>
                      </div>





                      <div class="col-md-6 col-xs-12 col-sm-6 nopadding">
                          <div class="login-second sign-up">
      
                              <h1>Sign Up</h1> 

                              <form method="POST" action="{{ route('register') }}">
                                @csrf
        
                                <div class="form-group row">
                                    <label for="name" class="col-md-5 col-form-label text-md-right">{{ __('Name') }}</label>
        
                                    <div class="col-md-7">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="email" class="col-md-5 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        
                                    <div class="col-md-7">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password" class="col-md-5 col-form-label text-md-right">{{ __('Password') }}</label>
        
                                    <div class="col-md-7">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-5 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
        
                                    <div class="col-md-7">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
        
                                <div class="form-group row mb-0">
                                    <div class="col-md-7 offset-md-5">
                                        <button type="submit" class="btn btn-primary">
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
          <!-- Modal body end-->
        </div>   
    </div>
  </div>