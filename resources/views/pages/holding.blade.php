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
	<link rel="stylesheet" href="css/core.min.css" />
	<link rel="stylesheet" href="css/skin.css" />

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
                                        <img src="/images/logos/keto-long.png" width="50%" style = "margin: 0 auto;display: block;">
                                    </div>
                                </div>
                            </div>

                            {{--<div id = "sign-up-banner" class = "section-block pt-10 pb-0 position-fixed" style = "background-color: #534742;">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="column width-12">--}}
                                        {{--<p class="lead text-medium weight-bold mb-10 color-white text-center inline offset-3"><a href="javascript:document.getElementById('email').focus()">Sign up now for 20% off your First Order</a></p>--}}
                                            {{--<ul class="social-list list-horizontal pull-right clear-float-on-mobile mt-5">--}}
                                                {{--<li><a href="{{TWITTER}}" target="_blank"><span class="icon-twitter-with-circle medium color-white"></span></a></li>--}}
                                                {{--<li><a href="{{FACEBOOK}}" target="_blank"><span class="icon-facebook-with-circle medium color-white"></span></a></li>--}}
                                                {{--<li><a href="{{INSTAGRAM}}" target="_blank"><span class="icon-instagram-with-circle medium color-white"></span></a></li>--}}
                                                {{--<li><a href="{{PINTEREST}}" target="_blank"><span class="icon-pinterest-with-circle medium color-white"></span></a></li>--}}
                                            {{--</ul>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}


                            <div id = "" class = "section-block pb-50 pt-50" alt="<a href='https://www.freepik.com/free-photo/composed-nuts-on-white-background_1367985.htm'>Designed by Freepik</a>">
                                <div class="row">
                                    <div class="column width-10 offset-1  center offset-1">
                                        <h1 class="title-xlarge font-alt-2 weight-light color-red mb-30">Sadly Ketogram is no longer in operation</h1>
                                    </div>

                                    {{--<div class="column width-4 offset-4 center" style="border: #534742 2px solid ; box-shadow: 0px 0px 10px;">--}}
                                        {{--@include('partials.admin.error-form')--}}

                                        {{--@include('partials.admin.success-form')--}}
                                        {{--<div class="signup-form-container">--}}
                                            {{--<form class="test" action="/queries/create" method="POST" novalidate="" style="color:white;">--}}
                                                {{--<div class="row">--}}
                                                    {{--<div class="column width-12 left">--}}
                                                        {{--<div class="field-wrapper">--}}
                                                            {{--<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />--}}
                                                            {{--<input type="email" name="email" id="email" class="form-email form-element no-padding-left no-padding-right color-brown" placeholder="Signup now for 20% your first order" tabindex="2" required="">--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="column width-12 mb-10">--}}
                                                        {{--<input type="submit" value="Go" class="form-submit button pill bkg-charcoal-light bkg-hover-theme color-white color-hover-white">--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<input type="text" name="honeypot" class="form-honeypot form-element">--}}
                                            {{--</form>--}}
                                            {{--<div class="form-response show color-brown">*We respect your privacy and will not share your information.</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}



                                    {{--<div class="column width-8 offset-2 center pt-20">--}}
                                        {{--<p class="lead text-medium weight-bold mb-30  color-brown">--}}
                                            {{--Each month Ketogram will deliver 7-10 carefully curated snacks to your doorstep. Each product will--}}
                                            {{--have a serving size of 5g or less net carbs.--}}
                                        {{--</p>--}}
                                    {{--</div>--}}

                                    {{--<div class="column width-8 offset-2 center">--}}
                                        {{--<p class="lead text-medium weight-bold mb-30  color-brown">If you like surprises, or are someone who knows what they--}}
                                              {{--like, we are also providing the option of curating your own Ketogram box from our selection of--}}
                                              {{--keto/low carb friendly goodies!</p>--}}

                                        {{--<p class="lead text-medium weight-bold mb-30 color-white">Join Today and receive 20% of your first order!</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="column width-8 offset-2 center">--}}
                                        {{--<p class="lead text-medium weight-bold mb-30  color-brown">--}}

                                        {{--</p>--}}


                                    {{--</div>--}}
                                </div>
                            </div>




						</div>
					</div>
				</section>
				<!-- Fullscreen Sections End -->

				<!-- Signup Modal End -->
				{{--<div id="signup-lightbox" class="signup-1 pt-70 pb-50 hide">--}}
					{{--<div class="row">--}}
						{{--<div class="column width-10 offset-1 left mb-20">--}}
							{{--<div class="signup-form-container">--}}
								{{--<h3 class="mb-30 center">You'll receive a notification</h3>--}}
								{{--<form class="signup-form" action="php/subscribe.php" method="post" novalidate>--}}
									{{--<div class="row">--}}
										{{--<div class="column width-12">--}}
											{{--<div class="field-wrapper">--}}
												{{--<input type="email" name="email" class="form-email form-element large" placeholder="Email address" tabindex="2" required>--}}
											{{--</div>--}}
										{{--</div>--}}
										{{--<div class="column width-6 offset-3 center">--}}
											{{--<input type="submit" value="Sign Me Up" class="form-submit button pill medium border-theme bkg-hover-theme color-theme color-hover-white">--}}
										{{--</div>--}}
									{{--</div>--}}
									{{--<input type="text" name="honeypot" class="form-honeypot form-element">--}}
								{{--</form>--}}
								{{--<div class="form-response">No Spamming Here!</div>--}}
							{{--</div>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
				<!-- Signup Modal End -->

				<!-- Search Modal End -->
				<div id="search-modal" class="hide">
					<div class="row">
						<div class="column width-12 center">
							<div class="search-form-container site-search">
								<form action="#" method="get" novalidate>
									<div class="row">
										<div class="column width-12">
											<div class="field-wrapper">
												<input type="text" name="search" class="form-search form-element" placeholder="type &amp; hit enter...">
												<span class="border"></span>
											</div>
										</div>
									</div>
								</form>
								<div class="form-response"></div>
							</div>
							<a href="#" class="tml-aux-exit">Close</a>
						</div>
					</div>
				</div>
				<!-- Search Modal End -->

			</div>
			<!-- Content End -->
		</div>
	</div>

	<!-- Js -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js?v=3"></script>
	<script src="js/timber.master.min.js"></script>
	<script type="text/javascript" src="/js/admin/bootstrap.min.js"></script>
</body>
</html>