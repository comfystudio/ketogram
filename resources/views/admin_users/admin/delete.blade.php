@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
        <!-- Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Admin Users</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="/admin/admin-users/">Admin User</a></li>
                            <li>Delete</li>
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
                <h2>Delete '{{$admin['username']}}'</h2>
            </div>
            <!-- END General Elements Title -->
            <!-- General Elements Content -->
            <div class="alert alert-danger alert-dismissable">
                <h4><strong>Warning</strong></h4>
                <p>Please note that this will remove this admin user. You can add them again at a later time.</p>
            </div>
            <form action="/admin/admin-users/delete/{{$admin['id']}}" method="post" class="form-horizontal form-bordered">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="col-md-9">
                        <p class="form-control-static">You are removing: <strong>{{$admin['username']}}</strong></p>
                    </div>
                </div>
                <div class="form-group form-actions">
                    <div class="col-md-5">
                        <input type="submit" name="delete" class="btn btn-effect-ripple btn-primary loader" value="Delete">
                        <a href = "{{ URL::previous() }}" type="submit" name="cancel" class="btn btn-effect-ripple btn-danger loader" value="Cancel">Cancel</a>
                    </div>
                </div>
            </form>
            <!-- END General Elements Content -->
        </div>
        <!-- END General Elements Block -->
    </div>
    <!-- END Page Content -->
@stop