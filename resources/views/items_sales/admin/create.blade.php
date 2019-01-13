@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
        <!-- Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Items Sales</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="/admin/items/edit/{{$items->id}}">Items Sales</a></li>
                            <li>Add</li>
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
                <h2>Add Items Sales</h2>
            </div>
            <!-- END General Elements Title -->
            @include('partials.admin.error-form')

            @include('partials.admin.success')
            <!-- General Elements Content -->
            <form action="/admin/items-sales/create/{{$items->id}}" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input type = "hidden" name="item_id" value="{{$items->id}}">

                <div class="form-group @if($errors->has('price')) error @endif">
                    <label class="col-md-2 control-label" for="name">Item Sale Price (Normal Price £{{$items->price}} )<span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="price" name="price" class="form-control" value="@if(old('price')){{old('price')}} @elseif(isset($sale->price)){{$sale->price}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('valid_from')) error @endif">
                    <label class="col-md-2 control-label" for="date">Sale Valid From<span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="valid_from" name="valid_from" class="form-control input-datepicker" data-date-format="yyyy-mm-dd"  placeholder="yyyy-mm-dd" value="@if(old('valid_from')){{old('valid_from')}} @elseif(isset($sale->valid_from)){{$sale->valid_from}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('valid_to')) error @endif">
                    <label class="col-md-2 control-label" for="date">Sale Valid To<span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="valid_to" name="valid_to" class="form-control input-datepicker" data-date-format="yyyy-mm-dd"  placeholder="yyyy-mm-dd" value="@if(old('valid_to')){{old('valid_to')}} @elseif(isset($sale->valid_to)){{$sale->valid_to}}@endif">
                    </div>
                </div>

                <div class="form-group form-actions">
                    <div class="col-md-5 col-md-offset-2">
                        <input type="submit" name="save" class="btn btn-effect-ripple btn-primary loader" value="Save">
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