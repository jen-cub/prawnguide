<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">

	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.png" type="image/png">

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/styles.css">

	<script src="https://use.typekit.net/xot6whf.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/fontawesome/css/font-awesome.min.css">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	<!-- Google Tag Manager -->
	<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TKHPP3"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-TKHPP3');</script>
	<!-- End Google Tag Manager -->
	<?php
		global $post;
		$slug = get_post( $post )->post_name;
		$_slug = array('good', 'bad', 'dodgy', 'okay');
		
		$head_class = '';
		$logo_path = '';
		if (in_array($slug, $_slug)) {
			$head_class = 'class="header-'. $slug . '"';
			$logo_path = $slug.'/';
		}
	?>

	<header <?php echo $head_class;?>>
		<div class="top-bar">
			<ul class="sm-btns">
				<li>
					<a href="#" data-share="facebook">
						<span class="fa-stack fa-lg">
						  <i class="fa fa-circle fa-stack-2x"></i>
						  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
						</span>
					<span class="li-text">Share</span></a>
				</li>
				<li>
					<a href="#" data-share="twitter" data-url="" data-message="<?php the_field('twitter_default', 'option'); ?>">
						<span class="fa-stack fa-lg">
						  <i class="fa fa-circle fa-stack-2x"></i>
						  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
						</span>
					<span class="li-text">Tweet</span></a>
				</li>
				<li class="btn-whatsapp">
					<!-- <a href="whatsapp://send" data-text="<?php the_field('whatsapp_default', 'option'); ?>" data-href="" class="wa_btn wa_btn_s whatsapp" style="display:none">
						<span class="fa-stack fa-lg">
						  <i class="fa fa-circle fa-stack-2x"></i>
						  <i class="fa fa-whatsapp fa-stack-1x fa-inverse"></i>
						</span>
					</a> -->
					<a href="whatsapp://send?text=<?php echo urlencode(get_field('whatsapp_default', 'option')); ?>" data-href="" class="whatsapp" target="_top" onclick="window.parent.null">
						<span class="fa-stack fa-lg">
						  <i class="fa fa-circle fa-stack-2x"></i>
						  <i class="fa fa-whatsapp fa-stack-1x fa-inverse"></i>
						</span>
					</a>
					<!-- <span class="li-text">What's App</span></a> -->
				</li>

			</ul>
		</div>

		<div class="header-inner">

			<h1 class="logo">
				<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/assets/images/headers/<?php echo $logo_path;?>logo-full.png" alt="The Prawn Guide" ></a>
			</h1>

			<h2 class="logo-mobile">
				<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/assets/images/headers/<?php echo $logo_path;?>logo-full.png" alt="The Prawn Guide" ></a>
			</h2>

		</div>
		<div class="header-bottom"></div>
	</header>