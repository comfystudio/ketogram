@extends('layouts/layout')

@section('content')
    <div class="content clearfix" style="display: flex; flex-wrap:wrap;">
        <!-- Intro Title Section 2 -->
        <div class="section-block background-aqua pt-100 pb-50">
            <div class="media-overlay"></div>
            <div class="row">
                <div class="column width-12">
                    <div class="title-container">
                        <div class="title-container-inner">
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">Subscription Box</h1>
                        </div>
                    </div>
                    @include('partials.admin.error-form')

                    @include('partials.admin.success-form')
                </div>
            </div>
        </div>
        <!-- Intro Title Section 2 End -->

        {{--<div class="section-block pb-50 pt-50">--}}
            {{--<div class="row" style="display: flex;">--}}
                <div class="column width-5 background-white subscribe-box text-gray text-medium">
                    <h2 style="color:#666;">Standard Subscription Box</h2>
                    <p>The Standard Subscription contents are carefully curated by us. We source a variety of keto friendly products and deliver them to you monthly for you to discover. </p>

                    <p>In addition to snacks and other food products, there will be a ‘product of the month’. This is generally a product which will be the focus of the recipe card, which will hopefully inspire you to create your own keto friendly treats!</p>

                    <br/><br/>
                    <h1 class="text-medium column width-11" style="color:#666;">Standard Subscriptions £30 <span class ="text-medium">(Free P&P)</span></h1>


                    <div class="space3d-small offset-3">
                        <div class="_3dbox-small">
                            <div class="_3dface-small _3dface--front-small">
                                <img id="keto-approved" src="/images/logos/keto-approved.png" alt="keto-approved">
                            </div>

                            <div class="_3dface-small _3dface--top-small">
                            </div>

                            <div class="_3dface-small _3dface--bottom-small">
                            </div>

                            <div class="_3dface-small _3dface--left-small">
                            </div>

                            <div class="_3dface-small _3dface--right-small">
                            </div>

                            <div class="_3dface-small _3dface--back-small">
                            </div>
                        </div>
                    </div>


                    {{--<p style="margin: 6rem auto 3rem;width: 30%;">--}}
                        {{--<a class="button pill checkout no-margin-bottom button-yellow center-block" href="{{url('/subscribe-checkout')}}">Subscribe Now</a>--}}
                    {{--</p>--}}
                    <div class="column width-12 mt-100 mb-50 offset-3">
                        <a class="button pill checkout no-margin-bottom button-yellow center-block" href="{{url('/subscribe-checkout')}}">Subscribe Now</a>
                    </div>

                    <p>If you’d like to know more – please check out our <a href = "{{url('/faqs')}}" class = "link">FAQ’s</a></p>
                </div>

                <div class="column width-2 subscribe-gradient">
                </div>

                <div class="column width-5 background-yellow subscribe-box text-medium">
                    <h2 style = "color:#666;">Custom Subscription Box</h2>
                    <p>The Custom subscription box is available for those who like to have a bit more control over what they would like delivered to their door, either for allergy reasons, or just because they know what they want!</p>

                    <p>Customers can select items from a dedicated list of products, that they would like delivered on a monthly basis. These items can be changed at any time in your account area. New lines will also be added regularly - so check back and see what new treats you can add to your custom box!</p>

                    <h1 class="text-medium column width-11" style="color:#666;">Custom Subscriptions £30 <span class ="text-medium">(Free P&P)</span></h1>

                    <div class="space3d-small-right offset-3">
                        <div class="_3dbox-small-right">
                            <div class="_3dface-small _3dface--front-small-right">
                                <h1 class = "question-mark">?</h1>
                            </div>

                            <div class="_3dface-small _3dface--top-small-right">
                            </div>

                            <div class="_3dface-small _3dface--bottom-small-right">
                            </div>

                            <div class="_3dface-small _3dface--left-small-right">
                            </div>

                            <div class="_3dface-small _3dface--right-small-right">
                            </div>

                            <div class="_3dface-small _3dface--back-small-right">
                            </div>
                        </div>
                    </div>

                    {{--<p style="margin: 4rem auto 3rem;width: 30%;">--}}
                        {{--<a class="button pill checkout no-margin-bottom button-orange center-block" href="{{url('/subscribe-custom')}}">Subscribe Now</a>--}}
                    {{--</p>--}}
                    <div class="column width-12 mt-100 mb-50 offset-3">
                        <a class="button pill checkout no-margin-bottom button-orange center-block" href="{{url('/subscribe-custom')}}">Subscribe Now</a>
                    </div>

                    <p>If you’d like to know more – please check out our <a href = "{{url('/faqs')}}" class = "link">FAQ’s</a></p>

                </div>
            {{--</div>--}}
        {{--</div>--}}

    </div>
@stop