@extends('layouts/layout')

@section('content')
    <!-- Content -->
    <div class="content clearfix">

        <!-- Intro Title Section 2 -->
        <div class="section-block background-aqua pt-100 pb-50">
            <div class = "row center pt-50 pb-50">
                <div class="space3d">
                    <div class="_3dbox">
                        <div class="_3dface _3dface--front">
                            <?php $count = 0;?>
                            @if(isset($itemsCustom))
                                @foreach($itemsCustom as $item)
                                    <?php $count++;?>
                                    @if($count % 4 == 1)
                                        <div class = "row">
                                    @endif

                                        @if(isset($item->itemImages[0]))
                                            <div class = "custom-box-item" id="custom-box-item_{{$item->id}}">
                                                <span class="badge background-aqua">{{$item->quantity}}</span>
                                                <span class="badge custom-remove icon-cancel" data-id="{{$item->id}}" data-quantity="{{$item->quantity}}" data-price="{{$item->price}}"></span>
                                                <img src="/{{$item->itemImages[0]['image']}}" alt="{{$item->itemImages[0]['title']}}" />
                                            </div>
                                        @else
                                            <div class = "custom-box-item" id="custom-box-item_{{$item->id}}">
                                                <span class="badge background-aqua">{{$item->quantity}}</span>
                                                <span class="badge custom-remove icon-cancel" data-id="{{$item->id}}" data-quantity="{{$item->quantity}}" data-price="{{$item->price}}"></span>
                                                <img src="/images/no-image.png" alt="No Image" />
                                            </div>
                                        @endif

                                    @if($count % 4 == 0)
                                        </div>
                                    @endif


                                @endforeach

                                @if($count % 4 != 0)
                                    </div>
                                @endif
                            @endif
                        </div>

                        <div class="_3dface _3dface--top">

                        </div>
                        <div class="_3dface _3dface--bottom">

                        </div>
                        <div class="_3dface _3dface--left">

                        </div>
                        <div class="_3dface _3dface--right">

                        </div>
                        <div class="_3dface _3dface--back">

                        </div>
                    </div>
                </div>
            </div>

            <div id="custom_price" data-price="@if(isset($itemsCustom)){{$itemsCustom->totalPrice}}@endif"></div>

            <div class = "row" id="custom-coupon-error" style="display: none;">
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <ul>
                        <li>Item limit reached</li>
                    </ul>
                </div>
            </div>

            <div class = "row" id="custom-move-button" @if(isset($itemsCustom) && $itemsCustom->totalPrice >= 20)style="display: block;" @else style="display: none;"@endif>
                <a class="button pill checkout no-margin-bottom button-yellow center-block" href="{{url('/subscribe-checkout/custom')}}">Move on</a>
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
                            <li class = "post-categories widget-title-long"><a @if(Request::query('category') == $category) class = "current" @endif href = "/subscribe-custom?category={{$category}}">{{$category}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- Intro Title Section 2 End -->

        <!-- Product Grid -->
        <div id="product-grid" class="section-block grid-container products fade-in-progressively no-padding-top" data-layout-mode="masonry" data-grid-ratio="1.5" data-animate-resize data-animate-resize-duration="700">
            <div class="row">
                <div class="column width-12">
                    <div class="row grid content-grid-3">
                        @foreach($items as $item)
                            <div class="grid-item product portrait grid-sizer">
                                <div class="thumbnail product-thumbnail img-scale-in" data-hover-easing="easeInOut" data-hover-speed="700" data-hover-bkg-color="#000000" data-hover-bkg-opacity="0.01">
                                    <a class="overlay-link" href="/items/{{$item->id}}">
                                        @if(isset($item->itemImages[0]))<img src="/{{$item->itemImages[0]['image']}}" alt="{{$item->itemImages[0]['title']}}" />@else <img src="/images/no-image.png" alt="No Image" /> @endif
                                    </a>
                                    <div class="product-actions center">
                                        @if(isset($itemsCustom) && $itemsCustom->totalPrice >= 20)
                                            <a id = "add-to-custom_{{$item->id}}" class="button pill add-to-cart-button large disabled" data-id="{{$item->id}}">Add To Box</a>
                                        @else
                                            <a id = "add-to-custom_{{$item->id}}" class="button pill add-to-cart-button large add-to-custom" data-id="{{$item->id}}">Add To Box</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="product-details center">
                                    <h3 class="product-title">
                                        <a href="/items/{{$item->id}}">
                                            {{$item->title}}
                                        </a>
                                    </h3>
                                    <div class="product-actions-mobile">
                                        @if(isset($itemsCustom) && $itemsCustom->totalPrice >= 20)
                                            <a id = "add-to-custom_{{$item->id}}" class="button pill add-to-cart-button large disabled" data-id="{{$item->id}}">Add To Box</a>
                                        @else
                                            <a id = "add-to-custom_{{$item->id}}" class="button pill add-to-cart-button large add-to-custom" data-id="{{$item->id}}">Add To Box</a>
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