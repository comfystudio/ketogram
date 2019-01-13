@extends('layouts/layout')

@section('content')
            <!-- Content -->
			<div class="content clearfix mt-80">
				<!-- Fullscreen Slider Section -->
				<section class="section-block header-panel pt-50">
				    <div class = "row">
                        <div class="column width-6 header-box">
                            <h1 class="text-orange text-center">Keeping Keto Simple</h1>



                            <ul class="text-small header-list text-black">
                                <li>6-8 Keto approved products every month;</li>
                                <li>Includes Keto support to help you stay on track, inc. recipes and more;</li>
                                <li>Subscribe to a mystery box or customise your own;</li>
                                <li>All subscriptions £30;</li>
                                <li>Free UK postage & packaging;</li>
                                <li>Cancel anytime.</li>
                            </ul>

                            <div style="margin: 0 auto;display: block;width: 250px;">
                                <a href = "{{url('/subscriptions')}}" class="button pill bkg-theme text-uppercase button-blue text-xlarge text-bold uppercase"><span></span> Subscribe Today</a>
                            </div>

                            <ul class="social-list list-horizontal header-social" >
                                <li><a href="{{TWITTER}}" target="_blank"><span class="icon-twitter-with-circle medium"></span></a></li>
                                <li><a href="{{FACEBOOK}}" target="_blank"><span class="icon-facebook-with-circle medium"></span></a></li>
                                {{--<li><a href="#"><span class="icon-youtube-with-circle medium"></span></a></li>--}}
                                {{--<li><a href="#"><span class="icon-vimeo-with-circle medium"></span></a></li>--}}
                                <li><a href="{{INSTAGRAM}}" target="_blank"><span class="icon-instagram-with-circle medium"></span></a></li>
                                <li><a href="{{PINTEREST}}" target="_blank"><span class="icon-pinterest-with-circle medium"></span></a></li>
                            </ul>

                        </div>

                        <div class="column width-6">

                        </div>
				    </div>
				</section>
				{{--<section class="section-block featured-media window-height tm-slider-parallax-container">--}}
					{{--<div class="tm-slider-container full-width-slider" data-featured-slider data-parallax data-scale-under="960" data-speed="1100" data-height="800px" data-auto-advance>--}}
						{{--<ul class="tms-slides">--}}

							{{--<li class="tms-slide" data-image data-force-fit data-animation="scaleIn" data-overlay-bkg-color="#000000" data-overlay-bkg-opacity="0.3">--}}
								{{--<div class="tms-content">--}}
									{{--<div class="tms-content-inner center v-align-middle">--}}
										{{--<div class="row">--}}
											{{--<div class="column width-12">--}}
												{{--<h1 class="title-xlarge font-alt-2 weight-light color-white mb-40">--}}
													{{--<span class="tms-caption" data-animate-in="preset:slideInDownShort;duration:800ms;delay:200;" data-no-scale>The go-to</span>--}}
													{{--<span class="tms-caption" data-animate-in="preset:flipInX;duration:800ms;delay:500ms;" data-no-scale>source for premium</span>--}}
													{{--<span class="tms-caption" data-animate-in="preset:slideInUpShort;duration:800ms;delay:800ms;" data-no-scale>keto products</span>--}}
												{{--</h1>--}}
												{{--<div class="clear pb-50"></div>--}}
												{{--<a href = "{{url('/subscriptions')}}" class="tms-caption button pill bkg-theme text-uppercase button-blue text-xlarge"--}}
													{{--data-animate-in="preset:scaleOut;duration:1000ms;delay:500ms;"--}}
													{{--data-no-scale--}}
                                                {{-->--}}
												{{--<span></span> Subscribe</a>--}}
											{{--</div>--}}
										{{--</div>--}}
									{{--</div>--}}
								{{--</div>--}}
                                {{--<img data-src="images/6.png" data-retina src="images/blank.png" alt=""/>--}}
							{{--</li>--}}

							{{--<li class="tms-slide" data-image data-force-fit data-animation="slideLeftRight" data-overlay-bkg-color="#000000" data-overlay-bkg-opacity="0.4">--}}
								{{--<div class="tms-content">--}}
									{{--<div class="tms-content-inner center v-align-middle">--}}
										{{--<div class="row">--}}
											{{--<div class="column width-12">--}}
												{{--<h1 class="title-medium font-alt-2 weight-light color-white mb-10">--}}
                                                    {{--<span class="tms-caption text-xlarge mb-50" data-animate-in="preset:flipInY;duration:800ms;;" data-no-scale>Ketogram offers a:</span>--}}
                                                    {{--<span class="tms-caption bullets mb-30" data-animate-in="preset:flipInX;duration:800ms;delay:300ms;" data-no-scale>Monthly subscription box, curated to help you live the keto lifestyle.</span>--}}
                                                    {{--<span class="tms-caption bullets mb-30" data-animate-in="preset:flipInY;duration:800ms;delay:600ms;" data-no-scale>Customise your own keto subscription box to suit you.</span>--}}
                                                    {{--<span class="tms-caption bullets mb-30" data-animate-in="preset:flipInY;duration:800ms;delay:900ms;" data-no-scale>All products, and much more, are available at our online shop.</span>--}}
												{{--</h1>--}}
												{{--<div class="clear pb-70"></div>--}}
                                                {{--<a href = "{{url('/subscriptions')}}" class="tms-caption button pill bkg-theme text-uppercase button-blue text-xlarge"--}}
                                                    {{--data-animate-in="preset:scaleOut;duration:1000ms;delay:500ms;"--}}
                                                    {{--data-no-scale--}}
                                                {{-->--}}
                                                {{--<span></span> Subscribe</a>--}}
											{{--</div>--}}
										{{--</div>--}}
									{{--</div>--}}
								{{--</div>--}}
                                {{--<img data-src="images/slider/gallery-3.jpg" data-retina src="images/blank.png" alt=""/>--}}
							{{--</li>--}}
						{{--</ul>--}}
					{{--</div>--}}
				{{--</section>--}}
				<!-- Fullscreen Slider Section End -->

				<!-- Stat Section 1 -->
                <div class="section-block stats-1 bkg-brown pb-10 pt-20 feature-column-group center">
                    <div class="row flex">
                        <div class = "column width-12">
                            <h2 class ="text-white">This month's subscription closes in</h2>

                            <div id = "countdown"></div>

                        </div>
                    </div>
                </div>
                <!-- Stat Section 1 -->

				<!-- Content -->
				<div class="section-block pb-50 pt-50">
				    <div class = "row">
                        @include('partials.admin.error-form')

                        @include('partials.admin.success-form')
				    </div>

                    <div class ="row pb-50">
                        <h2 class="text-orange text-center">Keeping keto simple because life sometimes isn’t</h2>
                    </div>

				    <div class = "row">
				        <div class ="column width-4">
				            <div class = "what-is-panel">
				                <div class="image-container"><img src="/images/box.png" alt="keto-box" width="96"></div>
                                <div><p class="text-small">Quality Products: Receive 6-8 different Keto friendly products, shipped directly to your door every month for £30 – that’s less than £1 a day!</p></div>
                            </div>

                            <div class = "what-is-panel">
                                <div class="image-container"><img src="/images/plate.png" alt="keto-plate" width="96"></div>
                                <div><p class="text-small">Receive recipes and support to help keep you motivated in your keto lifestyle, even when you are at your busiest.</p></div>
                            </div>

                            <div class = "what-is-panel">
                                <div class="image-container"><img src="/images/less-than.png" alt="keto-less-than" width="96"></div>
                                <div><p class="text-small">All items are 5g of carbs per serving or less</p></div>
                            </div>
				        </div>

				        <div class ="column width-4 pt-50">
                            <img src="/images/circle.png" alt="keto-pig">
                            <div style="margin: 5rem auto; display: block; width: 145px;">
                                <a href = "{{url('/subscriptions')}}" class="button pill bkg-theme text-uppercase button-blue text-xlarge text-bold uppercase"><span></span> Subscribe</a>
                            </div>
                        </div>

                        <div class ="column width-4">
                            <div class = "what-is-panel">
                                <div class="image-container"><img src="/images/pig.png" alt="keto-pig" width="96"></div>
                                <div><p class="text-small">Resist sugar filled snacks by having keto friendly snacks shipped to you every month</p></div>
                            </div>

                            <div class = "what-is-panel">
                                <div class="image-container"><img src="/images/woman.png" alt="keto-woman" width="96"></div>
                                <div><p class="text-small">Make sticking to Keto and achieving your goals a little easier and fun with the surprise of new keto friendly products each month!</p></div>
                            </div>

                            <div class = "what-is-panel">
                                <div class="image-container"><img src="/images/delivery-man.png" alt="keto-delivery" width="96"></div>
                                <div><p class="text-small">We ship to the UK – it’s free!</p></div>
                            </div>
                        </div>
				    </div>

					{{--<div class="row subscription-home-panel">--}}
						{{--<div class="column width-8">--}}
                            {{--<div class="pu-10">--}}
								{{--<p class="lead text-large weight-bold mb-20 mb-mobile-0">The Ketogram Subscriptions</p>--}}

                                {{--<div class ="row">--}}
                                    {{--<span class="bullets text-medium column width-1"></span><p class="text-medium column width-11">Standard subscription is sourced by us, and features products and recipes we know you'll love.</p>--}}
                                {{--</div>--}}

                                {{--<div class ="row">--}}
                                    {{--<span class="bullets text-medium column width-1"></span><p class="text-medium column width-11">The custom subscription gives you more control, allowing you to select from a list of items to suit your needs.</p>--}}
                                {{--</div>--}}

                                {{--<div class ="row">--}}
                                    {{--<span class="bullets text-medium column width-1"></span><p class="text-medium column width-11">Both options are on a month to month basis and can be switched or cancelled at anytime.</p>--}}
                                {{--</div>--}}

                                {{--<div class ="row">--}}
                                    {{--<span class="bullets text-medium column width-1"></span><h1 class="text-medium column width-11" style="color:#666;">All Subscriptions £30 <span class ="text-medium">(Free P&P)</span></h1>--}}
                                {{--</div>--}}
							{{--</div>--}}

                            {{--<div class = "row">--}}
                                {{--<div class ="column width-6 offset-4">--}}
						            {{--<a href = "{{url('/subscriptions')}}" class="button pill bkg-theme text-uppercase button-blue text-large">Subscribe</a>--}}
						        {{--</div>--}}
						    {{--</div>--}}
						{{--</div>--}}

						{{--<div class="column width-4 center " style="padding-left: 6rem; min-height: 0!important;">--}}
                            {{--<div class="space3d-small offset-3" >--}}
                                {{--<div class="_3dbox-small">--}}
                                    {{--<div class="_3dface-small _3dface--front-small">--}}
                                        {{--<img id="keto-approved" src="/images/logos/keto-approved.png" alt="keto-approved">--}}
                                    {{--</div>--}}

                                    {{--<div class="_3dface-small _3dface--top-small">--}}
                                    {{--</div>--}}

                                    {{--<div class="_3dface-small _3dface--bottom-small">--}}
                                    {{--</div>--}}

                                    {{--<div class="_3dface-small _3dface--left-small">--}}
                                    {{--</div>--}}

                                    {{--<div class="_3dface-small _3dface--right-small">--}}
                                    {{--</div>--}}

                                    {{--<div class="_3dface-small _3dface--back-small">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
					{{--</div>--}}
				</div>


				<!-- HOW IT WORKS SECTION -->
                <div class="section-block background-yellow how-it-works pt-50 pb-50">
                    <div class="row">
                         <h1 class="text-brown text-center">How Ketogram Works</h1>
                    </div>

                    <div class="row flex">
                        <div class="column width-4">
                            <div class="text-center"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></div>
                            <div class="how-it-works-text text-center">
                                <h3 class="text-white">Step 1 <br/> <br/> <span class="text-blue">Subscribe to Ketogram</span></h3>
                                <p class="text-medium text-gray">Choose the subscription that suits you best. Cancel anytime.</p>
                            </div>
                        </div>

                        <div class="column width-4">
                            <div class="text-center"><i class="fa fa-search" aria-hidden="true"></i></div>
                            <div class="how-it-works-text text-center">
                                <h3 class="text-white">Step 2 <br/> <br/> <span class="text-blue">Ketogram Creation</span></h3>
                                <p class="text-medium text-gray">We curate your Ketogram box.</p>
                            </div>
                        </div>

                        <div class="column width-4">
                            <div class="text-center"><i class="fa fa-bell" aria-hidden="true"></i></div>
                            <div class="how-it-works-text text-center">
                                <h3 class="text-white">Step 3 <br/> <br/><span class="text-blue">Receive your Ketogram</span></h3>
                                <p class="text-medium text-gray">Awesome Keto friendly goodies, recipes and Keto motivation.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END HOW IT WORKS SECTION-->

                <!-- WHAT IS KETO SECTION -->
                <div class="section-block what-is-keto pt-50 pb-50">
                    <div class="row">
                         <h1 class="text-orange text-center pb-30">What is Keto?</h1>
                    </div>

                    <div class="row">
                        <div class="column width-12">
                            <p class="text-medium">Keto or ‘Ketogenic’ is a low carb, high fat diet which makes our bodies turn into machines when burning fat. Keto has many weight loss and health benefits, particularly with those with issues including, but not limited to, Type 2 diabetes, epilepsy, PCOS, obesity and many more.</p>
                        </div>

                        <div class="column width-12">
                            <p class="text-medium">By restricting consumption of sugar and carbohydrates from foods such as bread and pasta, the keto diet focus’ on healthy fats, protein and vegetables. Ketogram.co.uk provides all the resources you need to learn how to start and maintain a Ketogenic life from online resources and products to your door. For more information check out our <a href="{{url('blog')}}" class="text-orange" target="_blank">Blog</a> and follow us on social media.</p>
                        </div>

                        <div class="column width-12">
                            <img src="/images/Keto-Pyramid.png" alt="keto-pyramid" class="text-center">
                        </div>
                    </div>
                </div>
                <!-- END WHAT IS KETO SECTION-->


				<!-- SHOP SECTION -->
                {{--<div class="section-block gradient-blue pb-0 pt-0 home-image-panel">--}}
                    {{--<div class ="row">--}}
                        {{--<div class = "column width-8">--}}
                            {{--<a href="{{url('/shop')}}" alt="shop" class="link-image"></a>--}}
                            {{--<div class = "column home-link">--}}
                                {{--<a href = "{{url('/shop')}}" style= "position: relative; margin-top: 40%;" class="button pill bkg-theme text-uppercase button-orange text-large">Shop</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="column width-4 left-on-mobile pt-100 pb-100 home-text-panel">--}}
                            {{--<div class="pu-10">--}}
                                {{--<p class="lead text-large weight-bold mb-20 mb-mobile-0">The Ketogram Shop</p>--}}
                                {{--<p class="text-medium column width-12">We want to be your 'one stop keto shop'.</p>--}}
                                {{--<p class="text-medium column width-12">All products from our subscription boxes can be bought in our online shop, as well as many others, to help you fulfill your keto and low carb lifestyle</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
				<!-- END SHOP SECTION-->

				<!-- RECIPES SECTION -->
                <div class="section-block pb-0 pt-0 home-image-panel gradient-brown">

                    <div class ="row">
                        <div class="column width-4 left-on-mobile pt-100 pb-100 home-text-panel-left">
                            <div class="pu-10">
                                <p class="lead text-large weight-bold mb-20 mb-mobile-0">The Ketogram Recipes</p>
                                <p class="text-medium column width-12">A selection of tried and tested keto recipes we hope you will try for yourself</p>
                            </div>
                        </div>


                        <div class = "column width-8" style="margin-left: 30%;">
                            <a href="{{url('/recipes')}}" alt="recipes" class="link-image-recipes"></a>
                            <div class = "column home-link">
                                <a href = "{{url('/recipes')}}" style= "position: relative; margin-top: 40%; float:right;" class="button pill bkg-theme text-uppercase button-yellow text-large">Recipes</a>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- END RECIPES SECTION-->

                <!-- BLOG SECTION -->
                <div class="section-block pb-0 pt-0 home-image-panel gradient-orange">
                    <div class ="row">
                        <div class = "column width-8">
                            <a href="{{url('/blog')}}" alt="blog" class="link-image-blog"></a>
                            <div class = "column home-link">
                                <a href = "{{url('/blog')}}" style= "position: relative; margin-top: 40%;" class="button pill bkg-theme text-uppercase button-blue text-large">Blogs</a>
                            </div>
                        </div>

                        <div class="column width-4 left-on-mobile pt-100 pb-100 home-text-panel">
                            <div class="pu-10">
                                <p class="lead text-large weight-bold mb-20 mb-mobile-0">The Ketogram Blog</p>
                                <p class="text-medium column width-12">Find out our latest news, featured products, and keto advice in our blog.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END BLOG SECTION-->

                <!-- SOCIAL MEDIA -->
                <div class="section-block products pt-20 pb-80 bkg-brown" id="social-media-home">
                        <div class = "row">
                            <div class="column width-12 center">
                                <p class="lead text-large weight-bold mb-20 mb-mobile-0 neon-orange">Social Media</p>
                            </div>
                        </div>

                    {{--<div class="row">--}}
                        <div class="column width-12 slider-column no-padding">
                            <div class="tm-slider-container recent-slider" data-speed="1100" data-auto-advance data-nav-arrows="true" data-progress-bar="false" data-carousel-visible-slides="6">
                                <ul class="tms-slides">

                                    <li class="tms-slide product">
                                        <div class="thumbnail product-thumbnail img-scale-in" data-hover-easing="easeInOut" data-hover-speed="700" data-hover-bkg-color="#000000" data-hover-bkg-opacity="0.01">
                                            <span class="social-icons"><span class="icon-instagram-with-circle large"></span></span>
                                            <a class="overlay-link" target="_blank" href="{{INSTAGRAM}}">
                                                <img class="tms-caption" data-src="images/slider/social-1.png" src="images/blank.png" alt=""/>
                                            </a>
                                            {{--<div class="product-actions center">--}}
                                                {{--<a class="text-xlarge">#ketogram</a>--}}
                                            {{--</div>--}}
                                        </div>
                                    </li>

                                    <li class="tms-slide product">
                                        <div class="thumbnail product-thumbnail img-scale-in" data-hover-easing="easeInOut" data-hover-speed="700" data-hover-bkg-color="#000000" data-hover-bkg-opacity="0.01">
                                            <span class="social-icons"><span class="icon-facebook-with-circle large"></span></span>
                                            <a class="overlay-link" target="_blank" href="{{FACEBOOK}}">
                                                <img class="tms-caption" data-src="images/slider/social-2.png" src="images/blank.png" alt=""/>
                                            </a>
                                            {{--<div class="product-actions center">--}}
                                                {{--<a class="text-xlarge">#ketogram</a>--}}
                                            {{--</div>--}}
                                        </div>
                                    </li>

                                    <li class="tms-slide product">
                                        <div class="thumbnail product-thumbnail img-scale-in" data-hover-easing="easeInOut" data-hover-speed="700" data-hover-bkg-color="#000000" data-hover-bkg-opacity="0.01">
                                            <span class="social-icons"><span class="icon-twitter-with-circle large"></span></span>
                                            <a class="overlay-link" target="_blank" href="{{TWITTER}}">
                                                <img class="tms-caption" data-src="images/slider/social-3.png" src="images/blank.png" alt=""/>
                                            </a>
                                            {{--<div class="product-actions center">--}}
                                                {{--<a class="text-xlarge">#ketogram</a>--}}
                                            {{--</div>--}}
                                        </div>
                                    </li>

                                    <li class="tms-slide product">
                                        <div class="thumbnail product-thumbnail img-scale-in" data-hover-easing="easeInOut" data-hover-speed="700" data-hover-bkg-color="#000000" data-hover-bkg-opacity="0.01">
                                            <span class="social-icons"><span class="icon-instagram-with-circle large"></span></span>
                                            <a class="overlay-link" target="_blank" href="{{INSTAGRAM}}">
                                                <img class="tms-caption" data-src="images/slider/social-4.png" src="images/blank.png" alt=""/>
                                            </a>
                                            {{--<div class="product-actions center">--}}
                                                {{--<a class="text-xlarge">#ketogram</a>--}}
                                            {{--</div>--}}
                                        </div>
                                    </li>

                                    <li class="tms-slide product">
                                        <div class="thumbnail product-thumbnail img-scale-in" data-hover-easing="easeInOut" data-hover-speed="700" data-hover-bkg-color="#000000" data-hover-bkg-opacity="0.01">
                                            <span class="social-icons"><span class="icon-facebook-with-circle large"></span></span>
                                            <a class="overlay-link" target="_blank" href="{{FACEBOOK}}">
                                                <img class="tms-caption" data-src="images/slider/social-5.png" src="images/blank.png" alt=""/>
                                            </a>
                                            {{--<div class="product-actions center">--}}
                                                {{--<a class="text-xlarge">#ketogram</a>--}}
                                            {{--</div>--}}
                                        </div>
                                    </li>

                                    <li class="tms-slide product">
                                        <div class="thumbnail product-thumbnail img-scale-in" data-hover-easing="easeInOut" data-hover-speed="700" data-hover-bkg-color="#000000" data-hover-bkg-opacity="0.01">
                                            <span class="social-icons"><span class="icon-twitter-with-circle large"></span></span>
                                            <a class="overlay-link" target="_blank" href="{{TWITTER}}">
                                                <img class="tms-caption" data-src="images/slider/social-6.png" src="images/blank.png" alt=""/>
                                            </a>
                                            {{--<div class="product-actions center">--}}
                                                {{--<a class="text-xlarge">#ketogram</a>--}}
                                            {{--</div>--}}
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    {{--</div>--}}
                </div>
                <!-- END SOCIAL MEDIA -->


                <!-- SIGN UP -->
                <div class ="section-block pb-0 pt-50">
                    <div class="row">
                        <div class="column width-12">
                            <div class="widget text-medium">
                                <h2 class="widget-title center">Signup For Our Newsletter</h2>
                                <p class="mb-20">If you'd like to keep up to date to benefit from our offers just sign up below for our newsletter, and you will receive 15% of your first order!</p>
                                <div class="signup-form-container">
                                    <form class="signup" action="{{url('/queries/create')}}" method="post" novalidate id="newsletter-footer">
                                    <script>
                                        function onSubmit() {
                                                grecaptcha.execute();
                                                document.getElementById("newsletter-footer").submit();
                                            }
                                    </script>
                                    {{ csrf_field() }}
                                        <div class="row">
                                            <div class="column width-12 left">
                                                <div class="field-wrapper">
                                                    <input type="email" name="email" class="form-email form-element no-padding-left no-padding-right" placeholder="Email address*" tabindex="2" required>
                                                </div>
                                            </div>
                                            {{--<div class="g-recaptcha" data-sitekey="6LeFzVoUAAAAAJGTOgjPp4Msr5Tz-0q__Y2P4VgH"></div>--}}
                                            <div
                                                class="g-recaptcha column width-4 offset-4 center"
                                                data-sitekey="6LeFzVoUAAAAAJGTOgjPp4Msr5Tz-0q__Y2P4VgH"
                                                data-callback="onSubmit">
                                            </div>
                                            <div class="special-field">
                                              <label for="birthday">Birthday</label>
                                              <input type="text" name="birthday" id="birthday" value="" />
                                            </div>
                                            <div class="column width-12 center">
                                                <input type="submit" value="Signup" id="recaptcha-submit" class="form-submit button pill button-orange text-large">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SIGN UP -->





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
@stop