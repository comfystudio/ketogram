@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
    	<!-- Table Styles Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Item</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li>Item</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->
        <!-- Table Styles Block -->
        <div class="block full">
        	<div class="block-title">
                <h2>Manage Item</h2>
                <div class="block-options pull-right">
    	    		 <div id="esearch" class="dataTables_filter">
    		    		<form class="form-wrap" method='get' action='/admin/items/'>
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
                                <a href="/admin/items/create" class="btn btn-success"><i class="fa fa-plus"></i> Add Item</a>
                            </div>
    					</div>
    				</div>
    				@if($items->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter table-hover no-margin">
                                <thead>
                                    <tr>
                                        <th>Sort</th>
                                        <th>Title</th>
                                        <th>Price / Weight</th>
                                        <th>Stock</th>
                                        <th>Subscriptionable?</th>
                                        <th>Is orderable?</th>
                                        <th>Gift?</th>
                                        <th>Featured?</th>
                                        <th style="width: 160px; min-width:160px;" class="text-center"><i class="fa fa-flash"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $a = 1; ?>
                                    @foreach($items as $data)
                                    <tr @if($data->is_active == 0) class="danger" @endif>
                                        <td>
                                            @if(count($items) > 1)
                                                <!--if its not the top most item add up arrow-->
                                                @if($a != 1 )
                                                    <a class="btn btn-sm btn-info" href="/admin/items/{{$data->id}}/sort/up/{{$data['sort']}}/" ><i class="fa fa-caret-up"></i></a>
                                                @endif

                                                {{--<!--if its not the last item add down arrow-->--}}
                                                @if($a != count($items))
                                                    <a class="btn btn-sm btn-info" href="/admin/items/{{$data->id}}/sort/down/{{$data['sort']}}/" ><i class="fa fa-caret-down"></i></a>
                                                @endif
                                            @endif
                                        </td>
                                        <td><strong>{{$data->title}}</strong><br/>{{date("F j, Y, g:i a", strtotime($data->created_at))}}</td>
                                        <td>
                                            @if(isset($data->ItemSales[0]) && !empty($data->ItemSales[0]))
                                                <del>£{{$data->price}}</del><br/>£{{$data->ItemSales[0]['price']}}<br/>
                                                Starts: {{date("F j, Y", strtotime($data->ItemSales[0]['valid_from']))}}<br/>
                                                Ends: {{date("F j, Y", strtotime($data->ItemSales[0]['valid_to']))}}
                                                <br/>{{$data->weight}} grams
                                            @else
                                                £{{$data->price}}
                                                <br/>{{$data->weight}} grams
                                            @endif

                                        </td>
                                        <td>{{$data->stock}}</td>
                                        <td>
                                            @if($data->subscription)
                                                <i class="fa fa-check text-success center-block yes-no"></i>
                                            @else
                                                <i class="fa fa-close text-danger center-block yes-no"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @if($data->is_order)
                                                <i class="fa fa-check text-success center-block yes-no"></i>
                                            @else
                                                <i class="fa fa-close text-danger center-block yes-no"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @if($data->is_gift)
                                                <i class="fa fa-check text-success center-block yes-no"></i>
                                            @else
                                                <i class="fa fa-close text-danger center-block yes-no"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @if($data->is_featured)
                                                <i class="fa fa-check text-success center-block yes-no"></i>
                                            @else
                                                <i class="fa fa-close text-danger center-block yes-no"></i>
                                            @endif
                                        </td>

                                        <td class="text-left">
                                            <a href="/admin/items/edit/{{$data->id}}/" data-toggle="tooltip" title="Edit Item" class="btn btn-effect-ripple btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                                            <a href="/admin/items-sales/create/{{$data->id}}" data-toggle="tooltip" title="Create Sale" class="btn btn-effect-ripple btn-sm btn-warning"><i class="fa fa-gbp"></i></a>
                                            <a href="/admin/items-images/{{$data->id}}/" data-toggle="tooltip" title="Manage Images" class="btn btn-effect-ripple btn-sm btn-info"><i class="fa fa-picture-o"></i></a>
                                            <a href="/admin/items/delete/{{$data->id}}/" data-toggle="tooltip" title="Delete Item" class="btn btn-effect-ripple btn-sm btn-danger"><i class="fa fa-times"></i></a>
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
    							<p>There are no Item to display.</p>
    			            </div>
    		            </div>
    			    @endif
                    <div class="pagination-wrap row">
                        <div class="pull-right">
                            <a href="/admin/items/create" class="btn btn-success"><i class="fa fa-plus"></i> Add Item</a>
                        </div>
                        <div class="dataTables_paginate paging_bootstrap">
                            {{$items->links('partials/admin/admin')}}
                        </div>
                    </div>
    	        </div>
            <!-- END Table Styles Content -->
        </div>
        <!-- END Table Styles Block -->
    </div>
    <!-- END Page Content -->
@stop