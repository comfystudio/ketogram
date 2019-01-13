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
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">{{$recipes->title}}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Intro Title Section 2 End -->

        <div class="section-block clearfix pt-40 no-padding-bottom">
            <div class="row">

                <!-- Content Inner -->
                <div class="column width-9 push-3 content-inner blog-regular">
                    <div class="post">
                        <div class="post-media">
                            <div class="tm-slider-container">
                                <ul class="tms-slides">
                                    @foreach($recipes->recipesImages as $key => $image)
                                        <li class="tms-slide" id="tms-slide-{{$key}}" data-image>
                                            <img data-src="../{{$image['image']}}" src="../{{$image['image']}}">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        {{--<div class="post-content with-background">--}}
                            {{--<h3>{{$recipes->title}} - <i style = "font-size: smaller; font-weight: normal;" >{{date("F d, Y", strtotime($recipes->publish_date))}}</i></h3>--}}
                            {{--<p> {!! $recipes->text !!}</p>--}}
                        {{--</div>--}}

                        <!-- Related Info -->
                        <div class="row product-related mt-40">
                            <div class="column width-12">
                                <div class="tabs product-tabs style-2">
                                    <ul class="tab-nav">
                                        <li class="active">
                                            <a href="#tabs-1-pane-1">Description</a>
                                        </li>
                                        <li>
                                            <a href="#tabs-1-pane-2">Nutritional Info</a>
                                        </li>
                                        {{--<li>--}}
                                            {{--<a href="#tabs-1-pane-3" id="reviews">Reviews (3)</a>--}}
                                        {{--</li>--}}
                                    </ul>
                                    <div class="tab-panes">
                                        <div id="tabs-1-pane-1" class="active animate">
                                            <div class="tab-content">
                                                <h3>{{$recipes->title}} - <i style = "font-size: smaller; font-weight: normal;" >{{date("F d, Y", strtotime($recipes->publish_date))}}</i></h3>
                                                <p>{!! $recipes->text !!}</p>
                                            </div>
                                        </div>
                                        <div id="tabs-1-pane-2">
                                            <div class="tab-content">
                                                <section class="performance-facts">
                                                    <header class="performance-facts__header">
                                                        <h1 class="performance-facts__title">Nutrition Facts</h1>
                                                        <p>Serving Size {{$recipes->serving}}
                                                        {{--<p>Serving Per Container 8</p>--}}
                                                    </header>
                                                    <table class="performance-facts__table">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="3" class="small-info">
                                                                Amount Per Serving
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th colspan="2">
                                                                <b>Calories</b>
                                                                {{$recipes->cals}}
                                                            </th>
                                                            <td>
                                                                Calories from Fat
                                                                {{$recipes->fat * 9}}
                                                            </td>
                                                        </tr>

                                                        <tr class="thick-row">
                                                            <td colspan="3" class="small-info">
                                                                <b>% Daily Value*</b>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th colspan="2">
                                                                <b>Total Fat</b>
                                                                {{$recipes->fat}}g
                                                            </th>
                                                            <td>
                                                                <b>{{round(($recipes->fat / 70) * 100)}}%</b>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="blank-cell">
                                                            </td>
                                                            <th>
                                                                Saturated Fat
                                                                {{$recipes->sat_fat}}g
                                                            </th>
                                                            <td>
                                                                <b>{{round(($recipes->sat_fat / 20) * 100)}}%</b>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                        <td class="blank-cell">
                                                            </td>
                                                                <th>
                                                                    Trans Fat
                                                                    {{$recipes->tran_fat}}g
                                                                </th>
                                                            <td>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th colspan="2">
                                                                <b>Cholesterol</b>
                                                                {{$recipes->cholesterol}}mg
                                                            </th>
                                                            <td>
                                                                <b>{{round(($recipes->cholesterol / 300) * 100)}}%</b>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th colspan="2">
                                                                <b>Sodium</b>
                                                                 {{$recipes->salt}}mg
                                                            </th>
                                                            <td>
                                                                <b>{{round(($recipes->salt / 6) * 100)}}%</b>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th colspan="2">
                                                                <b>Total Carbohydrate</b>
                                                                {{$recipes->carbs}}g
                                                            </th>
                                                            <td>
                                                                <b>{{round(($recipes->carbs / 230) * 100)}}%</b>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="blank-cell">
                                                            </td>
                                                            <th>
                                                                Dietary Fiber
                                                                {{$recipes->fibre}}g
                                                            </th>
                                                            <td>
                                                                <b>{{round(($recipes->fibre / 24) * 100)}}%</b>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="blank-cell">
                                                            </td>
                                                            <th>
                                                                Sugars
                                                                {{$recipes->sugar}}
                                                            </th>
                                                            <td>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            @if(($recipes->carbs - $recipes->polyol) < 5)
                                                                <th colspan="2" style = "color:#008f95;">
                                                                    <b>Impact Carbs</b>
                                                                    {{$recipes->carbs - $recipes->polyol}}g
                                                                </th>
                                                            @else
                                                                <th colspan="2" style = "color:red;">
                                                                    <b>Impact Carbs</b>
                                                                    {{$recipes->carbs - $recipes->polyol}}g
                                                                </th>
                                                            @endif

                                                            <td>
                                                            </td>
                                                        </tr>

                                                        <tr class="thick-end">
                                                            <th colspan="2">
                                                                <b>Protein</b>
                                                                {{$recipes->protein}}g
                                                            </th>
                                                            <td>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    </table>

                                                <table class="performance-facts__table--grid">
                                                    {{--<tbody>--}}
                                                        {{--<tr>--}}
                                                            {{--<td colspan="2">--}}
                                                            {{--Vitamin A--}}
                                                            {{--10%--}}
                                                            {{--</td>--}}
                                                            {{--<td>--}}
                                                            {{--Vitamin C--}}
                                                            {{--0%--}}
                                                            {{--</td>--}}
                                                        {{--</tr>--}}

                                                        {{--<tr class="thin-end">--}}
                                                            {{--<td colspan="2">--}}
                                                                {{--Calcium--}}
                                                                {{--10%--}}
                                                            {{--</td>--}}
                                                            {{--<td>--}}
                                                                {{--Iron--}}
                                                                {{--6%--}}
                                                            {{--</td>--}}
                                                        {{--</tr>--}}
                                                    {{--</tbody>--}}
                                                </table>

                                                <p class="small-info">* Percent Daily Values are based on a 2,000 calorie diet. Your daily values may be higher or lower depending on your calorie needs:</p>

                                                {{--<p class="small-info">--}}

                                                {{--</p>--}}
                                                <p class="small-info text-center">
                                                    Calories per gram:
                                                    Fat 9
                                                    &bull;
                                                    Carbohydrate 4
                                                    &bull;
                                                    Protein 4
                                                </p>

                                                </section>
                                                {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Related Info End -->
                    </div>
                </div>
                <!-- Content Inner End -->

                <!-- Sidebar -->
                <aside class="column width-3 pull-9 sidebar left">
                    <div class="sidebar-inner">
                        <div class="widget">
                            <h3 class="widget-title">Search</h3>
                            <div class="search-form-container site-search">
                                <form action="/blog" method="get" novalidate>
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
                        <div class="widget">
                            <h3 class="widget-title">Tags</h3>
                            <ul>
                                @foreach($categories as $category)
                                    <li class = "post-categories"><a @if(Request::query('keywords') == $category) class = "current" @endif href = "/recipes?category={{$category}}">{{$category}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget">
                            <div class="box bkg-grey-ultralight mb-50">
                                <h3 class="widget-title">Recipes</h3>
                                <p>We love to try and recreate Keto friendly recipes from around the web. This section highlights our attempts and our verdict on how easy/tasty we find them. Hopefully these will give you some inspiration. If there are any recipes you'd like us to try let us know! All links to the recipe we followed is linked withing the recipe post.<p>
                            </div>
                        </div>

                        <div class="widget">
                            <ul class="social-list list-horizontal">
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{env('APP_URL')}}%2Frecipes%2F{{$recipes->slug}}" target="_blank" title="facebook"><span class="icon-facebook-with-circle medium"></span></a></li>
                                <li><a href="https://plus.google.com/share?url={{env('APP_URL')}}%2Frecipes%2F{{$recipes->slug}}" target="_blank" title="googleplus"><span class="icon-google-with-circle medium"></span></a></li>
                                <li><a href="https://twitter.com/intent/tweet?text={{$recipes->title}}&amp;url={{env('APP_URL')}}%2Frecipes%2F{{$recipes->slug}}" target="_blank" title="twitter"><span class="icon-twitter-with-circle medium"></span></a></li>
                                <li><a href="http://pinterest.com/pin/create/button/?url={{env('APP_URL')}}%2Frecipes%2F{{$recipes->slug}}&description={{$recipes->title}}" target="_blank" title="pinterest"><span class="icon-pinterest-with-circle medium"></span></a></li>
                            </ul>
                        </div>

                        <div class="widget">
                            <h3 class="widget-title">Instagram</h3>
                            <!-- Instagram -->
                            <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-version="7" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:658px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:8px;"> <div style=" background:#F8F8F8; line-height:0; margin-top:40px; padding:45.22727272727273% 0; text-align:center; width:100%;"> <div style=" background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsCAMAAAApWqozAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAMUExURczMzPf399fX1+bm5mzY9AMAAADiSURBVDjLvZXbEsMgCES5/P8/t9FuRVCRmU73JWlzosgSIIZURCjo/ad+EQJJB4Hv8BFt+IDpQoCx1wjOSBFhh2XssxEIYn3ulI/6MNReE07UIWJEv8UEOWDS88LY97kqyTliJKKtuYBbruAyVh5wOHiXmpi5we58Ek028czwyuQdLKPG1Bkb4NnM+VeAnfHqn1k4+GPT6uGQcvu2h2OVuIf/gWUFyy8OWEpdyZSa3aVCqpVoVvzZZ2VTnn2wU8qzVjDDetO90GSy9mVLqtgYSy231MxrY6I2gGqjrTY0L8fxCxfCBbhWrsYYAAAAAElFTkSuQmCC); display:block; height:44px; margin:0 auto -44px; position:relative; top:-22px; width:44px;"></div></div> <p style=" margin:8px 0 0 0; padding:0 4px;"> <a href="https://www.instagram.com/p/BcDbYbLhqQ5/" style=" color:#000; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none; word-wrap:break-word;" target="_blank">Love finding new snacks!? Snacks are our favourite! And we are so busy here at Ketogram HQ sourcing some awesome UK products to include in our monthly subscription box. We&#39;re confident this will be the face you make when you receive a Ketogram! To keep up to date with our launch progress and get 20% off your first box, sign up at http://www.ketogram.co.uk. Where&#39;s the harm in that! 😊 Launching January 2018 http://www.ketogram.co.uk. Sign up now for 20% off your first order! #keto #ketouk #ketogenicdiet #ketofoods #ketodiet #lowsugar #lowcarb #highfat #lchf #lchfuk #ketoislife #lowcarblifestyle #ketogram</a></p> <p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">A post shared by Ketogram (@ketogramuk) on <time style=" font-family:Arial,sans-serif; font-size:14px; line-height:17px;" datetime="2017-11-21T22:56:49+00:00">Nov 21, 2017 at 2:56pm PST</time></p></div></blockquote> <script async defer src="//platform.instagram.com/en_US/embeds.js"></script>                        </div>
                    </div>
                </aside>
                <!-- Sidebar End -->

            </div>
        </div>
    </div>
    <!-- Content End -->
@stop