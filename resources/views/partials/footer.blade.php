        <!-- Footer -->
        <footer class="footer footer-fixed">
            <div class="footer-top two-columns-on-tablet">
                <div class="row flex">
                    <div class="column width-4">
                        <div class="widget">
                            <h4 class="widget-title weight-light">About</h4>
                            <p>Even with the best willpower in the world, it is not always possible to make the ‘right’ snack choices. Sometimes that choice is made even tougher when your lifestyle is LCHF, low carb or keto. Here at Ketogram we are all too familiar with this struggle!<br/><br/> Unlike fellow keto’ers who are States based, there is a real dearth of information on snacks which are LCHF or Keto friendly in the UK. To help bridge that gap we created Ketogram, the subscription box service which sources low carb, keto friendly snacks to help maintain a low carb lifestyle with a bit of flavour.</p>
                        </div>
                    </div>
                    <div class="column width-4">
                        <div class="widget">
                            <h4 class="widget-title weight-light">Ketogram News</h4>
                            <ul class="list-group large">
                                @if(isset($footerNews))
                                    @foreach($footerNews as $news)
                                        <li>
                                            <a href="{{url('/blog').'/'.$news->slug}}">{{$news->title}} </a>
                                            <span class="post-info"><span class="post-date">{{date("F j, Y", strtotime($news->publish_date))}}</span></span>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="column width-4">
                        @include('partials.admin.error-form')

                        @include('partials.admin.success-form')


                        <div class="widget">
                            <h4 class="widget-title">Never Miss Updates</h4>
                            <p class="mb-20">If you'd like to keep up to date to benefit from our offers just sign up below for our newsletter, and you will receive 15% of your first order!</p>
                            <div class="signup-form-container">
                                <form class="signup2" action="{{url('/queries/create')}}" method="post" novalidate id="newsletter-footer2">
                                <script>
                                    function onSubmitFooter() {
                                            grecaptcha.execute();
                                            document.getElementById("newsletter-footer2").submit();
                                        }
                                </script>
                                {{ csrf_field() }}
                                    <div class="row">
                                        <div class="column width-12 left">
                                            <div class="field-wrapper">
                                                <input type="email" name="email" class="form-email form-element no-padding-left no-padding-right" placeholder="Email address*" tabindex="2" required>
                                            </div>
                                        </div>
                                        <div
                                            class="g-recaptcha column width-4 offset-1 center"
                                            data-sitekey="6LeFzVoUAAAAAJGTOgjPp4Msr5Tz-0q__Y2P4VgH"
                                            data-callback="onSubmit">
                                        </div>
                                        <div class="special-field">
                                            <label for="birthday">Birthday</label>
                                            <input type="text" name="birthday" id="birthday" value="" />
                                        </div>
                                        <div class="column width-12 right">
                                            <input type="submit" value="Signup" id="recaptcha-submit2" class="form-submit button pill button-orange text-xlarge weight-bold uppercase">
                                        </div>
                                    </div>
                                    {{--<input type="submit" name="submit" class="form-honeypot form-element">--}}
                                </form>
                                <div class="form-response show pull-right" style="position: relative;">*No spamming here.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row">
                    <div class="column width-12">
                        <div class="footer-bottom-inner center">
                            <p class="copyright pull-left clear-float-on-mobile">
                                &copy; Ketogram Ltd. All Rights Reserved. <a href="{{url('/terms')}}">Terms &amp; Conditions</a> | <a href="{{url('/privacy')}}">Privacy policy</a> | <a href = "{{url('/about')}}">About Ketogram</a> | <a href = "{{url('/faqs')}}">FAQ's</a>
                            </p>
                            <ul class="social-list list-horizontal pull-right clear-float-on-mobile">
                                <li><a href="{{TWITTER}}" target="_blank"><span class="icon-twitter-with-circle medium"></span></a></li>
                                <li><a href="{{FACEBOOK}}" target="_blank"><span class="icon-facebook-with-circle medium"></span></a></li>
                                <li><a href="{{INSTAGRAM}}" target="_blank"><span class="icon-instagram-with-circle medium"></span></a></li>
                                <li><a href="{{PINTEREST}}" target="_blank"><span class="icon-pinterest-with-circle medium"></span></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="column width-12">
                        <p class="copyright pull-left clear-float-on-mobile">
                            Developed by <a href="https://comfystudio.com" target="_blank" alt="comfystudio" style="color:#01b1ae;">Comfystudio</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer End -->

    </div>
</div>