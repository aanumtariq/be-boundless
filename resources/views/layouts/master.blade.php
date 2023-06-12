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
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/projectICO.ico') }}">
  <title><?php echo isset($title) ? $title.' - '.$config['COMPANY'] : $config['COMPANY'];  ?></title>
  @include('layouts.links')  
  @yield('css')
</head>
<body>
  {{ View::make('layouts.header') }} 
  @yield('content')
  {{ View::make('layouts.footer') }}
</body>
@include('layouts.scripts')
@include('layouts.errorhandler')
@yield('js')
</html>