<?php
	

		//Meta Boxes
		define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/meta-box' ) );
		define( 'RWMB_DIR', trailingslashit( get_stylesheet_directory() . '/meta-box' ) );
		require_once RWMB_DIR . 'meta-box.php';
		include get_template_directory() . '/inc/widgets.php';
		include get_template_directory() . '/inc/actions.php';
		include get_template_directory() . '/inc/config.php';
		include get_template_directory() . '/inc/posts.php';
		include get_template_directory() . '/inc/meta-boxes.php';
		include get_template_directory() . '/inc/helpers.php';


	// Redirección para no logueados
	add_action('wp','proximamente');
	function proximamente() {
		if ( !is_user_logged_in()) { header("Location: http://metroscopia.org/"); }
	}

?>