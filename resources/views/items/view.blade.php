@extends('layouts/layout')

@section('content')
    <!-- Content -->
    <div class="content clearfix">

        <div class="section-block replicable-content">

            <!-- Product Details -->
            <div class="row product">
                <div class="column width-8 offset-2 pb-20">
                    @include('partials.admin.error-form')

                    @include('partials.admin.success-form')
                </div>
                <div class="column width-5">
                    <div class="product-summary">
                        <h1 class="product-title">{{$item->title}}</h1>
                        <hr>
                        {{--<div class="product-rating">--}}
                            {{--<span class="star-rating"><span class="icon-star"></span><span class="icon-star"></span><span class="icon-star"></span><span class="icon-star"></span><span class="icon-star-outlined"></span></span>--}}
                            {{--<a href="#reviews" class="product-review-link scroll-link tab-trigger-click" data-offset="-80" data-target-tab="#reviews">(3 reviews)</a>--}}
                        {{--</div>--}}
                        @if(isset($item->ItemSales[0]) && !empty($item->ItemSales[0]))
                            <span class="product-price price"><span><i>Price: </i></span> <del><span class="amount">£{{$item->price}} </span></del><br/><span><i>Sale: </i></span><ins><span class="amount">£{{$item->ItemSales[0]['price']}}</span></ins></span>
                        @else
                            <div class="product-price price"><span><i>Price: </i></span><ins><span class="amount">£{{$item->price}}</span></ins></div>
                        @endif
                        <hr>

                        <div class="product-description">
                            <p>{!! str_limit(strip_tags($item->text), 200) !!}</p>
                        </div>

                        <hr>

                        <div class="product-cart">
                            {{--<div class="form-select form-element medium pull-right">--}}
                                {{--<select name="type">--}}
                                    {{--<option selected="selected" value="">Black</option>--}}
                                    {{--<option value="">Black</option>--}}
                                    {{--<option value="">Green</option>--}}
                                    {{--<option value="">Blue</option>--}}
                                    {{--<option value="">Red</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            <label for = "quantity">Quantity:</label>
                            <input type="text" step="1" min="1" id="quantity_{{$item->id}}" name="quantity" value="1" title="Qty" class="form-element quantity" size="4">

                            @if($item->stock <= 0)
                                <button id = "add-to-cart_{{$item->id}}" class="button pill add-to-cart-button disabled" data-id="{{$item->id}}">Out Of Stock</button>
                            @else
                                <button id = "add-to-cart_{{$item->id}}" class="button pill add-to-cart-button add-to-cart" data-id="{{$item->id}}" data-stock="{{$item->stock}}">Add To Cart</button>
                            @endif

                            <span class="checkout-button"><a id = "checkout-button" href="{{ url('/checkout') }}" class="button pill">Checkout</a></span>
                        </div>

                        <div class="cart-warning" id="cart-warning_{{$item->id}}" style = "display: none;">
                            <p style ="color:red;">Quantity exceeds stock limit - more on the way!</p>
                        </div>

                        <hr>
                        <div class="product-meta">
                            <span class="tagged-as">Tags:
                                @foreach($item->FoodCategory as $tag)
                                    <a href = "/shop?category={{$tag['name']}}">{{$tag['name']}}</a>,
                                @endforeach
                            </span>
                        </div>
                        <hr>
                        <ul class="social-list list-horizontal">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{env('APP_URL')}}%2F{{$item->id}}" target="_blank" title="facebook"><span class="icon-facebook-with-circle medium"></span></a></li>
                            <li><a href="https://plus.google.com/share?url={{env('APP_URL')}}%2F{{$item->id}}" target="_blank" title="googleplus"><span class="icon-google-with-circle medium"></span></a></li>
                            <li><a href="https://twitter.com/intent/tweet?text={{$item->title}}&amp;url={{env('APP_URL')}}%2F{{$item->id}}" target="_blank" title="twitter"><span class="icon-twitter-with-circle medium"></span></a></li>
                            <li><a href="http://pinterest.com/pin/create/button/?url={{env('APP_URL')}}%2F{{$item->id}}&description={{$item->title}}" target="_blank" title="pinterest"><span class="icon-pinterest-with-circle medium"></span></a></li>
                        </ul>
                        <hr class="hide show-on-mobile">
                    </div>
                </div>

                <div class="column width-6 offset-1">
                    <div class="product-images">

                        <?php $count = 0;?>
                        <?php if(!isset($item->itemImages[0])){$item->itemImages[0] = array('image' => 'images/no-image.png', 'title' => 'no-image');} ?>
                        @foreach($item->itemImages as $key => $image)
                            <div class="thumbnail product-thumbnail img-scale-in" data-hover-easing="easeInOut" data-hover-speed="700" data-hover-bkg-color="#000000" data-hover-bkg-opacity="0.1">
                                @if(isset($item->ItemSales[0]) && !empty($item->ItemSales[0]))
                                    <span class="onsale">Sale</span>
                                @endif

                                @if($item->stock <= 0)
                                    <span class="outofstock" id="cart-tag_{{$item->id}}">Out of Stock</span>
                                @elseif($item->stock <= 10)
                                     <span class="outofstock" id="cart-tag_{{$item->id}}">Only {{$item->stock}} left!</span>
                                @else
                                     <span class="outofstock hide" id="cart-tag_{{$item->id}}"></span>
                                @endif

                                @if(isset($item->is_gift) && $item->is_gift >= 1)
                                    <span class="onsale gift text-bold">Gift Options</span>
                                @endif


                                <a class="overlay-link lightbox-link @if($count >= 1) hide @endif" data-group="product-lightbox-gallery" href="/{{$image['image']}}" data-lightbox-group="grouped">
                                    <img src="/{{$image['image']}}" alt="/{{$image['title']}}"/>
                                    <span class="overlay-info">
                                        <span>
                                            <span>
                                                <span class="icon-plus large"></span>
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </div>
                        <?php $count++?>
                        @endforeach

                        <div class="product-thumbnails grid-container">
                            <div class="row">
                                <div class="column width-12">
                                    <div class="row grid content-grid-4">
                                        <?php $count = 0;?>
                                        @foreach($item->itemImages as $key => $image)
                                            <div class="grid-item @if($count == 0) grid-sizer @endif">
                                                <div class="thumbnail img-scale-in" data-hover-easing="easeInOut" data-hover-speed="700" data-hover-bkg-color="#000000" data-hover-bkg-opacity="0.1">
                                                    <a class="overlay-link lightbox-link" data-group="product-gallery" href="/{{$image['image']}}">
                                                        <img src="/{{$image['image']}}" alt="/{{$image['title']}}"/>
                                                        <span class="overlay-info">
                                                            <span>
                                                                <span>
                                                                    <span class="icon-plus"></span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php $count++?>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Details End -->

            <!-- Related Info -->
            <div class="row product-related">
                <div class="column width-12">
                    <div class="tabs product-tabs style-2">
                        <ul class="tab-nav">
                            <li class="active">
                                <a href="#tabs-1-pane-1">Description</a>
                            </li>
                            <li>
                                <a href="#tabs-1-pane-2">Nutritional Info</a>
                            </li>
                            {{--<li>--}}
                                {{--<a href="#tabs-1-pane-3" id="reviews">Reviews (3)</a>--}}
                            {{--</li>--}}
                        </ul>
                        <div class="tab-panes">
                            <div id="tabs-1-pane-1" class="active animate">
                                <div class="tab-content">
                                    <p>{!! $item->text !!}</p>
                                </div>
                            </div>
                            <div id="tabs-1-pane-2">
                                <div class="tab-content">
                                    <section class="performance-facts">
                                        <header class="performance-facts__header">
                                            <h1 class="performance-facts__title">Nutrition Facts</h1>
                                            <p>Serving Size {{$item->serving}}
                                            {{--<p>Serving Per Container 8</p>--}}
                                        </header>
                                        <table class="performance-facts__table">
                                            <thead>
                                                <tr>
                                                    <th colspan="3" class="small-info">
                                                    Amount Per Serving
                                                    </th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                            <tr>
                                                <th colspan="2">
                                                    <b>Calories</b>
                                                    {{$item->cals}}
                                                </th>
                                                <td>
                                                    Calories from Fat
                                                    {{$item->fat * 9}}
                                                </td>
                                            </tr>

                                            <tr class="thick-row">
                                                <td colspan="3" class="small-info">
                                                    <b>% Daily Value*</b>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th colspan="2">
                                                    <b>Total Fat</b>
                                                    {{$item->fat}}g
                                                </th>
                                                <td>
                                                    <b>{{round(($item->fat / 70) * 100)}}%</b>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="blank-cell">
                                                </td>
                                                <th>
                                                    Saturated Fat
                                                    {{$item->sat_fat}}g
                                                </th>
                                                <td>
                                                    <b>{{round(($item->sat_fat / 20) * 100)}}%</b>
                                                </td>
                                            </tr>

                                            <tr>
                                            <td class="blank-cell">
                                                </td>
                                                    <th>
                                                        Trans Fat
                                                        {{$item->tran_fat}}g
                                                    </th>
                                                <td>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th colspan="2">
                                                    <b>Cholesterol</b>
                                                    {{$item->cholesterol}}mg
                                                </th>
                                                <td>
                                                    <b>{{round(($item->cholesterol / 300) * 100)}}%</b>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th colspan="2">
                                                    <b>Sodium</b>
                                                     {{$item->salt}}mg
                                                </th>
                                                <td>
                                                    <b>{{round(($item->salt / 6) * 100)}}%</b>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th colspan="2">
                                                    <b>Total Carbohydrate</b>
                                                    {{$item->carbs}}g
                                                </th>
                                                <td>
                                                    <b>{{round(($item->carbs / 230) * 100)}}%</b>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="blank-cell">
                                                </td>
                                                <th>
                                                    Dietary Fiber
                                                    {{$item->fibre}}g
                                                </th>
                                                <td>
                                                    <b>{{round(($item->fibre / 24) * 100)}}%</b>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="blank-cell">
                                                </td>
                                                <th>
                                                    Sugars
                                                    {{$item->sugar}}
                                                </th>
                                                <td>
                                                </td>
                                            </tr>

                                            <tr>
                                                @if(($item->carbs - $item->polyol) < 5)
                                                    <th colspan="2" style = "color:#008f95;">
                                                        <b>Impact Carbs</b>
                                                        {{$item->carbs - $item->polyol}}g
                                                    </th>
                                                @else
                                                    <th colspan="2" style = "color:red;">
                                                        <b>Impact Carbs</b>
                                                        {{$item->carbs - $item->polyol}}g
                                                    </th>
                                                @endif

                                                <td>
                                                </td>
                                            </tr>

                                            <tr class="thick-end">
                                                <th colspan="2">
                                                    <b>Protein</b>
                                                    {{$item->protein}}g
                                                </th>
                                                <td>
                                                </td>
                                            </tr>
                                        </tbody>
                                        </table>

                                    <table class="performance-facts__table--grid">
                                        {{--<tbody>--}}
                                            {{--<tr>--}}
                                                {{--<td colspan="2">--}}
                                                {{--Vitamin A--}}
                                                {{--10%--}}
                                                {{--</td>--}}
                                                {{--<td>--}}
                                                {{--Vitamin C--}}
                                                {{--0%--}}
                                                {{--</td>--}}
                                            {{--</tr>--}}

                                            {{--<tr class="thin-end">--}}
                                                {{--<td colspan="2">--}}
                                                    {{--Calcium--}}
                                                    {{--10%--}}
                                                {{--</td>--}}
                                                {{--<td>--}}
                                                    {{--Iron--}}
                                                    {{--6%--}}
                                                {{--</td>--}}
                                            {{--</tr>--}}
                                        {{--</tbody>--}}
                                    </table>

                                    <p class="small-info">* Percent Daily Values are based on a 2,000 calorie diet. Your daily values may be higher or lower depending on your calorie needs:</p>

                                    {{--<p class="small-info">--}}

                                    {{--</p>--}}
                                    <p class="small-info text-center">
                                        Calories per gram:
                                        Fat 9
                                        &bull;
                                        Carbohydrate 4
                                        &bull;
                                        Protein 4
                                    </p>

                                    </section>
                                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Related Info End -->

            <!-- Products Similar -->
            <div class="row products-similar mt-20">
                <div class="column width-12">
                    <hr>
                    <h5 class="mb-50">Related Products</h5>
                    <div id="product-grid" class="grid-container products fade-in-progressively no-padding-top" data-layout-mode="masonry" data-grid-ratio="1.5" data-animate-resize data-animate-resize-duration="0">
                        <div class="row">
                            <div class="column width-12">
                                <div class="row grid content-grid-3">
                                    @foreach($relatedItems as $relatedItem)
                                        <div class="grid-item grid-sizer product design">
                                            <div class="thumbnail product-thumbnail img-scale-in" data-hover-easing="easeInOut" data-hover-speed="700" data-hover-bkg-color="#000000" data-hover-bkg-opacity="0.1">
                                                @if(isset($relatedItem->ItemSales[0]) && !empty($relatedItem->ItemSales[0]))
                                                    <span class="onsale" >Sale</span>
                                                @endif

                                                @if($relatedItem->stock <= 0)
                                                    <span class="outofstock" id="cart-tag_{{$relatedItem->id}}">Out of Stock</span>
                                                @elseif($relatedItem->stock <= 10)
                                                    <span class="outofstock" id="cart-tag_{{$relatedItem->id}}">Only {{$relatedItem->stock}} left!</span>
                                                @else
                                                     <span class="outofstock hide" id="cart-tag_{{$relatedItem->id}}"></span>
                                                @endif

                                                @if(isset($relatedItem->is_gift) && $relatedItem->is_gift >= 1)
                                                    <span class="onsale gift text-bold">Gift Options</span>
                                                @endif

                                                <a class="overlay-link" href="/items/{{$relatedItem->id}}">
                                                    @if(isset($relatedItem->itemImages[0]))<img src="/{{$relatedItem->itemImages[0]['image']}}" alt="{{$relatedItem->itemImages[0]['title']}}" />@else <img src="/images/no-image.png" alt="No Image" /> @endif
                                                </a>
                                                <div class="product-actions center">
                                                    @if($relatedItem->stock <= 0)
                                                        <a id = "add-to-cart_{{$relatedItem->id}}" class="button pill add-to-cart-button large disabled">Out Of Stock</a>
                                                    @else
                                                        <a id = "add-to-cart_{{$relatedItem->id}}" class="button pill add-to-cart-button add-to-cart large" data-id="{{$relatedItem->id}}" data-stock="{{$relatedItem->stock}}">Add To Cart</a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="product-details center">
                                                <h3 class="product-title">
                                                    <a href="/items/{{$relatedItem->id}}">
                                                        {{$relatedItem->title}}
                                                    </a>
                                                </h3>
                                                {{--<span class="product-price price"><span class="amount">£{{$relatedItem->price}}</span><ins></ins></span>--}}
                                                @if(isset($relatedItem->ItemSales[0]) && !empty($relatedItem->ItemSales[0]))
                                                    <span class="product-price price"><del><span class="amount">£{{$relatedItem->price}}</span></del><ins><span class="amount">£{{$relatedItem->ItemSales[0]['price']}}</span></ins></span>
                                                @else
                                                    <span class="product-price price"><ins><span class="amount">£{{$relatedItem->price}}</span></ins></span>
                                                @endif
                                                <div class="product-actions-mobile">
                                                    @if($relatedItem->stock <= 0)
                                                        <a id = "add-to-cart_{{$relatedItem->id}}" class="button pill add-to-cart-button large disabled">Out Of Stock</a>
                                                    @else
                                                        <a id = "add-to-cart_{{$relatedItem->id}}" class="button pill add-to-cart-button add-to-cart large" data-id="{{$relatedItem->id}}" data-stock="{{$relatedItem->stock}}">Add To Cart</a>
                                                    @endif
                                                </div>
                                                <div class="cart-warning" id="cart-warning_{{$relatedItem->id}}" style = "display: none;">
                                                    <p style ="color:red;">Quantity exceeds stock limit - more on the way!</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Products Similar End -->

        </div>
    </div>
    <!-- Content End -->
@stop