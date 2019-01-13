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
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">Login</h1>
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
                        <form class="form-horizontal login-form" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}
                            @if(isset($back) && !empty($back))
                                <input type = "hidden" name="back" value="{{$back}}">
                            @endif
                            <div class="row">
                                <div class="column width-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="field-wrapper">
                                        <input id="email" type="email" class="form-fname form-element large text-medium" placeholder="Email*" name="email" value="{{ old('email') }}" required autofocus>
                                    </div>
                                </div>

                                <div class="column width-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="field-wrapper">
                                        <input id="password" type="password" class="form-fname form-element large text-medium" placeholder="Password*" name="password" value="{{ old('password') }}" required>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="column width-6">
                                    <div class="field-wrapper">
                                        <input id="checkbox-1" class="form-element checkbox rounded" name="checkbox" type="checkbox">
                                        <label for="checkbox-1" class="checkbox-label text-small">Remember Me</label>
                                    </div>
                                </div>

                                <div class="column width-6">
                                    <label class="checkbox-label"><a class="btn btn-link text-small" href="{{ url('/password/reset') }}">Forgot your password?</a></label>
                                </div>
                            </div>

                            <div class="row center">
                                <div class="column width-12">
                                    <input type="submit" value="Login" class="form-submit button border-theme bkg-hover-theme color-theme color-hover-white button-orange">
                                    <a href = "{{url('/register')}}" class="button pill bkg-theme text-uppercase button-blue text-xlarge text-bold uppercase"><span></span>Register</a>
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
