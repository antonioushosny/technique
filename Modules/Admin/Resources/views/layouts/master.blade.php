<!DOCTYPE html>

 
<html dir="{{ $dir }}" lang="{{ $locale }}" class="{{ $dir == 'rtl' ? 'fa-dir-flip' : '' }}">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content=">
    <meta name="keyword" content="Admin, Control Panel">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ __('admin::lang.siteTitle') }} | {{ __('admin::lang.adminPanel') }}</title>

    <link rel="icon" href="{{ asset('backend/imf/logo.png') }}" type="image/png" sizes="16x16">
 
    <!-- Icons-->
    <link href="{{ asset('vendors/@coreui/icons/css/coreui-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet"href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> 
    <link href="https://cdn.rawgit.com/tonystar/bootstrap-float-label/v4.0.1/dist/bootstrap-float-label.min.css" media="all" rel="stylesheet" type="text/css" />

    <!-- Styles for File Input Plugin-->
    <link href="{{ asset('backend/css/file-input/fileinput.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/file-input/fileinput-rtl.css') }}" rel="stylesheet">

    {{-- Alertify JS --}}
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.min.css"/>

    {{-- End / Alertify JS --}}

    <!-- Main styles for this application-->
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/tajawal-font.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet">
    @yield('style')
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
   
</head>
<body class="app header-fixed sidebar-hidden aside-menu-fixed"> 
    @include('admin::layouts.includes.header')

    <div id="overlayer"></div>

    <div class="row">
        <div class="col">
            <div class="text-center">
                <div class="loader">
                  <span class="loader-inner"> </span>
                </div>
            </div>
        </div>
    </div>
       

    <div class="app-body">
        @include('admin::layouts.includes.sidebar')
        @yield('main')
    </div>
    @include('admin::layouts.includes.footer')
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('vendors/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/popper.js/js/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/pace-progress/js/pace.min.js') }}"></script>
    <script src="{{ asset('vendors/perfect-scrollbar/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('vendors/@coreui/coreui/js/coreui.min.js') }}"></script>
     <!-- <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script> -->
     <!-- <script src="https://cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script> -->
    <script src="//cdn.ckeditor.com/4.11.4/full/ckeditor.js"></script>
    <script src="{{ asset('vendors/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendors/select2/js/i18n/ar.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Custom scripts required by this view --> 
    
    <!-- JS for File Input Plugin-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/piexif.min.js" type="text/javascript"></script>
    <script src="{{ asset('backend/js/file-input/fileinput.min.js') }}"></script>
    <script src="{{ asset('backend/js/file-input/themes/theme.min.js') }}"></script>
    <script src="{{ asset('backend/js/file-input/ar.js') }}"></script>

    {{-- Alertify --}}
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>

    <script src="{{ asset('backend/js/custom.js') }}"></script>
    
    @include('admin::layouts.includes.ckeditor')
    
   
    @yield('script')
    @stack('js')

</body>
</html>
