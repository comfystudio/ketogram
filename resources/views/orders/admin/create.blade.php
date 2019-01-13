@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
        <!-- Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Food</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="/admin/items/">Food</a></li>
                            <li>@if(isset($items)) Edit @else Add @endif</li>
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
                <h2>@if(isset($items)) Edit @else Add @endif Food</h2>
            </div>
            <!-- END General Elements Title -->
            @include('partials.admin.error-form')

            @include('partials.admin.success')
            <!-- General Elements Content -->
            <form action="/admin/items/{{isset($items) ? 'edit/'.$items->id : 'create'}}" method="POST" class="form-horizontal form-bordered">
                {{ csrf_field() }}

                <div class="form-group @if($errors->has('title')) error @endif">
                    <label class="col-md-2 control-label" for="name">Title <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="title" name="title" class="form-control" value="@if(old('title')){{old('title')}} @elseif(isset($items->title)){{$items->title}}@endif">
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
                                    @elseif(isset($items['appends']['categories']) && in_array($key, $items['appends']['categories']))
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
                        <textarea id="text" name="text" rows="7" class="ckeditor" >@if(old('text')){{old('text')}} @elseif(isset($items->text)){{$items->text}}@endif</textarea>
                    </div>
                </div>

                <div class="form-group @if($errors->has('price')) error @endif">
                    <label class="col-md-2 control-label" for="name">Price <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="number" id="price" name="price" class="form-control" value="@if(old('price')){{old('price')}} @elseif(isset($items->price)){{$items->price}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('protein')) error @endif">
                    <label class="col-md-2 control-label" for="name">Protein</label>
                    <div class="col-md-5">
                        <input type="number" id="protein" name="protein" class="form-control" value="@if(old('protein')){{old('protein')}} @elseif(isset($items->protein)){{$items->protein}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('carbs')) error @endif">
                    <label class="col-md-2 control-label" for="name">Carbs</label>
                    <div class="col-md-5">
                        <input type="number" id="carbs" name="carbs" class="form-control" value="@if(old('carbs')){{old('carbs')}} @elseif(isset($items->carbs)){{$items->carbs}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('fat')) error @endif">
                    <label class="col-md-2 control-label" for="name">Fat</label>
                    <div class="col-md-5">
                        <input type="number" id="fat" name="fat" class="form-control" value="@if(old('fat')){{old('fat')}} @elseif(isset($items->fat)){{$items->fat}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('fibre')) error @endif">
                    <label class="col-md-2 control-label" for="name">Fibre</label>
                    <div class="col-md-5">
                        <input type="number" id="fibre" name="fibre" class="form-control" value="@if(old('fibre')){{old('fibre')}} @elseif(isset($items->fibre)){{$items->fibre}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('cals')) error @endif">
                    <label class="col-md-2 control-label" for="name">Calories</label>
                    <div class="col-md-5">
                        <input type="number" id="cals" name="cals" class="form-control" value="@if(old('cals')){{old('cals')}} @elseif(isset($items->cals)){{$items->cals}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('serving')) error @endif">
                    <label class="col-md-2 control-label" for="name">Serving Size</label>
                    <div class="col-md-5">
                        <input type="text" id="serving" name="serving" class="form-control" value="@if(old('serving')){{old('serving')}} @elseif(isset($items->serving)){{$items->serving}}@endif">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="is_active">Subscriptionable?</label>
                    <input type="hidden" name="subscription" value="0">
                    <div class="col-md-5">
                        <div class="checkbox">
                            <label for="subscription" class="switch switch-primary"><input type="checkbox" name="subscription" id="subscription" value="1" @if((old('subscription') && old('subscription') != 0)  || (isset($items->subscription) && $items->subscription != 0) || (!isset($items->id))) checked = "checked" @endif><span></span></label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="is_active">Is Active</label>
                    <input type="hidden" name="is_active" value="0">
                    <div class="col-md-5">
                        <div class="checkbox">
                            <label for="is_active" class="switch switch-primary"><input type="checkbox" name="is_active" id="is_active" value="1" @if((old('is_active') && old('is_active') != 0)  || (isset($items->is_active) && $items->is_active != 0) || (!isset($items->id))) checked = "checked" @endif><span></span></label>
                        </div>
                    </div>
                </div>

                <div class="form-group form-actions">
                    <div class="col-md-5 col-md-offset-2">
                        <input type="submit" name="save" class="btn btn-effect-ripple btn-primary loader" value="@if(isset($items)) Update @else Save @endif">
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