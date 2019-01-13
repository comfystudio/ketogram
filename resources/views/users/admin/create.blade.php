@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
        <!-- Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Users</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="/admin/users/">Users</a></li>
                            <li>@if(isset($user)) Edit @else Add @endif</li>
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
                <h2>@if(isset($user)) Edit @else Add @endif Users</h2>
            </div>
            <!-- END General Elements Title -->
            @include('partials.admin.error-form')

            @include('partials.admin.success')
            <!-- General Elements Content -->
            <form action="/admin/users/{{isset($user) ? 'edit/'.$user->id : 'create'}}" method="POST" class="form-horizontal form-bordered">
                {{ csrf_field() }}

                <div class="form-group @if($errors->has('name')) error @endif">
                    <label class="col-md-2 control-label" for="name">Username <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="name" name="name" class="form-control" value="@if(old('name')){{old('name')}} @elseif(isset($user->name)){{$user->name}}@endif">
                    </div>
                </div>
                <div class="form-group @if($errors->has('email')) error @endif">
                    <label class="col-md-2 control-label" for="email">Email <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="email" id="email" name="email" class="form-control" value="@if(old('email')){{old('email')}} @elseif(isset($user->email)){{$user->email}}@endif">
                    </div>
                </div>
                 <div class="form-group @if($errors->has('password')) error @endif">
                    <label class="col-md-2 control-label" for="password">Password <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="password" id="password" name="password" class="form-control">
                        {{--<span class = "help-block">Note: Password must contain at least one number, one uppercase letter and atleast 8 characters.</span>--}}
                    </div>
                    <div class="col-md-1">
                        <span id="password_result"></span>
                    </div>
                    <div class="col-md-1">
                        <div class="checkbox">
                            <label for="generate_password">
                               <input type="checkbox" id="generate_password" name="generate_password" value="1" /> Generate
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div id="generated_password"></div>
                    </div>
                </div>
                <div class="form-group @if($errors->has('confirm_password')) error @endif">
                    <label class="col-md-2 control-label" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                    </div>
                </div>

                <div class="form-group form-actions">
                    <div class="col-md-5 col-md-offset-2">
                        <input type="submit" name="save" class="btn btn-effect-ripple btn-primary loader" value="@if(isset($user)) Update @else Save @endif">
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