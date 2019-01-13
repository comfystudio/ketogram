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
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">Blog</h1>
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
                    @if(!empty($news[0]))
                        @foreach($news as $new)
                            <div class="post">
                                <div class="post-media">
                                    <div class="thumbnail overlay-fade-img-scale-in" data-hover-easing="easeInOut" data-hover-speed="700" data-hover-bkg-color="#000000" data-hover-bkg-opacity="0.01">
                                        <a class="overlay-link" href="/blog/{{$new->slug}}">
                                            @if(isset($new->newsImages[0]))<img src="/{{$new->newsImages[0]['image']}}" alt="{{$new->newsImages[0]['title']}}" />@endif
                                            <span class="overlay-info">
                                                <span>
                                                    <span>
                                                        <div class = "overlay-text">
                                                            <span class="post-title">{{$new->title}}</span>
                                                            <span class="post-info"><span class="post-date">{{date("F d, Y", strtotime($new->publish_date))}}</span></span>
                                                        </div>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="post-content with-background">
                                    <p>{!! str_limit(strip_tags($new->text), 200) !!}</p>
                                    <a href="/blog/{{$new->slug}}" class="read-more"><span class="icon-right-open-mini"></span> More</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="post">
                            <div class="post-media">
                                <div class="thumbnail overlay-fade-img-scale-in" data-hover-easing="easeInOut" data-hover-speed="700" data-hover-bkg-color="#000000" data-hover-bkg-opacity="0.01">
                                </div>
                                 <div class="post-content with-background">
                                    <p>No Blogs :(</p>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                <!-- Content Inner End -->

                <!-- Sidebar -->
                <aside class="column width-3 pull-9 sidebar left">
                    <div class="sidebar-inner">
                        <div class="widget">
                            <h3 class="widget-title">Search</h3>
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
                        <div class="widget">
                            <h3 class="widget-title">Tags</h3>
                            <ul>
                                @foreach($categories as $category)
                                    <li class = "post-categories"><a @if(Request::query('category') == $category) class = "current" @endif href = "/blog?category={{$category}}">{{$category}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget">
                            <div class="box bkg-grey-ultralight mb-50">
                                <h3 class="widget-title">About</h3>
                                <p><strong>What's in our blog? </strong>As well as including some insights on all things keto - here you'll find some sneak peeks of upcoming boxes, new products in our shop and much much more.<p>
                            </div>
                        </div>

                        <div class="widget">
                            <h3 class="widget-title">Instagram</h3>
                            <!-- Instagram -->
                            <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-version="7" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:658px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:8px;"> <div style=" background:#F8F8F8; line-height:0; margin-top:40px; padding:45.22727272727273% 0; text-align:center; width:100%;"> <div style=" background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsCAMAAAApWqozAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAMUExURczMzPf399fX1+bm5mzY9AMAAADiSURBVDjLvZXbEsMgCES5/P8/t9FuRVCRmU73JWlzosgSIIZURCjo/ad+EQJJB4Hv8BFt+IDpQoCx1wjOSBFhh2XssxEIYn3ulI/6MNReE07UIWJEv8UEOWDS88LY97kqyTliJKKtuYBbruAyVh5wOHiXmpi5we58Ek028czwyuQdLKPG1Bkb4NnM+VeAnfHqn1k4+GPT6uGQcvu2h2OVuIf/gWUFyy8OWEpdyZSa3aVCqpVoVvzZZ2VTnn2wU8qzVjDDetO90GSy9mVLqtgYSy231MxrY6I2gGqjrTY0L8fxCxfCBbhWrsYYAAAAAElFTkSuQmCC); display:block; height:44px; margin:0 auto -44px; position:relative; top:-22px; width:44px;"></div></div> <p style=" margin:8px 0 0 0; padding:0 4px;"> <a href="https://www.instagram.com/p/BcDbYbLhqQ5/" style=" color:#000; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none; word-wrap:break-word;" target="_blank">Love finding new snacks!? Snacks are our favourite! And we are so busy here at Ketogram HQ sourcing some awesome UK products to include in our monthly subscription box. We&#39;re confident this will be the face you make when you receive a Ketogram! To keep up to date with our launch progress and get 20% off your first box, sign up at http://www.ketogram.co.uk. Where&#39;s the harm in that! 😊 Launching January 2018 http://www.ketogram.co.uk. Sign up now for 20% off your first order! #keto #ketouk #ketogenicdiet #ketofoods #ketodiet #lowsugar #lowcarb #highfat #lchf #lchfuk #ketoislife #lowcarblifestyle #ketogram</a></p> <p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">A post shared by Ketogram (@ketogramuk) on <time style=" font-family:Arial,sans-serif; font-size:14px; line-height:17px;" datetime="2017-11-21T22:56:49+00:00">Nov 21, 2017 at 2:56pm PST</time></p></div></blockquote> <script async defer src="//platform.instagram.com/en_US/embeds.js"></script>
                        </div>
                    </div>
                </aside>
                <!-- Sidebar End -->

            </div>
        </div>

        {{$news->links('partials/paginator')}}
    </div>
    <!-- Content End -->
@stop