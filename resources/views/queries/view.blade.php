@extends('layouts.layout')

@section('content')

    <!-- Content -->
    <div class="content clearfix">
        <!-- Intro Title Section 2 -->
        <div class="section-block background-aqua pt-150 pb-100">
            <div class="media-overlay"></div>
            <div class="row">
                <div class="column width-12">
                    <div class="title-container">
                        <div class="title-container-inner">
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">Newsletter</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Intro Title Section 2 End -->

         <!-- Intro -->
            <div class="section-block pb-0 pt-70">
                <div class="row">
                    <div class="column width-10 offset-1 center">
                        <p class="lead weight-regular mb-70 text-medium">If you'd like to keep up to date with any new products we add to our shop or would like to benefit from our offers just sign up below for our newsletter, and you will receive 15% of your first order!</p>
                    </div>
                    <div class="column width-12">
                        <hr class="mb-70">
                    </div>
                </div>
            </div>
            <!-- Intro End -->

        <!-- Form Advanced -->
        <div class="section-block replicable-content pt-10">
            <div class = "row">
                <div class="column width-8 offset-2 pb-20">
                    @include('partials.admin.error-form')

                    @include('partials.admin.success-form')
                </div>
            </div>

            <div class="row">
                <div class="column width-8 offset-2 border-form">
                    <div class="contact-form-container">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/queries/create') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="column width-12 {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="field-wrapper">
                                        <input id="email" type="email" class="form-fname form-element large text-medium" placeholder="Email*" name="email" value="{{ old('email') }}" required autofocus>
                                    </div>
                                </div>
                            </div>

                            <div class="row center">
                                <div class="column width-12">
                                    <input type="submit" value="Login" class="form-submit button border-theme bkg-hover-theme color-theme color-hover-white button-orange">
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
@stop
