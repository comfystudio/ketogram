@extends('layouts.layout')

@section('content')

<!-- Content -->
<div class="content clearfix">
    <!-- Intro Title Section 2 -->
    <div class="section-block background-aqua pt-100 pb-50">
        <div class="media-overlay"></div>
        <div class="row">
            <div class="column width-12">
                <div class="title-container">
                    <div class="title-container-inner">
                        <h1 class="font-alt-1 weight-bold mb-0 color-white center">Switch to Standard Sub</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Intro Title Section 2 End -->

    <!-- Form Advanced -->
    <div class="section-block replicable-content bkg-grey-ultralight pt-20" >
        <div class = "row">
            <div class="column width-8 offset-2 pb-20">
                @include('partials.admin.error-form')

                @include('partials.admin.success-form')
            </div>
        </div>

        <!-- Intro -->
        {{--<div class="section-block pb-0 pt-70">--}}
            <div class="row">
                <div class="column width-10 offset-1 center">
                    <p class="lead weight-regular mb-40 text-large">Switch to Standard Sub?</p>
                    <p class="lead weight-regular mb-40">Are you sure you wish to switch to Standard Subscription?</p>
                </div>
                <div class="column width-12">
                    <hr class="mb-70">
                </div>
            </div>
        {{--</div>--}}
        <!-- Intro End -->

        <div class="row">
            <div class="column width-8 offset-2 border-form">
                <div class="contact-form-container">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/subscriptions/standard').'/'.$subscriptions->id}}">
                        {{ csrf_field() }}

                        <div class = "row">
                            <div class="row center">
                                <div class="column width-12">
                                    <input type="submit" value="Switch To Standard" name="action" class="form-submit button border-theme bkg-hover-theme color-theme color-hover-white button-blue">
                                    <a href = "{{ URL::previous() }}" type="submit" name="cancel" class="form-submit button border-theme bkg-hover-theme color-theme color-hover-white button-orange" value="Cancel">Back</a>
                                </div>
                            </div>
                        </div>

                    </form>
                    <div class="form-response"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Advanced End -->
</div>
@endsection
