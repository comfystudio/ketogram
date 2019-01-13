@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
        <!-- Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Category</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="/admin/categories/">Category</a></li>
                            <li>@if(isset($categories)) Edit @else Add @endif</li>
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
                <h2>@if(isset($data)) Edit @else Add @endif Category</h2>
            </div>
            <!-- END General Elements Title -->
            @include('partials.admin.error-form')

            @include('partials.admin.success')
            <!-- General Elements Content -->
            <form action="/admin/categories/{{isset($categories) ? 'edit/'.$categories->id : 'create'}}" method="POST" class="form-horizontal form-bordered">
                {{ csrf_field() }}

                <div class="form-group @if($errors->has('name')) error @endif">
                    <label class="col-md-2 control-label" for="name">Name <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="name" name="name" class="form-control" value="@if(old('name')){{old('name')}} @elseif(isset($categories->name)){{$categories->name}}@endif">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="is_active">Is Active</label>
                    <input type="hidden" name="is_active" value="0">
                    <div class="col-md-5">
                        <div class="checkbox">
                            <label for="is_active" class="switch switch-primary"><input type="checkbox" name="is_active" id="is_active" value="1" @if((old('is_active') && old('is_active') != 0)  || (isset($categories->is_active) && $categories->is_active != 0) || (!isset($categories->id))) checked = "checked" @endif><span></span></label>
                        </div>
                    </div>
                </div>

                <div class="form-group form-actions">
                    <div class="col-md-5 col-md-offset-2">
                        <input type="submit" name="save" class="btn btn-effect-ripple btn-primary loader" value="@if(isset($categories)) Update @else Save @endif">
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