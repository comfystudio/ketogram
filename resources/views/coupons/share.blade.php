@extends('layouts/layout')

@section('content')
    <!-- Content -->
    <div class="content clearfix cart">

        <!-- Intro Title Section 2 -->
        <div class="section-block background-aqua pt-100 pb-50">
            <div class="media-overlay"></div>
            <div class="row">
                <div class="column width-12">
                    <div class="title-container">
                        <div class="title-container-inner">
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">Subscriptions</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Intro Title Section 2 End -->

        <!-- Cart Overview -->
        <div class="section-block cart-overview pt-20">
            <div class="row">
                <div class="column width-8 offset-2 pb-20">
                    @include('partials.admin.error-form')

                    @include('partials.admin.success-form')
                </div>

                <div class="column width-12 pt-50 text-medium">
                    <h3 class="widget-title widget-title-long">Sharing</h3>
                    <p class="mb-20">Sharing is caring. Generate a share code below and give it to your family and friends to use as a coupon for 20% off. For every 10 uses of your code
                        we will send you a thank you box with some extra goodies!
                    </p>
                </div>

                @if(isset($coupon->id) && !empty($coupon->id))
                    <div class="column width-12 pt-50 pb-50">
                        <div class="column width-2 offset-5 center">
                            <input value="{{$coupon->code}}" class="form-submit button pill button-orange text-large">
                        </div>
                    </div>
                @else
                    <div class="column width-12 pt-50 pb-50">
                        <form class="signup" action="{{url('/share')}}/{{Auth::id()}}" method="post" novalidate>
                            {{ csrf_field() }}
                            <div class="column width-3 offset-5 center">
                                <input type = "submit" value="Generate Share Code" class="form-submit button pill button-orange text-large">
                            </div>
                        </form>
                    </div>
                @endif

                <hr/>

                <a name="share-o-metre"></a>
                <div class="column width-12 pt-50">
                <h3 class="widget-title widget-title-long">Ketogram Share-O-Metre</h3>
                    <span class="progress-bar-label">@if($user['subscription_count'] % 10 == 0)1% To your next Thank You Box! @else{{ $user['subscription_count'] % 10}}0% To your next Thank You Box! @endif</span>
                    <div class="progress-bar pill xlarge bkg-grey-ultralight">
                        <div class="bar bkg-theme color-white percent-@if($user['subscription_count'] % 10 == 0)00 @else{{ $user['subscription_count'] % 10}}0 @endif horizon"
                            data-animate-in="transX:-100%;duration:1000ms;easing:easeIn;">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Cart Overview End -->
    </div>
    <!-- Content End -->
@stop