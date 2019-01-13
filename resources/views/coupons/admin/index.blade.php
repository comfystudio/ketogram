@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
    	<!-- Table Styles Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Coupons</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li>Coupons</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->
        <!-- Table Styles Block -->
        <div class="block full">
        	<div class="block-title">
                <h2>Manage Coupons</h2>
                <div class="block-options pull-right">
    	    		 <div id="esearch" class="dataTables_filter">
    		    		<form class="form-wrap" method='get' action='/admin/coupons/'>
                            <div class="input-group pull-right">
    					        <input type="text" class="form-control" placeholder="Search" name="keywords" id="search_term" value ="{{Request::query('keywords')}}" ><span class="search-btn"><button type="submit" class="btn btn-effect-ripple btn-sm"><i class="fa fa-search"></i></button></span>
    					    </div>
    					</form>
    				</div>
        		</div>
        	</div>

            @include('partials.admin.error')

            @include('partials.admin.success-form')
            <!-- Table Styles Content -->
    	        <div class="dataTables_wrapper form-inline no-footer">
    		        <div class="row">
    			       <div class="col-xs-12">
    				        <div class="pull-right">
                                <a href="/admin/coupons/create" class="btn btn-success"><i class="fa fa-plus"></i> Add Coupons</a>
                            </div>
    					</div>
    				</div>
    				@if($coupons->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter table-hover no-margin">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>User Email</th>
                                        <th>Referrer</th>
    	                                <th>Valid From</th>
    	                                <th>Valid To</th>
    	                                <th>Count</th>
    	                                <th>Percentage</th>
    	                                <th>Number Used</th>
    	                                <th>Code</th>
    	                                <th>Only works for Subs?</th>
                                        <th style="width: 90px; min-width:90px;" class="text-center"><i class="fa fa-flash"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coupons as $data)
                                    <tr>
                                        <td>@if($data->user_id != null){{$data->User->name}}@else No User @endif</td>
                                        <td>@if(!empty($data->user_email)){{$data->user_email}}@else No Email @endif</td>
                                        <td>@if($data->referrer_id != null){{$data->Referrer->name}}@else No Referrer @endif</td>
                                        <td>{{date("F j, Y, g:i a", strtotime($data->valid_from))}}</td>
                                        <td>{{date("F j, Y, g:i a", strtotime($data->valid_to))}}</td>
                                        <td>{{$data->count}}</td>
                                        <td>{{$data->percentage}}</td>
                                        <td>{{$data->number_used}}</td>
                                        <td>{{$data->code}}</td>
                                        <td>
                                            @if($data->is_subscription)
                                                <i class="fa fa-check text-success center-block yes-no"></i>
                                            @else
                                                <i class="fa fa-close text-danger center-block yes-no"></i>
                                            @endif
                                        </td>
                                        <td class="text-left">
                                            <a href="/admin/coupons/edit/{{$data->id}}/" data-toggle="tooltip" title="Edit Coupon" class="btn btn-effect-ripple btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                                            <a href="/admin/coupons/delete/{{$data->id}}/" data-toggle="tooltip" title="Delete Coupon" class="btn btn-effect-ripple btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
    		             <div class="row no-result">
    			            <div class="col-xs-12">
    							<p>There are no Coupons to display.</p>
    			            </div>
    		            </div>
    			    @endif
                    <div class="pagination-wrap row">
                        <div class="pull-right">
                            <a href="/admin/coupons/create" class="btn btn-success"><i class="fa fa-plus"></i> Add Coupons</a>
                        </div>
                        <div class="dataTables_paginate paging_bootstrap">
                            {{$coupons->links('partials/admin/admin')}}
                        </div>
                    </div>
    	        </div>
            <!-- END Table Styles Content -->
        </div>
        <!-- END Table Styles Block -->
    </div>
    <!-- END Page Content -->
@stop