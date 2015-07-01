<?php get_header() ?>
<div id="container" <?php body_class('container clearfix'); ?>>
	<div class="row">
		<section class="content-404 col-sm-10 col-sm-offset-1">
			<h2 class="block-title"><?php _e('Lo sentimos, la página que intentas ver no existe.', 'ungrynerd') ?></h2>
			<p><?php _e('Puede ser que se deba a uno de los siguientes motivos:', 'ungrynerd'); ?></p>
			<ul>
				<li><?php _e('Una dirección mal escrita', 'ungrynerd'); ?></li>
				<li><?php _e('Un enlace caducado', 'ungrynerd'); ?></li>
			</ul>
			<p><?php _e('Si quieres puedes usar el buscador:', 'ungrynerd'); ?></p>
			<?php get_search_form(); ?>
		</section>
	</div>
</div>
<?php get_footer() ?>