@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
    	<!-- Table Styles Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Categories</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li>Categories</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->
        <!-- Table Styles Block -->
        <div class="block full">
        	<div class="block-title">
                <h2>Manage Categories</h2>
                <div class="block-options pull-right">
    	    		 <div id="esearch" class="dataTables_filter">
    		    		<form class="form-wrap" method='get' action='/admin/categories/'>
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
                                <a href="/admin/categories/create" class="btn btn-success"><i class="fa fa-plus"></i> Add Categories</a>
                            </div>
    					</div>
    				</div>
    				@if($categories->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter table-hover no-margin">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
    	                                <th>Created</th>
                                        <th style="width: 90px; min-width:90px;" class="text-center"><i class="fa fa-flash"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $data)
                                    <tr @if($data->is_active == 0) class="danger" @endif >
                                        <td><strong>{{$data->id}}</strong></td>
                                        <td><strong>{{$data->name}}</strong></td>
                                        <td>{{date("F j, Y, g:i a", strtotime($data->created_at))}}</td>
                                        <td class="text-left">
                                            <a href="/admin/categories/edit/{{$data->id}}/" data-toggle="tooltip" title="Edit Category" class="btn btn-effect-ripple btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                                            <a href="/admin/categories/delete/{{$data->id}}/" data-toggle="tooltip" title="Delete Category" class="btn btn-effect-ripple btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
    		             <div class="row no-result">
    			            <div class="col-xs-12">
    							<p>There are no Categories to display.</p>
    			            </div>
    		            </div>
    			    @endif
                    <div class="pagination-wrap row">
                        <div class="pull-right">
                            <a href="/admin/categories/create" class="btn btn-success"><i class="fa fa-plus"></i> Add Categories</a>
                        </div>
                        <div class="dataTables_paginate paging_bootstrap">
                            {{$categories->links('partials/admin/admin')}}
                        </div>
                    </div>
    	        </div>
            <!-- END Table Styles Content -->
        </div>
        <!-- END Table Styles Block -->
    </div>
    <!-- END Page Content -->
@stop