<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
        <link href="/images/favicon.ico" rel="shortcut icon" />
        <meta name="description" content="@if(isset($meta['description'])){{$meta['description']}}@endif" />
        <meta name="author" content="ComfyStudio"/>

        <!-- Css -->
        <link rel="stylesheet" href="/css/admin/croppie.css">
        <link rel="stylesheet" href="/css/admin/bootstrap.min.css">
        <link rel="stylesheet" href="/css/admin/plugins.css">
        <link rel="stylesheet" href="/css/admin/themes.css">
        <link rel="stylesheet" href="/css/admin/custom.css">
        <link rel="stylesheet" href="/css/admin/main.css">

        <!-- HEAD JS-->
        <script src="/js/admin/modernizr-2.8.3.min.js"></script>

        <title>@if(isset($meta['title'])){{($meta['title'])}}@endif</title>
    </head>
    <body>
        <div id="page-wrapper">
            <div id="page-container" class="header-fixed-top sidebar-visible-lg-full">
                <!-- Sidebar -->
                @include('partials/admin/sidebar')
                <div id="main-container">
                    @include('partials/admin/header')
                        @yield('content')
                    @include('partials/admin/footer')
                </div>
            </div>
        </div>

        <script src="/js/admin/jquery-2.1.4.min.js"></script>
        <script src="/js/admin/bootstrap.min.js"></script>
        <script src="/js/admin/plugins.js"></script>
        <script src="/js/admin/ckeditor/ckeditor.js"></script>
        <script src="/js/admin/croppie/croppie.js"></script>
        <script src="/js/admin/app.js"></script>
        <script src="/js/admin/general.js"></script>
    </body>
</html>