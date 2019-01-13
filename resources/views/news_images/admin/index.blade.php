@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
    	<!-- Table Styles Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>News Images</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li>News Images</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->
        <!-- Table Styles Block -->
        <div class="block full">
        	<div class="block-title">
                <h2>Manage News Images</h2>
                <div class="block-options pull-right">
    	    		 <div id="esearch" class="dataTables_filter">
    		    		<form class="form-wrap" method='get' action='/admin/news-images/{{$news->id}}'>
                            <div class="input-group pull-right">
    					        <input type="text" class="form-control" placeholder="Search" name="keywords" id="search_term" value ="{{Request::query('keywords')}}" ><span class="search-btn"><button type="submit" class="btn btn-effect-ripple btn-sm"><i class="fa fa-search"></i></button></span>
    					    </div>
    					</form>
    				</div>
        		</div>
        	</div>

            @include('partials.admin.error-form')

            @include('partials.admin.success-form')
            <!-- Table Styles Content -->
    	        <div class="dataTables_wrapper form-inline no-footer">
    		        <div class="row">
    			       <div class="col-xs-12">
    				        <div class="pull-right">
                                <a href="/admin/news-images/{{$news->id}}/create" class="btn btn-success"><i class="fa fa-plus"></i> Add News Images</a>
                            </div>
    					</div>
    				</div>
    				@if($images->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter table-hover no-margin">
                                <thead>
                                    <tr>
                                        <th>Sort</th>
                                        <th>Image</th>
                                        <th>Title</th>
    	                                <th>Created</th>
                                        <th style="width: 90px; min-width:90px;" class="text-center"><i class="fa fa-flash"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $a = 1; ?>
                                    @foreach($images as $data)
                                        <tr @if($data->is_active == 0) class="danger" @endif >
                                            <td>
                                                @if(count($images) > 1)
                                                    <!--if its not the top most item add up arrow-->
                                                    @if($a != 1)
                                                        <a class="btn btn-sm btn-info" href="/admin/news-images/{{$news->id}}/sort/up/{{$data['id']}}/{{$data['sort']}}/" ><i class="fa fa-caret-up"></i></a>
                                                    @endif

                                                    {{--<!--if its not the last item add down arrow-->--}}
                                                    @if($a != count($images))
                                                        <a class="btn btn-sm btn-info" href="/admin/news-images/{{$news->id}}/sort/down/{{$data['id']}}/{{$data['sort']}}/" ><i class="fa fa-caret-down"></i></a>
                                                    @endif
                                                @endif
                                            </td>
                                            <td><img src = "/{{$data->image}}" alt = "{{$data->title}}" style = "width:64px;"></td>
                                            <td>{{$data->title}}</td>
                                            <td>{{date("F j, Y, g:i a", strtotime($data->created_at))}}</td>
                                            <td class="text-left">
                                                <a href="/admin/news-images/{{$news->id}}/edit/{{$data->id}}/" data-toggle="tooltip" title="Edit News Image" class="btn btn-effect-ripple btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                                                <a href="/admin/news-images/{{$news->id}}/delete/{{$data->id}}/" data-toggle="tooltip" title="Delete News Image" class="btn btn-effect-ripple btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    <?php $a++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
    		             <div class="row no-result">
    			            <div class="col-xs-12">
    							<p>There are no News Images to display.</p>
    			            </div>
    		            </div>
    			    @endif
                    <div class="pagination-wrap row">
                        <div class="pull-right">
                            <a href="/admin/news-images/{{$news->id}}/create" class="btn btn-success"><i class="fa fa-plus"></i> Add News Images</a>
                        </div>
                        <div class="dataTables_paginate paging_bootstrap">
                            {{$images->links('partials/admin/admin')}}
                        </div>
                    </div>
    	        </div>
            <!-- END Table Styles Content -->
        </div>
        <!-- END Table Styles Block -->
    </div>
    <!-- END Page Content -->
@stop