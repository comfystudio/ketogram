@extends('layouts/layout')

@section('content')
    <!-- Content -->
    <div class="content clearfix cart">

        <!-- Intro Title Section 2 -->
        <div class="section-block background-aqua pt-100 pb-50">
            <div class="media-overlay"></div>
            <div class="row">
                <div class="column width-12">
                    <div class="title-container">
                        <div class="title-container-inner">
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">Cart</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Intro Title Section 2 End -->

        <!-- Cart Overview -->
        <div class="section-block cart-overview pt-50">
            <div class="row">
                <div class="column width-12">
                    <div class="cart-review">
                        <table class="table non-responsive">
                            <thead>
                                <tr>
                                    <th class="product-remove"></th>
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name">Name</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    <tr class="cart-item" id="cart-item_{{$item->id}}">
                                        <td class="product-remove center">
                                            <a class="product-remove icon-cancel" data-id="{{$item->id}}" data-stock="{{$item->stock}}"></a>
                                        </td>
                                        <td class="product-thumbnail">
                                            <a href="/items/{{$item->id}}">
                                                @if(isset($item->itemImages[0]))<img src="/{{$item->itemImages[0]['image']}}" alt="{{$item->itemImages[0]['title']}}" />@else <img src="/images/no-image.png" alt="No Image" /> @endif
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <a href="/items/{{$item->id}}" class="product-title">{{$item->title}}</a>
                                        </td>
                                        <td class="product-price">
                                            @if(isset($item->itemSales[0]) && !empty($item->itemSales[0]))
                                                <span class="amount" id="cart-price_{{$item->id}}" data-price="{{$item->itemSales[0]['price']}}"><del><span class="currency">£</span>{{$item->price}} </del><ins><span class="amount">£{{$item->itemSales[0]['price']}}</span></ins></span>
                                            @else
                                                <span class="amount" id="cart-price_{{$item->id}}" data-price="{{$item->price}}"><span class="currency">£</span>{{$item->price}}</span>
                                            @endif
                                        </td>
                                        <td class="product-quantity">
                                            <input type="text" step="1" min="1" max="{{$item->stock + $item->quantity}}" data-max = "{{$item->stock + $item->quantity}}" data-id = "{{$item->id}} "name="quantity" value="{{$item->quantity}}" title="Qty" class="form-element quantity cart-quantity" size="4">
                                            <br/>
                                            <p class="cart-warning" id="cart-warning_{{$item->id}}" style ="color:red; display: none;">Quantity exceeds stock! Set to Max.</p>
                                        </td>

                                        <td class="product-subtotal">
                                            @if(isset($item->itemSales[0]) && !empty($item->itemSales[0]))
                                                <span class="amount cart-amount" id="cart-amount_{{$item->id}}" data-total = "{{$item->itemSales[0]['price'] * $item->quantity}}">£
                                                    {{$item->itemSales[0]['price'] * $item->quantity}}
                                                </span>
                                            @else
                                                <span class="amount cart-amount" id="cart-amount_{{$item->id}}" data-total = "{{$item->price * $item->quantity}}">£
                                                    {{$item->price * $item->quantity}}
                                                </span>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row flex boxes">
                {{--<div class="column width-6">--}}
                    {{--<div class="cart-totals box xlarge bkg-grey-ultralight">--}}
                        {{--<h5 class="mb-30 color-black">Payment Options</h5>--}}
                        {{--<img src="/images/stripe-payment-icon.png" alt="stripe-accepted-cards" width="500px">--}}
                        {{--<p>--}}
                            {{--All transactions are secure and encrypted.--}}
                        {{--</p>--}}

                        {{--<img src = "/images/powered_by_stripe.svg" alt = "powered by stripe">--}}
                        {{--<p><small><em>Pay with credit card</em></small></p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="column offset-6 width-6">
                    <div class="cart-totals box xlarge bkg-grey-ultralight">
                        <h5 class="mb-30 color-black">Cart Totals</h5>
                        <table class="table non-responsive">
                            <tbody>
                                <tr class="cart-subtotal">
                                    <th>Subtotal</th>
                                    <td><span class="amount" id="cart-subtotal" data-price="{{$items->totalPrice}}">£ {{$items->totalPrice}}</span></td>
                                </tr>
                                <tr class="cart-order-total">
                                    <th>Total</th>
                                    <td><span class="amount" id="cart-total" data-price="{{$items->totalPrice}}">£ {{$items->totalPrice}}</span></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="cart-actions right clear-float-on-mobile left-on-mobile">
                            <a href="/checkout" class="button pill checkout no-margin-bottom fade-location">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart Overview End -->
    </div>
    <!-- Content End -->
@stop