@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
        <!-- Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>News Image</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="/admin/news-images/{{$news->id}}/">News Image</a></li>
                            <li>@if(isset($images)) Edit @else Add @endif</li>
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
                <h2>@if(isset($data)) Edit @else Add @endif News Image</h2>
            </div>
            <!-- END General Elements Title -->
            @include('partials.admin.error-form')

            @include('partials.admin.success')
            <!-- General Elements Content -->
            <form action="/admin/news-images/{{$news->id}}/{{isset($images) ? 'edit/'.$images->id : 'create'}}" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group @if($errors->has('title')) error @endif">
                    <label class="col-md-2 control-label" for="name">Image Title</label>
                    <div class="col-md-5">
                        <input type="text" id="title" name="title" class="form-control" value="@if(old('title')){{old('title')}} @elseif(isset($images->title)){{$images->title}}@endif">
                    </div>
                </div>

                @if (isset($images->id) && $images->image)
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="current file">Current Image</label>
                        <div class="col-md-10 double-input">
                            <div class="col-md-5">
                                <td><img src="/{{$images->image}}" alt="{{$images->title}}" style = "width:120px;"></td>
                            </div>

                            <div class="col-xs-6">
                                <div class="edit-download-wrap">
                                    <a href="/admin/news-images/{{$news->id}}/download/{{$images->id}}/" class="btn btn-primary">Download Current News Image <i class="fa fa-cloud-download"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-group @if($errors->has('image')) error @endif ">
                    <label class="col-md-2 control-label" for="file">News Image <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="file" name="image" id="image">
                        {{--<span class = "help-block">Note: Width:600px Height:700px</span>--}}
                        @if (isset($images->id) && $images->image)
                            <span class = "help-block">Note: Uploading a new Image will remove the previous one.</span>
                        @endif
                    </div>

                    <div class="col-md-5">
                        <div id = "news-image"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="is_active">Is Active</label>
                    <input type="hidden" name="is_active" value="0">
                    <div class="col-md-5">
                        <div class="checkbox">
                            <label for="is_active" class="switch switch-primary"><input type="checkbox" name="is_active" id="is_active" value="1" @if((old('is_active') && old('is_active') != 0)  || (isset($images->is_active) && $images->is_active != 0) || (!isset($images->id))) checked = "checked" @endif><span></span></label>
                        </div>
                    </div>
                </div>

                <div class="form-group form-actions">
                    <div class="col-md-5 col-md-offset-2">
                        <input type="submit" name="save" class="btn btn-effect-ripple btn-primary loader" value="@if(isset($images)) Update @else Save @endif">
                        <a href = "{{ URL::previous() }}" type="submit" name="cancel" class="btn btn-effect-ripple btn-danger loader">Cancel</a>
                    </div>
                </div>
            </form>
            <!-- END General Elements Content -->
        </div>
        <!-- END General Elements Block -->
    </div>
    <!-- END Page Content -->
@stop