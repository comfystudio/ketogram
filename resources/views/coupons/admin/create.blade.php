@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
        <!-- Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Coupon</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="/admin/coupons/">Coupon</a></li>
                            <li>@if(isset($coupons)) Edit @else Add @endif</li>
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
                <h2>@if(isset($data)) Edit @else Add @endif Coupon</h2>
            </div>
            <!-- END General Elements Title -->
            @include('partials.admin.error-form')

            @include('partials.admin.success')
            <!-- General Elements Content -->
            <form action="/admin/coupons/{{isset($coupons) ? 'edit/'.$coupons->id : 'create'}}" method="POST" class="form-horizontal form-bordered">
                {{ csrf_field() }}


                <div class="form-group">
                    <label class="col-md-2 control-label" for="user_id">Select User</label>
                    <div class="col-md-5">
                        <select class="select-chosen" name="user_id" data-placeholder="Please Select User...">
                            <option value="0">All Users</option>
                            @foreach($users as $key => $user)
                                <option value="{{$key}}"
                                    @if(old('user_id') && old('user_id') == $key)
                                        selected = "selected"
                                    @elseif(isset($coupons['user_id']) && $coupons['user_id'] == $key)
                                        selected = "selected"
                                    @endif
                                >
                                    {{$user}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group @if($errors->has('user_email')) error @endif">
                    <label class="col-md-2 control-label" for="user_email">User Email</label>
                    <div class="col-md-5">
                        <input type="email" id="user_email" name="user_email" class="form-control" value="@if(old('user_email')){{old('user_email')}} @elseif(isset($coupons->user_email)){{$coupons->user_email}}@endif">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="referrer_id">Select Referrer</label>
                    <div class="col-md-5">
                        <select class="select-chosen" name="referrer_id" data-placeholder="Please Select Referrer...">
                                <option value="0">No Referrer</option>
                            @foreach($users as $key => $user)
                                <option value="{{$key}}"
                                    @if(old('referrer_id') && old('referrer_id') == $key)
                                        selected = "selected"
                                    @elseif(isset($coupons['referrer_id']) && $coupons['referrer_id'] == $key)
                                        selected = "selected"
                                    @endif
                                >
                                    {{$user}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group @if($errors->has('valid_from')) error @endif">
                    <label class="col-md-2 control-label" for="date">Valid From <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="valid_from" name="valid_from" class="form-control input-datepicker" data-date-format="yyyy-mm-dd"  placeholder="yyyy-mm-dd" value="@if(old('valid_from')){{old('valid_from')}} @elseif(isset($coupons->valid_from)){{$coupons->valid_from}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('valid_to')) error @endif">
                    <label class="col-md-2 control-label" for="date">Valid To <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="valid_to" name="valid_to" class="form-control input-datepicker" data-date-format="yyyy-mm-dd"  placeholder="yyyy-mm-dd" value="@if(old('valid_to')){{old('valid_to')}} @elseif(isset($coupons->valid_to)){{$coupons->valid_to}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('count')) error @endif">
                    <label class="col-md-2 control-label" for="user_email">Count <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="count" name="count" class="form-control" value="@if(old('count')){{old('count')}} @elseif(isset($coupons->count)){{$coupons->count}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('percentage')) error @endif">
                    <label class="col-md-2 control-label" for="user_email">Percentage Discount <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="percentage" name="percentage" class="form-control" value="@if(old('percentage')){{old('percentage')}} @elseif(isset($coupons->percentage)){{$coupons->percentage}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('code')) error @endif">
                    <label class="col-md-2 control-label" for="code">Discount Code <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="code" name="code" class="form-control" value="@if(old('code')){{old('code')}} @elseif(isset($coupons->code)){{$coupons->code}}@endif">
                    </div>
                    <div class="col-md-1">
                        <span id="code_result"></span>
                    </div>
                    <div class="col-md-1">
                        <div class="checkbox">
                            <label for="generate_code">
                               <input type="checkbox" id="generate_code" name="generate_code" value="1" /> Generate
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div id="generated_code"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="is_subscription">Only for subscriptions?</label>
                    <input type="hidden" name="is_subscription" value="0">
                    <div class="col-md-5">
                        <div class="checkbox">
                            <label for="is_subscription" class="switch switch-primary"><input type="checkbox" name="is_subscription" id="is_subscription" value="1" @if((old('is_subscription') && old('is_subscription') != 0)  || (isset($coupons->is_subscription) && $coupons->is_subscription != 0) || (!isset($coupons->id))) checked = "checked" @endif><span></span></label>
                        </div>
                    </div>
                </div>

                <div class="form-group form-actions">
                    <div class="col-md-5 col-md-offset-2">
                        <input type="submit" name="save" class="btn btn-effect-ripple btn-primary loader" value="@if(isset($coupons)) Update @else Save @endif">
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