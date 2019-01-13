<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
        <meta name="description" content="{{$meta['description']}}" />
        <meta name="author" content="ComfyStudio"/>

        <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon" />
        <!-- Css -->
        <link rel="stylesheet" href="/css/admin/bootstrap.min.css">
        <link rel="stylesheet" href="/css/admin/plugins.css">
        <link rel="stylesheet" href="/css/admin/main.css">
        <link rel="stylesheet" href="/css/admin/themes.css">
        <link rel="stylesheet" href="/css/admin/custom.css">
        <script src="/js/admin/modernizr-2.8.3.min.js"></script>

        <title>{{$meta['title']}}</title>
    </head>

    <body>
        @yield('content')

        <script src="/js/admin/jquery-2.1.4.min.js"></script>
        <script src="/js/admin/bootstrap.min.js"></script>
        <script src="/js/admin/plugins.js"></script>
        <script src="/js/admin/app.js"></script>
        <script src="/js/admin/general.js"></script>
    </body>
</html>