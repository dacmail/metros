<!DOCTYPE html>
<html <?php language_attributes(); ?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header id="header">
		<div class="container">
			<div class="row">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mobile-menu">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
			    </button>
				<div class="col-sm-5 logo-wrap"><a class="logo" href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.jpg" alt="<?php bloginfo('name'); ?>" /></a></div>
				<div class="col-sm-7 desktop-menu">
					<?php wp_nav_menu(array('container' => 'nav', 'container_id' => 'main-menu', 'menu_class' => 'nav navbar-nav navbar-right', 'theme_location' => 'main')); ?>
				</div>
				<div class="col-sm-12 desktop-menu">
					<?php wp_nav_menu(array('container' => 'nav', 'container_id' => 'secondary-menu', 'menu_class' => 'nav navbar-nav', 'theme_location' => 'secondary')); ?>
				</div>
				<div class="mobile-menu collapse navbar-collapse width" id="mobile-menu">
					<?php wp_nav_menu(array('container' => 'nav', 'container_id' => 'mobile-main-menu', 'menu_class' => 'nav navbar-nav navbar-right', 'theme_location' => 'main')); ?>
					<?php wp_nav_menu(array('container' => 'nav', 'container_id' => 'mobile-secondary-menu', 'menu_class' => 'nav navbar-nav', 'theme_location' => 'secondary')); ?>
				</div>
			</div>
			
		</div>
		
	</header>