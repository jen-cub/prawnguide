jQuery(document).ready(function($) {

	var googleApi = 'AIzaSyA8e_ApCm3zWlDe9OKItY-A1QJw0qwm0qU';

	// trigger fancybox on pageload

	if ($('.auto-open').length > 0 && !Cookies.get('gpap_signup') || window.location.hash == '#signup' || window.location.search.indexOf('signup=true') > 0) {
		$.fancybox.open([
		    {
		        href : '#modal_box'
		    }
		], {
			maxWidth	: 600,
			maxHeight	: 540,
			fitToView	: false,
			width		: '90%',
			height		: '90%',
			autoSize	: false,
			closeBtn	: false,
			modal	: true
		});
	}

	// custom close button
	$('a.close-modalbox').click(function(e){
        e.preventDefault();
        $.fancybox.close();
    });

	// hacky fix for country list
	$('select[name="country"] option').removeAttr('value');
	$('select[name="country"]').change(function() {

		if ($(this).val() !== 'Australia') {
			$(this).parent().next().removeClass("required");
		} else {
			$(this).parent().next().addClass("required");
		}

	});

	$('.register-form').validate({
		rules: {
			"first_name": {
				"required": true
			},
			"last_name": {
				required: true
			},
			"postcode": {
				required: function(element) { return ($('[name="country"]').val() == 'Australia') },
				number: true,
				min: 1000,
				max: 9999
			}
		},
		submitHandler: function(form) {

			$(form).find('[type="submit"]').addClass('loading').text('One moment...');

			// console.log($(form).serialize());
			var inputs = {
				postcode: $(form).find('[name="postcode"]').val(),
				country: $(form).find('[name="country"]').val() || 'Australia'
			}

			// geocode
			$.get('https://maps.googleapis.com/maps/api/geocode/json?key='+googleApi+'&address=' + inputs.postcode + ', ' + inputs.country, function(res) {
				var state = res.results[0].address_components[2].short_name;
				$('.state').val(state.toLowerCase());
				$('select').selectOrDie('update');
			});

			$.ajax({
				type: 'POST',
				url: '/gpap/submit',
				data: $(form).serialize(),
				success: function(data) {
					console.log(data.success);

					if (data.success) {
						Cookies.set('gpap_signup', true, {expires: 14})
						//_moments.push({action: 'signup'});
						$.fancybox.close();
					} else {
						$('.error-message').text(data.message).show();
						$(form).find('[type="submit"]').removeClass('loading').text('Take Me To The Guide');
					}

				}
			})


		}
	});




	// shares
	$('a[data-share]').share({
		counts: false
	})


	// state select
	$(".state").selectOrDie({
    	customClass: "state-selector"
	});

/*
 *	code block to hide / whos the state accordion
 *
$('.state').on('change', function(event) {

		var val = $(this).val();
		if (val == '') {
			$('.provider').fadeIn();
			$('.statecol:not(.statecol-aus)').hide();
			$('.statecol-aus').show();
		} else {
			$('.provider:not(.'+val+')').fadeOut();
			$('.provider.'+val).fadeIn();
			$('.statecol:not(.statecol-'+val+')').hide();
			$('.statecol-'+val).show();
			//window.location.href = '/'+val+'/';
		}

		$('.prov-detail').slideUp();
		$('.provider').removeClass('open');

		

	}).change();
*/

/*
 *code block to redirect after rating is selected
 */
	$('.rate-selector').change(function() {
		window.location.href = '/'+$(this).val()+'/';
	});

	
	// scroll to links
	$("a.ratings_link").click(
	function()
	{
	   $("html, body").animate({ scrollTop: $('#ratings-container').offset().top }, 1000);
	});

	// accordians
	$(".extended-article").each(function() {
		$(this).after('<a href="#" class="ghost_btn toggle-btn">read more</a>');
		$(this).hide();
	});

	$(".toggle-btn").click(function( e ) {
	   $(this).siblings(".extended-article").slideToggle();

	   e.preventDefault();
	   return false;

	});


	$(".disclaimer-btn").click(function( e ) {
	   $(".disclaimer").slideToggle();
	   $("html, body").animate({ scrollTop: $('#disclaimer').offset().top }, 1000);
	   e.preventDefault();
	   return false;

	});

	// provider accordians

	$(".prov-detail").hide();

	$(".prov-top").click(function() {
	   $(this).siblings(".prov-detail").slideToggle();
	   $(this).find(".fa-chevron-down").toggleClass("flip-arrow");

	   $(this).parent().toggleClass('open');

	   if ($(this).parent().hasClass('open')) {
		//    console.log('')
		   $(this).parent().find('.score-bar').each( function() {
			   $(this).css('width', $(this).data('width'));
		   })
	   } else {
		    $(this).parent().find('.score-bar').css('width', '0');
	   }

	});

	var AppFlicker = {

        init: function() {
    		this.title_pulsate();
        },

        title_pulsate: function() {
        	var _this = this;
        	var _delay = [10000,20000,30000];
        	var delay = _delay[Math.floor(Math.random() * _delay.length)];
        	$('.mainLogo').delay(500).fadeIn(20).fadeOut(20).fadeIn(25).fadeOut(25).fadeIn(10).fadeIn(20).fadeOut(20).fadeIn(25).fadeOut(25).fadeIn(10);

        	setTimeout(function() {
        		_this.title_pulsate();
        	},delay);
        }
    };

    AppFlicker.init();


}); // end doc init
