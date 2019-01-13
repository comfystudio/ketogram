jQuery(document).ready(function(){
	
	// External Link
	jQuery('a[rel="external"]').click(function(){
        window.open( jQuery(this).attr('href') );
        return false;
    });

	// Print
	jQuery('a[rel="print"]').click(function() {
		window.print();
		return false;
	});
	
	// Generate a random password for users
	jQuery("#generate_password").change(function() {
		var generate = jQuery(this).prop('checked');
		if(generate == true){
			jQuery.get(
				'/admin/admin-users/generate-random-password/',
				function(data) {
					jQuery("#generated_password").html(data);
					var new_pw = jQuery("#new_pw").val();
					jQuery("#password").val(new_pw).trigger('keyup');
					jQuery("#confirm_password").val(new_pw);
				}
			);
		}else{
			var new_pw = '';
			jQuery("#generated_password").html('');
			jQuery("#new_pw").val(new_pw);
			jQuery("#password").val(new_pw).trigger('keyup');
			jQuery("#confirm_password").val(new_pw);
		}
	})

    // Generate a random Code for coupons
    jQuery("#generate_code").change(function() {
        var code = jQuery(this).prop('checked');
        if(code == true){
            jQuery.get(
                '/admin/coupons/generate-random-code',
                function(data) {
                    jQuery("#generated_code").html(data);
                    var new_code = jQuery("#new_code").val();
                    jQuery("#code").val(new_code).trigger('keyup');
                    //jQuery("#confirm_password").val(new_pw);
                }
            );
        }else{
            var new_code = '';
            jQuery("#generated_code").html('');
            jQuery("#new_code").val(new_code);
            jQuery("#code").val(new_code).trigger('keyup');
            //jQuery("#confirm_password").val(new_pw);
        }
    })

    var CSRF_TOKEN = $('input[name="_token"]').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Adding more items to a subscription
    jQuery("#sub-add-item").click(function(){
        var current =  jQuery(this).data('id');
        var count = jQuery(".remove-item").length;

        if(count <= 9) {
            jQuery.post(
                '/admin/subscriptions/ajax-get-items',
                {current: current, _token: CSRF_TOKEN},
                function (data) {
                    if (data) {
                        jQuery("#sub-add-item").parent().before(data);
                        removeItems();
                    } else {
                    }
                }
            );
            current = current + 1;
            jQuery(this).data('id', current);
        }else{
            jQuery("#sub-add-item").parent().hide();
        }
    });

    // Remove item if remove item is selected
    jQuery(".remove-item").click(function(){
        var current =  jQuery(this).data('id');
        jQuery("#item-group_"+current).remove();

    });

    // Remove item if remove item is selected function
    function removeItems(){
        jQuery(".remove-item").off();
        jQuery(".remove-item").click(function(){
            var current =  jQuery(this).data('id');
            jQuery("#item-group_"+current).remove();

            var count = jQuery(".remove-item").length
            if(count <= 9) {
                jQuery("#sub-add-item").parent().show();
            }
        })
    }

    // if is_custom is selected remove items
    jQuery("#is_custom").change(function() {
        if(jQuery('#is_custom').is(':checked')){
            jQuery(".remove-item").parent().show();
            jQuery("#sub-add-item").parent().show();
        }else{
            jQuery(".remove-item").parent().hide();
            jQuery("#sub-add-item").parent().hide();
        }
    })

    if(jQuery('#is_custom').is(':unchecked')){
        jQuery(".remove-item").parent().hide();
        jQuery("#sub-add-item").parent().hide();
    }


    /*crop Image */
    function cropUpload(id, width, height) {
        var $uploadCrop;

        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    });
                    $('.image-crop').addClass('ready');
                }

                reader.readAsDataURL(input.files[0]);
            }
            else {
                swal("Sorry - you're browser doesn't support the FileReader API");
            }
        }

        $uploadCrop = $(id).croppie({
            viewport: {
                width: width,
                height: height
            },
            boundary: {
                width: 300,
                height: 300
            },
            enableExif: true
        });

        $('#image').on('change', function () { readFile(this); });
        if ( $( "#image1" ).length ) {
            $('#image1').on('change', function () { readFile(this); });
        }


        $('input[name="save"]').on('click', function (ev) {
            ev.preventDefault();
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size:   {
                    width:  600,
                    height: 800
                }
            }).then(function (resp) {
                $('#imagebase64').val(resp);
                $('#form').submit();
            });
        });
    }

    if ( $( "#items-image" ).length ) {
        cropUpload('#items-image', 150, 200);
    }
});