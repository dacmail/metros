<?php 
	//Opciones generales
	add_option('ungrynerd_encuestas_icon', 'fa fa-bar-chart', '', 'yes');
	add_option('ungrynerd_analisis_icon', 'fa fa-search', '', 'yes');
	add_option('ungrynerd_recursos_icon', 'fa fa-pie-chart', '', 'yes');

	// Content width
	if ( ! isset( $content_width ) ) $content_width = 970;

	//Add title tag support
	add_theme_support( 'title-tag' );

	// Comments reply
	if ( is_singular() ) wp_enqueue_script("comment-reply");

	// automatic feed links
	add_theme_support('automatic-feed-links');

	// Definición widgets
	if ( function_exists('register_sidebar') ){
		 register_sidebar(array(
		 	'id' => 'main-sidebar',
		    'before_widget' => '<div id="%1$s" class="widget %2$s">',
		    'after_widget' => '</div>',
		    'before_title' => '<h2 class="block-title">',
		 	'after_title' => '</h2>',
		 	'name' => 'Barra Lateral'
		 ));
	}

	// Definición menús
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
			array(
			  'main' => 'Menu principal',
			  'secondary' => 'Menu secundario',
			  'main-foot' => 'Menu principal (footer)',
			  'secondary-foot' => 'Menu secundario (footer)'
			)
		);
	}

	// Soporte para miniaturas y definición de tamaños
	add_theme_support( 'post-thumbnails' );
	if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'featured-secondary', 800, 800, false );
		add_image_size( 'dato', 400, 290, true );
		add_image_size( 'featured-big', 1200, 1200, false );
	}
?>