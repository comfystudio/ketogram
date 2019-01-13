@extends('layouts/layout')

@section('content')
    <div class="content clearfix">
        <!-- Intro Title Section 2 -->
        <div class="section-block background-aqua pt-100 pb-50">
            <div class="media-overlay"></div>
            <div class="row">
                <div class="column width-12">
                    <div class="title-container">
                        <div class="title-container-inner">
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">About Ketogram</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Intro Title Section 2 End -->

        <div class="section-block pb-0 pt-20">
            <div class="row">
                <div class="column offset-1 width-10">
                    <div class="cart-totals box xlarge bkg-grey-ultralight">
                        <p class="text-medium"> Our mission is to bring people easy, delicious keto and low carb friendly products.</p>

                        <p class="text-medium">Even with the best willpower in the world, it is not always possible to make the ‘right’ snack choices. Sometimes that choice is made even tougher when your lifestyle is LCHF, low carb or keto. Here at Ketogram we are all too familiar with this struggle! Unlike fellow keto’ers who are States based, there is a real dearth of information on snacks which are LCHF or Keto friendly in the UK. To help bridge that gap we created Ketogram, the subscription box service which sources low carb, keto friendly snacks to help maintain a low carb lifestyle with a bit of flavour.</p>
                        <div class="column width-12">
                            @include('partials.admin.error-form')

                            @include('partials.admin.success-form')


                            <div class="widget pb-50 text-medium">
                                <h2 class="widget-title center">Signup For Notifications</h2>
                                <p class="mb-20">If you'd like to keep up to date to benefit from our offers just sign up below for our newsletter, and you will receive 15% of your first order!</p>
                                <div class="signup-form-container">
                                    <form class="signup" action="{{url('/queries/create')}}" method="post" novalidate>
                                    {{ csrf_field() }}
                                        <div class="row">
                                            <div class="column width-12 left">
                                                <div class="field-wrapper">
                                                    <input type="email" name="email" class="form-email form-element no-padding-left no-padding-right" placeholder="Email address*" tabindex="2" required>
                                                </div>
                                            </div>
                                            <div class="column width-12 center">
                                                <input type="submit" value="Signup" class="form-submit button pill button-orange text-large">
                                            </div>
                                        </div>
                                        {{--<input type="submit" name="submit" class="form-honeypot form-element">--}}
                                    </form>
                                </div>
                            </div>
                        </div>

                        <p class="text-medium">If you’d like to know more – please check out our <a href = "{{url('/faqs')}}" class = "link">FAQ’s</a></p>

                        <p class="text-smallest"><i>Ketogram is the trading name of Ketogram Ltd., registered in Northern Ireland (Company Number: NI649506)</i></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop