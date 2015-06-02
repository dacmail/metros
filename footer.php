	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-2"><a class="logo" href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-footer.jpg" alt="<?php bloginfo('name'); ?>" /></a></div>
				<div class="col-sm-2 col-sm-offset-3">
					<?php wp_nav_menu(array('container' => 'nav', 'container_id' => 'main-menu', 'menu_class' => 'nav navbar-nav', 'theme_location' => 'main-foot')); ?>
				</div>
				<div class="col-sm-5">
					<?php wp_nav_menu(array('container' => 'nav', 'container_id' => 'secondary-menu', 'menu_class' => 'nav navbar-nav', 'theme_location' => 'secondary-foot')); ?>
				</div>
				<div class="col-sm-12 copy">
					Copyright &copy; 2011 Metroscopia. C/ General Yagüe, 6 bis. 28020 Madrid. Tel: 91 701 55 99. Fax: 91 521 06 09 / <a href="#">Política de Privacidad</a> - <a href="http://ungrynerd.com" target="_blank">UNGRYNERD</a> &amp; <a href="http://wordpress.org" target="_blank">WordPress</a>
				</div>
			</div>
		</div>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>