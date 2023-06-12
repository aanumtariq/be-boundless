<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/projectICO.ico') }}">
  <title><?php echo isset($title) ? $title.' - '.$config['COMPANY'] : $config['COMPANY'];  ?> - Admin Panel</title>  
  @include('admin.include.links')
  @yield('css')
  <style type="text/css">
    div.adminiy-upgradeProgress {
        margin-bottom: 10px;
    }
</style>
</head>
<body data-ma-theme="{{$config['CURRENTHEME'] ?? 'green' }}">
<main class="main">
            <div class="page-loader">
                <div class="page-loader__spinner">
                    <svg viewBox="25 25 50 50">
                        <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                    </svg>
                </div>
            </div>

    @if(!is_admin())
            @yield('content')
    @else
    <input type="hidden" id="web_base_url" value="{{url('/')}}" />
    <input type="hidden" id="loggedinid" value="{{admin()->id}}" />
            {{ View::make('admin.layouts.header') }}
            {{ View::make('admin.layouts.sidebar') }}
            {{ View::make('admin.layouts.chat') }}
            @yield('content')
            {{ View::make('admin.layouts.footer') }}

    @endif
    </main>
</body>
@include('admin.include.scripts')
@include('admin.layouts.errorhandler')
@yield('js')
<script type="text/javascript">
function themeSwitch(theme){      
    currentTheme = theme;       
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        url: "{{route('admin.themeSave')}}",
        method: 'post',               
        data: {
            currentTheme : currentTheme                  
        },
        success: function(result){ reload (); } });
}

function reload () {
  window.location.hash = 'r';
  window.location.reload();
}

$(document).ready(function () {
  if (window.location.hash == '#r') {
    notify('','Update Successfull');
  }
});
</script>
</html>
