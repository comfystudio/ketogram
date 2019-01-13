@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
    	<!-- Table Styles Header -->
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
                            <li>Subscription</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->
        <!-- Table Styles Block -->
        <div class="block full">
        	<div class="block-title">
                <h2>Manage Subscription</h2>
                <div class="block-options pull-right">
    	    		 <div id="esearch" class="dataTables_filter">
    		    		<form class="form-wrap" method='get' action='/admin/subscriptions/'>
                            <div class="input-group pull-right">
                                <input type="text" class="form-control" placeholder="Search" name="keywords" id="search_term" value ="{{Request::query('keywords')}}" ><span class="search-btn"><button type="submit" class="btn btn-effect-ripple btn-sm"><i class="fa fa-search"></i></button></span>
                            </div>

                            <div class="input-group pull-right">
                                <select onchange="this.form.submit()" class="form-control" placeholder="Status" name="status" id="status" value ="{{Request::query('status')}}">
                                    <option value="" disabled @if(Request::query('status') === null) selected = "selected" @endif>Filter Status</option>
                                    <option value = 0 @if(Request::query('status') === 0) selected = "selected" @endif>Not Custom</option>
                                    <option value = 1 @if(Request::query('status') == 1) selected = "selected" @endif>Custom</option>
                                  </select>
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
                                {{--<a href="/admin/subscriptions/create" class="btn btn-success"><i class="fa fa-plus"></i> Add Subscription</a>--}}
                            </div>
    					</div>
    				</div>
    				@if($subscriptions->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter table-hover no-margin">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Address</th>
                                        <th>Items</th>
                                        <th>last Payment</th>
                                        <th>Active Until</th>
    	                                <th>Created</th>
                                        <th style="width: 125px; min-width:125px;" class="text-center"><i class="fa fa-flash"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subscriptions as $data)
                                    <tr @if($data->is_active == 0) class="danger" @endif @if($data->is_custom != 1) class="warning" @endif>
                                        <td><a href = "/admin/users/edit/{{$data->user_id}}">{{$data->User->name}} ({{$data->user_id}})</a></td>
                                        <td>
                                            {{$data->address_1}}<br/>
                                            {{$data->address_2}}<br/>
                                            {{$data->town}}<br/>
                                            {{$data->county}}<br/>
                                            {{$data->postcode}}
                                        </td>
                                        <td>
                                            @if($data->is_custom != 1)
                                                <strong>Not Custom</strong>
                                            @else
                                                @foreach($data->Item as $items)
                                                    <a href = "/admin/items/edit/{{$items->id}}">{{$items->title}}</a><br/>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{date("F j, Y, g:i a", strtotime($data->last_payment))}}</td>
                                        <td>{{date("F j, Y, g:i a", strtotime($data->active_until))}}</td>
                                        <td>{{date("F j, Y, g:i a", strtotime($data->created_at))}}</td>
                                        <td class="text-left">
                                            @if($data->is_active == 1)
                                                <a href="/admin/subscriptions/edit/{{$data->id}}/" data-toggle="tooltip" title="Edit Subscription" class="btn btn-effect-ripple btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                                            @endif
                                            @if($data->is_active == 1)
                                                <a href="/admin/subscriptions/cancel/{{$data->id}}/" data-toggle="tooltip" title="Cancel Subscription" class="btn btn-effect-ripple btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
    		             <div class="row no-result">
    			            <div class="col-xs-12">
    							<p>There are no Subscription to display.</p>
    			            </div>
    		            </div>
    			    @endif
                    <div class="pagination-wrap row">
                        <div class="pull-right">
                            {{--<a href="/admin/subscriptions/create" class="btn btn-success"><i class="fa fa-plus"></i> Add Subscription</a>--}}
                        </div>
                        <div class="dataTables_paginate paging_bootstrap">
                            {{$subscriptions->links('partials/admin/admin')}}
                        </div>
                    </div>
    	        </div>
            <!-- END Table Styles Content -->
        </div>
        <!-- END Table Styles Block -->
    </div>
    <!-- END Page Content -->
@stop