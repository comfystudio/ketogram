jQuery(document).ready(function(){
    $(".select-chosen").chosen();

    $('.special-field').css({position: 'absolute', left: '-10000px'});



    //var feed = new Instafeed({
    //    get: 'tagged',
    //    tagName: 'awesome',
    //    clientId: 'b68591621ec64adcb4e343c3de61172d'
    //});
    //feed.run();

    $( '.tm-slider-container-blog' ).avalancheSlider({
        fullwidth:false,
        lazyload:false,
        showProgressBar:false,
        navPagination: false

    });


    $('#cookie-panel-a').click( function(e) {e.preventDefault()
        setAgreeCookie();
        $('#cookie-panel').hide();
    });

    function setAgreeCookie() {
        var expire=new Date();
        expire=new Date(expire.getTime()+7776000000);
        document.cookie="cookie=true; AMIR86=here; expires="+expire;
    }

    $( '.tm-slider-container' ).avalancheSlider({
        animation: 'slide',
        easing: 'easeInOutQuart',
        speed: 700,
        autoAdvance: false,
        forceFit: false,
        fullwidth: false,
        scaleUnder: 960,
        scaleMinHeight: 400,
        captionScaling: true,
        lazyLoad: false,
        navArrows: true,
        navPagination: true,
        navShowOnHover: true,
        respectRatio: false,
        retinaSupport: false
    });

    //user selects add to cart
    jQuery(".add-to-cart").click(function(){
        var item_id = jQuery(this).data('id');
        var quantity = jQuery('#quantity_'+item_id).val();
        var stock = jQuery(this).data('stock');
        var clicked = jQuery(this);
        jQuery('#cart-update').addClass('cart-active');
        if(typeof quantity === 'undefined'){
            quantity = 1;
        }
        //need to check if quantity exceeds stock if so then no flag warning

        if(quantity > stock){
            jQuery('#cart-warning_'+item_id).show();
        }else{
            jQuery.get(
                '/items/update-cart/' + item_id + '/' + quantity + '/increment',
                function (data) {
                    if (data) {
                        buildCartHeader(data);
                        buildCartHeaderMobile(data);
                        buildCartSidePanel(data);
                        removeCartItems();

                        jQuery('#cart-warning_'+item_id).hide();
                        clicked.data('stock', (stock - quantity));
                        updateStockCounters(item_id, (stock - quantity));

                    } else {
                    }
                }
            );
        }
    });

    function buildCartHeader(data){
        var items = JSON.parse(data);
        var html = '';

        html += '<a href="#" class="nav-icon cart no-page-fade"><span class="cart-indication"><span class="icon-shopping-cart"></span> <span class="badge background-aqua">'+items.totalCount+'</span></span></a>';
        html += '<ul class="sub-menu custom-content cart-overview">';
            for(var i in items){
                if(typeof items[i]['id'] !== 'undefined'){
                    html += '<li class="cart-item">';
                        html += '<a href="/items/'+items[i]['id']+'" class="product-thumbnail">';
                            if(typeof items[i]['item_images']['0'] !== 'undefined'){ html+= '<img src="/'+items[i]['item_images'][0]['image']+'" alt="'+items[i]['item_images'][0]['title']+'" />';}else{ html+= '<img src="/images/no-image.png" alt="No Image" />'}
                        html += '</a>';

                        html += '<div class="product-details">';
                            html += '<a href="/items/'+items[i]['id']+'" class="product-title">';
                                html += items[i]['title'];
                            html += '</a>';
                            html += '<span class="product-quantity">'+items[i]['quantity']+' x </span>';

                            if(typeof items[i]['item_sales'][0] !== 'undefined') {
                                html += '<span class="product-price"><del><span class="currency">£</span>' + items[i]['price'] + ' </del><ins><span class="amount">£'+items[i]['item_sales'][0]['price']+'</span></ins></span>';
                            }else{
                                html += '<span class="product-price"><span class="currency">£</span>'+items[i]['price']+'</span>';
                            }

                            html += '<a class="product-remove icon-cancel" data-id="'+items[i]['id']+'" data-stock="'+items[i]['stock']+'"></a>';
                        html += '</div>';
                    html += '</li>';
                }
            }

            html += '<li class="cart-subtotal">';
                html += 'Sub Total';
                html += '<span class="amount"><span class="currency">£</span>'+items.totalPrice+'</span>';
            html += '</li>';
            html += '<li class="cart-actions">';
                html += '<a href="/cart" class="view-cart mt-10 checkout button pill small">View Cart</a>';
                html += '<a href="/checkout" class="checkout button pill small"> Checkout</a>';
            html += '</li>';
        html += '</ul>';

        jQuery("#cart-navigation").children().remove();
        jQuery("#cart-navigation").append(html);
    }

    function buildCartHeaderMobile(data){
        var items = JSON.parse(data);
        var html = '';

        for(var i in items){
            if(typeof items[i]['id'] !== 'undefined'){
                html += '<li class="cart-item">';
                html += '<a href="/items/'+items[i]['id']+'" class="product-thumbnail">';
                if(typeof items[i]['item_images']['0'] !== 'undefined'){ html+= '<img src="/'+items[i]['item_images'][0]['image']+'" alt="'+items[i]['item_images'][0]['title']+'" />';}else{ html+= '<img src="/images/no-image.png" alt="No Image" />'}
                html += '</a>';

                html += '<div class="product-details">';
                html += '<a href="/items/'+items[i]['id']+'" class="product-title">';
                html += items[i]['title'];
                html += '</a>';
                html += '<span class="product-quantity">'+items[i]['quantity']+' x </span>';

                if(typeof items[i]['item_sales'][0] !== 'undefined') {
                    html += '<span class="product-price"><del><span class="currency">£</span>' + items[i]['price'] + ' </del><ins><span class="amount">£'+items[i]['item_sales'][0]['price']+'</span></ins></span>';
                }else{
                    html += '<span class="product-price"><span class="currency">£</span>'+items[i]['price']+'</span>';
                }

                html += '<a class="product-remove icon-cancel" data-id="'+items[i]['id']+'" data-stock="'+items[i]['stock']+'"></a>';
                html += '</div>';
                html += '</li>';
            }
        }

        html += '<li class="cart-subtotal">';
        html += 'Sub Total';
        html += '<span class="amount"><span class="currency">£</span>'+items.totalPrice+'</span>';
        html += '</li>';
        html += '<li class="cart-actions">';
        html += '<a href="/cart" class="view-cart mt-10 checkout button pill small">View Cart</a>';
        html += '<a href="/checkout" class="checkout mt-10 button pill small"> Checkout</a>';
        html += '</li>';


        jQuery("#cart-navigation-mobile").children().find('li').remove();
        jQuery("#cart-navigation-mobile ul").append(html);
        jQuery("#cart-navigation-mobile .badge").html(items.totalCount);
    }

    function buildCartSidePanel(data){
        var items = JSON.parse(data);
        var html = '';

        //if(items[0]['id'] != null && typeof items[0]['id'] !== 'undefined') {
            for (var i in items) {
                if(items[i]['id'] != null && typeof items[i]['id'] !== 'undefined'){

                    if (items[i]['item_images'] != null && typeof items[i]['item_images'][0] !== 'undefined') {
                        var image = '/'+items[i]['item_images'][0]['image'];
                    } else {
                        var image = '/images/no-image.png';
                    }

                    html += '<div class = "cart-item" id="cart-item_'+items[i]['id']+'">';
                        html += '<img src="'+image+'"/>';
                        html += '<div class = "cart-content">';
                            html += '<div class = "row">';
                                html += '<span class ="title">' + items[i]['title'] + '</span>';
                            html += '</div>';

                            html += '<div class = "row">';
                                if(items[i]['item_sales'] != null && typeof items[i]['item_sales'][0] !== 'undefined'){
                                    html += '<span class="quantity background-aqua">' + items[i]['quantity'] + ' x <del><span class="currency">£</span>' + items[i]['price'] + ' </del><ins><span class="currency">£</span>'+items[i]['item_sales'][0]['price']+'</ins></span>';
                                }else{
                                    html += '<span class="quantity background-aqua">' + items[i]['quantity'] + ' x <span class="currency">£</span>' + items[i]['price'] + '</span>';
                                }
                            html += '</div>';

                            html += '<span class="remove product-remove icon-cancel" data-id="' + items[i]['id'] + '" data-quantity="' + items[i]['quantity'] + '" data-price="' + items[i]['price'] + '" data-stock="' + items[i]['stock'] + '"></span>';
                        html += '</div>';

                    html += '</div>';
                }
            }
            html += '<div class = "cart-total pb-20 pt-20">';
                html += 'Sub Total';
                html += '<span class="amount pull-right"><span class="currency">£</span>'+items.totalPrice+'</span>';
            html += '</div>';

            html += '<div class="cart-actions">';
                html += '<a href="/cart" class="view-cart mt-10 checkout button pill button-yellow text-large">View Cart</a>';
                html += '<a href="/checkout" class="checkout mt-10 button pill button-blue pull-right text-large"> Checkout</a>';
            html += '</div>';
        //}
        jQuery("#cart-container").children().remove();
        jQuery("#cart-container").append(html);
    }

    function removeCartItems(){
        jQuery(".product-remove").off();
        jQuery(".product-remove").click(function(){
            var item_id = jQuery(this).data('id');
            var stock = jQuery(this).data('stock');
            jQuery.get(
                '/items/remove-cart-items/'+item_id,
                function (data) {
                    if (data) {
                        buildCartHeader(data);
                        buildCartHeaderMobile(data);
                        buildCartSidePanel(data);
                        removeCartItems();

                        jQuery('#cart-warning_'+item_id).hide();
                        //clicked.data('stock', (stock - quantity));
                        jQuery('#add-to-cart_'+item_id).data('stock', stock);
                        jQuery('#cart-item_'+item_id).remove();
                        updateStockCounters(item_id, stock);
                        cartUpdateTotals();
                    } else {
                    }
                }
            );
        })
    }

    function updateStockCounters(item_id, stock){
        if((stock) == 0 ){
            var html = '<span class="outofstock" id="cart-tag_'+item_id+'">Out of Stock</span>';
            jQuery("#cart-tag_"+item_id).replaceWith(html);

            jQuery("#add-to-cart_"+item_id).text('Out Of Stock');
            jQuery("#add-to-cart_"+item_id).removeClass('add-to-cart');
            jQuery("#add-to-cart_"+item_id).addClass('disabled');

        }else if((stock) <= 10){
            var html = '<span class="outofstock" id="cart-tag_'+item_id+'">Only '+(stock)+' left!</span>';
            jQuery("#cart-tag_"+item_id).replaceWith(html);

            if (jQuery("#add-to-cart_"+item_id).hasClass("disabled")) {
                jQuery("#add-to-cart_"+item_id).text('Add To Cart');
                jQuery("#add-to-cart_"+item_id).addClass('add-to-cart');
                jQuery("#add-to-cart_"+item_id).removeClass('disabled');
            }

        }else if((stock) > 10){
            var html = '<span class="outofstock hide" id="cart-tag_'+item_id+'"></span>';
            jQuery("#cart-tag_"+item_id).replaceWith(html);

            if (jQuery("#add-to-cart_"+item_id).hasClass("disabled")) {
                jQuery("#add-to-cart_" + item_id).text('Add To Cart');
                jQuery("#add-to-cart_" + item_id).addClass('add-to-cart');
                jQuery("#add-to-cart_" + item_id).removeClass('disabled');
            }
        }
    }

    function cartQuantityChange(){
        jQuery('.cart-quantity').change(function(){
            var item_id = jQuery(this).data('id');
            var max = jQuery(this).data('max');
            var quantity = jQuery(this).val();
            var price = jQuery('#cart-price_'+item_id).data('price');
            if(quantity > max){
                jQuery(this).val(max);
                jQuery('#cart-warning_'+item_id).show().fadeOut(2000);
                jQuery('#cart-amount_'+item_id).data('total',(max * price));
                jQuery('#cart-amount_'+item_id).text('£ '+(max * price));
                quantity = max;
                cartUpdateTotals();
            }else{
                jQuery('#cart-amount_'+item_id).data('total',(quantity * price));
                jQuery('#cart-amount_'+item_id).text('£ '+(quantity * price));
                cartUpdateTotals();
            }

            //we need to update header
            jQuery.get(
                '/items/update-cart/' + item_id + '/' + quantity + '/set',
                function (data) {
                    if (data) {
                        buildCartHeader(data);
                        buildCartHeaderMobile(data);
                        buildCartSidePanel(data);
                        removeCartItems();

                        //jQuery('#cart-warning_'+item_id).hide();
                        //clicked.data('stock', (stock - quantity));
                        //updateStockCounters(item_id, (stock - quantity));

                    } else {
                    }
                }
            );
        })
    }

    function cartUpdateTotals(){
        var total = 0;
        jQuery('.cart-amount').each(function(){
            total += jQuery(this).data('total');
        });
        jQuery('#cart-subtotal').data('price', total);
        jQuery('#cart-subtotal').text('£ '+total);

        //Working out total now.
        //var postage = jQuery('#cart-postage').data('price');
        //var coupon = jQuery('#cart-coupon').data('price');
/*        if(coupon == 0){
            coupon = 1;
        }*/
        var maxTotal = (total);
        //setting max total in cart page
        jQuery("#cart-total").data('price', maxTotal);
        jQuery("#cart-total").text('£ '+maxTotal);
    }


    removeCartItems();

    cartQuantityChange();

    jQuery('#checkout-select-country').change(function(){
        var country = jQuery('#checkout-select-country').val();
        var weight = jQuery('#checkout-weight').data('weight');
        var postage = 0;
        //if the country is UK
        if(country == 'United Kingdom'){
            for (var i = 0; i < 99; i++) {
                switch (true) {
                    case (weight < 2000):
                        postage += 3.90;
                        weight -= 2000;
                        break;
                    case (weight < 5000):
                        postage += 14.75;
                        weight -= 5000;
                        break;
                    case (weight < 10000):
                        postage += 21.25;
                        weight -= 10000;
                        break;
                    case (weight >= 10000):
                        postage += 29.55;
                        weight -= 20000;
                        break;
                    default:
                        postage += 29.55;
                        weight -= 20000;
                }
                if(weight <= 0){
                    break;
                }
            }
        //else if not Uk
        }else{
            for (var i = 0; i < 99; i++) {
                if(weight <= 2000) {
                    postage += Math.ceil(((weight / 250) * 1.75) + 10);
                    weight -= 2000;
                }else{
                    postage += Math.ceil(((2000 / 250) * 1.75) + 10);
                    weight -= 2000;
                }
                if(weight <= 0){
                    break;
                }
            }
        }

        jQuery('#checkout-postage').data('price', postage);
        jQuery("#checkout-postage").text('£'+postage);
        updateCheckoutTotal();


    });

    function updateCheckoutTotal(){
        var postage = jQuery('#checkout-postage').data('price');
        var coupon = jQuery('#cart-coupon').data('price');
        if(coupon != 1){
            coupon = 1 - (coupon / 100);
        }
        var itemTotal = 0;
        jQuery('.checkout-item').each(function(){
            itemTotal += jQuery(this).data('price');
        });
        var total = (itemTotal * coupon) + postage;
        jQuery('#checkout-total').data('price', total);
        jQuery('#checkout-total').text('£'+total);
        jQuery('#checkout-form input[name=total]').val(total);
    }

    jQuery('#checkout-coupon-form').submit(function(el){
        el.preventDefault();
        var code = jQuery('#form-coupon-code').val();
        if(code) {
            jQuery.get(
                '/coupons/check-coupon/' + code,
                function (data) {
                    if (data) {
                        jQuery('#checkout-coupon-error').hide();
                        jQuery('#checkout-coupon-success').hide();
                        if (data.status == 'error') {
                            jQuery('#checkout-coupon-error').text(data.text);
                            jQuery('#checkout-coupon-error').show();
                        } else {
                            jQuery('#checkout-coupon-success').text(data.text);
                            jQuery('#checkout-coupon-success').show();

                            jQuery('#cart-coupon').data('price', data.percent);
                            jQuery('#cart-coupon').text('-'+data.percent+'%');
                            jQuery('#cart-coupon').parent().parent().show();
                            jQuery('#checkout-form input[name=coupon]').val(code);
                            updateCheckoutTotal();
                        }

                    } else {
                    }
                }
            );
        }else{
            jQuery('#checkout-coupon-error').text('Please provide code.');
            jQuery('#checkout-coupon-error').show();
        }
    });

    //
    jQuery('#checkout-button').click(function(){
        jQuery('#checkout-form').submit();
    });

    addToCustom();

    function addToCustom(){
        jQuery(".add-to-custom").click(function(){
            var item_id = jQuery(this).data('id');
            var clicked = jQuery(this);
            jQuery('#cart-update').addClass('cart-active');
            jQuery.get(
                '/items/update-custom/' + item_id + '/increment',
                function (data) {
                    if (data) {
                        var min = -20;
                        var max = 20;
                        var random = Math.floor(Math.random() * (max - min + 1)) + min;
                        if(random % 2 == 0){
                            jQuery('.space3d ._3dbox').css( {'transform': 'rotateX('+ random +'deg)'})
                        }else{
                            jQuery('.space3d ._3dbox').css( {'transform': 'rotateY('+ random +'deg)'})

                        }

                        //jQuery('.space3d ._3dbox').addClass('_3dbox-animate').finish();


                        var items = JSON.parse(data);
                        jQuery('#custom_price').data('price', items.totalPrice);

                        if(items.totalPrice >= 20){
                            jQuery('#custom-move-button').show();
                            jQuery('.add-to-cart-button').each(function(){
                                jQuery(this).addClass('disabled');
                                jQuery(this).removeClass('add-to-custom');
                            });
                        }

                        var html = '';
                        var count = 0;
                        if(typeof items[0]['id'] !== 'undefined') {
                            for (var i in items) {
                                if(items[i]['id'] != null && typeof items[i]['id'] !== 'undefined'){
                                    count++;
                                    if (count % 4 == 1) {
                                        html += '<div class = "row">';
                                    }

                                    if (items[i]['item_images'] != null && typeof items[i]['item_images'][0] !== 'undefined') {
                                        html += '<div class = "custom-box-item" id="custom-box-item_'+ items[i]['id'] +'">';
                                        html += '<span class="badge background-aqua">' + items[i]['quantity'] + '</span>';
                                        html += '<span class="badge custom-remove icon-cancel" data-id="' + items[i]['id'] + '" data-quantity="' + items[i]['quantity'] + '" data-price="' + items[i]['price'] + '"></span>';
                                        html += '<img src="/' + items[i]['item_images'][0]['image'] + '" alt="' + items[i]['item_images'][0]['title'] + '" />';
                                        html += '</div>';
                                    } else {
                                        html += '<div class = "custom-box-item" id="custom-box-item_'+ items[i]['id'] +'">';
                                        html += '<span class="badge background-aqua">' + items[i]['quantity'] + '</span>';
                                        html += '<span class="badge custom-remove icon-cancel" data-id="' + items[i]['id'] + '" data-quantity="' + items[i]['quantity'] + '" data-price="' + items[i]['price'] + '"></span>';
                                        html += '<img src="/images/no-image.png" alt="No Image" />';
                                        html += '</div>';
                                    }

                                    if (count % 4 == 0) {
                                        html += '</div>';
                                    }
                                }
                            }
                            if(count % 4 != 0) {
                                html += '</div>';
                            }
                        }

                        jQuery("._3dface--front").children().remove();
                        jQuery("._3dface--front").append(html);

                        //updating our #cart-update
                        var html = '';
                        if(typeof items[0]['id'] !== 'undefined') {
                            for (var i in items) {
                                if(items[i]['id'] != null && typeof items[i]['id'] !== 'undefined'){

                                    if (items[i]['item_images'] != null && typeof items[i]['item_images'][0] !== 'undefined') {
                                        var image = '/'+items[i]['item_images'][0]['image'];
                                    } else {
                                        var image = '/images/no-image.png';
                                    }

                                    html += '<div class = "cart-item" id="cart-item_'+items[i]['id']+'">';
                                        html += '<img src="'+image+'"/>';
                                        html += '<div class = "cart-content">';
                                            html += '<div class = "row">';
                                                html += '<span class ="title">' + items[i]['title'] + '</span>';
                                            html += '</div>';

                                            html += '<div class = "row">';
                                                html += '<span class="quantity background-aqua">x ' + items[i]['quantity'] + '</span>';
                                            html += '</div>';

                                            html += '<span class="remove custom-remove icon-cancel" data-id="' + items[i]['id'] + '" data-quantity="' + items[i]['quantity'] + '" data-price="' + items[i]['price'] + '"></span>';
                                        html += '</div>';

                                    html += '</div>';

                                }
                            }
                        }
                        jQuery("#cart-container").children().remove();
                        jQuery("#cart-container").append(html);

                        removeCustomItems();
                    } else {
                    }
                }
            );

        });
    }

    removeCustomItems();

    function removeCustomItems(){
        jQuery(".custom-remove").off();
        jQuery(".custom-remove").click(function(){
            var item_id = jQuery(this).data('id');
            var price = jQuery(this).data('price');
            var quantity = jQuery(this).data('quantity');
            var clicked = jQuery(this);
            jQuery('#cart-update').addClass('cart-active');
            jQuery.get(
                '/subscriptions/remove-custom-items/'+item_id,
                function (data) {
                    if (data) {
                        var min = -20;
                        var max = 20;
                        var random = Math.floor(Math.random() * (max - min + 1)) + min;
                        if(random % 2 == 0){
                            jQuery('.space3d ._3dbox').css( {'transform': 'rotateX('+ random +'deg)'})
                        }else{
                            jQuery('.space3d ._3dbox').css( {'transform': 'rotateY('+ random +'deg)'})

                        }

                        //clicked.parent().remove();
                        jQuery('#custom-box-item_'+item_id).remove();
                        jQuery('#cart-item_'+item_id).remove();
                        var total = jQuery('#custom_price').data('price');
                        total = total - (price * quantity);
                        jQuery('#custom_price').data('price', total);

                        //if total is less than £25 then we need remove move on button and allow user to select goods again
                        if(total < 20){
                            jQuery('#custom-move-button').hide();
                            //jQuery('#custom-coupon-error').hide();
                            jQuery('.add-to-cart-button').each(function(){
                                jQuery(this).removeClass('disabled');
                                jQuery(this).addClass('add-to-custom');
                            });
                            addToCustom();
                        }

                    } else {
                    }
                }
            );
        })
    }

    jQuery('#custom-coupon-form').submit(function(el){
        el.preventDefault();
        var code = jQuery('#form-coupon-code').val();
        if(code) {
            jQuery.get(
                '/coupons/check-coupon-custom/' + code,
                function (data) {
                    if (data) {
                        jQuery('#checkout-coupon-error').hide();
                        jQuery('#checkout-coupon-success').hide();
                        if (data.status == 'error') {
                            jQuery('#checkout-coupon-error').text(data.text);
                            jQuery('#checkout-coupon-error').show();
                        } else {
                            jQuery('#checkout-coupon-success').text(data.text);
                            jQuery('#checkout-coupon-success').show();

                            jQuery('#cart-coupon').data('price', data.percent);
                            jQuery('#cart-coupon').text('-'+data.percent+'%');
                            jQuery('#cart-coupon').parent().parent().show();
                            jQuery('#checkout-form input[name=coupon]').val(code);
                            jQuery('#custom-first-month').text('£'+((100 - data.percent) / 100) * 30);
                            jQuery('#checkout-form input[name=first-price]').val(((100 - data.percent) / 100) * 30);
                            //updateCheckoutTotal();
                        }

                    } else {
                    }
                }
            );
        }else{
            jQuery('#checkout-coupon-error').text('Please provide code.');
            jQuery('#checkout-coupon-error').show();
        }
    });

    custom_edit_remove();
    function custom_edit_remove() {
        jQuery(".custom-edit-remove").click(function () {
            var item_id = jQuery(this).data('id');
            var price = jQuery('#item_' + item_id + ' select').find(':selected').data('price');
            var total = jQuery('#first_price').val();

            total = total - price;
            jQuery('#first_price').val(total);
            jQuery('#item_' + item_id + ' select').val(0);
            jQuery('select').trigger("chosen:updated");

            //remove image
            jQuery('#custom-edit-image_'+item_id+' img').attr("src","");

            if (total < 20) {
                jQuery('#custom-edit-add').fadeIn(1000).fadeOut(5000);
                jQuery('#custom-edit-submit').css("visibility", "hidden");
                $('select').prop('disabled', false).trigger("chosen:updated");
            }
        });
    }

    select_custom();
    function select_custom() {
        jQuery('.select-chosen').change(function () {
            var item_id = jQuery(this).data('id');
            var price = jQuery('#item_' + item_id + ' select').find(':selected').data('price');
            var total = jQuery('#first_price').val();
            var img = jQuery('#item_' + item_id + ' select').find(':selected').data('img-src');
            jQuery('#items-hidden-'+item_id).val(jQuery(this).val());
            total = parseFloat(total) + parseFloat(price);
            jQuery('#first_price').val(total);
            jQuery('#item_' + item_id + ' select').val(0);

            //add image
            jQuery('#custom-edit-image_'+item_id+' img').attr("src",img);

            if (total >= 20) {
                jQuery('#custom-edit-error').fadeIn(1000).fadeOut(5000);
                jQuery('#custom-edit-submit').css("visibility", "visible");
                $('select').prop('disabled', true).trigger("chosen:updated");
            }
        })
    }

    countdown();
    function countdown() {
        var monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        if ($('#countdown').length) {
            // Set the date we're counting down to
            //var countDownDate = new Date("Sep 5, 2018 00:00:00").getTime();
            var now = new Date();
            if(now.getDate() > 14){
                var countDownDate = new Date(now.getFullYear(), now.getMonth() + 1, 14).getTime();
            }else{
                var countDownDate = new Date(now.getFullYear(), now.getMonth(), 14).getTime();
            }


            // Update the count down every 1 second
            var x = setInterval(function () {

                // Get todays date and time
                var now = new Date().getTime();

                // Find the distance between now an the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="demo"
                document.getElementById("countdown").innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    var now = new Date();
                    document.getElementById("countdown").innerHTML = ""+monthNames[now.getMonth()]+" Box Time!";

                }
            }, 1000);
        }
    }

    jQuery("#cart-update .cart-close").click(function () {
        jQuery('#cart-update').removeClass('cart-active');
    });



    var version = detectIE();
    if (version >= 11){
        jQuery('.space3d-small').children().remove();
        jQuery('.space3d-small').css('padding', '0');
        jQuery('.space3d-small').append('<img src="/images/box-fallback.png" alt="ketogram box">');

        jQuery('.space3d-small-right').children().remove();
        jQuery('.space3d-small-right').css('padding', '0');
        jQuery('.space3d-small-right').append('<img src="/images/box-fallback-2.png" alt="ketogram box">');

        jQuery('.space3d').children().remove();
        jQuery('.space3d').css('padding', '0');
        jQuery('.space3d').append('<img src="/images/box-fallback-3.png" alt="ketogram box">');
    }
    /**
     * detect IE
     * returns version of IE or false, if browser is not Internet Explorer
     */
    function detectIE() {
        var ua = window.navigator.userAgent;

        // Test values; Uncomment to check result …

        // IE 10
        // ua = 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)';

        // IE 11
        // ua = 'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko';

        // Edge 12 (Spartan)
        // ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36 Edge/12.0';

        // Edge 13
        // ua = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586';

        var msie = ua.indexOf('MSIE ');
        if (msie > 0) {
            // IE 10 or older => return version number
            return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
        }

        var trident = ua.indexOf('Trident/');
        if (trident > 0) {
            // IE 11 => return version number
            var rv = ua.indexOf('rv:');
            return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
        }

        var edge = ua.indexOf('Edge/');
        if (edge > 0) {
            // Edge (IE 12+) => return version number
            return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
        }

        // other browser
        return false;
    }


    /*MODAL APPEARS after 20 seconds*/
    setTimeout(function(){
        if (document.cookie.indexOf("subbox=") >= 0){
            //have cookie

        }else{
            //No Cookie
            var expire=new Date();
            expire=new Date(expire.getTime()+7776000000);
            document.cookie="subbox=1; AMIR86=here; expires="+expire;

            jQuery('#myModal').show();
            jQuery('#myModal .close').click(function () {
                jQuery('#myModal').hide();
            });

        }

    }, 20000);


});

