@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
    	<!-- Table Styles Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Order</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li>Order</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->
        <!-- Table Styles Block -->
        <div class="block full">
        	<div class="block-title">
                <h2>Manage Order</h2>
                <div class="block-options pull-right">
    	    		 <div id="esearch" class="dataTables_filter">
    		    		<form class="form-wrap" method='get' action='/admin/orders/'>
                            <div class="input-group pull-right">
                                <input type="text" class="form-control" placeholder="Search" name="keywords" id="search_term" value ="{{Request::query('keywords')}}" ><span class="search-btn"><button type="submit" class="btn btn-effect-ripple btn-sm"><i class="fa fa-search"></i></button></span>
                            </div>

                            <div class="input-group pull-right">
                                <select onchange="this.form.submit()" class="form-control" placeholder="Status" name="status" id="status" value ="{{Request::query('status')}}">
                                    <option value="" disabled @if(Request::query('status') === null) selected = "selected" @endif>Filter Status</option>
                                    <option value = 0 @if(Request::query('status') === 0) selected = "selected" @endif>Pending</option>
                                    <option value = 1 @if(Request::query('status') == 1) selected = "selected" @endif>Dispatched</option>
                                    <option value = 2 @if(Request::query('status') == 2) selected = "selected" @endif>Cancelled</option>
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
                                {{--<a href="/admin/orders/create" class="btn btn-success"><i class="fa fa-plus"></i> Add Order</a>--}}
                            </div>
    					</div>
    				</div>
    				@if($orders->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter table-hover no-margin">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Address</th>
                                        <th>Items</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
    	                                <th>Order Text</th>
                                        <th style="width: 125px; min-width:125px;" class="text-center"><i class="fa fa-flash"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $data)
                                    <tr @if($data->status == 2) class="danger" @endif>
                                        <td><strong>{{$data->id}}</strong><br/>{{date("F j, Y, g:i a", strtotime($data->created_at))}}</td>
                                        <td><a href = "/admin/users/edit/{{$data->user_id}}">{{$data->User->name}} ({{$data->user_id}})</a></td>
                                        <td>
                                            {{$data->address_1}}<br/>
                                            {{$data->address_2}}<br/>
                                            {{$data->town}}<br/>
                                            {{$data->county}}<br/>
                                            {{$data->postcode}}
                                        </td>
                                        <td>
                                            @foreach($data->Item as $items)
                                                <a href = "/admin/items/edit/{{$items->id}}">{{$items->title}}</a><br/>
                                            @endforeach
                                        </td>
                                        <td>£{{$data->total}}</td>
                                        <td>
                                            @if($data->status === 0)
                                                Pending
                                            @elseif($data->status === 1)
                                                Dispatched on {{date("F j, Y, g:i a", strtotime($data->updated_at))}}
                                            @elseif($data->status === 2)
                                                Cancelled
                                            @endif
                                        </td>
                                        <td>{{$data->gift_text}}</td>
                                        <td class="text-left">
                                            {{--<a href="/admin/orders/edit/{{$data->id}}/" data-toggle="tooltip" title="Edit Order" class="btn btn-effect-ripple btn-sm btn-success"><i class="fa fa-pencil"></i></a>--}}
                                            {{--<a href="/admin/orders-images/{{$data->id}}/" data-toggle="tooltip" title="Manage Images" class="btn btn-effect-ripple btn-sm btn-info"><i class="fa fa-picture-o"></i></a>--}}
                                            @if($data->status === 0)
                                                <a href="/admin/orders/dispatch/{{$data->id}}/" data-toggle="tooltip" title="Mark as Dispatched" class="btn btn-effect-ripple btn-sm btn-info"><i class="fa fa-paper-plane"></i></a>
                                            @endif
                                            @if($data->status != 2)
                                                <a href="/admin/orders/cancel/{{$data->id}}/" data-toggle="tooltip" title="Cancel Order" class="btn btn-effect-ripple btn-sm btn-danger"><i class="fa fa-times"></i></a>
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
    							<p>There are no Order to display.</p>
    			            </div>
    		            </div>
    			    @endif
                    <div class="pagination-wrap row">
                        <div class="pull-right">
                            {{--<a href="/admin/orders/create" class="btn btn-success"><i class="fa fa-plus"></i> Add Order</a>--}}
                        </div>
                        <div class="dataTables_paginate paging_bootstrap">
                            {{$orders->links('partials/admin/admin')}}
                        </div>
                    </div>
    	        </div>
            <!-- END Table Styles Content -->
        </div>
        <!-- END Table Styles Block -->
    </div>
    <!-- END Page Content -->
@stop