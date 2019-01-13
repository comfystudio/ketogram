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
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">Update Delivery Address</h1>
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

                <div class="column width-10 offset-1">
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
                                            <form id="checkout-form" class="billing-form" action="{{url('/subscriptions/address').'/'.$subscriptions->id}}" method="post" novalidate>
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="column width-12 {{ $errors->has('address_1') ? ' has-error' : '' }}">
                                                        <input type="text" name="address_1" value="@if(old('address_1')){{old('address_1')}} @elseif(isset($subscriptions->address_1)){{$subscriptions->address_1}}@endif" class="form-billing-address form-element large" placeholder="Billing Address*" tabindex="6" required>
                                                    </div>
                                                    <div class="column width-12 {{ $errors->has('address_2') ? ' has-error' : '' }}">
                                                        <input type="text" name="address_2" value="@if(old('address_2')){{old('address_2')}} @elseif(isset($subscriptions->address_2)){{$subscriptions->address_2}}@endif" class="form-billing-address-2 form-element large" placeholder="Billing Address 2*" tabindex="7" required>
                                                    </div>
                                                    <div class="column width-6 {{ $errors->has('town') ? ' has-error' : '' }}">
                                                        <input type="text" name="town" value="@if(old('town')){{old('town')}} @elseif(isset($subscriptions->town)){{$subscriptions->town}}@endif" class="form-city form-element large" placeholder="Town*" tabindex="8" required>
                                                    </div>
                                                    <div class="column width-6 {{ $errors->has('county') ? ' has-error' : '' }}">
                                                        <input type="text" name="county" value="@if(old('county')){{old('county')}} @elseif(isset($subscriptions->county)){{$subscriptions->county}}@endif" class="form-city form-element large" placeholder="County*" tabindex="8" required>
                                                    </div>
                                                    <div class="column width-6 {{ $errors->has('postcode') ? ' has-error' : '' }}">
                                                        <input type="text" name="postcode" value="@if(old('postcode')){{old('postcode')}} @elseif(isset($subscriptions->postcode)){{$subscriptions->postcode}}@endif" class="form-zip-code form-element large" placeholder="Zip Code / Postcode*" tabindex="9" required>
                                                    </div>
                                                    <div class="column width-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                        <input type="text" name="phone" value="@if(old('phone')){{old('phone')}} @elseif(isset($subscriptions->phone)){{$subscriptions->phone}}@endif" class="form-zip-code form-element large" placeholder="Phone Number" tabindex="9">
                                                    </div>
                                                    <div class="column width-12 {{ $errors->has('country') ? ' has-error' : '' }}">
                                                        <div class="form-select form-element large">
                                                            <select name="country" id = "checkout-select-country" required tabindex="5">
                                                                <option value="United Kingdom" selected>United Kingdom</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="column width-12 center">
                                                        <input type="submit" value="Update" name="action" class="button pill checkout no-margin-bottom">
                                                        <a href = "{{ URL::previous() }}" type="submit" name="cancel" class="button pill checkout no-margin-bottom button-orange" value="Cancel">Back</a>
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