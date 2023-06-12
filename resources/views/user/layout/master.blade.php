@if(Auth::check())
  {{ session(['user' => auth()->user()->id]) }}
@else
  {{ session(['user' => 'guest']) }}               
@endif
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/riviereICO.ico') }}">
  <title>Riviere</title>
  @include('user.include.userCss')
  @yield('css')
</head>
<body>
  @if (Auth::check())
    <div class="dashboardWrapper">       
      {{ View::make('user.layout.sidebar') }}      
      <main class="dashboard">
        {{ View::make('user.layout.header') }}
          <div class="dashboardContent">
            @yield('content')          
          </div>
      </main>
    </div>
  @else
    @yield('login')    
  @endif   
@include('user.auth.authModal')
</body>
@include('user.include.scripts')
@yield('js')
</html>