<?php 
	$limit = get_post_meta(get_the_ID(), '_ungrynerd_block_1_count', true);
	$block_posts = new WP_Query(array(
				'post_type' => array('recurso'),
				'posts_per_page' => 3,
				'post__not_in' => $posts_excluded
				)); ?>
<h2 class="block-title <?php echo $term->slug ?>">Recursos</h2>
<div class="row">
<?php while ($block_posts->have_posts()) : $block_posts->the_post(); ?>
	<?php $posts_excluded[] = get_the_ID();  ?>
	<article <?php post_class('col-sm-4'); ?> id="featured-<?php the_ID(); ?>">
		<?php the_post_thumbnail('cat-thumb'); ?>
		<h2 class="post-title">
			<a href="<?php the_permalink() ?>" title="Enlace a <?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
	</article>
<?php endwhile; ?>
</div>
<p class="more"><a href="#">Ver más recursos</a></p>
<?php wp_reset_query(); ?>