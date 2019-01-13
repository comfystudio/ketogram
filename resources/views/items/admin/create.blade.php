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
                        <textarea id="text" name="text" rows="7" class="ckeditor" >@if(old('text')){{old('text')}}@elseif(isset($items->text)){{$items->text}}@endif</textarea>
                    </div>
                </div>

                <div class="form-group @if($errors->has('stock')) error @endif">
                    <label class="col-md-2 control-label" for="stock">Stock <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="stock" name="stock" class="form-control" value="@if(old('stock')){{old('stock')}}@elseif(isset($items->stock)){{$items->stock}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('price')) error @endif">
                    <label class="col-md-2 control-label" for="name">Price <span class="text-danger">*</span></label>
                    <div class="col-md-5">
                        <input type="text" id="price" name="price" class="form-control" value="@if(old('price')){{old('price')}}@elseif(isset($items->price)){{$items->price}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('protein')) error @endif">
                    <label class="col-md-2 control-label" for="name">Protein</label>
                    <div class="col-md-5">
                        <input type="text" id="protein" name="protein" class="form-control" value="@if(old('protein')){{old('protein')}}@elseif(isset($items->protein)){{$items->protein}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('carbs')) error @endif">
                    <label class="col-md-2 control-label" for="name">Carbs</label>
                    <div class="col-md-5">
                        <input type="text" id="carbs" name="carbs" class="form-control" value="@if(old('carbs')){{old('carbs')}}@elseif(isset($items->carbs)){{$items->carbs}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('sugar')) error @endif">
                    <label class="col-md-2 control-label" for="name">Sugar</label>
                    <div class="col-md-5">
                        <input type="text" id="sugar" name="sugar" class="form-control" value="@if(old('sugar')){{old('sugar')}}@elseif(isset($items->sugar)){{$items->sugar}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('polyol')) error @endif">
                    <label class="col-md-2 control-label" for="name">Polyols</label>
                    <div class="col-md-5">
                        <input type="text" id="polyol" name="polyol" class="form-control" value="@if(old('polyol')){{old('polyol')}}@elseif(isset($items->polyol)){{$items->polyol}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('fat')) error @endif">
                    <label class="col-md-2 control-label" for="name">Fat</label>
                    <div class="col-md-5">
                        <input type="text" id="fat" name="fat" class="form-control" value="@if(old('fat')){{old('fat')}}@elseif(isset($items->fat)){{$items->fat}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('sat_fat')) error @endif">
                    <label class="col-md-2 control-label" for="name">Saturated Fat</label>
                    <div class="col-md-5">
                        <input type="text" id="sat_fat" name="sat_fat" class="form-control" value="@if(old('sat_fat')){{old('sat_fat')}}@elseif(isset($items->sat_fat)){{$items->sat_fat}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('cholesterol')) error @endif">
                    <label class="col-md-2 control-label" for="name">Cholesterol</label>
                    <div class="col-md-5">
                        <input type="text" id="cholesterol" name="cholesterol" class="form-control" value="@if(old('cholesterol')){{old('cholesterol')}}@elseif(isset($items->cholesterol)){{$items->cholesterol}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('tran_fat')) error @endif">
                    <label class="col-md-2 control-label" for="name">Trans Fat</label>
                    <div class="col-md-5">
                        <input type="text" id="tran_fat" name="tran_fat" class="form-control" value="@if(old('tran_fat')){{old('tran_fat')}}@elseif(isset($items->tran_fat)){{$items->tran_fat}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('fibre')) error @endif">
                    <label class="col-md-2 control-label" for="name">Fibre</label>
                    <div class="col-md-5">
                        <input type="text" id="fibre" name="fibre" class="form-control" value="@if(old('fibre')){{old('fibre')}}@elseif(isset($items->fibre)){{$items->fibre}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('cals')) error @endif">
                    <label class="col-md-2 control-label" for="name">Calories</label>
                    <div class="col-md-5">
                        <input type="text" id="cals" name="cals" class="form-control" value="@if(old('cals')){{old('cals')}}@elseif(isset($items->cals)){{$items->cals}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('salt')) error @endif">
                    <label class="col-md-2 control-label" for="name">Salt</label>
                    <div class="col-md-5">
                        <input type="text" id="salt" name="salt" class="form-control" value="@if(old('salt')){{old('salt')}}@elseif(isset($items->salt)){{$items->salt}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('serving')) error @endif">
                    <label class="col-md-2 control-label" for="name">Serving Size</label>
                    <div class="col-md-5">
                        <input type="text" id="serving" name="serving" class="form-control" value="@if(old('serving')){{old('serving')}}@elseif(isset($items->serving)){{$items->serving}}@endif">
                    </div>
                </div>

                <div class="form-group @if($errors->has('weight')) error @endif">
                    <label class="col-md-2 control-label" for="name">Item Weight (grams)</label>
                    <div class="col-md-5">
                        <input type="text" id="weight" name="weight" class="form-control" value="@if(old('weight')){{old('weight')}}@elseif(isset($items->weight)){{$items->weight}}@endif">
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
                    <label class="col-md-2 control-label" for="is_active">Is Orderable?</label>
                    <input type="hidden" name="is_order" value="0">
                    <div class="col-md-5">
                        <div class="checkbox">
                            <label for="is_order" class="switch switch-primary"><input type="checkbox" name="is_order" id="is_order" value="1" @if((old('is_order') && old('is_order') != 0)  || (isset($items->is_order) && $items->is_order != 0) || (!isset($items->id))) checked = "checked" @endif><span></span></label>
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

                <div class="form-group">
                    <label class="col-md-2 control-label" for="is_active">Is Gift?</label>
                    <input type="hidden" name="is_gift" value="0">
                    <div class="col-md-5">
                        <div class="checkbox">
                            <label for="is_gift" class="switch switch-primary"><input type="checkbox" name="is_gift" id="is_gift" value="1" @if((old('is_gift') && old('is_gift') != 0)  || (isset($items->is_gift) && $items->is_gift != 0)) checked = "checked" @endif><span></span></label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="is_active">Is Featured</label>
                    <input type="hidden" name="is_featured" value="0">
                    <div class="col-md-5">
                        <div class="checkbox">
                            <label for="is_featured" class="switch switch-primary"><input type="checkbox" name="is_featured" id="is_featured" value="1" @if((old('is_featured') && old('is_featured') != 0)  || (isset($items->is_featured) && $items->is_featured != 0)) checked = "checked" @endif><span></span></label>
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