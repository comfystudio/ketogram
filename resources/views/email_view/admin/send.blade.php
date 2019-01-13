@extends('layouts.admin')

@section('content')
    <!-- Page content -->
    <div id="page-content">
        <!-- Header -->
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
                            <li><a href="/admin/items/">Email</a></li>
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
                <h2>Add Email</h2>
            </div>
            <!-- END General Elements Title -->
            @include('partials.admin.error-form')

            @include('partials.admin.success')
            <!-- General Elements Content -->
            <form action="/admin/emails/send/{{$emails->id}}" method="POST" class="form-horizontal form-bordered">
                {{ csrf_field() }}


                <div class="form-group">
                    <label class="col-md-2 control-label" for="option">Select Option</label>
                    <div class="col-md-5">
                        <select class="select-chosen" name="option" data-placeholder="Please Select Email List...">
                            {{--<option value="0">All Users</option>--}}
                            @foreach($choiceArray as $key => $choice)
                                <option value="{{$key}}"
                                    @if(old('option') && old('option') == $key)
                                        selected = "selected"
                                    @elseif(isset($emails['option']) && $emails['option'] == $key)
                                        selected = "selected"
                                    @endif
                                >
                                    {{$choice}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group form-actions">
                    <div class="col-md-5 col-md-offset-2">
                        <input type="submit" name="save" class="btn btn-effect-ripple btn-primary loader" value="@if(isset($emails)) Send @else Send @endif">
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