<?php
// Helper Functions
// -------------------------

require_once('inc/extras.php');


// Template Tags
// -------------------------

require_once('inc/template-tags.php');

// Post Types & Taxonomies
// -------------------------

require_once('inc/types.php');
require_once('inc/taxonomies.php');

// Shortcodes
// -------------------------

require_once('inc/shortcodes.php');


// Theme
// -------------------------

function base_scripts() {

	// jQuery
	wp_enqueue_script(
		'jquery'
	);

	// selectordie
	wp_enqueue_script(
		'selectordie',
		get_template_directory_uri() . '/assets/js/selectordie/selectordie.min.js',
		false,
		'2.6.2',
		false
	);

	wp_enqueue_style(
		'selectordie',
		get_template_directory_uri() . '/assets/js/selectordie/selectordie.css'
	);

    // share
    wp_enqueue_script(
        'share',
        get_template_directory_uri() . '/assets/js/vendor/share.js',
        array('jquery'),
        '1.0.0',
        true
    );

	// js cookie
    wp_enqueue_script(
        'jscookie',
        get_template_directory_uri() . '/assets/js/vendor/js.cookie.js',
        array(),
        '1.0.0',
        true
    );

	// fancybox
    wp_enqueue_script(
        'fancybox',
        get_template_directory_uri() . '/assets/js/fancybox/jquery.fancybox.pack.js',
        array('jquery'),
        '1.0.0',
        true
    );

	wp_enqueue_style(
		'fancybox',
		get_template_directory_uri() . '/assets/js/fancybox/jquery.fancybox.css'
	);

	// jquery.validate
    wp_enqueue_script(
        'jquery.validate',
        get_template_directory_uri() . '/assets/js/vendor/jquery.validate.min.js',
        array('jquery'),
        '1.0.0',
        true
    );

	// site
	wp_enqueue_script(
		'site',
		get_template_directory_uri() . '/assets/js/init.js',
		array('jquery', 'share', 'jquery.validate', 'selectordie', 'fancybox'),
		'1.0.0',
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

}

add_action( 'wp_enqueue_scripts', 'base_scripts' );



// Theme Settings
// -------------------------

register_nav_menus( array(
	'primary' => 'Site Navigation'
) );

add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array('search-form', 'gallery') );
add_editor_style('assets/css/editor.css');

// Example Sidebar

// register_sidebar(array(
// 	'name' => __( 'Blog Sidebar' ),
// 	'id' => 'blog-sidebar',
// 	'description' => __( 'Widgets across blog pages.' ),
// 	'before_title' => '<h6>',
// 	'after_title' => '</h6><div class="widget-block">',
// 	'before_widget' => '<aside id="%1$s" class="widget blog-widget %2$s">',
// 	'after_widget' => '</div></aside>'
// ));

if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
}


function remove_menus(){

  // remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'edit.php' );                   //Posts
  // remove_menu_page( 'upload.php' );                 //Media
  // remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  // remove_menu_page( 'themes.php' );                 //Appearance
  // remove_menu_page( 'plugins.php' );                //Plugins
  // remove_menu_page( 'users.php' );                  //Users
  remove_menu_page( 'tools.php' );                  //Tools
  // remove_menu_page( 'options-general.php' );        //Settings

}
add_action( 'admin_menu', 'remove_menus' );

// Image Sizes
// -------------------------

// add_image_size('small-feature', 270, 180, TRUE);
// add_image_size('med-feature', 470, 215, TRUE);
// add_image_size('cropped-thumbnail', 250, 250, TRUE);

function mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

add_filter( 'mce_buttons_2', 'mce_editor_buttons' );

function mce_before_init( $settings ) {

    $style_formats = array(
        array(
            'title' => 'Button',
            'selector' => 'a',
            'classes' => 'button button-primary'
        ),
		array(
            'title' => 'Collapsed Content',
            'block' => 'div',
            'classes' => 'extended-article'
        )
    );

    $settings['style_formats'] = json_encode($style_formats);

    return $settings;

}

add_filter('tiny_mce_before_init', 'mce_before_init');


// Responsive Embeds
// -------------------------

function base_responsive_embeds($html, $url, $attr, $post_id) {

  return '<div class="embed-container">' . $html . '</div>';

}
add_filter('embed_oembed_html', 'base_responsive_embeds', 99, 4);
