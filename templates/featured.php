<?php $featured = new WP_Query(array('meta_key' => '_ungrynerd_featured', 'meta_value' => 1, 'post_type'=> array('post'), 'posts_per_page' => -1)); ?>
<?php while ($featured->have_posts()) : $featured->the_post(); ?>
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h1 class="post-title">
			<a href="<?php the_permalink() ?>" title="Enlace a <?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h1>
		<div class="post-content">
			<?php the_content( __('Leer m&aacute;s &raquo;', 'ungrynerd')); ?>
			<?php wp_link_pages(); ?>
		</div>
		<div class="meta"><?php the_tags(); ?></div>
	</article>
<?php endwhile; ?>