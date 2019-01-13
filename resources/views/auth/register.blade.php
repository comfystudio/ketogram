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
                        <h1 class="font-alt-1 weight-bold mb-0 color-white center">Register</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Intro Title Section 2 End -->

    <!-- Form Advanced -->
    <div class="section-block replicable-content bkg-grey-ultralight" >
        <div class = "row">
            <div class="column width-8 offset-2 pb-20">
                @include('partials.admin.error-form')

                @include('partials.admin.success-form')
            </div>
        </div>

        <div class="row">
            <div class="column width-8 offset-2 border-form">
                <div class="contact-form-container">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="column width-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="field-wrapper">
                                    <input id="name" type="text" class="form-fname form-element large text-medium" placeholder="Full Name *" name="name" value="{{ old('name') }}" required autofocus>
                                </div>
                            </div>

                            <div class="column width-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="field-wrapper">
                                    <input id="email" type="email" class="form-fname form-element large text-medium" placeholder="Email *" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class = "row">
                            <div class="column width-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="field-wrapper">
                                    <input id="password" type="password" class="form-fname form-element large text-medium" placeholder="Password *" name="password" value="{{ old('password') }}" required>
                                </div>
                            </div>

                            <div class="column width-6 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <div class="field-wrapper">
                                    <input id="password_confirmation" type="password" class="form-fname form-element large text-medium" placeholder="Confirm Password *" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row center">
                            <div class="column width-12">
                                <input type="submit" value="Register" class="form-submit button border-theme bkg-hover-theme color-theme color-hover-white button-orange">
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
