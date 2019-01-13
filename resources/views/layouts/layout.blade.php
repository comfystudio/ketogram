<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0" name="viewport">
	<meta name="twitter:widgets:theme" content="light">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="@if(isset($meta['description'])){{strip_tags($meta['description'])}}@endif" />
	<meta name="author" content="ComfyStudio.com"/>

	<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111780453-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-111780453-1');
    </script>
    <script src='https://www.google.com/recaptcha/api.js'></script>



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
	<link rel="stylesheet" href="/css/core.min.css" />
	<link rel="stylesheet" href="/css/skin.css" />
	<link rel="stylesheet" href="/css/admin/plugins.css">
	<link rel="stylesheet" href="/css/chosen.min.css">
	<link rel="stylesheet" href="/css/chosenImage.css">
	{{--<link rel="stylesheet" type="text/css" href="/css/admin/bootstrap.min.css"/>--}}

	<!--[if lt IE 9]>
    	<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body class="shop home-page">
    @include('partials/header')
        @yield('content')
    @include('partials/footer')

	<!-- Js -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js?v=3"></script>
	<script src="/js/timber.master.min.js"></script>
	<script type="text/javascript" src="/js/admin/bootstrap.min.js"></script>
	<script src="/js/main.js"></script>
	<script src="/js/chosen.jquery.min.js"></script>
	<script src="/js/chosenImage.jquery.js"></script>
	<script src="/js/instafeed.min.js"></script>
	<script>
        Stripe.setPublishableKey('{{ env('STRIPE_PUB_KEY') }}'); // Test Key

        function stripeResponseHandler(status, response) {
          var $form = $('#payment-form');

          if (response.error) {
            // Show the errors on the form
            jQuery('#payment_errors').show();
            jQuery('#payment_errors .payment-errors').text(response.error.message);
            $form.find('button').prop('disabled', false);
          } else {
            // response contains id and card, which contains additional card details
            var token = response.id;
            // Insert the token into the form so it gets submitted to the server
            $form.append($('<input type="hidden" name="stripeToken" />').val(token));
            // and submit
            $form.get(0).submit();
          }
        };

        jQuery(function($) {
          $('#payment-form').submit(function(event) {
            var $form = $(this);

            // Disable the submit button to prevent repeated clicks
            $form.find('button').prop('disabled', true);

            Stripe.card.createToken($form, stripeResponseHandler);

            // Prevent the form from submitting with the default action
            return false;
          });
        });
    </script>
</body>
</html>