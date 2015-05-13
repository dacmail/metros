<?php get_header() ?>
<div id="container" <?php body_class('clearfix'); ?>>
	<section id="content" class="clearfix">
		<h1 class="post-title"><?php _e('La p&aacute;gina que buscas no existe', 'ungrynerd'); ?></h1>
		<p class="post-content"><a href="<?php echo home_url(); ?>"><?php _e('Vuelve a la p&aacute;gina de inicio', 'ungrynerd'); ?></a></p>
	</section>
</div>
<?php get_footer() ?>