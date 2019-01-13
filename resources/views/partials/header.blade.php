    <!-- Side Navigation Menu -->
	<aside class="side-navigation-wrapper enter-right" data-no-scrollbar data-animation="push-in">
		<div class="side-navigation-scroll-pane">
			<div class="side-navigation-inner">
				<div class="side-navigation-header">
					<div class="navigation-hide side-nav-hide">
						<a href="#">
							<span class="icon-cancel medium"></span>
						</a>
					</div>
				</div>

				<nav class="side-navigation">
					<ul>
						<li @if(isset($meta) && $meta['section'] == 'Home') class = "current" @endif>
							<a href="/">Home</a>
						</li>
						<li @if(isset($meta) && $meta['section'] == 'Subscription') class = "current" @endif>
							<a href="/subscriptions">Subscribe</a>
						</li>
						<li @if(isset($meta) && $meta['section'] == 'Order') class = "current" @endif>
							<a href="/shop">Shop</a>
						</li>
						<li @if(isset($meta) && $meta['section'] == 'Recipe') class = "current" @endif>
							<a href="/recipes">Recipes</a>
						</li>
						<li @if(isset($meta) && $meta['section'] == 'Blog') class = "current" @endif>
                            <a href="/blog">Blog</a>
                        </li>
                        {{--<li @if(isset($meta) && $meta['section'] == 'Faq') class = "current" @endif>--}}
                            {{--<a href="/faqs">FAQs</a>--}}
                        {{--</li>--}}
					</ul>
				</nav>
				<nav class="side-navigation nav-block">
					<ul>
						<li id="cart-navigation-mobile">
                            <a href="#" class="contains-sub-menu cart">Cart <span class="cart-indication"><span class="badge background-aqua"><?php echo $cartArray['totalCount'];?></span></span></a>
                            <ul class="sub-menu custom-content cart-overview">
                                <?php foreach($cartArray as $dat){?>
                                    <?php if(isset($dat['id']) && !empty($dat['id'])){?>
                                        <li class="cart-item">
                                            <a href="/items/<?php echo $dat['id']?>" class="product-thumbnail">
                                                @if(isset($dat->itemImages[0]))<img src="/{{$dat->itemImages[0]['image']}}" alt="{{$dat->itemImages[0]['title']}}" />@else <img src="/images/no-image.png" alt="No Image" /> @endif
                                            </a>
                                            <div class="product-details">
                                                <a href="/items/<?php echo $dat['id']?>" class="product-title">
                                                    <?php echo $dat['title']?>
                                                </a>
                                                <span class="product-quantity"><?php echo $dat['quantity']?> x</span>

                                                @if(isset($dat->itemSales[0]) && !empty($dat->itemSales[0]))
                                                    <span class="product-price"><del><span class="currency">£</span><?php echo $dat['price']?> </del><ins><span class="amount">£{{$dat->itemSales[0]['price']}}</span></ins></span>
                                                @else
                                                    <span class="product-price"><span class="currency">£</span><?php echo $dat['price']?></span>
                                                @endif

                                                <a class="product-remove icon-cancel" data-id="<?php echo $dat['id']?>" data-stock="{{$dat['stock']}}"></a>
                                            </div>
                                        </li>
                                    <?php } ?>
                                <?php }?>
                                <li class="cart-subtotal">
                                    Sub Total
                                    <span class="amount"><span class="currency">£</span><?php echo $cartArray['totalPrice']; ?></span>
                                </li>
                                <li class="cart-actions">
                                    <a href="/cart" class="view-cart mt-10 checkout button pill small">View Cart</a>
                                    <a href="/checkout" class="checkout mt-10 button pill small"> Checkout</a>
                                </li>
                            </ul>
						</li>
					</ul>
				</nav>
                <nav class="side-navigation nav-block">
                    <ul>
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}" class="cart"><span class = "header-invert">Login</span></a></li>
                        @else
                            <li>
                                <a href="#" class="contains-sub-menu cart"><span class="cart-indication"><span class="fa fa-user"></span></span></a>
                                <ul class="sub-menu custom-content cart-overview">
                                    <li class = "username">{{ Auth::user()->name }}</li>
                                    <li class="user-options"><a href="{{ url('/subscriptions')}}/{{Auth::id()}}">Manage Subscription</a></li>
                                    <li class="user-options"><a href="{{ url('/share')}}/{{Auth::id()}}">Share-O-Metre</a></li>
                                    <li class="user-options"><a href="{{ url('/orders') }}/{{Auth::id()}}">Shop Orders</a></li>
                                    <li class="user-options"><a href="{{ url('/settings/') }}/{{Auth::id()}}">Settings</a></li>
                                    <li class="user-options"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                    <li class="user-options"><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </nav>


			</div>
		</div>
	</aside>

    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class ="column width-3">
                <div class="modal-image">
                    <img src="/images/header-small.jpg" alt="ketogram box">
                </div>
            </div>

            <div class ="column width-9">
                <span class="close  icon-cancel"></span>
                <h3 class="text-orange text-center">15% Off your First Order!</h3>
                <p class="text-medium text-center">Sign up to our newsletter for exclusive Ketogram news, inspiration, offers and more!</p>
                <form class="signup" action="{{url('/queries/create')}}" method="post" novalidate>
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="column width-8 offset-2">
                            <div class="field-wrapper">
                                <input type="email" name="email" class="form-email form-element no-padding-left no-padding-right" placeholder="Email address*" tabindex="2" required>
                            </div>
                        </div>
                        <div
                            class="g-recaptcha column width-4 offset-3 center"
                            data-sitekey="6LeFzVoUAAAAAJGTOgjPp4Msr5Tz-0q__Y2P4VgH"
                            data-callback="onSubmit">
                        </div>
                        <div class="special-field">
                            <label for="birthday">Birthday</label>
                            <input type="text" name="birthday" id="birthday" value="" />
                        </div>
                        <div class="column width-2 offset-5">
                            <input type="submit" value="Signup" class="form-submit button pill button-orange text-xlarge weight-bold uppercase">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(isset($meta) && ($meta['section'] == 'Subscription') || $meta['section'] == 'Order'))
	<!-- Cart Update -->
    <aside id = "cart-update">
        <div id="cart-top"><h2 class = "cart-title">Your Box</h2><span class ="icon-right-circled cart-close"></span></div>
        <div id="cart-form">
            <div id="cart-container">
                @if(isset($itemsCustom))
                    @foreach($itemsCustom as $item)
                        @if(isset($item->itemImages[0]))
                            <?php $image = '/'.$item->itemImages[0]['image'];?>
                        @else
                            <?php $image = '/images/no-image.png';?>
                        @endif
                        <div class = "cart-item" id ="cart-item_{{$item->id}}">
                            <img src="{{$image}}"/>
                            <div class = 'cart-content'>
                                <div class = "row">
                                    <span class ="title">{{$item->title}}</span>
                                </div>

                                <div class = "row">
                                    <span class="quantity background-aqua">x {{$item->quantity}}</span>
                                </div>

                                <span class="remove custom-remove icon-cancel" data-id="{{$item->id}}" data-quantity="{{$item->quantity}}" data-price="{{$item->price}}"></span>
                            </div>
                        </div>
                    @endforeach

                    {{--@if(isset($meta) && $meta['section'] == 'Order')--}}
                        {{--<div class = "cart-total">--}}
                            {{--<h2>TEST</h2>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                @elseif(isset($cartArray))
                    @foreach($cartArray as $dat)
                        @if(isset($dat['id']))
                            @if(isset($dat->itemImages[0]))
                                <?php $image = '/'.$dat->itemImages[0]['image'];?>
                            @else
                                <?php $image = '/images/no-image.png';?>
                            @endif

                            <div class = "cart-item" id ="cart-item_{{$dat['id']}}">
                                <img src="{{$image}}"/>
                                <div class = 'cart-content'>
                                    <div class = "row">
                                        <span class ="title">{{$dat['title']}}</span>
                                    </div>

                                    <div class = "row">
                                        @if(isset($dat->itemSales[0]) && !empty($dat->itemSales[0]))
                                            <span class="quantity background-aqua">{{$dat['quantity']}} x <del><span class="currency">£</span>{{$dat['price']}} </del><ins><span class="currency">£</span>{{$dat->itemSales[0]['price']}}</ins></span>
                                        @else
                                            <span class="quantity background-aqua">{{$dat['quantity']}} x <span class="currency">£</span>{{$dat['price']}}</span>
                                        @endif
                                    </div>

                                    <span class="remove product-remove icon-cancel" data-id="{{$dat['id']}}" data-quantity="{{$dat['quantity']}}" data-price="{{$dat['price']}}" data-stock="{{$dat['stock']}}"></span>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class = "cart-total pb-20 pt-20">
                        Sub Total
                        <span class="amount pull-right"><span class="currency">£</span><?php echo $cartArray['totalPrice']; ?></span>
                    </div>

                    <div class="cart-actions">
                        <a href="/cart" class="view-cart mt-10 checkout button pill button-yellow text-large">View Cart</a>
                        <a href="/checkout" class="checkout mt-10 button pill button-blue pull-right text-large"> Checkout</a>
                    </div>
                @endif
            </div>
        </div>
    </aside>
    <!-- END CART UPDATE -->
    @endif

	<!-- Side Navigation Menu End -->
	<div class="wrapper">
        <div class="wrapper-inner">

            <!-- Header -->
            <header class="header header-fixed header-fixed-on-mobile header-transparent" data-bkg-threshold="100" data-compact-threshold="100">
                <div class="header-inner">
                    <div class="row nav-bar">
                        <div class="column width-12 nav-bar-inner">
                            <div class="logo">
                                <div class="logo-inner">
                                    <a href="/"><img src="/images/logos/keto-long2.png" style="width:150%;" alt="Ketogram Logo"/></a>
                                    <a href="/"><img src="/images/logos/keto-long2.png" style="width:150%;" alt="Ketogram Logo" /></a>
                                </div>
                            </div>
                            <nav class="navigation nav-block secondary-navigation nav-right">
                                <ul>
                                    <li id="cart-navigation">
                                        <a href="#" class="nav-icon cart no-page-fade"><span class="cart-indication"><span class="icon-shopping-cart"></span> <span class="badge background-aqua"><?php echo $cartArray['totalCount'];?></span></span></a>
                                        <ul class="sub-menu custom-content cart-overview">
                                            <?php foreach($cartArray as $dat){?>
                                                <?php if(isset($dat['id']) && !empty($dat['id'])){?>
                                                    <li class="cart-item">
                                                        <a href="/items/<?php echo $dat['id']?>" class="product-thumbnail">
                                                            @if(isset($dat->itemImages[0]))<img src="/{{$dat->itemImages[0]['image']}}" alt="{{$dat->itemImages[0]['title']}}" />@else <img src="/images/no-image.png" alt="No Image" /> @endif
                                                        </a>
                                                        <div class="product-details">
                                                            <a href="/items/<?php echo $dat['id']?>" class="product-title">
                                                                <?php echo $dat['title']?>
                                                            </a>
                                                            <span class="product-quantity"><?php echo $dat['quantity']?> x</span>
                                                            @if(isset($dat->itemSales[0]) && !empty($dat->itemSales[0]))
                                                                <span class="product-price"><del><span class="currency">£</span><?php echo $dat['price']?> </del><ins><span class="amount">£{{$dat->itemSales[0]['price']}}</span></ins></span>
                                                            @else
                                                                <span class="product-price"><span class="currency">£</span><?php echo $dat['price']?></span>
                                                            @endif
                                                            <a class="product-remove icon-cancel" data-id="<?php echo $dat['id'];?>" data-stock="{{$dat['stock']}}"></a>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            <?php }?>
                                            <li class="cart-subtotal">
                                                Sub Total
                                                <span class="amount"><span class="currency">£</span><?php echo $cartArray['totalPrice']; ?></span>
                                            </li>
                                            <li class="cart-actions">
                                                <a href="/cart" class="view-cart mt-10 checkout button pill small">View Cart</a>
                                                <a href="/checkout" class="checkout button pill small"> Checkout</a>
                                            </li>
                                        </ul>
                                    </li>
                                        @if (Auth::guest())
                                            <li><a href="{{ url('/login') }}" class="nav-icon cart no-page-fade"><span class = "header-invert">Login</span></a></li>
                                        @else
                                            <li>
                                                <a href="#" class="nav-icon cart no-page-fade"><span class="cart-indication"><span class="fa fa-user"></span></span></a>
                                                <ul class="sub-menu custom-content cart-overview" id = "user-sub-menu">
                                                    <li class = "username">{{ Auth::user()->name }}</li>
                                                    <li><a href="{{ url('/subscriptions')}}/{{Auth::id()}}">Manage Subscription</a></li>
                                                    <li><a href="{{ url('/share')}}/{{Auth::id()}}">Share-O-Metre</a></li>
                                                    <li><a href="{{ url('/orders') }}/{{Auth::id()}}">Shop Orders</a></li>
                                                    <li><a href="{{ url('/settings') }}/{{Auth::id()}}">Settings</a></li>
                                                    {{--<li><a href="{{ url('/logout') }}">Logout</a></li>--}}
                                                    <li><a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                                    <li><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form></li>
                                                </ul>
                                            </li>
                                        @endif
                                    <li>
                                        <!-- Search -->
                                        {{--<a href="#search-modal" data-content="inline" data-toolbar="" data-aux-classes="tml-search-modal" data-modal-mode data-modal-width="1000" data-lightbox-animation="fade" data-nav-exit="false" class="lightbox-link nav-icon">--}}
                                            {{--<span class="icon-magnifying-glass"></span>--}}
                                        {{--</a>--}}
                                    </li>
                                    <li class="aux-navigation hide">
                                        <!-- Aux Navigation -->
                                        <a href="#" class="navigation-show side-nav-show nav-icon">
                                            <span class="icon-menu"></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <nav class="navigation nav-block primary-navigation nav-right">
                                <ul>
                                    <li @if(isset($meta) && $meta['section'] == 'Home') class = "current" @endif>
                                        <a href="/">Home</a>
                                    </li>
                                    <li @if(isset($meta) && $meta['section'] == 'Subscription') class = "current" @endif>
                                        <a href="/subscriptions">Subscribe</a>
                                    </li>
                                    <li @if(isset($meta) && $meta['section'] == 'Order') class = "current" @endif>
                                        <a href="/shop">Shop</a>
                                    </li>
                                    <li @if(isset($meta) && $meta['section'] == 'Recipe') class = "current" @endif>
                                        <a href="/recipes">Recipes</a>
                                    </li>
                                    <li @if(isset($meta) && $meta['section'] == 'Blog') class = "current" @endif>
                                        <a href="/blog">Blog</a>
                                    </li>
                                    {{--<li @if(isset($meta) && $meta['section'] == 'Faq') class = "current" @endif>--}}
                                        {{--<a href="/faqs" class="contains-sub-menu">FAQs</a>--}}
                                    {{--</li>--}}
                                </ul>
                            </nav>
                        </div>
                    </div>

                    @if(!isset($_COOKIE["cookie"]) || !$_COOKIE["cookie"])
                        <div id = "cookie-panel" class = "section-block pt-10 pb-0" style = "background-color: #534742;">
                            <div class="row">
                                <div class="column width-12">
                                    <p class="lead text-medium mb-10 text-center inline offset-3" style = "color:white;">We use cookies to ensure you get the best experience <a href="/" id = "cookie-panel-a"><span class="icon-cancel"></span></a></p>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </header>
            <!-- Header End -->