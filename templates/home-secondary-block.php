<?php 
	$limit = get_post_meta(get_the_ID(), '_ungrynerd_block_2_count', true);
	$term = get_term(get_post_meta(get_the_ID(), '_ungrynerd_block_2_tax', true), get_tax_by_term_id(get_post_meta(get_the_ID(), '_ungrynerd_block_2_tax', true)));
	$block_posts = new WP_Query(array(
				'tax_query' => array(
					array(
						'taxonomy' => $term->taxonomy,
						'field'    => 'term_id',
						'terms'    => array($term->term_id),
					)
				),
				'posts_per_page' => $limit,
				'post__not_in' => $posts_excluded
				)); ?>
<h2 class="block-title"><?php echo $term->name ?></h2>
<div class="block-wrap">
	<?php while ($block_posts->have_posts()) : $block_posts->the_post(); ?>
		<?php $posts_excluded[] = get_the_ID();  ?>
		<article <?php post_class($block_posts->current_post==($limit-1) ? 'last clearfix' : 'clearfix'); ?> id="featured-<?php the_ID(); ?>">
			<h2 class="post-title">
				<a href="<?php the_permalink() ?>" title="Enlace a <?php the_title_attribute(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			<p class="author-meta"><?php the_author_posts_link(); ?></p>
		</article>
	<?php endwhile; ?>
<p class="more"><?php echo ungrynerd_tax_anchor($term, '', 'Ir a ' . $term->name); ?></p>

</div>

<?php wp_reset_query(); ?>