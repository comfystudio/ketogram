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
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">Edit Custom Subscription</h1>
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

                    <div class = "row" id="custom-edit-error" style="display: none;">
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul>
                                <li>Box Capacity limit reached</li>
                            </ul>
                        </div>
                    </div>

                    <div class = "row" id="custom-edit-add" style="display: none;">
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul>
                                <li>Add More Items</li>
                            </ul>
                        </div>
                    </div>
                </div>



                <form action="/subscriptions/edit/{{$subscriptions->id}}" method="POST" class="form-horizontal form-bordered">
                    <input type="hidden" id="first_price" value="@if(isset($subscriptions['totalPrice'])){{$subscriptions['totalPrice']}}@else 0 @endif" name="first_price">
                    {{ csrf_field() }}

                    <div class = "row pb-20">
                        <div class="row center">
                            <div class="column width-3 offset-3">
                                <input id="custom-edit-submit" type="submit" value="Update" name="action" class="button-blue" style="@if($subscriptions['totalPrice'] < 20){{'visibility:hidden;'}}@endif">
                            </div>
                            <div class="column width-3">
                                <a href = "{{ URL::previous() }}" type="submit" name="cancel" class="form-submit button button-orange" value="Cancel">Back</a>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Orders -->
                    <div class="column width-12">
                        {{--<h3 class="widget-title widget-title-long">Items</h3>--}}
                        <div class="cart-review">
                            <table class="table non-responsive">
                                <thead>
                                    <tr>
                                        <th class="product-name">#</th>
                                        <th class="product-name">Item</th>
                                        <th class="product-name">Image</th>
                                        <th class="product-subtotal">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i = 1;?>
                                    @foreach($subscriptions['Item'] as $key2 => $item_id)
                                        <tr class = "cart-item">
                                            <td class = "product-name">
                                                <a class="product-title">{{$i}}</a>
                                            </td>

                                            <td>
                                                <div class="column width-10 centre" id="item_{{$i}}">
                                                    <select class="select-chosen form-control" name="items[{{$i}}]" id="items[{{$i}}]" data-placeholder="Please Select Item..." style="width:50%;" data-id="{{$i}}" @if($subscriptions['totalPrice'] > 20){{'disabled'}}@endif>
                                                    <option value="0">-- Please Select Item --</option>
                                                        @foreach($items as $item)
                                                            <option value="{{$item->id}}" data-price="{{$item->price}}" @if(isset($item->itemImages[0])) data-img-src="/{{$item->itemImages[0]['image']}}" @endif
                                                                @if(old('items.'.$i) && ($item->id == old('items.'.$i)))
                                                                    selected = "selected"
                                                                @elseif(isset($subscriptions['Item']) && $item->id == $item_id['id'])
                                                                    selected = "selected"
                                                                @endif
                                                            >
                                                                {{$item->title}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="items[{{$i}}]" id="items-hidden-{{$i}}" value="{{$item_id['id']}}" />

                                                </div>
                                            </td>

                                            <td id="custom-edit-image_{{$i}}">
                                                @if(isset($item_id['ItemImages'][0]))
                                                    <img src="/{{$item_id['ItemImages'][0]['image']}}" alt="{{$item_id['ItemImages'][0]['title']}}" width="96">
                                                @endif
                                            </td>

                                            <td class="custom-remove-edit center">
                                                <a data-toggle="tooltip" id= "remove-item_{{$i}}" title="Remove Item" class="custom-edit-remove icon-cancel" data-id="{{$i}}"></a>
                                            </td>

                                        <?php $i++;?>
                                        </tr>
                                    @endforeach

                                    @for ($i; $i <= 10; $i++)
                                        <tr class = "cart-item">
                                            <td class = "product-name">
                                                <a class="product-title">{{$i}}</a>
                                            </td>

                                            <td>
                                                <div class="column width-10" id="item_{{$i}}">
                                                    <select class="select-chosen form-control" name="items[{{$i}}]" id="items[{{$i}}]" data-placeholder="Please Select Item..." style="width:50%;" data-id="{{$i}}" @if($subscriptions['totalPrice'] > 20){{'disabled'}}@endif>
                                                    <option value="0" selected>-- Please Select Item --</option>
                                                        @foreach($items as $key => $item)
                                                            <option value="{{$item->id}}" data-price="{{$item->price}}" @if(isset($item->itemImages[0])) data-img-src="/{{$item->itemImages[0]['image']}}" @endif>
                                                                {{$item->title}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="items[{{$i}}]" id="items-hidden-{{$i}}" value="" />
                                                </div>
                                            </td>

                                            <td id="custom-edit-image_{{$i}}">
                                                <img src="" alt="" width="96">
                                            </td>

                                            <td class="custom-remove-edit center">
                                                <a data-toggle="tooltip" id= "remove-item_{{$i}}" title="Remove Item" class="custom-edit-remove icon-cancel" data-id="{{$i}}"></a>
                                            </td>

                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Pending Orders END -->
                </form>
            </div>
        </div>
        <!-- Cart Overview End -->
    </div>
    <!-- Content End -->
@stop