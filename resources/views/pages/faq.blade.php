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
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">FAQ's</h1>
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
                    <p class="lead weight-regular mb-70">We’ve tried to come up with every possible question you might have regarding Ketogram but if we’ve missed anything, please do not hesitate to contact us.</p>
                </div>
                <div class="column width-12">
                    <hr class="mb-70">
                </div>
            </div>
        </div>
        <!-- Intro End -->

        <!-- Accordions Style Default Multiple Open -->
        <div class="section-block pb-0 pt-20">
            <div class="row">
                <div class="column width-3 mt-20">
                    <h3 class="mb-50 center">About Ketogram</h3>
                </div>
                <div class="column width-9">
                    <div class="accordion rounded" data-toggle-icon data-toggle-multiple>
                        <ul>
                            <li class="active">
                                <a href="#accordion-2-panel-1">What is Ketogram?</a>
                                <div id="accordion-2-panel-1">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">Ketogram is a monthly subscription of approximately 6-8 keto friendly snacks delivered to your doorstep. We want to help you to discover new snacks to include in your keto lifestyle and ship them to you in the most cost effective way. In the UK it is particularly difficult to find keto friendly snacks which are less that 5g net carbs per serving, which is why we created Ketogram. We talk more about ourselves <a href = "/blog" class = "color-orange">here</a> or you can <a href = "/register" class = "color-orange">sign up here</a> to see what the fuss is about!</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-2">What will I get in my Ketogram Boxes?</a>
                                <div id="accordion-2-panel-2">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">The standard Ketogram subscription box will include 6-8 keto friendly foods which we think you will love! Not only will you get snacks, you will also get items for creating your own keto friendly food, a recipe card featuring that months product, and sometimes it will even include some interesting Keto foods which you might want to try! These products have been sourced from the UK.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-3">How much does it cost?</a>
                                <div id="accordion-2-panel-3">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">Both subscription options are priced at £30 and include postage and packing. </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-4">Is Ketogram only for Keto diets/lifestyle?</a>
                                <div id="accordion-2-panel-4">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">Not at all! Ketogram products are suitable for anyone but it particularly caters for people who follow a ketogenic or low carb diet/lifestyle. We include the nutritional content in all of our products so you can make informed decisions for your diet choices.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-5">Why should I pay for Ketogram when I can just buy the snacks I want at any supermarket?</a>
                                <div id="accordion-2-panel-5">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">Part of the inspiration of Ketogram was based on the difficulty of finding keto friendly products in the UK. The subscription service is to allow you to discover items that you may not have been aware of, or that is not easily found in most supermarkets. Buying direct online can be costly once shipping is included if you purchase from multiple brands. If there is some that you have found that you would like to see us offer - let us know! <a href="mailto:hello@ketogram.co.uk" class = "color-orange">hello@ketogram.co.uk</a></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-6">How many net carbs are in these products?</a>
                                <div id="accordion-2-panel-6">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">The subscription boxes each have a 5g net carb serving limit for any product that is included. Some of our products are low carb rather than Keto friendly and are tagged as such on the item page. Each product in our store has the nutritional information available to help you make informed choices.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-7">Are your products Vegan? Kosher? Diary Free? Gluten Free? Peanut Free?</a>
                                <div id="accordion-2-panel-7">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">We have tagged our products with labels which will help you filter by Vegan, Organic, Gluten Free etc.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-9">Can I buy a gift voucher?</a>
                                <div id="accordion-2-panel-9">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">Unfortunately we do not offer gift vouchers at the moment but this is something we hope to offer in the near future.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Accordions Style Default Multiple Open End-->

        <div class="section-block pb-0">
            <div class="row">
                <div class="column width-3 mt-20">
                    <h3 class="mb-50 center">My Account and Billing</h3>
                </div>
                <div class="column width-9">
                    <div class="accordion rounded" data-toggle-icon data-toggle-multiple>
                        <ul>
                            <li class="active">
                                <a href="#accordion-2-panel-1">How does billing work?</a>
                                <div id="accordion-2-panel-1">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">When you subscribe, your payment will be processed on that date, and every subsequent month thereafter on the same date until you cancel. Orders are dispatched for delivery on the 15th. If you subscribe before the 15th, you will receive that months subscription. Any subscriptions sign ups after the 15th will begin to receive the subscription box from the following month.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-2">I just joined, when will I be billed again?</a>
                                <div id="accordion-2-panel-2">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">Your billing anniversary will be monthly, on the date you initially subscribed.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-3">How do I change my credit card information?</a>
                                <div id="accordion-2-panel-3">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">We do not store your credit card information, this is held by Stripe which is a secure ecommerce payment system. To update your credit card information, we would advise cancelling your subscription and signing up again with the updated credit card information.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-4">How do I change my address?</a>
                                <div id="accordion-2-panel-4">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">The delivery address can be changed in the Account Settings <a href = "/subscriptions/{{Auth::id()}}" class = "color-orange">here</a>.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-5">How do I cancel my subscription?</a>
                                <div id="accordion-2-panel-5">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">Boo, it’s sad to see you go :( Cancelling your subscription can be done anytime by logging into your account <a href = "/users/login" class = "color-orange">here</a>.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-6">When can I cancel my subscription?</a>
                                <div id="accordion-2-panel-6">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">Anytime! Your subscription will automatically renew based on the subscription billing period. Your card will automatically be charged the subscription fee until you cancel your subscription. You can cancel anytime by logging in on our site. </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-7">I cancelled my subscription but still received a box – why?</a>
                                <div id="accordion-2-panel-7">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">If you cancelled your subscription after the 15th of the month you will have already paid for the following month so you will receive a Ketogram.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-8">I want to get a refund or renewal – what do I do?</a>
                                <div id="accordion-2-panel-8">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">The subscription renews every month on your signup anniversary. You will be charged for the next month’s box if this is after the 15th which is our dispatch day. The last day to cancel the subscription without being charged for the next month is the 14th. If there are extraneous circumstances, please email us. The last day to get a refund is the last day of the month. Unfortunately we cannot offer a refund once the box has been posted.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-9">Where is my subscription box? I ordered a while ago…</a>
                                <div id="accordion-2-panel-9">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">If you ordered your subscription box after the 15th, your box will not arrive until the following month. We use Royal Mail to track our subscription boxes so please contact us <a href="mailto:hello@ketogram.co.uk" class = "color-orange">hello@ketogram.co.uk</a> if there are any issues.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-10">When is the renewal date?</a>
                                <div id="accordion-2-panel-10">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">The subscription renews every month on your signup anniversary.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Accordions Style Default Multiple Open End-->

        <div class="section-block pb-0">
            <div class="row">
                <div class="column width-3 mt-20">
                    <h3 class="mb-50 center">Postage</h3>
                </div>
                <div class="column width-9">
                    <div class="accordion rounded" data-toggle-icon data-toggle-multiple>
                        <ul>
                            <li class="active">
                                <a href="#accordion-2-panel-1">How much does postage cost? </a>
                                <div id="accordion-2-panel-1">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">Postage is included in the subscription price for the Standard subscription boxes.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-2">How long does it take to get my Ketogram?</a>
                                <div id="accordion-2-panel-2">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">Ketogram use Royal Mail 2nd Class signed for delivery service which typically takes around 3 working days.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-3">When does Ketogram ship?</a>
                                <div id="accordion-2-panel-3">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">Our Standard subscription boxes ship on the 15th of the month.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-4">Do you post to PO boxes?</a>
                                <div id="accordion-2-panel-4">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">Yes, we post to PO Boxes. It is up to the customer to ensure that their PO Box can cater for the subscription box.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#accordion-2-panel-5">Do you ship internationally or ROI?</a>
                                <div id="accordion-2-panel-5">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">Unfortunately we cannot offer our subscription box to international or ROI customers at this stage. Customers are responsible for ensuring the products are customs friendly for your country.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Accordions Style Default Multiple Open End-->

        <div class="section-block pb-0">
            <div class="row">
                <div class="column width-3 mt-20">
                    <h3 class="mb-50 center">Work with us</h3>
                </div>
                <div class="column width-9">
                    <div class="accordion rounded" data-toggle-icon data-toggle-multiple>
                        <ul>
                            <li class="active">
                                <a href="#accordion-2-panel-1">I would like to work with Ketogram – how can I make this happen?</a>
                                <div id="accordion-2-panel-1">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">We are always keen to discover new snacks from our customers. We make sure that we include high quality low carb snacks in Ketogram so we carefully vet our products to meet our customer’s needs. If your product is a snack food, with less than 5g net carbs and you believe your product is Keto friendly, please email us at <a href="mailto:hello@ketogram.co.uk" class = "color-orange">hello@ketogram.co.uk</a> We get very busy periods so please be patient and we will get back to you as soon as possible.</p>

                                        <p class="lead mb-20">If you are a social media guru and would like to work with our brand, we would always be interested in hearing from you. Please email us at <a href="mailto:hello@ketogram.co.uk" class = "color-orange">hello@ketogram.co.uk</a> and we will get back to you as soon as possible.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Accordions Style Default Multiple Open End-->

        <div class="section-block pb-0">
            <div class="row">
                <div class="column width-3 mt-20">
                    <h3 class="mb-50 center">Contact Us</h3>
                </div>
                <div class="column width-9">
                    <div class="accordion rounded" data-toggle-icon data-toggle-multiple>
                        <ul>
                            <li class="active">
                                <a href="#accordion-2-panel-1">How do I contact you?</a>
                                <div id="accordion-2-panel-1">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">We can be contacted anytime on our contact form or by email <a href="mailto:hello@ketogram.co.uk" class = "color-orange">hello@ketogram.co.uk</a> . Although we try to respond to all emails within a few hours, please allow up to 24 hours for a response – it can get very busy here at Ketogram Towers!</p>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <a href="#accordion-2-panel-2">Do you have a phone number?</a>
                                <div id="accordion-2-panel-2">
                                    <div class="accordion-content">
                                        <p class="lead mb-20">As a small team, we cannot currently offer telephone support. Although we try to respond to all emails within a few hours, please allow up to 24 hours for a response. If you have any questions you can contact us on our contact form or <a href="mailto:hello@ketogram.co.uk" class = "color-orange">hello@ketogram.co.uk</a></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Accordions Style Default Multiple Open End-->




    </div>
@stop