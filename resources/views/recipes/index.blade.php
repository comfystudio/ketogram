@extends('layouts/layout')

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
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">Recipes</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Intro Title Section 2 End -->


        <!-- Intro Title Section 2 -->
        <div class="section-block pt-20 pb-20">
            <div class="row">
                <div class="column width-3">
                    <div class="widget">
                        <h3 class="widget-title widget-title-long">Search</h3>
                        <div class="search-form-container site-search">
                            <form action="#" method="get" novalidate>
                                <div class="row">
                                    <div class="column width-12">
                                        <div class="field-wrapper">
                                            <input type="text" name="keywords" value = "{{Request::query('keywords')}}" class="form-search form-element" placeholder="Type &amp; hit enter...">
                                            <span class="border"></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="form-response"></div>
                        </div>
                    </div>
                </div>

                <div class="column width-6 offset-3">
                    <h3 class="widget-title widget-title-long">Tags</h3>
                    <ul>
                        @foreach($categories as $category)
                            <li class = "post-categories widget-title-long"><a @if(Request::query('category') == $category) class = "current" @endif href = "/recipes?category={{$category}}">{{$category}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- Intro Title Section 2 End -->

        <!-- Masonry Blog Grid -->
            <div class="section-block content-inner blog-masonry grid-container fade-in-progressively full-width no-margins pt-30" data-layout-mode="masonry" data-grid-ratio="1" data-animate-resize data-set-dimensions data-animate-resize-duration="600">
                <div class="row">
                    <div class="column width-12">
                        <div class="row grid content-grid-4">

                            @foreach($recipes as $key => $recipe)
                                @if(isset($recipe->recipesImages[0]))
                                    <?php $size = getimagesize(env('APP_URL').'/'.$recipe->recipesImages[0]['image']);?>
                                    <?php
                                        if($size[0] / $size[1] <= 0.5){
                                            $string = 'portrait';
                                        }elseif($size[0] / $size[1] <= 1){
                                            $string = '';
                                        }else{
                                            $string = 'wide';
                                        }
                                    ?>
                                @else
                                    <?php $string = 'wide';?>
                                @endif
                                <div class="grid-item grid-sizer {{$string}}">
                                    <div class="thumbnail overlay-fade-img-scale-in" data-hover-easing="easeInOut" data-hover-speed="700" data-hover-bkg-color="#000000" data-hover-bkg-opacity="0.01">
                                        <a class="overlay-link" href="/recipes/{{$recipe->slug}}">
                                            @if(isset($recipe->recipesImages[0]))<img src="/{{$recipe->recipesImages[0]['image']}}" alt="{{$recipe->recipesImages[0]['title']}}" />@endif
                                            <span class="overlay-info">
                                                <span>
                                                    <span>
                                                        <div class = "overlay-text">
                                                            <span class="post-title">{{$recipe->title}}</span>
                                                            <span class="post-info">{{date("F d, Y", strtotime($recipe->publish_date))}}</span>
                                                        </div>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Masonry Blog Grid End -->

        {{$recipes->links('partials/paginator')}}
    </div>
    <!-- Content End -->
@stop