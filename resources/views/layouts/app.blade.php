
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @yield('metatag')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('front/images/logo-icon.png') }}" type="image/png" sizes="16x16">

    {{-- Styles --}}
    @if($dir == 'rtl')
        {{-- RTL Styles --}}
        <link rel="stylesheet" href="{{ asset('front/css/bootstrap-rtl.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('front/css/bootstrap.css') }}">
    @endif
    
    <link rel="stylesheet" href="{{ asset('front/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/jquery.fancybox.min.css') }}">
   

    @yield('style')
  
 </head>

<!-- class="rtl" -->
<body class="{{ $dir == 'rtl' ? 'rtl' : ''  }} p-0 m-0 ">
 
   
 
    <div id="overlayer"></div>
    <span class="loader">
        <span class="loader-inner"></span>
    </span>  
    

    <div class="page-wrapper chiller-theme  ">
       
        <!-- sidebar-wrapper  -->
        <main class=" content-div ">
            @yield('content')
        </main>
        <!-- page-content" -->
    </div>
    <!-- page-wrapper -->

    
  
    {{-- Scripts --}}
    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front/js/popper.min.js') }}"></script>

    @if($dir == 'rtl')
        {{-- RTL Scripts --}}
        <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    @else
        <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    @endif

    <script src="{{ asset('vendors/select2/js/select2.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    @yield('script1')
    @yield('script2')
    @yield('script')

   
</body>
</html>
