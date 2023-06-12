@extends('admin.layouts.master')
@section('content')

<div class="login">
<!-- Login -->
<div class="login__block active" id="l-login">
<div class="login__block__header">
    <i class="zmdi zmdi-account-circle"></i>
    Hi there! Please Sign in
</div>
<form method="POST" action="{{ route('admin.performLogin') }}">
@csrf
<div class="login__block__body">
    <div class="form-group form-group--float form-group--centered">
        <input type="hidden" value="{{cthme()}}" />
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
        <label>Email Address</label>
        <i class="form-group__bar"></i>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group form-group--float form-group--centered">
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        <label>Password</label>
        <i class="form-group__bar"></i>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group form-group--float form-group--centered">
        <div class="checkbox">
            <input class="form-check-input" type="checkbox" name="remember" id="customCheck1" {{ old('remember') ? 'checked' : '' }}>
            <label class="checkbox__label" for="customCheck1">{{ __('Remember Me') }}</label>
        </div>
    </div>
    <button type="submit" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-long-arrow-right"></i></button>
</div>
</form>
</div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $(".form-group--float").each(function() {
            if($(this).find(".form-control").length>0){
                0 == !$(this).find(".form-control").val().length && $(this).find(".form-control").addClass("form-control--active")
            }
        });
        $(".login__block__body").on("blur", ".form-group--float .form-control", function() {
            0 == $(this).val().length ? $(this).removeClass("form-control--active") : $(this).addClass("form-control--active")
        });
    })
</script>
@endsection