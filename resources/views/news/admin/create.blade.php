@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
        <!-- Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>News</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="/admin/news/">News</a></li>
                            <li>@if(isset($news)) Edit @else Add @endif</li>
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
                <h2>@if(isset($news)) Edit @else Add @endif News</h2>
            </div>
            <!-- END General Elements Title -->
            @include('partials.admin.error-form')

            @include('partials.admin.success')
            <!-- General Elements Content -->
            <form action="/admin/news/{{isset($news) ? 'edit/'.$news->id : 'create'}}" method="POST" class="form-horizontal form-bordered">
                {{ csrf_field() }}

                <div class="form-group @if($errors->has('title')) error @endif">
                    <label class="col-md-2 control-label" for="name">Title <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="title" name="title" class="form-control" value="@if(old('title')){{old('title')}} @elseif(isset($news->title)){{$news->title}}@endif">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="category_ids">Select Categories</label>
                    <div class="col-md-5">
                        <select class="select-chosen" name="categories[]" data-placeholder="Please Select Categories..." multiple>
                            @foreach($categories as $key => $category)
                                <option value="{{$key}}"
                                    @if(old('categories') && (in_array($key, old('categories'))))
                                        selected = "selected"
                                    @elseif(isset($news['appends']['categories']) && in_array($key, $news['appends']['categories']))
                                        selected = "selected"
                                    @endif
                                >
                                    {{$category}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group @if($errors->has('text')) error @endif">
                    <label class="col-md-2 control-label" for="headline">Text <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <textarea id="text" name="text" rows="7" class="ckeditor" >@if(old('text')){{old('text')}} @elseif(isset($news->text)){{$news->text}}@endif</textarea>
                    </div>
                </div>

                <div class="form-group @if($errors->has('publish_date')) error @endif">
                    <label class="col-md-2 control-label" for="date">News Publish Date <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="publish_date" name="publish_date" class="form-control input-datepicker" data-date-format="yyyy-mm-dd"  placeholder="yyyy-mm-dd" value="@if(old('publish_date')){{old('publish_date')}} @elseif(isset($news->publish_date)){{$news->publish_date}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('meta_title')) error @endif">
                    <label class="col-md-2 control-label" for="name">Meta Title</label>
                    <div class="col-md-5">
                        <input type="text" id="meta_title" name="meta_title" class="form-control" value="@if(old('meta_title')){{old('meta_title')}} @elseif(isset($news->meta_title)){{$news->meta_title}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('meta_description')) error @endif">
                    <label class="col-md-2 control-label" for="headline">Meta Description</label>
                    <div class="col-md-5">
                        <textarea id="text" name="meta_description" rows="7" class="ckeditor" >@if(old('meta_description')){{old('meta_description')}} @elseif(isset($news->meta_description)){{$news->meta_description}}@endif</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="is_active">Is Active</label>
                    <input type="hidden" name="is_active" value="0">
                    <div class="col-md-5">
                        <div class="checkbox">
                            <label for="is_active" class="switch switch-primary"><input type="checkbox" name="is_active" id="is_active" value="1" @if((old('is_active') && old('is_active') != 0)  || (isset($news->is_active) && $news->is_active != 0) || (!isset($news->id))) checked = "checked" @endif><span></span></label>
                        </div>
                    </div>
                </div>

                <div class="form-group form-actions">
                    <div class="col-md-5 col-md-offset-2">
                        <input type="submit" name="save" class="btn btn-effect-ripple btn-primary loader" value="@if(isset($news)) Update @else Save @endif">
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