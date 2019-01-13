@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
    	<!-- Table Styles Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Email</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li>Email</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->
        <!-- Table Styles Block -->
        <div class="block full">
        	<div class="block-title">
                <h2>Manage Email</h2>
                <div class="block-options pull-right">
    	    		 <div id="esearch" class="dataTables_filter">
    		    		<form class="form-wrap" method='get' action='/admin/emails/'>
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
                                <a href="/admin/emails/create" class="btn btn-success"><i class="fa fa-plus"></i> Add Email</a>
                            </div>
    					</div>
    				</div>
    				@if($emails->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter table-hover no-margin">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Subject</th>
                                        <th>Title</th>
    	                                <th>Last Sent</th>
                                        <th style="width: 160px; min-width:160px;" class="text-center"><i class="fa fa-flash"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($emails as $data)
                                    <tr>
                                        <td><strong>{{$data->id}}</strong></td>
                                        <td><strong>{{$data->subject}}</strong></td>
                                        <td><strong>{{$data->title}}</strong></td>
                                        <td>{{date("F j, Y, g:i a", strtotime($data->updated_at))}}</td>
                                        <td class="text-left">
                                            <a href="/admin/emails/edit/{{$data->id}}/" data-toggle="tooltip" title="Edit Email" class="btn btn-effect-ripple btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                                            <a href="/admin/emails/test/{{$data->id}}/" data-toggle="tooltip" title="Test Email" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-gear"></i></a>
                                            <a href="/admin/emails/send/{{$data->id}}/" data-toggle="tooltip" title="Send Email" class="btn btn-effect-ripple btn-sm btn-info"><i class="fa fa-envelope-o"></i></a>
                                            <a href="/admin/emails/delete/{{$data->id}}/" data-toggle="tooltip" title="Delete Email" class="btn btn-effect-ripple btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
    		             <div class="row no-result">
    			            <div class="col-xs-12">
    							<p>There are no Emails to display.</p>
    			            </div>
    		            </div>
    			    @endif
                    <div class="pagination-wrap row">
                        <div class="pull-right">
                            <a href="/admin/emails/create" class="btn btn-success"><i class="fa fa-plus"></i> Add Email</a>
                        </div>
                        <div class="dataTables_paginate paging_bootstrap">
                            {{$emails->links('partials/admin/admin')}}
                        </div>
                    </div>
    	        </div>
            <!-- END Table Styles Content -->
        </div>
        <!-- END Table Styles Block -->
    </div>
    <!-- END Page Content -->
@stop