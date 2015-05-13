<?php
	//Meta Boxes
	define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/meta-box' ) );
	define( 'RWMB_DIR', trailingslashit( get_stylesheet_directory() . '/meta-box' ) );
	require_once RWMB_DIR . 'meta-box.php';
	include 'meta-boxes.php';

	//Enqueue scripts and styles
	function ungrynerd_scripts() {
		wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css');
		wp_enqueue_style('ungrynerd-style', get_stylesheet_uri() );

		if( !is_admin()){
			wp_deregister_script('jquery');

			wp_enqueue_script('jquery','/wp-includes/js/jquery/jquery.js','','',true);
			wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js','','',true);
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
		    'before_widget' => '<div id="%1$s" class="widget %2$s">',
		    'after_widget' => '</div>',
		    'before_title' => '<h2 class="title">',
		 	'after_title' => '</h2>',
		 	'name' => 'Barra Lateral'
		 ));
	}

	// Definición menús
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
			array(
			  'main' => 'Menu principal'
			)
		);
	}

	// Soporte para miniaturas y definición de tamaños
	add_theme_support( 'post-thumbnails' );
	if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'featured', 800, 400, true );
	}

	// Redirección para no logueados
	add_action('wp','proximamente');
	function proximamente() {
		if ( !is_user_logged_in()) { header("Location: http://google.com/"); }
	}

	// Oculta la barra de administración
	add_filter( "show_admin_bar", "__return_false" );

	// Listado de comentarios
	function comentarios($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; ?>
	   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	     <article id="comment-<?php comment_ID(); ?>" class="clearfix">
		  <?php echo get_avatar($comment,$size='75' ); ?>
	    	<div class="comment-content">
	    		<h5 class="author">
					<?php comment_author_link(); ?>
					<?php if ($comment->comment_approved == '0') : ?>
			         	<em><?php _e('Your comment is awaiting moderation.', 'ungrynerd') ?></em>
			      	<?php endif; ?>
			      	<?php edit_comment_link(__('(Edit)', 'ungrynerd'),'  ','') ?>
				</h5>
	    		<?php comment_text() ?>
	    	</div>
	     </article>
	<?php
	}
?>