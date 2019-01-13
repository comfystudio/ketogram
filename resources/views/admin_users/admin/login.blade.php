@extends('layouts.login')

@section('content')
    <div id="login-container">
        <!-- Login Header -->
        <h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
            <strong>Welcome to {{SITE_NAME}}</strong>
        </h1>
        <!-- END Login Header -->

        <!-- Login Block -->
        <div class="block animation-fadeInQuickInv">
            <!-- Login Title -->
            <div class="block-title">
                <div class="block-options pull-right">

                </div>
                <h2>Please Login</h2>
            </div>
            @include('partials.admin.error')

            @include('partials.admin.success')

            <!-- Login Form -->
            <form id="form-login" action="{{ url('/admin/login/') }}" method="POST" class="form-horizontal" role = "form">
                {{ csrf_field() }}
                <div class="form-group @if($errors->has('username')) error @endif">
                    <div class="col-xs-12">
                        <input type="text" id="login-email" name="username" class="form-control" placeholder="Username">
                    </div>
                </div>
                <div class="form-group @if($errors->has('password')) error @endif">
                    <div class="col-xs-12">
                        <input type="password" id="login-password" name="password" class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="form-group form-actions">
                    <div class="col-xs-4 text-left">
                        <button name= "submit" type="submit" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-check"></i> Login</button>
                    </div>
                </div>
            </form>
            <!-- END Login Form -->
        </div>
        <!-- END Login Block -->
    </div>
@stop