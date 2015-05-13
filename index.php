<?php get_header() ?>
<div id="container" <?php body_class('clearfix'); ?>>
	<section id="content" class="clearfix">
		<?php get_template_part( 'loop', 'single' ); ?>
	</section>
	<nav class="pagination">
		<?php previous_posts_link( __('Anterior', 'ungrynerd')); ?>
		<?php next_posts_link( __('Siguiente', 'ungrynerd')); ?>
	</nav>
	<?php get_sidebar() ?>
</div>
<?php get_footer() ?>