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
                            <h1 class="font-alt-1 weight-bold mb-0 color-white center">Checkout</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Intro Title Section 2 End -->

        <!-- Checkout -->
        <div class="section-block cart-overview pt-20">
            <div class="row">
                <div class="column width-8 offset-2 pb-20">
                    @include('partials.admin.error-form')

                    @include('partials.admin.success-form')
                </div>

                <div class="column width-5 push-7">
                    <div class="aux-details box large">
                        <div class="accordion product-addtional-info style-2">
                            <ul>
                                <li class="active payment-additional-info">
                                    <a href="#accordion-coupon">Have a Coupon? Click to Enter</a>
                                    <div id="accordion-coupon">
                                        <div class="accordion-content">
                                            <div class="cart-coupon-form-container">
                                                <form class="cart-coupon-form" action="" method="post" id="checkout-coupon-form" novalidate>
                                                    <input type="text" id="form-coupon-code" class="form-element" name="coupon" placeholder="Coupon Code">
                                                    <input type="submit" value="Apply" class="form-submit button pill no-margin-bottom">
                                                </form>
                                            </div>
                                            <p id = "checkout-coupon-error" class = "text-center" style = "color:red;font-weight: bold; display: none;">

                                            </p>
                                            <p id = "checkout-coupon-success" class = "text-center" style = "color:green;font-weight: bold; display: none;">

                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h5>Need Assistance?</h5>
                        <p>Experiencing an issue and require help? <a class = "link" href="mailto:hello@ketogram.co.uk">Contact Us</a></p>
                    </div>

                    <div class="aux-details box large">
                        <h5 class="mb-30">Order Overview</h5>
                        <div class="cart-review">
                            <table class="table non-responsive">
                                <thead>
                                    <tr>
                                        <th class="product-name">Product Name</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        <tr class="cart-item">
                                            <td class="product-name">
                                                <a href="/items/{{$item->id}}" class="product-title">{{$item->title}} x {{$item->quantity}}</a>
                                            </td>
                                            <td class="product-subtotal">
                                                @if(isset($item->itemSales[0]) && !empty($item->itemSales[0]))
                                                    <span class="amount checkout-item" data-price="{{$item->itemSales[0]['price'] * $item->quantity}}">£{{$item->itemSales[0]['price'] * $item->quantity}}</span>
                                                @else
                                                     <span class="amount checkout-item" data-price="{{$item->price * $item->quantity}}">£{{$item->price * $item->quantity}}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr class="cart-item coupon-subtitle" style="display: none;">
                                        <td class="product-name">
                                            <a class="product-title" style="color:green;">Coupon</a>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount" id="cart-coupon" data-price="1" style ="color:green;"></span>
                                        </td>
                                    </tr>

                                    <span class="hide" id="checkout-weight" data-weight="{{$items->totalWeight}}"></span>

                                    <tr class="cart-item">
                                        <td class="product-name">
                                            <a class="product-title">Postage and Packaging</a>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount" id="checkout-postage" data-price="{{$items->postage}}">£{{$items->postage}}</span>
                                        </td>
                                    </tr>

                                    <tr class="cart-order-total">
                                        <th>Total</th>
                                        <td class = "product-subtotal"><span class="amount" id="checkout-total" data-price="{{$items->totalPrice + $items->postage}}">£{{$items->totalPrice + $items->postage}}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="checkout-payment">
                            <div class="cart-actions left center-on-mobile pt-20">
                                <a class="button pill checkout no-margin-bottom" id="checkout-button">Place Your Order</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="column width-7 pull-5">
                    <div class="payment-details box large">
                        <div class="tabs style-2">
                            <ul class="tab-nav">
                                <li class="active">
                                    <a href="#tabs-1-pane-1">Delivery Address</a>
                                </li>
                            </ul>
                            <div class="tab-panes">
                                <div id="tabs-1-pane-1" class="active animate">
                                    <div class="tab-content">
                                        <div class="billing-form-container">
                                            <form id="checkout-form" class="billing-form" action="{{url('/payment')}}" method="post" novalidate>
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <input type="hidden" name="coupon">
                                                    <input type="hidden" name="total" value = "{{$items->totalPrice + $items->postage}}">
                                                    <div class="column width-12 {{ $errors->has('address_1') ? ' has-error' : '' }}">
                                                        <input type="text" name="address_1" value="{{isset($previousOrderAddress[0]) ? $previousOrderAddress[0]->address_1 : old('address_1')}}" class="form-billing-address form-element large" placeholder="Billing Address*" tabindex="6" required>
                                                    </div>
                                                    <div class="column width-12 {{ $errors->has('address_2') ? ' has-error' : '' }}">
                                                        <input type="text" name="address_2" value="{{isset($previousOrderAddress[0]) ? $previousOrderAddress[0]->address_2 : old('address_2')}}" class="form-billing-address-2 form-element large" placeholder="Billing Address 2*" tabindex="7" required>
                                                    </div>
                                                    <div class="column width-6 {{ $errors->has('town') ? ' has-error' : '' }}">
                                                        <input type="text" name="town" value="{{isset($previousOrderAddress[0]) ? $previousOrderAddress[0]->town : old('town')}}" class="form-city form-element large" placeholder="Town*" tabindex="8" required>
                                                    </div>
                                                    <div class="column width-6 {{ $errors->has('county') ? ' has-error' : '' }}">
                                                        <input type="text" name="county" value="{{isset($previousOrderAddress[0]) ? $previousOrderAddress[0]->county : old('county')}}" class="form-city form-element large" placeholder="County*" tabindex="8" required>
                                                    </div>
                                                    <div class="column width-6 {{ $errors->has('postcode') ? ' has-error' : '' }}">
                                                        <input type="text" name="postcode" value="{{isset($previousOrderAddress[0]) ? $previousOrderAddress[0]->postcode : old('postcode')}}" class="form-zip-code form-element large" placeholder="Zip Code / Postcode*" tabindex="9" required>
                                                    </div>
                                                    <div class="column width-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                        <input type="text" name="phone" value="{{isset($previousOrderAddress[0]) ? $previousOrderAddress[0]->phone : old('phone')}}" class="form-zip-code form-element large" placeholder="Phone Number" tabindex="9">
                                                    </div>
                                                    <div class="column width-12 {{ $errors->has('country') ? ' has-error' : '' }}">
                                                        <div class="form-select form-element large">
                                                            <select name="country" id = "checkout-select-country" required tabindex="5">
                                                                <option value="United Kingdom" selected>United Kingdom</option>
                                                                <option value="Afghanistan" @if(old('country') == 'Afghanistan') selected @endif>Afghanistan</option>
                                                                <option value="Albania">Albania</option>
                                                                <option value="Algeria">Algeria</option>
                                                                <option value="American Samoa">American Samoa</option>
                                                                <option value="Andorra">Andorra</option>
                                                                <option value="Angola">Angola</option>
                                                                <option value="Anguilla">Anguilla</option>
                                                                <option value="Antartica">Antarctica</option>
                                                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                                <option value="Argentina">Argentina</option>
                                                                <option value="Armenia">Armenia</option>
                                                                <option value="Aruba">Aruba</option>
                                                                <option value="Australia">Australia</option>
                                                                <option value="Austria">Austria</option>
                                                                <option value="Azerbaijan">Azerbaijan</option>
                                                                <option value="Bahamas">Bahamas</option>
                                                                <option value="Bahrain">Bahrain</option>
                                                                <option value="Bangladesh">Bangladesh</option>
                                                                <option value="Barbados">Barbados</option>
                                                                <option value="Belarus">Belarus</option>
                                                                <option value="Belgium">Belgium</option>
                                                                <option value="Belize">Belize</option>
                                                                <option value="Benin">Benin</option>
                                                                <option value="Bermuda">Bermuda</option>
                                                                <option value="Bhutan">Bhutan</option>
                                                                <option value="Bolivia">Bolivia</option>
                                                                <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                                                                <option value="Botswana">Botswana</option>
                                                                <option value="Bouvet Island">Bouvet Island</option>
                                                                <option value="Brazil">Brazil</option>
                                                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                                <option value="Bulgaria">Bulgaria</option>
                                                                <option value="Burkina Faso">Burkina Faso</option>
                                                                <option value="Burundi">Burundi</option>
                                                                <option value="Cambodia">Cambodia</option>
                                                                <option value="Cameroon">Cameroon</option>
                                                                <option value="Canada">Canada</option>
                                                                <option value="Cape Verde">Cape Verde</option>
                                                                <option value="Cayman Islands">Cayman Islands</option>
                                                                <option value="Central African Republic">Central African Republic</option>
                                                                <option value="Chad">Chad</option>
                                                                <option value="Chile">Chile</option>
                                                                <option value="China">China</option>
                                                                <option value="Christmas Island">Christmas Island</option>
                                                                <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                                                                <option value="Colombia">Colombia</option>
                                                                <option value="Comoros">Comoros</option>
                                                                <option value="Congo">Congo</option>
                                                                <option value="Congo">Congo, the Democratic Republic of the</option>
                                                                <option value="Cook Islands">Cook Islands</option>
                                                                <option value="Costa Rica">Costa Rica</option>
                                                                <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                                                                <option value="Croatia">Croatia (Hrvatska)</option>
                                                                <option value="Cuba">Cuba</option>
                                                                <option value="Cyprus">Cyprus</option>
                                                                <option value="Czech Republic">Czech Republic</option>
                                                                <option value="Denmark">Denmark</option>
                                                                <option value="Djibouti">Djibouti</option>
                                                                <option value="Dominica">Dominica</option>
                                                                <option value="Dominican Republic">Dominican Republic</option>
                                                                <option value="East Timor">East Timor</option>
                                                                <option value="Ecuador">Ecuador</option>
                                                                <option value="Egypt">Egypt</option>
                                                                <option value="El Salvador">El Salvador</option>
                                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                                <option value="Eritrea">Eritrea</option>
                                                                <option value="Estonia">Estonia</option>
                                                                <option value="Ethiopia">Ethiopia</option>
                                                                <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                                                                <option value="Faroe Islands">Faroe Islands</option>
                                                                <option value="Fiji">Fiji</option>
                                                                <option value="Finland">Finland</option>
                                                                <option value="France">France</option>
                                                                <option value="France Metropolitan">France, Metropolitan</option>
                                                                <option value="French Guiana">French Guiana</option>
                                                                <option value="French Polynesia">French Polynesia</option>
                                                                <option value="French Southern Territories">French Southern Territories</option>
                                                                <option value="Gabon">Gabon</option>
                                                                <option value="Gambia">Gambia</option>
                                                                <option value="Georgia">Georgia</option>
                                                                <option value="Germany">Germany</option>
                                                                <option value="Ghana">Ghana</option>
                                                                <option value="Gibraltar">Gibraltar</option>
                                                                <option value="Greece">Greece</option>
                                                                <option value="Greenland">Greenland</option>
                                                                <option value="Grenada">Grenada</option>
                                                                <option value="Guadeloupe">Guadeloupe</option>
                                                                <option value="Guam">Guam</option>
                                                                <option value="Guatemala">Guatemala</option>
                                                                <option value="Guinea">Guinea</option>
                                                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                                <option value="Guyana">Guyana</option>
                                                                <option value="Haiti">Haiti</option>
                                                                <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                                                                <option value="Holy See">Holy See (Vatican City State)</option>
                                                                <option value="Honduras">Honduras</option>
                                                                <option value="Hong Kong">Hong Kong</option>
                                                                <option value="Hungary">Hungary</option>
                                                                <option value="Iceland">Iceland</option>
                                                                <option value="India">India</option>
                                                                <option value="Indonesia">Indonesia</option>
                                                                <option value="Iran">Iran (Islamic Republic of)</option>
                                                                <option value="Iraq">Iraq</option>
                                                                <option value="Ireland">Ireland</option>
                                                                <option value="Israel">Israel</option>
                                                                <option value="Italy">Italy</option>
                                                                <option value="Jamaica">Jamaica</option>
                                                                <option value="Japan">Japan</option>
                                                                <option value="Jordan">Jordan</option>
                                                                <option value="Kazakhstan">Kazakhstan</option>
                                                                <option value="Kenya">Kenya</option>
                                                                <option value="Kiribati">Kiribati</option>
                                                                <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
                                                                <option value="Korea">Korea, Republic of</option>
                                                                <option value="Kuwait">Kuwait</option>
                                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                                <option value="Lao">Lao People's Democratic Republic</option>
                                                                <option value="Latvia">Latvia</option>
                                                                <option value="Lebanon">Lebanon</option>
                                                                <option value="Lesotho">Lesotho</option>
                                                                <option value="Liberia">Liberia</option>
                                                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                                <option value="Liechtenstein">Liechtenstein</option>
                                                                <option value="Lithuania">Lithuania</option>
                                                                <option value="Luxembourg">Luxembourg</option>
                                                                <option value="Macau">Macau</option>
                                                                <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                                                                <option value="Madagascar">Madagascar</option>
                                                                <option value="Malawi">Malawi</option>
                                                                <option value="Malaysia">Malaysia</option>
                                                                <option value="Maldives">Maldives</option>
                                                                <option value="Mali">Mali</option>
                                                                <option value="Malta">Malta</option>
                                                                <option value="Marshall Islands">Marshall Islands</option>
                                                                <option value="Martinique">Martinique</option>
                                                                <option value="Mauritania">Mauritania</option>
                                                                <option value="Mauritius">Mauritius</option>
                                                                <option value="Mayotte">Mayotte</option>
                                                                <option value="Mexico">Mexico</option>
                                                                <option value="Micronesia">Micronesia, Federated States of</option>
                                                                <option value="Moldova">Moldova, Republic of</option>
                                                                <option value="Monaco">Monaco</option>
                                                                <option value="Mongolia">Mongolia</option>
                                                                <option value="Montserrat">Montserrat</option>
                                                                <option value="Morocco">Morocco</option>
                                                                <option value="Mozambique">Mozambique</option>
                                                                <option value="Myanmar">Myanmar</option>
                                                                <option value="Namibia">Namibia</option>
                                                                <option value="Nauru">Nauru</option>
                                                                <option value="Nepal">Nepal</option>
                                                                <option value="Netherlands">Netherlands</option>
                                                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                                <option value="New Caledonia">New Caledonia</option>
                                                                <option value="New Zealand">New Zealand</option>
                                                                <option value="Nicaragua">Nicaragua</option>
                                                                <option value="Niger">Niger</option>
                                                                <option value="Nigeria">Nigeria</option>
                                                                <option value="Niue">Niue</option>
                                                                <option value="Norfolk Island">Norfolk Island</option>
                                                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                                <option value="Norway">Norway</option>
                                                                <option value="Oman">Oman</option>
                                                                <option value="Pakistan">Pakistan</option>
                                                                <option value="Palau">Palau</option>
                                                                <option value="Panama">Panama</option>
                                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                                <option value="Paraguay">Paraguay</option>
                                                                <option value="Peru">Peru</option>
                                                                <option value="Philippines">Philippines</option>
                                                                <option value="Pitcairn">Pitcairn</option>
                                                                <option value="Poland">Poland</option>
                                                                <option value="Portugal">Portugal</option>
                                                                <option value="Puerto Rico">Puerto Rico</option>
                                                                <option value="Qatar">Qatar</option>
                                                                <option value="Reunion">Reunion</option>
                                                                <option value="Romania">Romania</option>
                                                                <option value="Russia">Russian Federation</option>
                                                                <option value="Rwanda">Rwanda</option>
                                                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                                <option value="Saint LUCIA">Saint LUCIA</option>
                                                                <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                                                                <option value="Samoa">Samoa</option>
                                                                <option value="San Marino">San Marino</option>
                                                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                                <option value="Senegal">Senegal</option>
                                                                <option value="Seychelles">Seychelles</option>
                                                                <option value="Sierra">Sierra Leone</option>
                                                                <option value="Singapore">Singapore</option>
                                                                <option value="Slovakia">Slovakia (Slovak Republic)</option>
                                                                <option value="Slovenia">Slovenia</option>
                                                                <option value="Solomon Islands">Solomon Islands</option>
                                                                <option value="Somalia">Somalia</option>
                                                                <option value="South Africa">South Africa</option>
                                                                <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                                                                <option value="Span">Spain</option>
                                                                <option value="SriLanka">Sri Lanka</option>
                                                                <option value="St. Helena">St. Helena</option>
                                                                <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                                                                <option value="Sudan">Sudan</option>
                                                                <option value="Suriname">Suriname</option>
                                                                <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                                                                <option value="Swaziland">Swaziland</option>
                                                                <option value="Sweden">Sweden</option>
                                                                <option value="Switzerland">Switzerland</option>
                                                                <option value="Syria">Syrian Arab Republic</option>
                                                                <option value="Taiwan">Taiwan, Province of China</option>
                                                                <option value="Tajikistan">Tajikistan</option>
                                                                <option value="Tanzania">Tanzania, United Republic of</option>
                                                                <option value="Thailand">Thailand</option>
                                                                <option value="Togo">Togo</option>
                                                                <option value="Tokelau">Tokelau</option>
                                                                <option value="Tonga">Tonga</option>
                                                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                                <option value="Tunisia">Tunisia</option>
                                                                <option value="Turkey">Turkey</option>
                                                                <option value="Turkmenistan">Turkmenistan</option>
                                                                <option value="Turks and Caicos">Turks and Caicos Islands</option>
                                                                <option value="Tuvalu">Tuvalu</option>
                                                                <option value="Uganda">Uganda</option>
                                                                <option value="Ukraine">Ukraine</option>
                                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                                <option value="United States">United States</option>
                                                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                                <option value="Uruguay">Uruguay</option>
                                                                <option value="Uzbekistan">Uzbekistan</option>
                                                                <option value="Vanuatu">Vanuatu</option>
                                                                <option value="Venezuela">Venezuela</option>
                                                                <option value="Vietnam">Viet Nam</option>
                                                                <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                                                <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                                                                <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                                                                <option value="Western Sahara">Western Sahara</option>
                                                                <option value="Yemen">Yemen</option>
                                                                <option value="Yugoslavia">Yugoslavia</option>
                                                                <option value="Zambia">Zambia</option>
                                                                <option value="Zimbabwe">Zimbabwe</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($items->gift >= 1)
                                                        <div class="column width-12 {{ $errors->has('gift_text') ? ' has-error' : '' }}">
                                                            <textarea type="text" name="gift_text" value="{{old('gift_text')}}" class="form-zip-code form-element large" placeholder="Gift Text" tabindex="10"></textarea>
                                                        </div>
                                                    @endif
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="column width-12">
                    <hr>
                </div>
            </div>
            <!-- Checkout End -->
        </div>
        <!-- Order Overview End -->
    </div>
    <!-- Content End -->
@stop