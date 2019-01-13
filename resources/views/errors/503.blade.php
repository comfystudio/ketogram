<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0" name="viewport">
	<meta name="twitter:widgets:theme" content="light">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@if(isset($meta['description'])){{strip_tags($meta['description'])}}@endif" />
    <meta name="author" content="ComfyStudio.com"/>

	<!--facebook-->
    @if(isset($facebook['og:title']))<meta property="og:title" content="{{$facebook['og:title']}}">@endif
    @if(isset($facebook['og:url']))<meta property="og:url" content="{{Request::url()}}">@endif
    @if(isset($facebook['og:description']))<meta property="og:description" content="{{strip_tags($facebook['og:description'])}}">@endif
    <meta property="og:type" content="Website">
    @if(isset($facebook['og:image']))<meta property="og:image" content="{{$facebook['og:image']}}">@endif

	<title>@if(isset($meta['title'])){{($meta['title'])}}@endif</title>
	<link rel="shortcut icon" href="images/favicon.ico" type="favicon.ico">
    <link rel="icon" href="images/favicon.ico" type="favicon.ico">

	<!-- Font -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700%7CMontserrat:400,700%7CPlayfair+Display:400,400italic' rel='stylesheet' type='text/css'>
	
	<!-- Css -->
    <link rel="stylesheet" type="text/css" href="/css/admin/bootstrap.min.css"/>
	<link rel="stylesheet" href="/css/core.min.css" />
	<link rel="stylesheet" href="/css/skin.css" />

	<!--[if lt IE 9]>
    	<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body class="shop" style = "background-color:white;!important;">
	<div class="wrapper reveal-side-navigation">
		<div class="wrapper-inner">

			<!-- Content -->
			<div class="content clearfix">

				<!-- Fullscreen Sections -->
				<section class="fullscreen-sections-wrapper no-navigation">
					<div class="section-block fullscreen-section background-cover bkg-charcoal">
						<!-- Fullscreen Image -->
						<div class="fullscreen-inner" style="background:#e47833; padding-top: 0; ">
                            <div class = "section-block pb-0 pt-0" style = "background-color: #e47833;">
                                <div class="row">
                                    <div class="column width-12">
                                        <img src="/images/logos/keto-long.png" width="100%" style = "margin: 0 auto;display: block;">
                                    </div>
                                </div>
                            </div>

                            <div class = "section-block pb-50 pt-50" style="background: url(/images/4.jpg) no-repeat center center; background-size:100%;" alt="<a href='https://www.freepik.com/free-photo/composed-nuts-on-white-background_1367985.htm'>Designed by Freepik</a>">
                                <div class="row">
                                    <!-- Content -->
                                    <div class="content clearfix" style = "background-color: transparent;">
                                        <!-- Fullscreen Sections -->
                                        <div class="row">
                                            <div class="column width-6 offset-3 pt-50 center offset-1">
                                                <div class="box xlarge bkg-white no-padding-top no-margins">
                                                    <div class="pb-20">
                                                        <h1 class="status-code-title font-alt-2 weight-light color-brown mb-30">503</h1>
                                                        <h2 class="mb-30 title-medium no-padding-on-mobile text-uppercase color-brown">Page Not Found</h2>
                                                        <p class="color-brown">Sorry, the page you are looking for cannot be found.<br>Try checking the URL or return back home.</p>
                                                        <a href="/" class="button medium pill border-theme bkg-hover-theme color-theme color-hover-white text-uppercase fade-location button-orange"><span class="icon-left"></span> Return Home</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fullscreen Sections End -->
                                    </div>
                                    <!-- Content End -->
                                </div>
                            </div>
						</div>
					</div>
				</section>
				<!-- Fullscreen Sections End -->
			</div>
			<!-- Content End -->
		</div>
	</div>

	<!-- Js -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js?v=3"></script>
	<script src="/js/timber.master.min.js"></script>
	<script type="text/javascript" src="/js/admin/bootstrap.min.js"></script>
</body>
</html>