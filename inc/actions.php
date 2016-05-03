<?php
	function ungrynerd_skip_ssl_verify($ssl_verify) {
	    return false;
	}
	add_filter('https_ssl_verify', 'ungrynerd_skip_ssl_verify');
	add_filter('https_local_ssl_verify', 'ungrynerd_skip_ssl_verify');

	// Add category slug css class to menu items
	function wpa_category_nav_class( $classes, $item ){
	    if( 'category' == $item->object ){
	        $category = get_category( $item->object_id );
	        $classes[] = 'menu-' . $category->slug;
	    }
	    return $classes;
	}
	add_filter( 'nav_menu_css_class', 'wpa_category_nav_class', 10, 2 );

	//Enqueue scripts and styles
	function ungrynerd_scripts() {
		if( !is_admin()){
			wp_enqueue_style('fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css');
			wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css');
			wp_enqueue_style('carousel-style', get_template_directory_uri() . '/css/owl.carousel.css');
			wp_enqueue_style('ungrynerd-style', get_stylesheet_uri() );

			wp_deregister_script('jquery');

			wp_enqueue_script('jquery','/wp-includes/js/jquery/jquery.js','','',true);
			wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js','','',true);
			wp_enqueue_script('carousel', get_template_directory_uri() . '/js/owl.carousel.min.js','','',true);
			wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.min.js','','',true);

			wp_enqueue_script('ungrynerd-js', get_template_directory_uri() . '/js/default.js', array('jquery'), '1.0.0', true );

			wp_enqueue_script('html5shiv', 'https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js', array(), '3.7.2');
			wp_enqueue_script('respond', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js', array(), '1.4.2');
			
			wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
			wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'ungrynerd_scripts' );

	//Remove emojis support
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	//Remove recent comments styles in head
	function remove_recent_comments_style() {
	    global $wp_widget_factory;
	    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
	}
	add_action('widgets_init', 'remove_recent_comments_style');

	// Oculta la barra de administración
	add_filter( "show_admin_bar", "__return_false" );


	add_filter('get_avatar', 'ungrynerd_get_avatar', 10, 5);
	function ungrynerd_get_avatar($avatar, $id_or_email, $size, $default, $alt) {
		if (is_admin()) {
			$image = $avatar;
		} else {
			$imgpath = get_template_directory() . "/images/avatar/" . $id_or_email . '.jpg';
			$exists = file_exists($imgpath);
			if ($exists) {
				$imgpath = get_template_directory_uri() . "/images/avatar/" . $id_or_email . '.jpg';
				$image = "<img src='".$imgpath."' alt='".$alt."' height='".$size."' width='".$size."' class='avatar avatar-".$size." photo' />";
			} else {
				$image = $avatar;
			}
		}
		return $image;
	}
