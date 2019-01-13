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
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">Subscription Checkout</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Intro Title Section 2 End -->

        <!-- Checkout -->
        <div class="section-block cart-overview pt-20">
            <div class="row">
                <div class="column width-8 offset-2 pb-20">
                    @include('partials.admin.error-form')

                    @include('partials.admin.success-form')
                </div>

                <div class="column width-5 push-7">
                    <div class="aux-details box large">
                        <div class="accordion product-addtional-info style-2">
                            <ul>
                                <li class="active payment-additional-info">
                                    <a href="#accordion-coupon">Have a Coupon? Click to Enter</a>
                                    <div id="accordion-coupon">
                                        <div class="accordion-content">
                                            <div class="cart-coupon-form-container">
                                                <form class="cart-coupon-form" action="" method="post" id="custom-coupon-form" novalidate>
                                                    <input type="text" id="form-coupon-code" class="form-element" name="coupon" placeholder="Coupon Code">
                                                    <input type="submit" value="Apply" class="form-submit button pill no-margin-bottom">
                                                </form>
                                            </div>
                                            <p id = "checkout-coupon-error" class = "text-center" style = "color:red;font-weight: bold; display: none;">

                                            </p>
                                            <p id = "checkout-coupon-success" class = "text-center" style = "color:green;font-weight: bold; display: none;">

                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h5>Need Assistance?</h5>
                        <p>Experiencing an issue and require help? <a class = "link" href="mailto:hello@ketogram.co.uk">Contact Us</a></p>
                    </div>

                    <div class="aux-details box large">
                        <h5 class="mb-30">Order Overview</h5>
                        <div class="cart-review">
                            <table class="table non-responsive">
                                <thead>
                                    <tr>
                                        <th class="product-name">Product Name</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($custom)
                                        <?php $text = 'Custom Subscription';?>
                                    @else
                                        <?php $text = 'Standard Subscription';?>
                                    @endif

                                    <tr class="cart-item">
                                        <td class="product-name">
                                            <a class="product-title">{{$text}} first month:</a>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount checkout-item" data-price="30" id="custom-first-month">£30</span>
                                        </td>
                                    </tr>

                                    <tr class="cart-item coupon-subtitle" style="display: none;">
                                        <td class="product-name">
                                            <a class="product-title" style="color:green;">Coupon</a>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount" id="cart-coupon" data-price="1" style ="color:green;"></span>
                                        </td>
                                    </tr>

                                    <tr class="cart-item">
                                        <td class="product-name">
                                            <a class="product-title">{{$text}} subsequent months:</a>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount checkout-item" data-price="30">£30</span>
                                        </td>
                                    </tr>

                                    {{--<tr class="cart-order-total">--}}
                                        {{--<th>Total</th>--}}
                                        {{--<td class = "product-subtotal"><span class="amount" id="checkout-total" data-price="{{$items->totalPrice + $items->postage}}">£{{$items->totalPrice + $items->postage}}</span></td>--}}
                                    {{--</tr>--}}
                                </tbody>
                            </table>
                        </div>
                        <div class="checkout-payment">
                            <div class="cart-actions left center-on-mobile pt-20">
                                <a class="button pill checkout no-margin-bottom" id="checkout-button">Subscribe</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="column width-7 pull-5">
                    <div class="payment-details box large">
                        <div class="tabs style-2">
                            <ul class="tab-nav">
                                <li class="active">
                                    <a href="#tabs-1-pane-1">Delivery Address</a>
                                </li>
                            </ul>
                            <div class="tab-panes">
                                <div id="tabs-1-pane-1" class="active animate">
                                    <div class="tab-content">
                                        <div class="billing-form-container">
                                            <form id="checkout-form" class="billing-form" action="{{url('/subscribe-payment')}}" method="post" novalidate>
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <input type="hidden" name="coupon">
                                                    <input type="hidden" name="first_price" value="30">
                                                    <input type="hidden" name="custom" value="{{$custom}}">
                                                    {{--<input type="hidden" name="total" value = "{{$items->totalPrice + $items->postage}}">--}}
                                                    <div class="column width-12 {{ $errors->has('address_1') ? ' has-error' : '' }}">
                                                        <input type="text" name="address_1" value="{{isset($previousOrderAddress[0]) ? $previousOrderAddress[0]->address_1 : old('address_1')}}" class="form-billing-address form-element large" placeholder="Billing Address*" tabindex="6" required>
                                                    </div>
                                                    <div class="column width-12 {{ $errors->has('address_2') ? ' has-error' : '' }}">
                                                        <input type="text" name="address_2" value="{{isset($previousOrderAddress[0]) ? $previousOrderAddress[0]->address_2 : old('address_2')}}" class="form-billing-address-2 form-element large" placeholder="Billing Address 2*" tabindex="7" required>
                                                    </div>
                                                    <div class="column width-6 {{ $errors->has('town') ? ' has-error' : '' }}">
                                                        <input type="text" name="town" value="{{isset($previousOrderAddress[0]) ? $previousOrderAddress[0]->town : old('town')}}" class="form-city form-element large" placeholder="Town*" tabindex="8" required>
                                                    </div>
                                                    <div class="column width-6 {{ $errors->has('county') ? ' has-error' : '' }}">
                                                        <input type="text" name="county" value="{{isset($previousOrderAddress[0]) ? $previousOrderAddress[0]->county : old('county')}}" class="form-city form-element large" placeholder="County*" tabindex="8" required>
                                                    </div>
                                                    <div class="column width-6 {{ $errors->has('postcode') ? ' has-error' : '' }}">
                                                        <input type="text" name="postcode" value="{{isset($previousOrderAddress[0]) ? $previousOrderAddress[0]->postcode : old('postcode')}}" class="form-zip-code form-element large" placeholder="Zip Code / Postcode*" tabindex="9" required>
                                                    </div>
                                                    <div class="column width-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                        <input type="text" name="phone" value="{{isset($previousOrderAddress[0]) ? $previousOrderAddress[0]->phone : old('phone')}}" class="form-zip-code form-element large" placeholder="Phone Number" tabindex="9">
                                                    </div>
                                                    <div class="column width-12 {{ $errors->has('country') ? ' has-error' : '' }}">
                                                        <div class="form-select form-element large">
                                                            <select name="country" id = "checkout-select-country" required tabindex="5">
                                                                <option value="United Kingdom" selected>United Kingdom</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="column width-12">
                    <hr>
                </div>
            </div>
            <!-- Checkout End -->
        </div>
        <!-- Order Overview End -->
    </div>
    <!-- Content End -->
@stop