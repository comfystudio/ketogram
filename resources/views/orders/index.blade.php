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
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">Orders</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Intro Title Section 2 End -->

        <!-- Cart Overview -->
        <div class="section-block cart-overview">
            <div class="row">
                <div class="column width-8 offset-2 pb-20">
                    @include('partials.admin.error-form')

                    @include('partials.admin.success-form')
                </div>

                <!-- Pending Orders -->
                <div class="column width-12">
                    <h3 class="widget-title widget-title-long">Pending Orders</h3>
                    <div class="cart-review">
                        <table class="table non-responsive">
                            <thead>
                                <tr>
                                    {{--<th class="product-remove"></th>--}}
                                    {{--<th class="product-thumbnail"></th>--}}
                                    <th class="product-name">Address</th>
                                    <th class="product-price">Items</th>
                                    <th class="product-quantity">Total</th>
                                    <th class="product-subtotal">Date Ordered</th>
                                    <th class="product-subtotal"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingOrders as $order)
                                    <tr class="cart-item">
                                        <td>
                                            {{$order->address_1}}<br/>
                                            {{$order->address_2}}<br/>
                                            {{$order->town}}<br/>
                                            {{$order->county}}<br/>
                                            {{$order->postcode}}
                                        </td>

                                        <td>
                                            @foreach($order->Item as $item)
                                                <a href = "/items/{{$item->id}}">{{$item->title}}</a><br/>
                                            @endforeach
                                        </td>

                                        <td>£{{$order->total}}</td>

                                        <td class="center">{{date("F j, Y, g:i a", strtotime($order->created_at))}}</td>
                                        <td class="center">
                                            <a href="/orders/cancel/{{$order->id}}/" data-toggle="tooltip" title="Cancel Order" class="btn btn-effect-ripple btn-sm btn-danger"><span style= "font-size: 34px;" class="icon-cancel"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pending Orders END -->

                <!-- Dispatched / Completed -->
                <div class="column width-12">
                    <h3 class="widget-title widget-title-long">Dispatched / Completed Orders</h3>
                    <div class="cart-review">
                        <table class="table non-responsive">
                            <thead>
                                <tr>
                                    {{--<th class="product-remove"></th>--}}
                                    {{--<th class="product-thumbnail"></th>--}}
                                    <th class="product-name">Address</th>
                                    <th class="product-price">Items</th>
                                    <th class="product-quantity">Total</th>
                                    <th class="product-subtotal">Date Ordered</th>
                                    <th class="product-subtotal">Date Dispatched</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dispatchedOrders as $order)
                                    <tr class="cart-item">
                                        <td>
                                            {{$order->address_1}}<br/>
                                            {{$order->address_2}}<br/>
                                            {{$order->town}}<br/>
                                            {{$order->county}}<br/>
                                            {{$order->postcode}}
                                        </td>

                                        <td>
                                            @foreach($order->Item as $item)
                                                <a href = "/items/{{$item->id}}">{{$item->title}}</a><br/>
                                            @endforeach
                                        </td>

                                        <td>£{{$order->total}}</td>

                                        <td class="center">{{date("F j, Y, g:i a", strtotime($order->created_at))}}</td>
                                        <td class="center">{{date("F j, Y, g:i a", strtotime($order->updated_at))}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Dispatched / Completed END -->

                <!-- Cancelled Orders -->
                <div class="column width-12">
                    <h3 class="widget-title widget-title-long">Cancelled Orders</h3>
                    <div class="cart-review">
                        <table class="table non-responsive">
                            <thead>
                                <tr>
                                    {{--<th class="product-remove"></th>--}}
                                    {{--<th class="product-thumbnail"></th>--}}
                                    <th class="product-name">Address</th>
                                    <th class="product-price">Items</th>
                                    <th class="product-quantity">Total</th>
                                    <th class="product-subtotal">Date Ordered</th>
                                    <th class="product-subtotal">Date Cancelled</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cancelledOrders as $order)
                                    <tr class="cart-item">
                                        <td>
                                            {{$order->address_1}}<br/>
                                            {{$order->address_2}}<br/>
                                            {{$order->town}}<br/>
                                            {{$order->county}}<br/>
                                            {{$order->postcode}}
                                        </td>

                                        <td>
                                            @foreach($order->Item as $item)
                                                <a href = "/items/{{$item->id}}">{{$item->title}}</a><br/>
                                            @endforeach
                                        </td>

                                        <td>£{{$order->total}}</td>

                                        <td class="center">{{date("F j, Y, g:i a", strtotime($order->created_at))}}</td>
                                        <td class="center">{{date("F j, Y, g:i a", strtotime($order->updated_at))}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Cancelled Orders END -->

            </div>
        </div>
        <!-- Cart Overview End -->
    </div>
    <!-- Content End -->
@stop