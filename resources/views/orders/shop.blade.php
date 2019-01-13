@extends('layouts/layout')

@section('content')
    <!-- Content -->
    <div class="content clearfix">

        <!-- Intro Title Section 2 -->
        <div class="section-block background-aqua pt-100 pb-50">
            <div class="media-overlay"></div>
            <div class="row">
                <div class="column width-12">
                    <div class="title-container">
                        <div class="title-container-inner">
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">Shop</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Intro Title Section 2 End -->

        <!-- Intro Title Section 2 -->
        <div class="section-block pt-20 pb-20">
            <div class="row">
                <div class="column width-8 offset-2 pb-20">
                    @include('partials.admin.error-form')

                    @include('partials.admin.success-form')
                </div>
                <div class="column width-3">
                    <div class="widget">
                        <h3 class="widget-title widget-title-long">Search</h3>
                        <div class="search-form-container site-search">
                            <form action="#" method="get" novalidate>
                                <div class="row">
                                    <div class="column width-12">
                                        <div class="field-wrapper">
                                            <input type="text" name="keywords" value = "{{Request::query('keywords')}}" class="form-search form-element" placeholder="Type &amp; hit enter...">
                                            <span class="border"></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="form-response"></div>
                        </div>
                    </div>
                </div>

                <div class="column width-6 offset-3">
                    <h3 class="widget-title widget-title-long">Tags</h3>
                    <ul>
                        @foreach($categories as $category)
                            <li class = "post-categories widget-title-long"><a @if(Request::query('category') == $category) class = "current" @endif href = "/shop?category={{$category}}">{{$category}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- Intro Title Section 2 End -->

        <!-- Featured Grid -->
        @if(count($featuredItems) >= 1)
        <div id="product-grid" class="section-block pb-10 grid-container products fade-in-progressively no-padding-top" data-layout-mode="masonry" data-grid-ratio="1.5" data-animate-resize data-animate-resize-duration="700">
            <div class="row">
                <div class="column width-12">
                    <hr>
                    <h5 class="mb-50">Featured Products</h5>
                    <div class="row grid content-grid-3">
                        @foreach($featuredItems as $item)
                            <div class="grid-item product portrait grid-sizer">
                                <div class="thumbnail product-thumbnail img-scale-in" data-hover-easing="easeInOut" data-hover-speed="700" data-hover-bkg-color="#000000" data-hover-bkg-opacity="0.01">
                                    @if(isset($item->ItemSales[0]) && !empty($item->ItemSales[0]))
                                        <span class="onsale">Sale</span>
                                    @endif

                                    @if(isset($item->is_gift) && $item->is_gift >= 1)
                                        <span class="onsale gift text-bold">Gift Options</span>
                                    @endif

                                    @if($item->stock <= 0)
                                        <span class="outofstock" id="cart-tag_{{$item->id}}">Out of Stock</span>
                                    @elseif($item->stock <= 10)
                                         <span class="outofstock" id="cart-tag_{{$item->id}}">Only {{$item->stock}} left!</span>
                                    @else
                                         <span class="outofstock hide" id="cart-tag_{{$item->id}}"></span>
                                    @endif

                                    <a class="overlay-link" href="/items/{{$item->id}}">
                                        @if(isset($item->itemImages[0]))<img src="/{{$item->itemImages[0]['image']}}" alt="{{$item->itemImages[0]['title']}}" />@else <img src="/images/no-image.png" alt="No Image" /> @endif
                                    </a>
                                    <div class="product-actions center">
                                        @if($item->stock <= 0)
                                            <a id = "add-to-cart_{{$item->id}}" class="button pill add-to-cart-button large disabled" data-id="{{$item->id}}">Out Of Stock</a>
                                        @else
                                            <a id = "add-to-cart_{{$item->id}}" class="button pill add-to-cart-button large add-to-cart" data-id="{{$item->id}}" data-stock="{{$item->stock}}">Add To Cart</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="product-details center">
                                    <h3 class="product-title">
                                        <a href="/items/{{$item->id}}">
                                            {{$item->title}}
                                        </a>
                                    </h3>
                                    @if(isset($item->ItemSales[0]) && !empty($item->ItemSales[0]))
                                        <span class="product-price price"><del><span class="amount">£{{$item->price}}</span></del><ins><span class="amount">£{{$item->ItemSales[0]['price']}}</span></ins></span>
                                    @else
                                        <span class="product-price price"><ins><span class="amount">£{{$item->price}}</span></ins></span>
                                    @endif
                                    <div class="product-actions-mobile">
                                        @if($item->stock <= 0)
                                            <a id = "add-to-cart_{{$item->id}}" class="button pill add-to-cart-button large disabled" data-id="{{$item->id}}">Out Of Stock</a>
                                        @else
                                            <a id = "add-to-cart_{{$item->id}}" class="button pill add-to-cart-button large add-to-cart" data-id="{{$item->id}}" data-stock="{{$item->stock}}">Add To Cart</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr class="mt-0 mb-50">
                </div>
            </div>
        </div>
        @endif
        <!-- Featured Grid End -->

        <!-- Product Grid -->
        <div id="product-grid" class="section-block grid-container products fade-in-progressively no-padding-top" data-layout-mode="masonry" data-grid-ratio="1.5" data-animate-resize data-animate-resize-duration="700">
            <div class="row">
                <div class="column width-12">
                    <div class="row grid content-grid-3">
                        @foreach($items as $item)
                            <div class="grid-item product portrait grid-sizer">
                                <div class="thumbnail product-thumbnail img-scale-in" data-hover-easing="easeInOut" data-hover-speed="700" data-hover-bkg-color="#000000" data-hover-bkg-opacity="0.01">
                                    @if(isset($item->ItemSales[0]) && !empty($item->ItemSales[0]))
                                        <span class="onsale">Sale</span>
                                    @endif

                                    @if(isset($item->is_gift) && $item->is_gift >= 1)
                                        <span class="onsale gift text-bold">Gift Options</span>
                                    @endif

                                    @if($item->stock <= 0)
                                        <span class="outofstock" id="cart-tag_{{$item->id}}">Out of Stock</span>
                                    @elseif($item->stock <= 10)
                                         <span class="outofstock" id="cart-tag_{{$item->id}}">Only {{$item->stock}} left!</span>
                                    @else
                                         <span class="outofstock hide" id="cart-tag_{{$item->id}}"></span>
                                    @endif

                                    <a class="overlay-link" href="/items/{{$item->id}}">
                                        @if(isset($item->itemImages[0]))<img src="/{{$item->itemImages[0]['image']}}" alt="{{$item->itemImages[0]['title']}}" />@else <img src="/images/no-image.png" alt="No Image" /> @endif
                                    </a>
                                    <div class="product-actions center">
                                        @if($item->stock <= 0)
                                            <a id = "add-to-cart_{{$item->id}}" class="button pill add-to-cart-button large disabled" data-id="{{$item->id}}">Out Of Stock</a>
                                        @else
                                            <a id = "add-to-cart_{{$item->id}}" class="button pill add-to-cart-button large add-to-cart" data-id="{{$item->id}}" data-stock="{{$item->stock}}">Add To Cart</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="product-details center">
                                    <h3 class="product-title">
                                        <a href="/items/{{$item->id}}">
                                            {{$item->title}}
                                        </a>
                                    </h3>
                                    @if(isset($item->ItemSales[0]) && !empty($item->ItemSales[0]))
                                        <span class="product-price price"><del><span class="amount">£{{$item->price}}</span></del><ins><span class="amount">£{{$item->ItemSales[0]['price']}}</span></ins></span>
                                    @else
                                        <span class="product-price price"><ins><span class="amount">£{{$item->price}}</span></ins></span>
                                    @endif
                                    <div class="product-actions-mobile">
                                        @if($item->stock <= 0)
                                            <a id = "add-to-cart_{{$item->id}}" class="button pill add-to-cart-button large disabled" data-id="{{$item->id}}">Out Of Stock</a>
                                        @else
                                            <a id = "add-to-cart_{{$item->id}}" class="button pill add-to-cart-button large add-to-cart" data-id="{{$item->id}}" data-stock="{{$item->stock}}">Add To Cart</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Grid End -->

        {{$items->links('partials/paginator')}}
    </div>
    <!-- Content End -->
@stop