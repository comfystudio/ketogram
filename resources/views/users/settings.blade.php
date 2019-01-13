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
                        <h1 class="font-alt-1 weight-bold mb-0 color-white center">Settings</h1>
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

        <!-- Intro -->
        {{--<div class="section-block pb-0 pt-70">--}}
            <div class="row">
                <div class="column width-10 offset-1 center">
                    <p class="lead weight-regular mb-40 text-large">Change Password</p>
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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/settings') }}/{{Auth::id()}}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="column width-12 {{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="field-wrapper">
                                    <input id="password" type="password" class="form-fname form-element large text-medium" placeholder="Current Password *" name="password" value="{{ old('password') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class = "row">
                            <div class="column width-6 {{ $errors->has('new_password') ? ' has-error' : '' }}">
                                <div class="field-wrapper">
                                    <input id="new_password" type="password" class="form-fname form-element large text-medium" placeholder="New Password *" name="new_password" value="{{ old('new_password') }}" required>
                                </div>
                            </div>


                            <div class="column width-6{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <div class="field-wrapper">
                                    <input id="password_confirmation" type="password" class="form-fname form-element large text-medium" placeholder="Confirm Password *" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class = "row">
                            <div class="row center">
                                <div class="column width-12">
                                    <input type="submit" value="Change Password" class="form-submit button border-theme bkg-hover-theme color-theme color-hover-white button-orange">
                                </div>
                            </div>
                        </div>

                    </form>
                    <div class="form-response"></div>
                </div>
            </div>
        </div>

        <!-- Intro -->
        {{--<div class="section-block pb-0 pt-70">--}}
            <div class="row pt-70">
                <div class="column width-10 offset-1 center">
                    <p class="lead weight-regular mb-40 text-large">Change Email</p>
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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/change-email') }}/{{Auth::id()}}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="column width-12 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="field-wrapper">
                                    <input id="email" type="email" class="form-fname form-element large text-medium" placeholder="Current Email *" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class = "row">
                            <div class="row center">
                                <div class="column width-12">
                                    <input type="submit" value="Change Email" class="form-submit button border-theme bkg-hover-theme color-theme color-hover-white button-orange">
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
