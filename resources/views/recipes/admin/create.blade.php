@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
        <!-- Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Recipes</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="/admin/recipes/">Recipes</a></li>
                            <li>@if(isset($recipes)) Edit @else Add @endif</li>
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
                <h2>@if(isset($recipes)) Edit @else Add @endif Recipes</h2>
            </div>
            <!-- END General Elements Title -->
            @include('partials.admin.error-form')

            @include('partials.admin.success')
            <!-- General Elements Content -->
            <form action="/admin/recipes/{{isset($recipes) ? 'edit/'.$recipes->id : 'create'}}" method="POST" class="form-horizontal form-bordered">
                {{ csrf_field() }}

                <div class="form-group @if($errors->has('title')) error @endif">
                    <label class="col-md-2 control-label" for="name">Title <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="title" name="title" class="form-control" value="@if(old('title')){{old('title')}} @elseif(isset($recipes->title)){{$recipes->title}}@endif">
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
                                    @elseif(isset($recipes['appends']['categories']) && in_array($key, $recipes['appends']['categories']))
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
                        <textarea id="text" name="text" rows="7" class="ckeditor" >@if(old('text')){{old('text')}} @elseif(isset($recipes->text)){{$recipes->text}}@endif</textarea>
                    </div>
                </div>

                <div class="form-group @if($errors->has('publish_date')) error @endif">
                    <label class="col-md-2 control-label" for="date">Recipes Publish Date <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="publish_date" name="publish_date" class="form-control input-datepicker" data-date-format="yyyy-mm-dd"  placeholder="yyyy-mm-dd" value="@if(old('publish_date')){{old('publish_date')}} @elseif(isset($recipes->publish_date)){{$recipes->publish_date}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('protein')) error @endif">
                    <label class="col-md-2 control-label" for="name">Protein</label>
                    <div class="col-md-5">
                        <input type="text" id="protein" name="protein" class="form-control" value="@if(old('protein')){{old('protein')}}@elseif(isset($recipes->protein)){{$recipes->protein}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('carbs')) error @endif">
                    <label class="col-md-2 control-label" for="name">Carbs</label>
                    <div class="col-md-5">
                        <input type="text" id="carbs" name="carbs" class="form-control" value="@if(old('carbs')){{old('carbs')}}@elseif(isset($recipes->carbs)){{$recipes->carbs}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('sugar')) error @endif">
                    <label class="col-md-2 control-label" for="name">Sugar</label>
                    <div class="col-md-5">
                        <input type="text" id="sugar" name="sugar" class="form-control" value="@if(old('sugar')){{old('sugar')}}@elseif(isset($recipes->sugar)){{$recipes->sugar}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('polyol')) error @endif">
                    <label class="col-md-2 control-label" for="name">Polyols</label>
                    <div class="col-md-5">
                        <input type="text" id="polyol" name="polyol" class="form-control" value="@if(old('polyol')){{old('polyol')}}@elseif(isset($recipes->polyol)){{$recipes->polyol}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('fat')) error @endif">
                    <label class="col-md-2 control-label" for="name">Fat</label>
                    <div class="col-md-5">
                        <input type="text" id="fat" name="fat" class="form-control" value="@if(old('fat')){{old('fat')}}@elseif(isset($recipes->fat)){{$recipes->fat}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('sat_fat')) error @endif">
                    <label class="col-md-2 control-label" for="name">Saturated Fat</label>
                    <div class="col-md-5">
                        <input type="text" id="sat_fat" name="sat_fat" class="form-control" value="@if(old('sat_fat')){{old('sat_fat')}}@elseif(isset($recipes->sat_fat)){{$recipes->sat_fat}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('cholesterol')) error @endif">
                    <label class="col-md-2 control-label" for="name">Cholesterol</label>
                    <div class="col-md-5">
                        <input type="text" id="cholesterol" name="cholesterol" class="form-control" value="@if(old('cholesterol')){{old('cholesterol')}}@elseif(isset($recipes->cholesterol)){{$recipes->cholesterol}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('tran_fat')) error @endif">
                    <label class="col-md-2 control-label" for="name">Trans Fat</label>
                    <div class="col-md-5">
                        <input type="text" id="tran_fat" name="tran_fat" class="form-control" value="@if(old('tran_fat')){{old('tran_fat')}}@elseif(isset($recipes->tran_fat)){{$recipes->tran_fat}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('fibre')) error @endif">
                    <label class="col-md-2 control-label" for="name">Fibre</label>
                    <div class="col-md-5">
                        <input type="text" id="fibre" name="fibre" class="form-control" value="@if(old('fibre')){{old('fibre')}}@elseif(isset($recipes->fibre)){{$recipes->fibre}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('cals')) error @endif">
                    <label class="col-md-2 control-label" for="name">Calories</label>
                    <div class="col-md-5">
                        <input type="text" id="cals" name="cals" class="form-control" value="@if(old('cals')){{old('cals')}}@elseif(isset($recipes->cals)){{$recipes->cals}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('salt')) error @endif">
                    <label class="col-md-2 control-label" for="name">Salt</label>
                    <div class="col-md-5">
                        <input type="text" id="salt" name="salt" class="form-control" value="@if(old('salt')){{old('salt')}}@elseif(isset($recipes->salt)){{$recipes->salt}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('serving')) error @endif">
                    <label class="col-md-2 control-label" for="name">Serving Size</label>
                    <div class="col-md-5">
                        <input type="text" id="serving" name="serving" class="form-control" value="@if(old('serving')){{old('serving')}}@elseif(isset($recipes->serving)){{$recipes->serving}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('meta_title')) error @endif">
                    <label class="col-md-2 control-label" for="name">Meta Title</label>
                    <div class="col-md-5">
                        <input type="text" id="meta_title" name="meta_title" class="form-control" value="@if(old('meta_title')){{old('meta_title')}} @elseif(isset($recipes->meta_title)){{$recipes->meta_title}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('meta_description')) error @endif">
                    <label class="col-md-2 control-label" for="headline">Meta Description</label>
                    <div class="col-md-5">
                        <textarea id="text" name="meta_description" rows="7" class="ckeditor" >@if(old('meta_description')){{old('meta_description')}} @elseif(isset($recipes->meta_description)){{$recipes->meta_description}}@endif</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="is_active">Is Active</label>
                    <input type="hidden" name="is_active" value="0">
                    <div class="col-md-5">
                        <div class="checkbox">
                            <label for="is_active" class="switch switch-primary"><input type="checkbox" name="is_active" id="is_active" value="1" @if((old('is_active') && old('is_active') != 0)  || (isset($recipes->is_active) && $recipes->is_active != 0) || (!isset($recipes->id))) checked = "checked" @endif><span></span></label>
                        </div>
                    </div>
                </div>

                <div class="form-group form-actions">
                    <div class="col-md-5 col-md-offset-2">
                        <input type="submit" name="save" class="btn btn-effect-ripple btn-primary loader" value="@if(isset($recipes)) Update @else Save @endif">
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