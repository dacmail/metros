<?php $block_posts = new WP_Query(array(
				'tax_query' => array(
					array(
						'taxonomy' => get_tax_by_term_id(get_post_meta(get_the_ID(), '_ungrynerd_block_1_tax', true)),
						'field'    => 'term_id',
						'terms'    => array(get_post_meta(get_the_ID(), '_ungrynerd_block_1_tax', true)),
					)
				),
				'posts_per_page' => get_post_meta(get_the_ID(), '_ungrynerd_block_1_count', true),
				'post__not_in' => $posts_excluded
				)); ?>
<?php while ($block_posts->have_posts()) : $block_posts->the_post(); ?>
	<?php $posts_excluded[] = get_the_ID();  ?>
	<article <?php post_class(); ?> id="featured-<?php the_ID(); ?>">
		<div class="image"><?php the_post_thumbnail('thumbnail'); ?></div>
		<?php echo ungrynerd_cat_links(get_the_ID()); ?>
		<h2 class="post-title">
			<a href="<?php the_permalink() ?>" title="Enlace a <?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
		<p class="author-meta"><?php the_author_posts_link(); ?></p>
	</article>
<?php endwhile; ?>
<?php wp_reset_query(); ?>