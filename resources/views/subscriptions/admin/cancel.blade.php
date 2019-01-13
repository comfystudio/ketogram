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
                            <li>Cancel</li>
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
                <h2>Cancel Subscription '{{$subscriptions['User']['name']}}'</h2>
            </div>
            <!-- END General Elements Title -->
            <!-- General Elements Content -->
            <div class="alert alert-danger alert-dismissable">
                <h4><strong>Warning</strong></h4>
                <p>Please note that this will cancel this Subscription. The user will be emailed and refunded.</p>
            </div>
            <form action="/admin/subscriptions/cancel/{{$subscriptions['id']}}" method="post" class="form-horizontal form-bordered">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="col-md-9">
                        <p class="form-control-static">You are cancelling: <strong>{{$subscriptions['User']['name']}}</strong></p>
                    </div>
                </div>
                <div class="form-group form-actions">
                    <div class="col-md-5">
                        <input type="submit" name="delete" class="btn btn-effect-ripple btn-primary loader" value="Cancel Subscription">
                        <a href = "{{ URL::previous() }}" type="submit" name="cancel" class="btn btn-effect-ripple btn-danger loader" value="Cancel">Back</a>
                    </div>
                </div>
            </form>
            <!-- END General Elements Content -->
        </div>
        <!-- END General Elements Block -->
    </div>
    <!-- END Page Content -->
@stop