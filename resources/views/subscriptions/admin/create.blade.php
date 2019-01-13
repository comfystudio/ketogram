@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
        <!-- Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Subscription</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="/admin/subscriptions/">Subscription</a></li>
                            <li>@if(isset($subscriptions)) Edit @else Add @endif</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Header -->
        <!-- General Elements Block -->
        <div class="block">
            <!-- General Elements Title -->
            <div class="block-title">
                <h2>@if(isset($subscriptions)) Edit @else Add @endif Subscription</h2>
            </div>
            <!-- END General Elements Title -->
            @include('partials.admin.error-form')

            @include('partials.admin.success')
            <!-- General Elements Content -->
            <form action="/admin/subscriptions/{{isset($subscriptions) ? 'edit/'.$subscriptions->id : 'create'}}" method="POST" class="form-horizontal form-bordered">
                {{ csrf_field() }}

                <div class="form-group">
                    <label class="col-md-2 control-label" for="is_custom">Is Custom?</label>
                    <input type="hidden" name="is_custom" value="0">
                    <div class="col-md-5">
                        <div class="checkbox">
                            <label for="is_custom" class="switch switch-primary"><input type="checkbox" name="is_custom" id="is_custom" value="1" @if((old('is_custom') && old('is_custom') != 0)  || (isset($subscriptions->is_custom) && $subscriptions->is_custom != 0) || (!isset($subscriptions->id))) checked = "checked" @endif><span></span></label>
                        </div>
                    </div>
                </div>

                <?php $i = 1;?>
                @foreach($subscriptions['Item'] as $key2 => $item_id)
                    <div class="form-group" id= "item-group_{{$i}}" @if($subscriptions['is_custom'] != 1) style="display:none;" @endif>
                        <label class="col-md-2 control-label" for="item_ids">Item {{$i}}</label>
                        <div class="col-md-5">
                            <select class="select-chosen form-control" id="items[{{$i}}]" name="items[{{$i}}]" data-placeholder="Please Select Item...">
                            <option value="0">-- Please Select Item --</option>
                                @foreach($items as $key => $item)
                                    <option value="{{$key}}"
                                        @if(old('items.'.$i) && ($key == old('items.'.$i)))
                                            selected = "selected"
                                        @elseif(isset($subscriptions['Item']) && $key == $item_id['id'])
                                            selected = "selected"
                                        @endif
                                    >
                                        {{$item}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <a data-toggle="tooltip" id= "remove-item_{{$i}}" title="Remove Item" class="btn btn-effect-ripple btn-sm btn-danger remove-item" data-id="{{$i}}"><i class="fa fa-times"></i></a>

                    </div>
                    <?php $i++;?>
                @endforeach

                @if($i <= 10)
                    <div class="form-group" @if($subscriptions['is_custom'] != 1) style="display:none;" @endif>
                        <a href="#sub-add-item" class="btn btn-block btn-info" id="sub-add-item" data-id="{{$i}}"><i class="fa fa-plus"></i> Add Another Item</a>
                    </div>
                @endif

                <div class="form-group @if($errors->has('address_1')) error @endif">
                    <label class="col-md-2 control-label" for="address_1">Address 1 <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="address_1" name="address_1" class="form-control" value="@if(old('address_1')){{old('address_1')}} @elseif(isset($subscriptions->address_1)){{$subscriptions->address_1}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('address_2')) error @endif">
                    <label class="col-md-2 control-label" for="address_2">Address 2</label>
                    <div class="col-md-5">
                        <input type="text" id="address_2" name="address_2" class="form-control" value="@if(old('address_2')){{old('address_2')}} @elseif(isset($subscriptions->address_2)){{$subscriptions->address_2}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('town')) error @endif">
                    <label class="col-md-2 control-label" for="town">Town</label>
                    <div class="col-md-5">
                        <input type="text" id="town" name="town" class="form-control" value="@if(old('town')){{old('town')}} @elseif(isset($subscriptions->town)){{$subscriptions->town}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('county')) error @endif">
                    <label class="col-md-2 control-label" for="county">County</label>
                    <div class="col-md-5">
                        <input type="text" id="county" name="county" class="form-control" value="@if(old('county')){{old('county')}} @elseif(isset($subscriptions->county)){{$subscriptions->county}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('postcode')) error @endif">
                    <label class="col-md-2 control-label" for="postcode">Postcode <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="postcode" name="postcode" class="form-control" value="@if(old('postcode')){{old('postcode')}} @elseif(isset($subscriptions->postcode)){{$subscriptions->postcode}}@endif">
                    </div>
                </div>

                <div class="form-group form-actions">
                    <div class="col-md-5 col-md-offset-2">
                        <input type="submit" name="save" class="btn btn-effect-ripple btn-primary loader" value="@if(isset($subscriptions)) Update @else Save @endif">
                        <a href = "{{ URL::previous() }}" type="submit" name="cancel" class="btn btn-effect-ripple btn-danger loader">Cancel</a>
                    </div>
                </div>
            </form>
            <!-- END General Elements Content -->
        </div>
        <!-- END General Elements Block -->
    </div>
    <!-- END Page Content -->
@stop