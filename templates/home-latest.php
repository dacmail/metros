<?php 
	$block_posts = new WP_Query(array(
				'posts_per_page' => 3,
				'post__not_in' => $posts_excluded
				)); ?>
<h2 class="block-title <?php echo $term->slug ?>">Destacado</h2>
<div class="row">
<?php while ($block_posts->have_posts()) : $block_posts->the_post(); ?>
	<?php $posts_excluded[] = get_the_ID();  ?>
	<article <?php post_class('col-sm-4'); ?> id="featured-<?php the_ID(); ?>">
		<?php the_post_thumbnail('medium', array('class' => 'image')); ?>
		<?php echo ungrynerd_cat_links(get_the_ID()); ?>
		<h2 class="post-title">
			<a href="<?php the_permalink() ?>" title="Enlace a <?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
		<p class="author-meta"><?php the_author_posts_link(); ?></p>
	</article>
<?php endwhile; ?>
</div>
<?php wp_reset_query(); ?>