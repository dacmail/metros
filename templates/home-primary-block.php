<?php 
	$limit = get_post_meta(get_the_ID(), '_ungrynerd_block_1_count', true);
	$term = get_term(get_post_meta(get_the_ID(), '_ungrynerd_block_1_tax', true), get_tax_by_term_id(get_post_meta(get_the_ID(), '_ungrynerd_block_1_tax', true)));
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
<h2 class="block-title <?php echo $term->slug ?>"><?php echo $term->name ?></h2>
<div class="block-wrap">
	<?php include(locate_template('templates/primary-block.php')); ?>
	<p class="more"><?php echo ungrynerd_tax_anchor($term, '', 'Ir a ' . $term->name); ?></p>
</div>
<?php wp_reset_query(); ?>