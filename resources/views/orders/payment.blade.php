@extends('layouts/layout')

@section('content')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<!-- Content -->
    <div class="content clearfix">

        <!-- Intro Title Section 2 -->
        <div class="section-block background-aqua pt-100 pb-50">
            <div class="media-overlay"></div>
            <div class="row">
                <div class="column width-12">
                    <div class="title-container">
                        <div class="title-container-inner">
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">Payment</h1>
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

                    <div id="payment_errors" class="alert alert-danger alert-dismissable" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>
                            <strong>Failure</strong>
                        </h4>
                        <p class = "">
                            <ul>
                                <li>
                                    <span class="payment-errors"></span>
                                </li>
                            </ul>
                        </p>
                    </div>
                </div>

                <div class="column width-6">
                    <div class="cart-totals box xlarge bkg-grey-ultralight">
                        <h5 class="mb-30 color-black">Payment Options</h5>
                        {{--<img src="/images/stripe-payment-icon.png" alt="stripe-accepted-cards" width="500px">--}}
                        <p>
                            All transactions are secure and encrypted.
                        </p>

                        <p>
                            <a href="{{url('/terms')}}" alt="terms" target="_blank" class="link">Terms and Conditions</a>
                        </p>

                        <p>
                            <a href="{{url('/privacy')}}" alt="about" target="_blank" class="link">Our Privacy Policy</a>
                        </p>

                        {{--<p>--}}
                            {{--<a href="{{url('/faqs')}}" alt="about" target="_blank" class="link">FaQs</a>--}}
                        {{--</p>--}}

                        <p>
                            <a href="{{url('/about')}}" alt="about" target="_blank" class="link">About Ketogram</a>
                        </p>

                        <img src = "/images/powered_by_stripe.svg" alt = "powered by stripe">
                        <p><small><em>Pay with credit card</em></small></p>
                    </div>
                </div>

                <div class="column width-6">
                    <div class="payment-details box large">
                        {{--<div class="tabs style-2">--}}
                            {{--<ul class="tab-nav">--}}
                                {{--<li class="active">--}}
                                    {{--<a href="#tabs-1-pane-1">Billing Address</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                            {{--<div class="tab-panes">--}}
                                <div id="tabs-1-pane-1" class="active animate">
                                    <div class="tab-content">
                                        <div class="billing-form-container">
                                            <form action="/payment-create" method="POST" id="payment-form">
                                                {{ csrf_field() }}
                                                <input type = "hidden" data-stripe="email" name = "stripeEmail" value = "{{$user[0]->email}}">
                                                <input type = "hidden" name = "order_id" value = "{{$order->id}}">

                                                <div class="column width-12">
                                                    <input class="form-billing-address form-element large" type="text" size="20" data-stripe="number" id="card_number" placeholder="Card Number" value=""  />
                                                </div>

                                                {{--<div class = "row">--}}

                                                <div class="column width-4">
                                                    <label for="expiry" class = "large form-element label">Expiry:</label>
                                                </div>

                                                <div class="column width-4">
                                                    <input class="form-billing-address form-element large"  size="2" data-stripe="exp-month" id="expiry_month" class="month" placeholder="MM" value=""  />
                                                </div><!-- end form_item -->

                                                <div class="column width-4">
                                                    <input class="form-billing-address form-element large" size="4" data-stripe="exp-year" id="expiry_year" class="year" placeholder="YYYY" value=""  />
                                                </div>

                                                <div class="column width-6 pull-right">
                                                    <input class="form-billing-address form-element large" type="text" size="4" data-stripe="cvc" id="cvc" placeholder="CVC" value=""  />
                                                </div><!-- end form_item -->
                                                {{--</div>--}}
                                                <div class="clear"></div>

                                                <div class = "row">

                                                    <div class="column width-12 center">
                                                        <input id="checkout-pay-button" type="submit" value="Pay £{{$totalPrice}}" class="form-submit button border-theme bkg-hover-theme button-blue">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
            <!-- Checkout End -->
        </div>
        <!-- Order Overview End -->
    </div>
@stop