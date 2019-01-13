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
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">Subscriptions</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Intro Title Section 2 End -->

        <!-- Cart Overview -->
        <div class="section-block cart-overview pt-20">
            <div class="row">
                <div class="column width-8 offset-2 pb-20">
                    @include('partials.admin.error-form')

                    @include('partials.admin.success-form')
                </div>

                <!-- Pending Orders -->
                <div class="column width-12">
                    <h3 class="widget-title widget-title-long">Current Subscriptions</h3>
                    <div class="cart-review">
                        <table class="table non-responsive subscription-index">
                            <thead>
                                <tr>
                                    {{--<th class="product-remove"></th>--}}
                                    {{--<th class="product-thumbnail"></th>--}}
                                    <th class="product-name">Address</th>
                                    <th class="product-price">Standard / Custom</th>
                                    <th class="product-subtotal">Subscription Start Date</th>
                                    <th class="product-actions text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscriptions as $sub)
                                    <tr class="cart-item">
                                        <td>
                                            {{$sub->address_1}}<br/>
                                            {{$sub->address_2}}<br/>
                                            {{$sub->town}}<br/>
                                            {{$sub->county}}<br/>
                                            {{$sub->postcode}}
                                        </td>

                                        <td>
                                            @if($sub->is_custom)
                                                Custom Subscription
                                            @else
                                                Standard Subscription
                                            @endif
                                        </td>


                                        <td class="center product-subtotal">{{date("F j, Y", strtotime($sub->last_payment))}}</td>
                                        <td class="center">
                                            <a href="/subscriptions/address/{{$sub->id}}" data-toggle="tooltip" title="Change Delivery Address" class="btn btn-effect-ripple btn-sm btn-danger button pill front-button">Edit Address</a><br/>

                                            @if($sub->is_custom)
                                                {{--<a href="/subscriptions/edit/{{$sub->id}}" data-toggle="tooltip" title="Edit Custom Subscription" class="btn btn-effect-ripple btn-sm btn-danger button pill front-button"> Edit Custom Subscription</a><br/>--}}
                                                <a href="/subscriptions/standard/{{$sub->id}}" data-toggle="tooltip" title="Switch To Standard Subscription" class="btn btn-effect-ripple btn-sm btn-danger button pill front-button">Switch To Standard Sub</a><br/>
                                            @else
                                                {{--<a href="/subscriptions/custom/{{$sub->id}}" data-toggle="tooltip" title="Switch To Custom Subscription" class="btn btn-effect-ripple btn-sm btn-danger button pill front-button">Switch To Custom Sub</a><br/>--}}
                                            @endif

                                            <a href="/subscriptions/cancel/{{$sub->id}}" data-toggle="tooltip" title="Cancel Subscription" class="btn btn-effect-ripple btn-sm btn-danger button pill front-button"> Cancel Subscription</a>

                                            <a href="/subscriptions/update/{{$sub->id}}" data-toggle="tooltip" title="Update Card" class="btn btn-effect-ripple btn-sm btn-danger button pill front-button" style="margin-left: 0;">Update Payment Card</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pending Orders END -->

                <!-- Cancelled -->
                <div class="column width-12 pt-50">
                    <h3 class="widget-title widget-title-long">Cancelled Subscriptions</h3>
                    <div class="cart-review">
                        <table class="table non-responsive">
                            <thead>
                                <tr>
                                    {{--<th class="product-remove"></th>--}}
                                    {{--<th class="product-thumbnail"></th>--}}
                                    <th class="product-name">Address</th>
                                    <th class="product-price">Standard / Custom</th>
                                    <th class="product-subtotal">Subscription Start Date</th>
                                    <th class="product-subtotal">Subscription End Date</th>
                                    {{--<th class="product-subtotal">Actions</th>--}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cancelledsubscriptions as $sub)
                                    <tr class="cart-item">
                                        <td>
                                            {{$sub->address_1}}<br/>
                                            {{$sub->address_2}}<br/>
                                            {{$sub->town}}<br/>
                                            {{$sub->county}}<br/>
                                            {{$sub->postcode}}
                                        </td>

                                        <td>
                                            {{--@foreach($sub->Item as $item)--}}
                                                {{--<a href = "/items/{{$item->id}}">{{$item->title}}</a><br/>--}}
                                            {{--@endforeach--}}
                                            @if($sub->is_custom)
                                                Custom Subscription
                                            @else
                                                Standard Subscription
                                            @endif

                                        </td>


                                        <td class="center">{{date("F j, Y", strtotime($sub->last_payment))}}</td>
                                        <td class="center">{{date("F j, Y", strtotime($sub->updated_at))}}</td>
                                        {{--<td class="center">--}}
                                            {{--<a href="/subscriptions/renew/{{$sub->id}}" data-toggle="tooltip" title="Renew Subscription" class="btn btn-effect-ripple btn-sm btn-danger front-actions"><span style= "font-size: 34px;" class="icon-cycle"></span></a>--}}
                                        {{--</td>--}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Cancelled END -->

                <a name="share-o-metre"></a>
                <div class="column width-12 pt-50">
                <h3 class="widget-title widget-title-long">Ketogram Share-O-Metre</h3>
                    <span class="progress-bar-label">@if($user['subscription_count'] % 10 == 0)1% To your next Thank You Box! @else{{ $user['subscription_count'] % 10}}0% To your next Thank You Box! @endif</span>
                    <div class="progress-bar pill xlarge bkg-grey-ultralight">
                        <div class="bar bkg-theme color-white percent-@if($user['subscription_count'] % 10 == 0)00 @else{{ $user['subscription_count'] % 10}}0 @endif horizon"
                            data-animate-in="transX:-100%;duration:1000ms;easing:easeIn;">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Cart Overview End -->
    </div>
    <!-- Content End -->
@stop